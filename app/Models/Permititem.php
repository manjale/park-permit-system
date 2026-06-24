<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permititem extends Model
{
    protected $fillable = [
        'permit_id',
        'visitor_name',
        'visitor_type',
        'quantity',
        'unit_price',
        'subtotal'

    ];

    public function permits(){
        return $this->belongTo(Permit::class, 'permit_id');
    }
}
