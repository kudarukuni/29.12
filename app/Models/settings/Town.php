<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function suburbs()
    {
        return $this->hasMany(Suburb::class, 'municipality_code', 'municipality_code');
    }
}
