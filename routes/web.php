<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', ProjectController::class);

    // Nested tasks under projects
    Route::resource('projects.tasks', TaskController::class);

    // Route::get('/task', [TaskController::class, 'index'])->name('task');
    // Route::post('/store', [TaskController::class, 'store'])->name('store');
    // Route::post('/update', [TaskController::class, 'update'])->name('update');
     Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    // Route::post('/store', [ProjectController::class, 'store'])->name('addProject');
    // Route::post('/update', [ProjectController::class, 'update'])->name('updateProject');
    Route::resource('projects.tasks', TaskController::class)->shallow();
});

require __DIR__.'/auth.php';
