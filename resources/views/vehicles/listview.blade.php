@extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Vehicles</title>
    <link href="{{ asset('css/view.css') }}" rel="stylesheet">
</head>

@section('content')
<div class="container py-5">

    <!-- Filter Section -->
    <form action="{{ route('vehicles.listview') }}" method="GET" class="mb-4">
        <div class="row align-items-end"> <!-- Ensure alignment is correct -->

            <!-- Filter by Brand -->
            <div class="col-md-2">
                <input type="text" name="brand" class="form-control" placeholder="Brand" value="{{ request('brand') }}">
            </div>

            <!-- Filter by Model -->
            <div class="col-md-2">
                <input type="text" name="model" class="form-control" placeholder="Model" value="{{ request('model') }}">
            </div>

            <!-- Filter by Variant -->
            <div class="col-md-2">
                <input type="text" name="variant" class="form-control" placeholder="Variant" value="{{ request('variant') }}">
            </div>

            <!-- Filter by Manufacture Year -->
            <div class="col-md-2">
                <select name="manufacture_year" class="form-control">
                    <option value="">Year</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('manufacture_year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter by Transmission -->
            <div class="col-md-2">
                <select name="transmission" class="form-control">
                    <option value="">Transmission</option>
                    <option value="automatic" {{ request('transmission') == 'automatic' ? 'selected' : '' }}>Automatic</option>
                    <option value="manual" {{ request('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary btn-block">Filter</button>
            </div>

            <!-- Reset Button -->
            <div class="col-md-1">
                <a href="{{ route('vehicles.listview') }}" class="btn btn-secondary btn-block">Reset</a>
            </div>
        </div>
    </form>

    <!-- Table displaying vehicle data -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Variant</th>
                <th>Manufacture Year</th>
                <th>Transmission</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->id }}</td>
                    <td>{{ $vehicle->brand }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->variant }}</td>
                    <td>{{ $vehicle->manufacture_year }}</td>
                    <td>{{ ucfirst($vehicle->transmission) }}</td>
                    <td>
                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No vehicles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
