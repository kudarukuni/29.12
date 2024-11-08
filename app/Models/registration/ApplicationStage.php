<?php

namespace App\Models\registration;

use App\Models\settings\Stage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stage()
    {
        return $this->hasOne(Stage::class, 'id', 'stage_id');
    }

    public function application()
    {
        return $this->hasOne(Application::class, 'id', 'application_id');
    }
}
