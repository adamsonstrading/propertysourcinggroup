<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team Member - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1E4072;
            --primary-pink: #F95CA8;
        }

        body {
            background-color: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            background-color: var(--primary-blue);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 20px;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid var(--primary-pink);
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
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
            background-color: var(--primary-pink);
            color: white;
            border: none;
        }

        .btn-pink:hover {
            background-color: #d14088;
            color: white;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center mb-4 text-white fw-bold">PSG Admin</h4>
        <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
        <a href="{{ route('admin.services.index') }}"><i class="bi bi-grid-1x2 me-2"></i> Services</a>
        <a href="{{ route('admin.locations.index') }}"><i class="bi bi-geo-alt me-2"></i> Locations</a>
        <a href="{{ route('admin.team.index') }}" class="active"><i class="bi bi-people me-2"></i> Meet The Team</a>
        <a href="#" class="mt-5 text-white-50" onclick="document.getElementById('logout-form').submit();"><i
                class="bi bi-box-arrow-left me-2"></i> Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="form-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Edit Team Member: {{ $member->name }}</h4>
                <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Role (e.g. CEO)</label>
                        <input type="text" name="role" class="form-control" value="{{ old('role', $member->role) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select" required>
                            @foreach(['Leadership Team', 'Investment Team', 'Vendor Team', 'Marketing Team'] as $cat)
                                <option value="{{ $cat }}" {{ $member->category == $cat ? 'selected' : '' }}>{{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control"
                            value="{{ old('sort_order', $member->sort_order) }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Profile Image</label>
                        @if($member->image_url)
                            <div class="mb-2"><img src="{{ asset('storage/' . $member->image_url) }}" height="100"
                                    class="rounded shadow-sm"></div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" class="form-control"
                            value="{{ old('linkedin_url', $member->linkedin_url) }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Short Bio</label>
                        <textarea name="bio" class="form-control" rows="4">{{ old('bio', $member->bio) }}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-pink px-4">Update Member</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</body>

</html>