<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepapokanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/items", [DepapokanController::class, 'index']);

Route::post("/item", [DepapokanController::class, 'tambah']);
Route::get("/item/{id}", [DepapokanController::class, 'dapatSatu']);
Route::patch("/item/{id}", [DepapokanController::class, 'ubah']);
Route::delete("/item/{id}", [DepapokanController::class, 'hapus']);

Route::post("/item/{id}/ulasan", [DepapokanController::class, 'ulas']);
Route::get("/item/{id}/ulasan/{uid}", [DepapokanController::class, 'langkahSatu']);
Route::patch("/item/{id}/ulasan/{uid}", [DepapokanController::class, 'ubahUlasan']);
Route::delete("/item/{id}/ulasan/{uid}", [DepapokanController::class, 'hapusUlasan']);
