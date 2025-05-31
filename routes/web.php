<?php
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest');
})->name('home');
Route::get('/login', [AuthController::class, 'formlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'formregister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
        Route::get('/user', [AdminController::class, 'user'])->name('user');
        Route::get('/user_add', [AdminController::class, 'user_add'])->name('user_add');
        Route::post('/user_add', [AdminController::class, 'user_add_proses'])->name('user_add_proses');

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
        Route::get('/voter_hapus/{id}', [AdminController::class, 'voter_hapus'])->name('voter_hapus');

        Route::get('/voting', [AdminController::class, 'voting'])->name('voting');
        Route::get('/voting_add', [AdminController::class, 'voting_add'])->name('voting_add');
        Route::post('/voting_add', [AdminController::class, 'voting_add_proses'])->name('voting_add_proses');
        Route::get('/voting_edit/{id}', [AdminController::class, 'voting_edit'])->name('voting_edit');
        Route::post('/voting_edit/{id}', [AdminController::class, 'voting_edit_proses'])->name('voting_edit_proses');
        Route::get('/voting_hapus/{id}', [AdminController::class, 'voting_hapus'])->name('voting_hapus');
    });

Route::middleware(['auth', 'role:panitia'])
    ->prefix('panitia')
    ->name('panitia.')
    ->group(function () {
        Route::view('/dashboard', 'panitia.dashboard')->name('dashboard');
    });

Route::middleware(['auth', 'role:kandidat'])
    ->prefix('kandidat')
    ->name('kandidat.')
    ->group(function () {
        Route::view('/dashboard', 'kandidat.dashboard')->name('dashboard');

        Route::get('/profile', [KandidatController::class, 'profile'])->name('profile');
        Route::get('/profile_add', [KandidatController::class, 'profile_add'])->name('add_profile');
        Route::post('/profile_add_proses', [KandidatController::class, 'profile_add_proses'])->name('profile_add_proses');
    });

Route::get('/voting', [VoteController::class, 'formCek'])->name('voting.formCek');
Route::post('/voting', [VoteController::class, 'cek'])->name('voting.cek');
Route::get('/voting/vote', [VoteController::class, 'formVote'])->name('voting.formVote')->middleware('voterCek');
Route::post('/voting/vote', [VoteController::class, 'voteSubmit'])->name('voting.submit')->middleware('voterCek');
Route::get('/voting/result', [VoteController::class, 'result'])->name('voting.result')->middleware('voterCek');
Route::get('/keluar', [VoteController::class, 'keluar'])->name('keluar')->middleware('voterCek');
