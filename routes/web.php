<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $students = \App\Models\Student::query()->latest()->take(3)->get();

    return view('welcome', compact('students'));
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('students.index');
    })->name('dashboard');
});

Route::resource('students', StudentController::class)->only(['index']);

Route::middleware('auth')->group(function () {
    Route::resource('students', StudentController::class)->only([
        'create',
        'store',
        'edit',
        'update',
        'destroy',
    ]);
});

Route::resource('students', StudentController::class)->only(['show']);

// Profile Management routes created by Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';