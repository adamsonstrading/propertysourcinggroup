<?php

use Illuminate\Support\Facades\Route;
use App\Models\Property;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\InquiryController;

// Public Routes
Route::get('/', [FrontController::class, 'index'])->name('home');

// Temporary Fix for Admin Role (Delete after use)
Route::get('/make-me-admin/{email}', function ($email) {
    $user = \App\Models\User::where('email', $email)->first();
    if ($user) {
        $user->role = 'admin';
        $user->save();
        return "User {$email} is now an admin. You can now access /admin/dashboard";
    }
    return "User not found.";
});
Route::get('/services/{slug}', [FrontController::class, 'service'])->name('service.show');

// About Pages
Route::get('/how-it-works', [FrontController::class, 'howItWorks'])->name('how-it-works');
Route::get('/why-choose-us', [FrontController::class, 'whyChooseUs'])->name('why-choose-us');
Route::get('/meet-the-team', [FrontController::class, 'meetTheTeam'])->name('meet-the-team');

// Podcast
Route::get('/podcast', [FrontController::class, 'podcast'])->name('podcast');
Route::get('/become-property-investor', [FrontController::class, 'becomeInvestor'])->name('become-investor');
Route::get('/investor-event', [FrontController::class, 'investorEvent'])->name('investor-event');
Route::get('/recent-investment-properties', [FrontController::class, 'properties'])->name('properties.index');

// News/Blog Frontend Routes
Route::get('/news', [FrontController::class, 'news'])->name('news.index');
Route::get('/news/{slug}', [FrontController::class, 'newsShow'])->name('news.show');

// Contact & FAQ
Route::get('/contact-us', [FrontController::class, 'contact'])->name('contact');
Route::get('/faq', [FrontController::class, 'faq'])->name('faq');

// Inquiry Submission
Route::post('/inquiry/submit', [InquiryController::class, 'store'])->name('inquiry.submit');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('register.submit');



// Available Properties (Logged-in Users)
Route::middleware('auth')->group(function () {
    Route::get('/available-properties', [App\Http\Controllers\AvailablePropertyController::class, 'index'])->name('available-properties.index');
    Route::get('/available-properties/{id}', [App\Http\Controllers\AvailablePropertyController::class, 'show'])->name('available-properties.show');
});

// Admin & Agent Shared Staff Routes
Route::prefix('admin')->middleware(['auth', 'agent'])->name('admin.')->group(function () {
    Route::get('/dashboard', [PropertyController::class, 'index'])->name('dashboard');

    // Available Properties Management
    Route::get('/available-properties', [App\Http\Controllers\AvailablePropertyController::class, 'adminIndex'])->name('available-properties.index');
    Route::get('/available-properties/create', [App\Http\Controllers\AvailablePropertyController::class, 'create'])->name('available-properties.create');
    Route::post('/available-properties', [App\Http\Controllers\AvailablePropertyController::class, 'store'])->name('available-properties.store');
    Route::get('/available-properties/{id}/edit', [App\Http\Controllers\AvailablePropertyController::class, 'edit'])->name('available-properties.edit');
    Route::put('/available-properties/{id}', [App\Http\Controllers\AvailablePropertyController::class, 'update'])->name('available-properties.update');
    Route::post('/available-properties/{id}/status', [App\Http\Controllers\AvailablePropertyController::class, 'updateStatus'])->name('available-properties.update-status');
    Route::delete('/available-properties/{id}', [App\Http\Controllers\AvailablePropertyController::class, 'destroy'])->name('available-properties.destroy');


    // Inquiry Management
    Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{id}', [InquiryController::class, 'show'])->name('inquiries.show');
    Route::delete('/inquiries/{id}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
    Route::post('/inquiries/{id}/mark-read', [InquiryController::class, 'markAsRead'])->name('inquiries.mark-read');
    Route::post('/inquiries/{id}/mark-unread', [InquiryController::class, 'markAsUnread'])->name('inquiries.mark-unread');

    // Admin-Only Routes
    Route::middleware('admin')->group(function () {
        Route::get('/agent-properties', [App\Http\Controllers\AvailablePropertyController::class, 'agentProperties'])->name('agent-properties');

        // Property Management (Manual)
        Route::get('/create', [PropertyController::class, 'create'])->name('create');
        Route::post('/store', [PropertyController::class, 'store'])->name('store');
        Route::get('/edit/{property}', [PropertyController::class, 'edit'])->name('edit');
        Route::delete('/destroy/{property}', [PropertyController::class, 'destroy'])->name('destroy');
        Route::put('/update/{property}', [PropertyController::class, 'update'])->name('update');

        // Service Management using Resource Controller
        Route::resource('services', ServiceController::class);

        // Location Management
        Route::resource('locations', \App\Http\Controllers\LocationController::class);

        // Team Member Management
        Route::resource('team', \App\Http\Controllers\TeamMemberController::class);

        // Blog/News Management
        Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);

        // FAQ Management
        Route::resource('faq', \App\Http\Controllers\Admin\FaqController::class)->names([
            'index' => 'faq.index',
            'create' => 'faq.create',
            'store' => 'faq.store',
            'edit' => 'faq.edit',
            'update' => 'faq.update',
            'destroy' => 'faq.destroy',
        ]);

        // Work Step Management
        Route::resource('work-steps', \App\Http\Controllers\Admin\WorkStepController::class)->names([
            'index' => 'work-steps.index',
            'create' => 'work-steps.create',
            'store' => 'work-steps.store',
            'edit' => 'work-steps.edit',
            'update' => 'work-steps.update',
            'destroy' => 'work-steps.destroy',
        ]);

        // User Management
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::post('/users/{user}/status', [\App\Http\Controllers\Admin\UserController::class, 'updateStatus'])->name('users.status');
        Route::post('/users/{user}/role', [\App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('users.role');
        Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

        // Metadata Management
        Route::resource('property-types', \App\Http\Controllers\Admin\PropertyTypeController::class);
        Route::resource('marketing-purposes', \App\Http\Controllers\Admin\MarketingPurposeController::class);
        Route::resource('unit-types', \App\Http\Controllers\Admin\UnitTypeController::class);
        Route::resource('features', \App\Http\Controllers\Admin\FeatureController::class);
    });
});

// Location Frontend Routes
Route::get('/locations', [FrontController::class, 'locations'])->name('locations.index');
Route::get('/locations/{slug}', [FrontController::class, 'location'])->name('location.show');

// News/Blog Frontend Routes
Route::get('/news', [FrontController::class, 'news'])->name('news.index');
Route::get('/news/{slug}', [FrontController::class, 'newsShow'])->name('news.show');
