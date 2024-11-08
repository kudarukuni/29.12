<?php

namespace App\Models\settings;

use App\Models\registration\ApplicationStage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stage) {
            // Automatically set the order to +1 of the current highest order
            $stage->order = Stage::max('order') + 1;
        });
    }

    public function pending()
    {
        return $this->hasMany(ApplicationStage::class, 'stage_id', 'id')
            ->where('state', 'pending')
            ->get();
    }

    public function getLastStage()
    {
        $stage = Stage::where('status', 1)->orderBy('order', 'desc')->first();
        return $stage;
    }
}
