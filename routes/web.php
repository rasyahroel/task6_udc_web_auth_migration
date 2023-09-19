<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/mahasiswas', [MahasiswaController::class, 'index'])->name('mahasiswas')->middleware('auth');
Route::get('/mahasiswa-deleted', [MahasiswaController::class, 'deletedMahasiswa'])->middleware(['auth', 'must-admin-or-teacher']);

Route::get('/mahasiswa-add', [MahasiswaController::class, 'create'])->middleware(['auth', 'must-teacher']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->middleware(['auth', 'must-teacher']);
Route::get('/mahasiswa-edit/{id}', [MahasiswaController::class, 'edit'])->middleware(['auth', 'must-teacher']);
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->middleware(['auth', 'must-teacher']);
Route::get('/mahasiswa-delete/{id}', [MahasiswaController::class, 'delete'])->middleware(['auth', 'must-teacher']);
Route::delete('/mahasiswa-destroy/{id}', [MahasiswaController::class, 'destroy'])->middleware(['auth', 'must-teacher']);
Route::get('/mahasiswa/{id}/restore', [MahasiswaController::class, 'restore'])->middleware(['auth', 'must-teacher']);
Route::get('/mahasiswa/{id}/delete-permanent', [MahasiswaController::class, 'deletePermanent'])->name('mahasiswa.delete-permanent')->middleware(['auth', 'must-teacher']);
