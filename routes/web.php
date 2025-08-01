<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\AdminController;

// Form Dosen (tanpa login)
Route::get('/form-dosen', [DosenController::class, 'create'])->name('dosen.create');
Route::post('/form-dosen', [DosenController::class, 'store'])->name('dosen.store');

// Form Dosen Jurnal
Route::get('/form-dosen-jurnal', [DosenController::class, 'createJurnal'])->name('dosen.create.jurnal');
Route::post('/form-dosen-jurnal', [DosenController::class, 'storeJurnal'])->name('dosen.store.jurnal');

// Form Dosen PKM
Route::get('/form-dosen-pkm', [DosenController::class, 'createPKM'])->name('dosen.create.pkm');
Route::post('/form-dosen-pkm', [DosenController::class, 'storePKM'])->name('dosen.store.pkm');

// Form Penelitian sesuai jumlah penelitian
Route::get('/form-jurnal/{dosen}', [PenelitianController::class, 'create'])->name('penelitian.create');
Route::post('/form-jurnal/{dosen}', [PenelitianController::class, 'store'])->name('penelitian.store');

// Dashboard Admin (gunakan method dashboard untuk filter kategori)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/dosen/{id}', [AdminController::class, 'detail'])->name('admin.dosen.detail');

// Hapus penelitian (Soft Delete)
Route::delete('/admin/penelitian/{id}', [AdminController::class, 'deletePenelitian'])->name('admin.penelitian.delete');

// Recovery
Route::get('/admin/recovery', [AdminController::class, 'recovery'])->name('admin.recovery');
Route::post('/admin/recovery/{id}/restore', [AdminController::class, 'restore'])->name('admin.recovery.restore');
Route::delete('/admin/recovery/{id}/force', [AdminController::class, 'forceDelete'])->name('admin.recovery.force');

// Redirect root ke form dosen
Route::get('/', function () {
    return redirect()->route('dosen.form.pilihan');
});
Route::get('/form-dosen', function () {
    return view('dosen.form_pilihan');
})->name('dosen.form.pilihan');
