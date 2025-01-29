<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\PngWriter;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define an array of sample vehicle data
        $vehicles = [
            [
                'brand' => 'Toyota',
                'model' => 'Camry',
                'variant' => 'Hybrid',
                'manufacture_year' => 2022,
                'transmission' => 'automatic',
            ],
            [
                'brand' => 'Honda',
                'model' => 'Civic',
                'variant' => 'Sport',
                'manufacture_year' => 2021,
                'transmission' => 'manual',
            ],
            [
                'brand' => 'Ford',
                'model' => 'Mustang',
                'variant' => 'GT',
                'manufacture_year' => 2020,
                'transmission' => 'automatic',
            ],
            [
                'brand' => 'Tesla',
                'model' => 'Model S',
                'variant' => 'Plaid',
                'manufacture_year' => 2023,
                'transmission' => 'automatic',
            ],
            [
                'brand' => 'BMW',
                'model' => 'X5',
                'variant' => 'M Sport',
                'manufacture_year' => 2019,
                'transmission' => 'manual',
            ],
        ];

        // Insert each vehicle and generate its QR code
        foreach ($vehicles as $vehicleData) {
            // Create the vehicle record in the database
            $vehicle = Vehicle::create($vehicleData);

            // Generate a QR code for the vehicle
            $qrCode = new QrCode(
                data: route('vehicles.qr', $vehicle->id), // Use the vehicle's ID in the QR code URL
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::Low,
                size: 200,
                margin: 10
            );

            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            // Save the QR code as an image in the public directory
            $filePath = public_path("qrcodes/vehicle_{$vehicle->id}.png");
            file_put_contents($filePath, $result->getString());

            // Update the vehicle record with the QR code file path (if you have a column for it)
            $vehicle->qr_code = "qrcodes/vehicle_{$vehicle->id}.png";
            $vehicle->save();
        }
    }
}
