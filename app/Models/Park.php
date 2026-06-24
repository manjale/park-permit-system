<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Park extends Model
{
    protected $fillable = [
        'name',
        'location',
        'description'
    ];

    public function permitPark(){
        return $this->hasMany(Permit::class);
    }

    public function feerules(){
        return $this->hasMany(Feerule::class);
    }
}
