@extends('layouts.app')

@section('content')
    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 text-center">
                        <h2 class="fw-bold text-blue">New Password</h2>
                        <p class="text-muted small">Please enter your new password below to reset your account access.</p>
                    </div>
                    <div class="card-body p-4 p-md-5 pt-2">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm small mb-4">
                                @foreach ($errors->all() as $error)
                                    <div class="mb-0">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-4">
                                <label class="form-label small fw-600 text-uppercase tracking-wider">Email Address</label>
                                <div class="input-group-modern">
                                    <i class="bi bi-envelope icon"></i>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ $email ?? old('email') }}" required readonly>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-600 text-uppercase tracking-wider">New Password</label>
                                <div class="input-group-modern">
                                    <i class="bi bi-lock icon"></i>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••"
                                        required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-600 text-uppercase tracking-wider">Confirm
                                    Password</label>
                                <div class="input-group-modern">
                                    <i class="bi bi-shield-check icon"></i>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="••••••••" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-custom-pink w-100 py-3 mb-3 rounded-3 fw-bold">
                                Reset Password <i class="bi bi-check-circle ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .input-group-modern {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group-modern .icon {
            position: absolute;
            left: 15px;
            color: #adb5bd;
            font-size: 1.1rem;
            z-index: 5;
        }

        .input-group-modern .form-control {
            padding-left: 45px;
            height: 50px;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            background-color: #f8f9fa;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .input-group-modern .form-control:focus {
            background-color: #fff;
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 4px rgba(249, 92, 168, 0.1);
        }

        .fw-600 {
            font-weight: 600;
        }

        .tracking-wider {
            letter-spacing: 0.05em;
        }
    </style>
@endsection