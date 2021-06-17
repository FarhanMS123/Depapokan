<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepapokanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DepapokanController::class, 'index']);

Route::get('/tambah', [DepapokanController::class, 'viewTambah'])->name('tambah');
Route::post('/tambah', [DepapokanController::class, 'tambah']);

Route::get('/item/{id}', [DepapokanController::class, 'viewUbah'])->name('ubah');
Route::patch('/item/{id}', [DepapokanController::class, 'ubah']);
Route::delete('/item/{id}', [DepapokanController::class, 'hapus']);

Route::get('/item/{id}/ulasan', [DepapokanController::class, 'viewUlasan'])->name('ulas');
Route::post('/item/{id}/ulasan', [DepapokanController::class, 'ulas']);
Route::patch('/item/{id}/ulasan/{uid}', [DepapokanController::class, 'ubahUlasan'])->name('ulasan');
Route::delete('/item/{id}/ulasan/{uid}', [DepapokanController::class, 'hapusUlasan']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
