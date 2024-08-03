<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

// Route::get('/', 'UserController@index');
// Route::get('/',[UserController::class, 'index']);
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/tambah', [UserController::class, 'tambah'])->name('user.tambah');
Route::post('/user/tambah/aksi', [UserController::class, 'aksi'])->name('user.aksi');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.hapus');

Route::get('/user/tong', [UserController::class, 'tong'])->name('user.tong');
Route::get('/user/kembalikan/{id}', [UserController::class, 'kembalikan'])->name('user.kembalikan');
Route::get('/user/hapus_permanen/{id}', [UserController::class, 'hapus_permanen'])->name('user.hapus_permanen');