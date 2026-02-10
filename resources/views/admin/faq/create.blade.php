<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add FAQ - PSG Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
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
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: 0 auto;
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
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center mb-4 text-white fw-bold">PSG Admin</h4>
        <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
        <a href="{{ route('admin.services.index') }}"><i class="bi bi-grid-1x2 me-2"></i> Services</a>
        <a href="{{ route('admin.locations.index') }}"><i class="bi bi-geo-alt me-2"></i> Locations</a>
        <a href="{{ route('admin.team.index') }}"><i class="bi bi-people me-2"></i> Meet The Team</a>
        <a href="{{ route('admin.news.index') }}"><i class="bi bi-newspaper me-2"></i> Blogs / News</a>
        <a href="{{ route('admin.faq.index') }}" class="active"><i class="bi bi-question-circle me-2"></i> FAQ</a>
        <a href="#" class="mt-5 text-white-50" onclick="document.getElementById('logout-form').submit();"><i
                class="bi bi-box-arrow-left me-2"></i> Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="form-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Add New FAQ</h4>
                <a href="{{ route('admin.faq.index') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.faq.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Question</label>
                    <input type="text" name="question" class="form-control" value="{{ old('question') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Answer</label>
                    <textarea name="answer" class="form-control" rows="5" required>{{ old('answer') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-pink btn-lg py-3 fw-bold">Save FAQ</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>