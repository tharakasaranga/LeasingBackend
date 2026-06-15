<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refinanceapplication extends Model
{
    protected $primaryKey = 'RefinanceID';

    protected $fillable = [
        'ContractID',
        'ApplicationDate',
        'status',
    ];
}
