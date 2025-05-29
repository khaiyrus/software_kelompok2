<?php
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest');
});
Route::get('/login', [AuthController::class, 'formlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'formregister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
});
Route::middleware(['auth', 'role:panitia'])->prefix('panitia')->name('panitia.')->group(function(){
    Route::view('/dashboard', 'panitia.dashboard')->name('dashboard');
});
Route::middleware(['auth', 'role:kandidat'])->prefix('kandidat')->name('kandidat.')->group(function(){
    Route::view('/profile', 'kandidat.profile')->name('dashboard');
});
