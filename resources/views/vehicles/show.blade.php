@extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
</head>

@section('content')
<div class="container">
    <h1>Vehicle Details</h1>

    <div class="row">
        <!-- Vehicle Details -->
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $vehicle->id }}</td>
                </tr>
                <tr>
                    <th>Brand</th>
                    <td>{{ $vehicle->brand }}</td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td>{{ $vehicle->model }}</td>
                </tr>
                <tr>
                    <th>Variant</th>
                    <td>{{ $vehicle->variant }}</td>
                </tr>
                <tr>
                    <th>Manufacture Year</th>
                    <td>{{ $vehicle->manufacture_year }}</td>
                </tr>
                <tr>
                    <th>Transmission</th>
                    <td>{{ ucfirst($vehicle->transmission) }}</td>
                </tr>
            </table>
        </div>

        <!-- QR Code Section -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="{{ asset('qrcodes/' . $vehicle->id . '.png') }}" alt="QR Code" class="img-fluid">
        </div>
    </div>

    <a href="{{ route('vehicles.listview') }}" class="btn btn-secondary mt-4">Back</a>
</div>
@endsection
