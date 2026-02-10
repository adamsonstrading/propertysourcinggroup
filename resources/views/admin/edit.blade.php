<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property - PSG Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1E4072;
            --primary-pink: #F95CA8;
        }

        body {
            background-color: #f4f6f9;
            padding: 40px;
        }

        .form-card {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .btn-pink {
            background-color: var(--primary-pink);
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
            <h4 class="mb-4">Edit Property</h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Location (e.g. Bradford, BD12)</label>
                    <input type="text" name="location" class="form-control"
                        value="{{ old('location', $property->location) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"
                        required>{{ old('description', $property->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">BMV Percentage (e.g. 24.5)</label>
                        <div class="input-group">
                            <input type="text" name="bmv_percentage" class="form-control"
                                value="{{ old('bmv_percentage', $property->bmv_percentage) }}" required>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Property Image</label>
                        @if($property->image_url)
                            <div class="mb-2">
                                <img src="{{ Str::startsWith($property->image_url, 'http') ? $property->image_url : asset('storage/' . $property->image_url) }}"
                                    height="50" class="rounded">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-pink px-4">Update Property</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>

</html>