<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
   
    public function index()
    {
        return response()->json(Contract::with(['customer', 'vehicle'])->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'CustomerID'    => 'required|exists:customers,CustomerID',
            'VehicleID'     => 'required|exists:vehicles,VehicleID',
            'LoanAmount'    => 'required|numeric',
            'LeasingAmount' => 'required|numeric',
            'status'        => 'sometimes|in:Distributed,Pending,Approval',
        ]);

        $contract = Contract::create($validated);
        return response()->json(['message' => 'Contract created successfully', 'data' => $contract], 201);
    }

    public function show($id)
    {
        $contract = Contract::with(['customer', 'vehicle', 'refinanceApplications'])->find($id);
        if (!$contract) return response()->json(['message' => 'Contract not found'], 404);
        return response()->json($contract, 200);
    }

    public function update(Request $request, $id)
    {
        $contract = Contract::find($id);
        if (!$contract) return response()->json(['message' => 'Contract not found'], 404);

        $validated = $request->validate([
            'CustomerID'    => 'sometimes|exists:customers,CustomerID',
            'VehicleID'     => 'sometimes|exists:vehicles,VehicleID',
            'LoanAmount'    => 'sometimes|numeric',
            'LeasingAmount' => 'sometimes|numeric',
            'status'        => 'sometimes|in:Distributed,Pending,Approval',
        ]);

        $contract->update($validated);
        return response()->json(['message' => 'Contract updated successfully', 'data' => $contract], 200);
    }

    public function destroy($id)
    {
        $contract = Contract::find($id);
        if (!$contract) return response()->json(['message' => 'Contract not found'], 404);

        $contract->delete();
        return response()->json(['message' => 'Contract deleted successfully'], 200);
    }
}