@extends('layouts.app') 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Vehicle</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>

@section('content')
    <div class="container">
        <h1>Create New Vehicle</h1>

        <form action="{{ route('vehicles.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>

            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" id="model" name="model" required>
            </div>

            <div class="form-group">
                <label for="variant">Variant:</label>
                <input type="text" class="form-control" id="variant" name="variant">
            </div>

            <div class="form-group">
                <label for="manufacture_year">Manufacture Year:</label>
                <input type="number" class="form-control" id="manufacture_year" name="manufacture_year" required>
            </div>

            <div class="form-group">
                <label for="transmission">Transmission:</label>
                <select class="form-control" id="transmission" name="transmission">
                    <option value="automatic">Automatic</option>
                    <option value="manual">Manual</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection