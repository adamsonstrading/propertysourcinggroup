<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Location - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            padding: 40px;
        }

        .form-card {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .btn-pink {
            background-color: #F95CA8;
            color: white;
            border: none;
        }

        .btn-pink:hover {
            background-color: #d14088;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Edit Location: {{ $location->name }}</h4>
                <a href="{{ route('admin.locations.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.locations.update', $location->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Location Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $location->name) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Parent Location (Region)</label>
                        <select name="parent_id" class="form-select">
                            <option value="">None (Top Level Region)</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" {{ $location->parent_id == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $location->slug) }}">
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-pink px-4">Update Location</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>