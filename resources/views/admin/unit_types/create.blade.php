@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Unit Type</h1>
            <a href="{{ route('admin.unit-types.index') }}" class="btn btn-secondary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.unit-types.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="property_type_id" class="form-label fw-bold">Property Type</label>
                        <select name="property_type_id" id="property_type_id" class="form-select" required>
                            <option value="">Select Property Type</option>
                            @foreach($propertyTypes as $type)
                                <option value="{{ $type->id }}" {{ old('property_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label fw-bold">Unit Type Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            placeholder="e.g. Apartment, Villa, Office" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Unit Type</button>
                </form>
            </div>
        </div>
    </div>
@endsection