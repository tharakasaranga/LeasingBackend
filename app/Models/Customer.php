<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'CustomerID';

    protected $fillable = [
        'CustomerName',
        'NIC',
        'Address',
        'ContactNumber',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'CustomerID', 'CustomerID');
    }
}
