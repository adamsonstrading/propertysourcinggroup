@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Property Feature</h1>
            <a href="{{ route('admin.features.index') }}" class="btn btn-secondary shadow-sm"><i
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
                <form action="{{ route('admin.features.update', $feature->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $feature->name) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Feature</button>
                </form>
            </div>
        </div>
    </div>
@endsection