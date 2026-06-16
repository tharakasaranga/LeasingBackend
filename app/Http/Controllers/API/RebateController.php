<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rebate;
use Illuminate\Http\Request;

class RebateController extends Controller
{
    public function index()
    {
        return response()->json(Rebate::with('refinanceApplication')->get(), 200);
    }

    public function byContract($contractId)
    {
        $rebate = Rebate::with('refinanceApplication')
            ->whereHas('refinanceApplication', function ($query) use ($contractId) {
                $query->where('ContractID', $contractId);
            })
            ->orderByDesc('created_at')
            ->orderByDesc('RebateID')
            ->first();

        if (!$rebate) {
            return response()->json(null, 200);
        }

        return response()->json($rebate, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'RefinanceID'                 => 'required|exists:refinanceapplications,RefinanceID',
            'RemainingLoanInterest'       => 'required|numeric',
            'RemainingDeductInterest'     => 'required|numeric',
            'RemainingCapitaliseInterest' => 'required|numeric',
            'TotalInterest'               => 'required|numeric',
            'RebatingInterestPercentage'  => 'required|numeric',
            'RebatingInterestAmount'      => 'required|numeric',
        ]);

        $rebate = Rebate::create($validated);
        return response()->json(['message' => 'Rebate recorded successfully', 'data' => $rebate], 201);
    }

    public function show($id)
    {
        $rebate = Rebate::with('refinanceApplication')->find($id);
        if (!$rebate) return response()->json(['message' => 'Rebate record not found'], 404);
        return response()->json($rebate, 200);
    }

    public function update(Request $request, $id)
    {
        $rebate = Rebate::find($id);
        if (!$rebate) return response()->json(['message' => 'Rebate record not found'], 404);

        $validated = $request->validate([
            'RefinanceID'                 => 'sometimes|exists:refinanceapplications,RefinanceID',
            'RemainingLoanInterest'       => 'sometimes|numeric',
            'RemainingDeductInterest'     => 'sometimes|numeric',
            'RemainingCapitaliseInterest' => 'sometimes|numeric',
            'TotalInterest'               => 'sometimes|numeric',
            'RebatingInterestPercentage'  => 'sometimes|numeric',
            'RebatingInterestAmount'      => 'sometimes|numeric',
        ]);

        $rebate->update($validated);
        return response()->json(['message' => 'Rebate updated successfully', 'data' => $rebate], 200);
    }

    public function destroy($id)
    {
        $rebate = Rebate::find($id);
        if (!$rebate) return response()->json(['message' => 'Rebate record not found'], 404);

        $rebate->delete();
        return response()->json(['message' => 'Rebate deleted successfully'], 200);
    }
}