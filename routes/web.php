<?php
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest');
})->name('home');
Route::get('/login', [AuthController::class, 'formlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'formregister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::get('/user', [AdminController::class, 'user'])->name('user');



    Route::get('/kandidat', [AdminController::class, 'kandidat'])->name('kandidat');

    Route::get('/wilayah', [AdminController::class, 'wilayah'])->name('wilayah');
    Route::get('/wilayah_add', [AdminController::class, 'wilayah_add'])->name('wilayah_add');
    Route::post('/wilayah_add', [AdminController::class, 'wilayah_add_proses'])->name('wilayah_add_proses');
    Route::get('/wilayah_edit/{id}', [AdminController::class, 'wilayah_edit'])->name('wilayah_edit');
    Route::get('/wilayah_hapus/{id}', [AdminController::class, 'wilayah_hapus'])->name('wilayah_hapus');
    Route::post('/wilayah_edit/{id}', [AdminController::class, 'wilayah_edit_proses'])->name('wilayah_edit_proses');

    Route::get('/voter', [AdminController::class, 'voter'])->name('voter');
    Route::get('/voter_add', [AdminController::class, 'voter_add'])->name('voter_add');
    Route::post('/voter_add', [AdminController::class, 'voter_add_proses'])->name('voter_add_proses');
    Route::get('/voter_edit/{id}', [AdminController::class, 'voter_edit'])->name('voter_edit');
    Route::post('/voter_edit/{id}', [AdminController::class, 'voter_edit_proses'])->name('voter_edit_proses');
});


Route::middleware(['auth', 'role:panitia'])->prefix('panitia')->name('panitia.')->group(function(){
    Route::view('/dashboard', 'panitia.dashboard')->name('dashboard');

});

Route::middleware(['auth', 'role:kandidat'])->prefix('kandidat')->name('kandidat.')->group(function(){
    Route::view('/profile', 'kandidat.profile')->name('dashboard');
});
Route::get('/voting', function (){
    return view('voting');
})->name('voting');
