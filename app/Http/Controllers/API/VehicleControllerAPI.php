<?php

namespace App\Http\Controllers\API;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleControllerAPI extends Controller
{
    // Fetch all vehicles
    public function indexApi()
    {
        $vehicles = Vehicle::all();
        return response()->json($vehicles);
    }

    // Fetch a single vehicle by ID
    public function showApi($id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle) {
            return response()->json($vehicle);
        } else {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }
    }

    // Create a new vehicle
    public function storeApi(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'manufacture_year' => 'required|integer',
            'color' => 'required|string',
            'vin' => 'required|string|unique:vehicles',
        ]);

        $vehicle = Vehicle::create($validated);

        return response()->json($vehicle, 201);  // 201: Created
    }

    // Update an existing vehicle
    public function updateApi(Request $request, $id)
    {
        $validated = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'manufacture_year' => 'required|integer',
            'color' => 'required|string',
            'vin' => 'required|string|unique:vehicles,vin,' . $id,
        ]);

        $vehicle = Vehicle::find($id);

        if ($vehicle) {
            $vehicle->update($validated);
            return response()->json($vehicle);
        } else {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }
    }

    // Delete a vehicle
    public function destroyApi($id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle) {
            $vehicle->delete();
            return response()->json(['message' => 'Vehicle deleted successfully']);
        } else {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }
    }
}
