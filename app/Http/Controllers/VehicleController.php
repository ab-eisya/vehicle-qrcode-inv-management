<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\PngWriter;

class VehicleController extends Controller
{
    public function index(Request $request) 
    {
        $query = Vehicle::query();

        // Search by brand, model, or variant
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q  ->where('brand', 'like', '%' . $request->search . '%')
                    ->orWhere('model', 'like', '%' . $request->search . '%')
                    ->orWhere('variant', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by manufacture year
        if ($request->filled('manufacture_year')) {
            $query->where('manufacture_year', $request->manufacture_year);
        }

        // Filter by transmission
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Get unique manufacture years for the filter dropdown
        $years = Vehicle::select('manufacture_year')->distinct()->orderBy('manufacture_year', 'desc')->pluck('manufacture_year');

        // Fetch filtered or searched data
        $vehicles = $query->paginate(10); // Use pagination for better performance

        // Pass data to the view
        return view('vehicles.index', compact('vehicles', 'years')); 
    }

    public function create() 
    {
        return view('vehicles.create'); 
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'variant' => 'nullable|string',
            'manufacture_year' => 'required|integer',
            'transmission' => 'required|in:automatic,manual',
        ]);

        // Create a new Vehicle instance
        $vehicle = Vehicle::create($validatedData);

        // Generate QR code for the vehicle
        $qrCode = new QrCode(
            data: route('vehicles.show', $vehicle->id), // Direct route to show the vehicle data
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 200,
            margin: 10
        );

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Ensure the qrcodes directory exists
        $qrCodeDirectory = public_path('qrcodes');
        if (!file_exists($qrCodeDirectory)) {
            mkdir($qrCodeDirectory, 0777, true); // Create directory if it doesn't exist
        }

        // Save the QR code image to the file
        $qrCodePath = 'qrcodes/' . $vehicle->id . '.png';  // Set the QR code path
        $result->saveToFile(public_path($qrCodePath));

        // Store the QR code path in the database
        $vehicle->qr_code = $qrCodePath;
        $vehicle->save();

        // Return the user to the list view with a success message
        return redirect()->route('vehicles.listview')->with('success', 'Vehicle added and QR code generated successfully.');
    }


    public function listview(Request $request)
    {
        $query = Vehicle::query();

        // Filters
        if ($request->filled('brand')) {
            $query->where('brand', 'LIKE', '%' . $request->brand . '%');
        }

        if ($request->filled('model')) {
            $query->where('model', 'LIKE', '%' . $request->model . '%');
        }

        if ($request->filled('variant')) {
            $query->where('variant', 'LIKE', '%' . $request->variant . '%');
        }

        if ($request->filled('manufacture_year')) {
            $query->where('manufacture_year', $request->manufacture_year);
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Get unique manufacture years for the filter dropdown
        $years = Vehicle::select('manufacture_year')->distinct()->orderBy('manufacture_year', 'desc')->pluck('manufacture_year');

        // Fetch data
        $vehicles = $query->get();
        return view('vehicles.listview', compact('vehicles', 'years'));
    }

    //view data and QR code
    public function show($id)
    {
        // Fetch the vehicle data from the database
        $vehicle = Vehicle::findOrFail($id);
        
        // Define the path to the existing QR code based on the vehicle's ID
        $qrCodePath = 'qrcodes/' . $vehicle->id . '.png'; // Assuming QR code is stored as vehicle_id.png in the public folder
    
        // Check if the QR code file exists
        if (!file_exists(public_path($qrCodePath))) {
            // Handle the case if the QR code doesn't exist, maybe redirect with a message
            return redirect()->route('vehicles.listview')->with('error', 'QR code for this vehicle not found.');
        }
    
        // Pass the vehicle data and QR code path to the view
        return view('vehicles.show', compact('vehicle', 'qrCodePath'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'variant' => 'nullable|string',
            'manufacture_year' => 'required|integer',
            'transmission' => 'required|in:automatic,manual',
        ]);

        // Update the vehicle with the validated data
        $vehicle->update($validatedData);

        return redirect()->route('vehicles.listview')->with('success', 'Vehicle data updated successfully.');
    }

    // delete vehicle data
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.listview')->with('success', 'Vehicle deleted.');
    }

    public function qr(Vehicle $vehicle)
    {
        return response()->file(public_path($vehicle->qr_code));
    }
}
