<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RefinanceApplication;
use Illuminate\Http\Request;

class RefinanceApplicationController extends Controller
{
    public function index()
    {
        return response()->json(RefinanceApplication::with('contract')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ContractID'      => 'required|exists:contracts,ContractID',
            'ApplicationDate' => 'required|date',
            'status'          => 'sometimes|in:Distributed,Pending,Approval',
        ]);

        $application = RefinanceApplication::create($validated);
        return response()->json(['message' => 'Refinance Application created successfully', 'data' => $application], 201);
    }

    public function show($id)
    {
        $application = RefinanceApplication::with(['contract', 'rebates'])->find($id);
        if (!$application) return response()->json(['message' => 'Application not found'], 404);
        return response()->json($application, 200);
    }

    public function update(Request $request, $id)
    {
        $application = RefinanceApplication::find($id);
        if (!$application) return response()->json(['message' => 'Application not found'], 404);

        $validated = $request->validate([
            'ContractID'      => 'sometimes|exists:contracts,ContractID',
            'ApplicationDate' => 'sometimes|date',
            'status'          => 'sometimes|in:Distributed,Pending,Approval',
        ]);

        $application->update($validated);
        return response()->json(['message' => 'Application updated successfully', 'data' => $application], 200);
    }

    public function destroy($id)
    {
        $application = RefinanceApplication::find($id);
        if (!$application) return response()->json(['message' => 'Application not found'], 404);

        $application->delete();
        return response()->json(['message' => 'Application deleted successfully'], 200);
    }
}