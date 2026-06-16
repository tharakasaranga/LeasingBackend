<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $primaryKey = 'ContractID';

    protected $fillable = [
        'CustomerID',
        'VehicleID',
        'LoanAmount',
        'LeasingAmount',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID', 'CustomerID');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'VehicleID', 'VehicleID');
    }

    public function refinanceApplications()
    {
        return $this->hasMany(RefinanceApplication::class, 'ContractID', 'ContractID');
    }
}
