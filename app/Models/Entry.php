<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'permit_id',
        'entry_time',
        'exit_time'

    ];

    public function permits(){
        return $this->belongsTo(Permit::class, 'permit_id');
    }
}
