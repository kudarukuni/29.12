<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function suburb()
    {
        return $this->belongsTo(Suburb::class, 'locality_code', 'locality_code');
    }
}
