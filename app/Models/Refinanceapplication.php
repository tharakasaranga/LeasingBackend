<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefinanceApplication extends Model
{
    protected $table = 'refinanceapplications';

    protected $primaryKey = 'RefinanceID';

    protected $fillable = [
        'ContractID',
        'ApplicationDate',
        'status',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'ContractID', 'ContractID');
    }

    public function rebates()
    {
        return $this->hasMany(Rebate::class, 'RefinanceID', 'RefinanceID');
    }
}
