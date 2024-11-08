<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suburb extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function town()
    {
        return $this->belongsTo(Town::class, 'municipality_code', 'municipality_code');
    }

    public function streets()
    {
        return $this->hasMany(Street::class, 'locality_code', 'locality_code');
    }
}
