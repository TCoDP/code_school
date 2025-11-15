<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Landing');
})->name('home');

// SEO routes
Route::get('/sitemap.xml', [App\Http\Controllers\SeoController::class, 'sitemap'])
    ->name('sitemap');
Route::get('/robots.txt', [App\Http\Controllers\SeoController::class, 'robots'])
    ->name('robots');

// Legal pages
Route::get('/privacy-policy', [App\Http\Controllers\LegalController::class, 'privacyPolicy'])
    ->name('privacy-policy');
Route::get('/terms-of-service', [App\Http\Controllers\LegalController::class, 'termsOfService'])
    ->name('terms-of-service');

// Admin routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('assignments', App\Http\Controllers\Admin\AssignmentController::class);
    Route::resource('materials', App\Http\Controllers\Admin\MaterialController::class);
});

Route::get('dashboard', function (Request $request) {
    $user = $request->user();
    
    // Редирект в зависимости от роли
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    
    return redirect()->route('student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('student')->name('student.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Student\StudentDashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('courses', [App\Http\Controllers\Student\StudentDashboardController::class, 'index'])
        ->name('courses');
    Route::get('courses/{course}/lessons', [App\Http\Controllers\Student\CourseLessonsController::class, 'show'])
        ->name('courses.lessons');
    Route::get('homeworks', [App\Http\Controllers\Student\StudentDashboardController::class, 'index'])
        ->name('homeworks');
    Route::get('chat', [App\Http\Controllers\Student\StudentDashboardController::class, 'index'])
        ->name('chat');
    Route::get('materials', [App\Http\Controllers\Student\StudentDashboardController::class, 'index'])
        ->name('materials');
    Route::get('certificates', [App\Http\Controllers\Student\StudentDashboardController::class, 'index'])
        ->name('certificates');

    // Certificate routes
    Route::get('certificates/{certificate}/download', [App\Http\Controllers\Student\CertificateController::class, 'download'])
        ->name('certificates.download');
    Route::get('certificates/{certificate}/share', [App\Http\Controllers\Student\CertificateController::class, 'share'])
        ->name('certificates.share');
});

require __DIR__ . '/settings.php';
