@extends('layouts.admin')

@section('title', 'Investment Credits')

@section('content')
    <div class="container py-5">
        <!-- Header -->
        <div class="mb-5">
            <h1 class="fw-bold text-blue">Investment Credits</h1>
            <p class="text-muted">Track your progress and rewards.</p>
        </div>

        <!-- Stats Row -->
        <div class="row g-4 mb-5">
            <!-- Balance Card -->
            <div class="col-md-6">
                <div
                    class="card border-0 shadow-sm rounded-4 bg-warning text-white h-100 position-relative overflow-hidden">
                    <div class="card-body p-4 position-relative z-1">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <i class="bi bi-trophy-fill fs-1 text-white-50"></i>
                            <span class="badge bg-white text-warning rounded-pill px-3">Active Balance</span>
                        </div>
                        <h2 class="display-3 fw-bold mb-0">{{ number_format($user->investment_credits ?? 0) }}</h2>
                        <p class="mb-0 opacity-75">Current Investment Credits</p>
                    </div>
                    <!-- Decorative Icon -->
                    <i class="bi bi-trophy-fill position-absolute text-white opacity-25"
                        style="font-size: 10rem; bottom: -2rem; right: -2rem;"></i>
                </div>
            </div>

            <!-- Progress Card -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 bg-white h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-blue mb-4">Earn More Credits</h5>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <h3 class="fw-bold mb-0 text-success">{{ $completedCount % 5 }}/5</h3>
                                <small class="text-muted">Completions in current batch</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success-subtle text-success rounded-pill px-3">+3,000 Credits</span>
                            </div>
                        </div>
                        <div class="progress" style="height: 12px; border-radius: 6px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($completedCount % 5) * 20 }}%"
                                aria-valuenow="{{ ($completedCount % 5) * 20 }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-light rounded-3 d-flex align-items-center">
                            <i class="bi bi-info-circle-fill text-primary me-3 fs-4"></i>
                            <div>
                                <p class="mb-0 small text-muted">Complete <strong>{{ 5 - ($completedCount % 5) }}</strong>
                                    more properties to unlock your next reward of <strong>3,000</strong> credits.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terms Section -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3 border-bottom">
                <h5 class="fw-bold text-blue mb-0"><i class="bi bi-file-text me-2"></i>Completion Rewards Terms</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush rounded-bottom-4">
                    <!-- 5 Completions = 3,000 Credits -->
                    <div class="list-group-item p-4 d-flex align-items-start border-light">
                        <div class="bg-success-subtle text-success rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-check-lg fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">5 Completions = 3,000 Investment Credits</h6>
                            <p class="text-muted small mb-0">Each batch of 5 approved completions earns you 3,000 investment
                                credits automatically.</p>
                        </div>
                    </div>

                    <!-- Rate -->
                    <div class="list-group-item p-4 d-flex align-items-start border-light">
                        <div class="bg-primary-subtle text-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-currency-pound fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Redemption Rate</h6>
                            <p class="text-muted small mb-0">1 Investment Credit = £1 discount on property reservation
                                payments.</p>
                        </div>
                    </div>

                    <!-- Admin Approval -->
                    <div class="list-group-item p-4 d-flex align-items-start border-light">
                        <div class="bg-info-subtle text-info rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-shield-check fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Admin Approval Required</h6>
                            <p class="text-muted small mb-0">Investment credits are earned when completions are verified and
                                approved by an admin.</p>
                        </div>
                        </li>

                        <!-- Restrictions -->
                        <div class="list-group-item p-4 d-flex align-items-start border-light">
                            <div class="bg-warning-subtle text-warning rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <i class="bi bi-exclamation-triangle fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Usage Restrictions</h6>
                                <p class="text-muted small mb-0">Credits can ONLY be used towards property reservation
                                    payments. They have no cash value and cannot be transferred.</p>
                            </div>
                        </div>

                        <!-- Verification -->
                        <div class="list-group-item p-4 d-flex align-items-start border-0">
                            <div class="bg-secondary-subtle text-secondary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <i class="bi bi-search fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Verification</h6>
                                <p class="text-muted small mb-0">All submitted completions are subject to verification.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection