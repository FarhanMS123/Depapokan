<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;

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

Route::get('/', [Controllers\DepapokanController::class, 'index']);

Route::get('/tambah', [Controllers\DepapokanController::class, 'viewTambah'])->name('tambah');
Route::post('/tambah', [Controllers\DepapokanController::class, 'tambah']);

Route::get('/item/{id}', [Controllers\DepapokanController::class, 'viewUbah'])->name('ubah');
Route::patch('/item/{id}', [Controllers\DepapokanController::class, 'ubah']);
Route::delete('/item/{id}', [Controllers\DepapokanController::class, 'hapus']);
