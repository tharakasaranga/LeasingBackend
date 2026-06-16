<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rebate extends Model
{
    protected $fillable = [
        'RefinanceID',
        'RemainingLoanInterest',
        'RemainingDeductInterest',
        'RemainingCapitaliseInterest',
        'TotalInterest',
        'RebatingInterestPercentage',
        'RebatingInterestAmount',
    ];

    public function refinanceApplication()
    {
        return $this->belongsTo(RefinanceApplication::class, 'RefinanceID', 'RefinanceID');
    }
}
