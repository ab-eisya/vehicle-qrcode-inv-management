@extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Inventory</title>
    <!-- Include CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="hero-section" style="background-image: url('{{ asset('car-image.jpg') }}');">
        <div>
            <h1>Welcome, {{ Auth::user()->name }}</h1> <!-- Display the logged-in user's name -->
            <p>Vehicle Inventory Management</p>
        </div>
    </div>

    <!-- Inventory Management Section -->
    <div class="inventory-section text-center">
        <h2>Manage your inventory</h2>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Add Vehicle</a>
            <a href="{{ route('vehicles.listview') }}" class="btn btn-secondary">View List</a>
        </div>
    </div>
</div>
@endsection
