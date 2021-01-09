<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Produtos;
use App\Http\Controllers\Categorias;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::prefix('/categorias')->group(function(){
    Route::get('/', [Categorias::class, 'index']);
    Route::get('/novo', [Categorias::class, 'create']);
    Route::post('/', [Categorias::class, 'store']);
    Route::get('/editar/{id}', [Categorias::class, 'edit']);
    Route::post('/{id}', [Categorias::class, 'update']);
    Route::get('/excluir/{id}', [Categorias::class, 'destroy']);
});

Route::get('/produtos', [Produtos::class, 'indexView']);
