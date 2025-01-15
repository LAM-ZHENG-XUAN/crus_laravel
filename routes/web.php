<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');
Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::post('/projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');
Route::get('/users/create', [RegisteredUserController::class, 'create'])->name('users.create');
Route::post('/users', [RegisteredUserController::class, 'store'])->name('users.store');
Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.view');
Route::get('/users/{id}', [RegisteredUserController::class, 'show'])->name('users.show'); // View single user
Route::get('/users/{id}/edit', [RegisteredUserController::class, 'edit'])->name('users.edit'); // Edit user
Route::delete('/users/{id}', [RegisteredUserController::class, 'destroy'])->name('users.destroy'); // Delete user
Route::put('/users/{id}', [RegisteredUserController::class, 'update'])->name('users.update');
// Update an existing project
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');

Route::delete('projects/{project}/destroy', [ProjectController::class, 'destroy'])->name('projects.destroy');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
