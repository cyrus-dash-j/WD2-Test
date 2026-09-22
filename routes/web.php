<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController; // Imported your Student Controller
use Illuminate\Support\Facades\Route;

// Redirect the root URL straight to your student dashboard if authenticated
Route::get('/', function () {
    return redirect()->route('students.index');
});

// Protected Dashboard Layout Group
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Redirects Breeze's default '/dashboard' route over to your custom student index
    Route::get('/dashboard', function () {
        return redirect()->route('students.index');
    })->name('dashboard');

    // Securely maps all CRUD operations (Index, Create, Store, Show, Edit, Update, Destroy)
    Route::resource('students', StudentController::class);
    
});

// Profile Management routes created by Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';