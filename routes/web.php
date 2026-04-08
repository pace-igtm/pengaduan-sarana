<?php 
 
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\SiswaController; 
use App\Http\Controllers\AdminController; 
 
// Route Login & Logout 
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']); 
Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); 
 
// Route Khusus SISWA (Wajib Login sebagai Siswa) 
Route::middleware(['auth:siswa'])->group(function () { 
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard'); 
    Route::post('/siswa/lapor', [SiswaController::class, 'store'])->name('siswa.store'); 
}); 
 
// Route Khusus ADMIN (Wajib Login sebagai Admin) 
Route::middleware(['auth:admin'])->group(function () { 
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard'); 
    Route::post('/admin/update/{id}', [AdminController::class, 'updateStatus'])->name('admin.update'); 
}); 
 
// Redirect halaman awal ke login 
Route::get('/', function () { 
    return redirect('/login'); 
}); 