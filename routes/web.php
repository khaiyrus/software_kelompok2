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

Route::get('/dashboard', [AdminController::class, 'index'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
