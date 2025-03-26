<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.starter');
});

Route::get('/1', function () {
  return view('demo.file1');
});

Route::get('/2', [DemoController::class, 'index']);

Route::get('/forms', function () {
    return view('layouts.forms');
});

// Dosen Routes
Route::get('/dosen', [DosenController::class, 'index'])->name('dosenList');
Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosenCreate');
Route::post('/dosen/create', [DosenController::class, 'store'])->name('dosenStore');
Route::get('/dosen/edit/{dosen}', [DosenController::class, 'edit'])->name('dosenEdit');
Route::put('/dosen/edit/{dosen}', [DosenController::class, 'update'])->name('dosenUpdate');
Route::delete('/dosen/delete/{dosen}', [DosenController::class, 'destroy'])->name('dosenDelete');

Route::get('/mhs', [MahasiswaController::class, 'index'])->name('mahasiswaList');
Route::get('/mhs/create', [MahasiswaController::class, 'create'])->name('mahasiswaCreate');
Route::post('/mhs/create', [MahasiswaController::class, 'store'])->name('mahasiswaStore');
Route::get('/mhs/edit/{nrp}', [MahasiswaController::class, 'edit'])->name('mahasiswaEdit');
Route::put('/mhs/edit/{nrp}', [MahasiswaController::class, 'update'])->name('mahasiswaUpdate');
Route::delete('/mhs/delete/{nrp}', [MahasiswaController::class, 'destroy'])->name('mahasiswaDelete');
Route::get('/mhs/detail/{nrp}', [MahasiswaController::class, 'show'])->name('mahasiswaDetail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
