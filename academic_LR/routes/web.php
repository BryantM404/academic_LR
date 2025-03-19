<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\TataUsahaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.starter');
});

// Route::get('/superadmin', function () {
//     return view('superadmin.index');
// });


Route::get('/superadmin', [UserController::class, 'index'])->name('userList');
Route::get('/superadmin/create', [UserController::class, 'create'])->name('userCreate');
Route::post('/superadmin', [UserController::class, 'store'])->name('userStore');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
