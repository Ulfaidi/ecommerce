<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    homeController,
    Admin\KategoriController,
    Admin\ProdukController,
    AuthController,
    WebController
};

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

// WEBSITE





// LOGIN ADMIN
Route::post('/registrasi', [\App\Http\Controllers\RegisterController::class, 'register'])->name('daftar');
Route::middleware('guest')->get('/daftar', [\App\Http\Controllers\RegisterController::class, 'daftar'])->name('daftar');


Route::middleware('guest')->get('/login', [AuthController::class, 'halamanlogin'])->name('login');
Route::get('/login/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/web', [WebController::class, 'show']);


route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [homeController::class, 'show'])->name('home');
});


Route::group([
    // 'middleware' => ['auth'],
    'prefix' => "kategori"
], function ($router) {
    Route::get('/', [KategoriController::class, 'show']);
    Route::get('/create', [KategoriController::class, 'create']);
    Route::post('/store', [KategoriController::class, 'store']);
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/{id}', [KategoriController::class, 'update']);
    Route::get('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

Route::group([
    // 'middleware' => ['auth'],
    'prefix' => "produk"
], function ($router) {
    Route::get('/', [ProdukController::class, 'show']);
    Route::get('/create', [ProdukController::class, 'create']);
    Route::post('/store', [ProdukController::class, 'store']);
    Route::get('/{id}/edit', [ProdukController::class, 'edit']);
    Route::put('/{id}', [ProdukController::class, 'update']);
    Route::get('/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});
