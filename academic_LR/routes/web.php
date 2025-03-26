<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\TataUsahaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/superadmin', function () {
//     return view('superadmin.index');
// });

Route::get('/superadmin', [UserController::class, 'index'])->name('userList');
Route::get('/superadmin/create', [UserController::class, 'create'])->name('userCreate');
Route::post('/superadmin/create', [UserController::class, 'store'])->name('userStore');
Route::get('/superadmin/create/forms/{role}/{user}', [UserController::class, 'forms'])->name('userCreateForms');
Route::post('/superadmin/create/forms/{role}/{user}', [KaprodiController::class, 'store'])->name('kaprodiStore');

/* Mahasiswa Controller*/
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswaIndex');
Route::get('/mahasiswa/form', [MahasiswaController::class, 'form'])->name('mahasiswaForm');
Route::post('/mahasiswa/form', [MahasiswaController::class, 'forms'])->name('mahasiswaForms');
Route::get('/mahasiswa/pengajuan', [MahasiswaController::class, 'pengajuan'])->name('mahasiswaPengajuan');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
