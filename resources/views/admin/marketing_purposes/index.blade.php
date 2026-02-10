@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Marketing Purposes</h1>
            <a href="{{ route('admin.marketing-purposes.create') }}" class="btn btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marketingPurposes as $purpose)
                                <tr>
                                    <td>{{ $purpose->id }}</td>
                                    <td>{{ $purpose->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.marketing-purposes.edit', $purpose->id) }}"
                                            class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                        <form action="{{ route('admin.marketing-purposes.destroy', $purpose->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i>
                                                Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $marketingPurposes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection