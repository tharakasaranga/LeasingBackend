<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refinanceapplication extends Model
{
    //
    protected $fillable = [
        'ContractID',
        'ApplicationDate',
        'status',
    ];
}
