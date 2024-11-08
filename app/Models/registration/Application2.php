<?php

namespace App\Models\registration2;

use App\Models\settings\Street;
use App\Models\settings\Suburb;
use App\Models\settings\Town;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Application2 extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->reference = self::generateUniqueReferenceNumber();
        });
    }

    public static function generateUniqueReferenceNumber()
    {
        do {
            $reference = Str::upper(Str::random(6));
        } while (self::where('reference', $reference)->exists());

        return $reference;
    }

    public function stages()
    {
        return $this->hasMany(ApplicationStage2::class, 'application_id', 'id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('id_number', 'like', '%' . $search . '%')
                ->orWhere('account_number', 'like', '%' . $search . '%')
                ->orWhere('company_reg', 'like', '%' . $search . '%')
                //->orWhere('address_individual', 'like', '%' . $search . '%')
                //->orWhere('address_company', 'like', '%' . $search . '%')
                ->orWhere('phone_number', 'like', '%' . $search . '%')
                ->orWhere('phone_number_2', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('proposed_capacity', 'like', '%' . $search . '%')
                ->orWhere('generation_licence', 'like', '%' . $search . '%')
                ->orWhere('existing_capacity', 'like', '%' . $search . '%')
                ->orWhere('inverter_make', 'like', '%' . $search . '%')
                ->orWhere('inverter_model', 'like', '%' . $search . '%')
                ->orWhere('reference', 'like', '%' . $search . '%');
        });
    }

    public function street()
    {
        return $this->hasOne(Street::class, 'street_code', 'street_code');
    }

    public function suburb()
    {
        return $this->hasOne(Suburb::class, 'locality_code', 'locality_code');
    }

    public function town()
    {
        return $this->hasOne(Town::class, 'municipality_code', 'municipality_code');
    }

    public function streetName()
    {
        return $this->street->street_name;
    }

    public function suburbName()
    {
        return $this->suburb->locality_name;
    }

    public function townName()
    {
        return $this->town->municipality_name;
    }

    public function address()
    {
        return $this->stand_no . ' ' . $this->streetName() . ', ' . $this->suburbName() . ', ' . $this->townName();
    }

//    public function passed()
//    {
//        // Get all applications.
//        $applications = Application::all();
//
//        // Filter applications based on the last stage being passed and having no further stages created.
//        $completedApplications = $applications->filter(function ($application) {
//            // Get the last application stage based on the stage order at the time of completion.
//            $lastApplicationStage = $application->stages()
//                ->where('created_at', '<=', $application->updated_at) // Limit to stages created before the application was last updated
//                ->orderBy('stage_id', 'desc')
//                ->first();
//
//            // Check if the last stage is passed and if there are no further stages created after the last updated time.
//            return $lastApplicationStage &&
//                $lastApplicationStage->state === 'passed' &&
//                !$application->stages()
//                    ->where('created_at', '>', $lastApplicationStage->created_at)
//                    ->exists();
//        });
//
//        return $completedApplications;
//    }
    public function passed()
    {
        $applicationStages = $this->stages;
        if ($applicationStages->contains(function ($applicationStage) {
            return $applicationStage->state === 'pending' || $applicationStage->state === 'failed';
        })) {
            return false;
        }
        return true;
    }

    public function pending()
    {
        $applicationStages = $this->stages;
        if ($applicationStages->contains(function ($applicationStage) {
            return $applicationStage->state === 'pending';
        })) {
            return true;
        }
        return false;
    }

    public function failed()
    {
        $applicationStages = $this->stages;
        if ($applicationStages->contains(function ($applicationStage) {
            return $applicationStage->state === 'failed';
        })) {
            return true;
        }
        return false;
    }

    public static function countPassedApplications()
    {
        $applications = Application2::all();
        $i=0;
        foreach ($applications as $application) {
            if ($application->passed()) {
                $i++;
            }
        }
        return $i;
    }

    public static function countFailedApplications()
    {
        $applications = Application2::all();
        $i=0;
        foreach ($applications as $application) {
            if ($application->failed()) {
                $i++;
            }
        }
        return $i;
    }

    public static function countPendingApplications()
    {
        $applications = Application2::all();
        $i=0;
        foreach ($applications as $application) {
            if ($application->pending()) {
                $i++;
            }
        }
        return $i;
    }

    public function scopeReturnPending(Builder $query)
    {
        return $query->whereHas('stages', function ($query) {
            $query->where('state', 'pending');
        });
    }

    public function scopeReturnFailed(Builder $query)
    {
        return $query->whereHas('stages', function ($query) {
            $query->where('state', 'failed');
        });
    }

    public function scopeReturnPassed(Builder $query)
    {
        return $query->whereDoesntHave('stages', function ($query) {
            $query->whereIn('state', ['pending', 'failed']);
        });
    }


}
