<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ManageUController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Public routes
Route::resource('courses', CourseController::class); // For course management (index, create, store, etc.)

Route::post('courses/{course}/feedbacks', [FeedbackController::class, 'store'])->name('feedbacks.store');
Route::post('feedbacks/{feedback}/vote', [VoteController::class, 'store'])->name('votes.store');

// Course detail route
Route::get('/course/{id}', [CourseController::class, 'show'])->name('course.show');

// Auth routes
Auth::routes();
// Admin routes (middleware for authenticated admins)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [ManageUController::class, 'index'])->name('admin.index');
    Route::get('/admin/courses/create', [ManageUController::class, 'create'])->name('courses.create');
    Route::post('/admin/courses', [ManageUController::class, 'store'])->name('courses.store');
    Route::get('/admin/courses/{course}/edit', [ManageUController::class, 'edit'])->name('courses.edit');
    Route::put('/admin/courses/{course}', [ManageUController::class, 'update'])->name('courses.update');
    Route::delete('/admin/courses/{course}', [ManageUController::class, 'destroy'])->name('courses.destroy');
    // pour gerer les feedbacks
    Route::get('/admin/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('/admin/feedbacks/{id}', [FeedbackController::class, 'show'])->name('feedbacks.show'); // Route pour afficher un feedback
    Route::delete('/admin/feedbacks/{id}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit'); // Afficher le profil
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update'); // Modifier le profil
});

// logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//reset password
Auth::routes(['password/reset' => true]); 

