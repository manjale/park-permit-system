<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'permit_id',
        'amount',
        'reference_no',
        'status'

    ];


    public function permits(){
        return $this->belongsTo(Permit::class, 'permit_id');
    }
}
