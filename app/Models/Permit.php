<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    protected $fillable = [
        'permit_no',
        'user_id',
        'park_id',
        'visit_date',
        'status',
        'total_amount'

    ];

    public function users(){
        return $this->belongTo(User::class, 'user_id');
    }

    public function parks(){
        return $this->belongTo(Park::class, 'park_id');
    }

    public function entries(){
        return $this->hasOne(Entry::class);
    }
    public function permiteditems(){
        return $this->hasMany(Permititem::class);
    }
}
