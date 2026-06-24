<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feerule extends Model
{
    protected $fillable =[
        'park_id',
        'visitor_type',
        'amount'

    ];


    public function parks(){
        return $this->belongsTo(Park::class, 'park_id');
    }
}
