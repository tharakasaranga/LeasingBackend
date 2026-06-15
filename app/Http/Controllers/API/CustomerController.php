<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
    public function index()
    {
        return response()->json(Customer::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'CustomerName' => 'required|string|max:255',
            'NIC'          => 'required|string|unique:customers,NIC',
            'Address'      => 'required|string',
            'ContactNumber'=> 'required|string',
        ]);

        $customer = Customer::create($validated);
        return response()->json(['message' => 'Customer created successfully', 'data' => $customer], 201);
    }

    
    public function show($id)
    {
        $customer = Customer::with('contracts')->find($id);
        if (!$customer) return response()->json(['message' => 'Customer not found'], 404);
        return response()->json($customer, 200);
    }

   
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) return response()->json(['message' => 'Customer not found'], 404);

        $validated = $request->validate([
            'CustomerName' => 'sometimes|string|max:255',
            'NIC'          => 'sometimes|string|unique:customers,NIC,'.$id.',CustomerID',
            'Address'      => 'sometimes|string',
            'ContactNumber'=> 'sometimes|string',
        ]);

        $customer->update($validated);
        return response()->json(['message' => 'Customer updated successfully', 'data' => $customer], 200);
    }

   
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) return response()->json(['message' => 'Customer not found'], 404);
        
        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}