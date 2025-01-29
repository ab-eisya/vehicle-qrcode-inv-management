@extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>

@section('content')
    <div class="container">
        <!-- Back Button -->
        <h1>Edit Vehicle</h1>

        <form action="{{ route('vehicles.update', $vehicle) }}" method="POST" id="edit-form">
            @csrf
            @method('PUT') 

            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $vehicle->brand) }}" required>
                @error('brand')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $vehicle->model) }}" required>
                @error('model')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="variant">Variant:</label>
                <input type="text" class="form-control" id="variant" name="variant" value="{{ old('variant', $vehicle->variant) }}">
            </div>

            <div class="form-group">
                <label for="manufacture_year">Manufacture Year:</label>
                <input type="number" class="form-control" id="manufacture_year" name="manufacture_year" value="{{ old('manufacture_year', $vehicle->manufacture_year) }}" required>
                @error('manufacture_year')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="transmission">Transmission:</label>
                <select class="form-control" id="transmission" name="transmission">
                    <option value="automatic" {{ old('transmission', $vehicle->transmission) == 'automatic' ? 'selected' : '' }}>Automatic</option>
                    <option value="manual" {{ old('transmission', $vehicle->transmission) == 'manual' ? 'selected' : '' }}>Manual</option>
                </select>
                @error('transmission')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-danger" id="delete-button">Delete</button>
            </div>
        </form>

        <form id="delete-form" action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButton = document.querySelector('.btn-danger');
        const deleteForm = document.getElementById('delete-form');

        if (deleteButton && deleteForm) {
            deleteButton.addEventListener('click', function () {
                const confirmed = confirm('Are you sure you want to delete this vehicle data?');
                if (confirmed) {
                    deleteForm.submit();
                }
            });
        } else {
            console.error('Delete button or form not found');
        }
    });
</script>
@endpush
