<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\TataUsahaController;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/superadmin', function () {
//     return view('superadmin.index');
// });
Route::middleware(['auth'])->group(function(){

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware(['role:1'])->group(function (){
        Route::get('/superadmin', [UserController::class, 'index'])->name('userList');
        Route::get('/superadmin/create', [UserController::class, 'create'])->name('userCreate');
        Route::post('/superadmin/create', [UserController::class, 'store'])->name('userStore');
        Route::get('/superadmin/create/forms/{role}/{user}', [UserController::class, 'forms'])->name('userCreateForms');
        Route::post('/superadmin/create/forms/{role}/{user}', [KaprodiController::class, 'store'])->name('kaprodiStore');
        
        Route::post('/superadmin/create/forms/tataUsaha/{user}', [TataUsahaController::class, 'store'])->name('tataUsahaStore');
        Route::post('/superadmin/create/forms/mahasiswa/{user}', [MahasiswaController::class, 'store'])->name('mahasiswaStore');
        Route::delete('/superadmin/delete/{id}', [UserController::class, 'destroy'])->name('userDelete');
        Route::get('/superadmin/edit/{id}', [UserController::class, 'edit'])->name('userEdit');
        Route::put('/superadmin/edit/{id}', [UserController::class, 'update'])->name('userUpdate');
        
        Route::get('/superadmin/create/forms/{role}/{user}', [UserController::class, 'editForms'])->name('userEditForms');
        Route::put('/superadmin/create/forms/kaprodi/{user}', [KaprodiController::class, 'updateStore'])->name('kaprodiEditStore');
        Route::put('/superadmin/create/forms/tataUsaha/{user}', [TataUsahaController::class, 'updateStore'])->name('tataUsahaEditStore');
        Route::put('/superadmin/create/forms/mahasiswa/{user}', [MahasiswaController::class, 'updateStore'])->name('mahasiswaEditStore');
    });
    
    Route::middleware(['role:2'])->group(function (){
        Route::get('/kaprodi/pengajuan', [PengajuanSuratController::class, 'indexKaprodi'])->name('pengajuanListKaprodi'); // nampilin list pengajuan di kaprodi
        Route::get('/kaprodi/pengajuan/detail/{id}', [PengajuanSuratController::class, 'detailKaprodi'])->name('pengajuanDetailKaprodi'); // nampilin pengajuan detail
        Route::post('/kaprodi/pengajuan/accpeted/{id}', [PengajuanSuratController::class, 'accepted'])->name('pengajuanAccepted');
        Route::post('/kaprodi/pengajuan/rejected/{id}', [PengajuanSuratController::class, 'rejected'])->name('pengajuanRejected');
    });

    Route::middleware(['role:4'])->group(function (){
        /* Mahasiswa Controller*/
        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswaIndex');
        Route::get('/mahasiswa/form', [MahasiswaController::class, 'form'])->name('mahasiswaForm'); // nampilin form milih jenis usrat
        Route::post('/mahasiswa/form', [MahasiswaController::class, 'forms'])->name('mahasiswaForms'); // nampilin form sesuai jenis surat 
        Route::post('/mahasiswa/forms', [PengajuanSuratController::class, 'store'])->name('formsStore'); // nyimpen data pengajuan
        
        Route::get('/mahasiswa/pengajuan', [PengajuanSuratController::class, 'indexMahasiswa'])->name('pengajuanList'); // nampilin histori pengajuan
        Route::get('/mahasiswa/pengajuan/detail/{id}', [PengajuanSuratController::class, 'detail'])->name('pengajuanDetail'); // nampilin pengajuan detail
        Route::get('/mahasiswa/pengajuan/edit/{id}', [PengajuanSuratController::class, 'edit'])->name('pengajuanEdit'); // nampilin form edit pengajuan 
        Route::post('/mahasiswa/pengajuan/edit/{id}', [PengajuanSuratController::class, 'update'])->name('pengajuanUpdate'); // simpan edit pengajuan gpke put
        Route::delete('/mahasiswa/pengajuan/delete/{id}', [PengajuanSuratController::class, 'delete'])->name('pengajuanDelete'); // delete pengajuan
    });

    Route::middleware(['role:2,3,4'])->group(function (){
        Route::get('/pengajuan/filter=1', [PengajuanSuratController::class, 'filter1'])->name('pengajuanFilter1');
        Route::get('/pengajuan/filter=2', [PengajuanSuratController::class, 'filter2'])->name('pengajuanFilter2');
        Route::get('/pengajuan/filter=3', [PengajuanSuratController::class, 'filter3'])->name('pengajuanFilter3');
        Route::get('/pengajuan/filter=4', [PengajuanSuratController::class, 'filter4'])->name('pengajuanFilter4');
    });

});

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'role:1,2,3,4'])->name('dashboard');

Route::get('/check-user', function () {
    return response()->json(Auth::user()); // Lihat user yang sedang login
});

require __DIR__.'/auth.php';