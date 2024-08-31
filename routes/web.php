<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\TransaksiPenjualanController;

Route::pattern('id','[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka
Route::get('login', [AuthController::class,'login'])->name('login');
Route::post('login', [AuthController::class,'postlogin']);
Route::get('logout', [AuthController::class,'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function(){
    Route::get('/', [WelcomeController::class,'index']);

    Route::middleware(['authorize:ADM'])->group (function() {
        Route::get('/level', [LevelController::class, 'index']);
        Route::post('/level/list',[LevelController::class,'list']);
        Route::get('/level/create',[LevelController::class,'create']);
        Route::post('/level',[LevelController::class,'store']);
        Route::get('/level/{id}/edit',[LevelController::class,'edit']);
        Route::put('/level/{id}',[LevelController::class,'update']);
        Route::get('/level/{id}', [LevelController::class, 'show']);
        Route::delete('/level/{id}', [LevelController::class, 'destroy']);
    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserController::class, 'create']);      // menyimpan data user baru
        Route::post('/', [UserController::class, 'store']);          // menampilkan halaman awal user
        Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
        Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
    });

    Route::group(['prefix' => 'kategori'], function() {
        Route::get('/', [KategoriController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/list', [KategoriController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [KategoriController::class, 'create']);   // menyimpan data user baru
        Route::post('/', [KategoriController::class, 'store']);          // menampilkan halaman awal user
        Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail user
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data user
        Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data user
    });


    Route::middleware(['authorize:ADM'])->group (function() {
        Route::get('/barang', [DataBarangController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/barang/list', [DataBarangController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/barang/create', [DataBarangController::class, 'create']);   // menyimpan data user baru
        Route::post('/barang', [DataBarangController::class, 'store']);          // menampilkan halaman awal user
        Route::get('/barang/{id}', [DataBarangController::class, 'show']);       // menampilkan detail user
        Route::get('/barang/{id}/edit', [DataBarangController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/barang/{id}', [DataBarangController::class, 'update']);     // menyimpan perubahan data user
        Route::delete('/barang/{id}', [DataBarangController::class, 'destroy']); // menghapus data user
    });


    Route::middleware(['authorize:MNG'])->group (function() {
        Route::get('/barang', [DataBarangController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/barang/list', [DataBarangController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/barang/create', [DataBarangController::class, 'create']);   // menyimpan data user baru
        Route::post('/barang', [DataBarangController::class, 'store']);          // menampilkan halaman awal user
        Route::get('/barang/{id}', [DataBarangController::class, 'show']);       // menampilkan detail user
        Route::get('/barang/{id}/edit', [DataBarangController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/barang/{id}', [DataBarangController::class, 'update']);     // menyimpan perubahan data user
        Route::delete('/barang/{id}', [DataBarangController::class, 'destroy']); // menghapus data user
    });

    Route::middleware(['authorize:ADM,MNG'])->group (function() {
        Route::get('/barang', [DataBarangController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/barang/list', [DataBarangController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/barang/create', [DataBarangController::class, 'create']);   // menyimpan data user baru
        Route::post('/barang', [DataBarangController::class, 'store']);          // menampilkan halaman awal user
        Route::get('/barang/{id}', [DataBarangController::class, 'show']);       // menampilkan detail user
        Route::get('/barang/{id}/edit', [DataBarangController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/barang/{id}', [DataBarangController::class, 'update']);     // menyimpan perubahan data user
        Route::delete('/barang/{id}', [DataBarangController::class, 'destroy']); // menghapus data user
    });


    Route::group(['prefix' => 'stok'], function() {
        Route::get('/', [StokBarangController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/list', [StokBarangController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [StokBarangController::class, 'create']);   // menyimpan data user baru
        Route::post('/', [StokBarangController::class, 'store']);          // menampilkan halaman awal user
        Route::get('/{id}', [StokBarangController::class, 'show']);       // menampilkan detail user
        Route::get('/{id}/edit', [StokBarangController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/{id}', [StokBarangController::class, 'update']);     // menyimpan perubahan data user
        Route::delete('/{id}', [StokBarangController::class, 'destroy']); // menghapus data user
    });

    Route::group(['prefix' => 'penjualan'], function() {
        Route::get('/', [TransaksiPenjualanController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/list', [TransaksiPenjualanController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [TransaksiPenjualanController::class, 'create']);   // menyimpan data user baru
        Route::post('/', [TransaksiPenjualanController::class, 'store']);          // menampilkan halaman awal user
        Route::get('/{id}', [TransaksiPenjualanController::class, 'show']);       // menampilkan detail user
        Route::get('/{id}/edit', [TransaksiPenjualanController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/{id}', [TransaksiPenjualanController::class, 'update']);     // menyimpan perubahan data user
        Route::delete('/{id}', [TransaksiPenjualanController::class, 'destroy']); // menghapus data user
    });

});

