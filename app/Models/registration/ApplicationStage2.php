<?php

namespace App\Models\registration;

use App\Models\settings\Stage2;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStage2 extends Model{
    use HasFactory;
    protected $guarded = [];
    public function stage(){
        return $this->hasOne(Stage2::class, 'id', 'stage_id');
    }
    public function application(){
        return $this->hasOne(Application2::class, 'id', 'application_id');
    }
}
