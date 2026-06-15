<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return response()->json(Vehicle::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Brand' => 'required|string|max:255',
            'Model' => 'required|string|max:255',
        ]);

        $vehicle = Vehicle::create($validated);
        return response()->json(['message' => 'Vehicle added successfully', 'data' => $vehicle], 201);
    }

    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        if (!$vehicle) return response()->json(['message' => 'Vehicle not found'], 404);
        return response()->json($vehicle, 200);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);
        if (!$vehicle) return response()->json(['message' => 'Vehicle not found'], 404);

        $validated = $request->validate([
            'Brand' => 'sometimes|string|max:255',
            'Model' => 'sometimes|string|max:255',
        ]);

        $vehicle->update($validated);
        return response()->json(['message' => 'Vehicle updated successfully', 'data' => $vehicle], 200);
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        if (!$vehicle) return response()->json(['message' => 'Vehicle not found'], 404);

        $vehicle->delete();
        return response()->json(['message' => 'Vehicle deleted successfully'], 200);
    }
}