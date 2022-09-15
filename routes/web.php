<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('home');
Route::get('/categorias/{categoria}', function () {
    return view('welcome');
})->name('home.productoCategoria');
Route::get('/producto/{producto}', function () {
    return view('welcome');
})->name('home.producto');
Route::get('/categorias/get-breadcrumbs/{categoria}', 'ProductosController@getBreadcrumbs')->name('home.productoBreadcrumbs');
Route::get('/categorias/get-filtros/{categoria}', 'ProductosController@getFiltros')->name('home.productos.getFiltros');
Route::post('/get-productos', 'ProductosController@getProductos')->name('home.productos.getProductos');
Route::get('/home/nav', 'SiteController@getMenu')->name('SiteController.getMenu');
    



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
