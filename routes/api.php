<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\MultipleUploadController;

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProductosImagenController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProveedoresController;

use App\Http\Controllers\FaenaController;
use App\Http\Controllers\FaenaDetallesController;


use App\Http\Controllers\RomaneoController;
use App\Http\Controllers\RomaneoDetalleController;

use App\Http\Controllers\Auth\AuthController;


/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

/*
Route::post('login', 'Auth\AuthController@login')->name('login');
Route::post('register', 'Auth\AuthController@register');
*/

Route::post('multiple-image-upload', 'API\MultipleUploadController@store');
Route::post('uploadTest', 'API\MultipleUploadController@uploadTest');


Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'Auth\AuthController@login')->name('login');
    Route::post('register', 'Auth\AuthController@register');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user')->name('user');

    });

});


Route::group(['middleware' => 'auth:api'], function() {
    //Route::get('productos',[ProductosController::class,'index'])->name('produtos.index');
    //Route::post('productos',[ProductosController::class,'store']);
});


Route::get('users',[AuthController::class,'index']);

Route::get('categorias',[CategoriasController::class,'index']);
Route::get('categorias/{id}',[CategoriasController::class,'show']);
Route::post('categorias',[CategoriasController::class,'store']);
Route::put('categorias/{id}',[CategoriasController::class,'update']);
Route::delete('categorias/{id}',[CategoriasController::class,'destroy']);

Route::get('productos',[ProductosController::class,'index']);
Route::get('productos/{id}',[ProductosController::class,'show']);
Route::post('productos',[ProductosController::class,'store']);
Route::put('productos/{id}',[ProductosController::class,'update']);
Route::delete('productos/{id}',[ProductosController::class,'destroy']);


Route::get('productos-imagen',[ProductosImagenController::class,'index']);
Route::get('productos-imagen/{id}',[ProductosImagenController::class,'ImagenByProducto']);
Route::post('productos-imagen-add', [ProductosImagenController::class, 'storeImage']);


Route::post('multiple-image-upload', [MultipleUploadController::class, 'store']);
Route::post('uploadTest', [MultipleUploadController::class, 'uploadTest']);

// ruta de los clientes
//Route::resource('clientes', ClienteController::class)->names('admin.clientes');
Route::get('clientes',[ClientesController::class,'index']);
Route::get('clientes/show',[ClientesController::class,'show']);
Route::get('clientes/store',[ClientesController::class,'store']);
Route::get('clientes/update',[ClientesController::class,'update']);
Route::get('clientes/destroy',[ClientesController::class,'destroy']);

// ruta de los proveedores
Route::get('proveedores',[ProveedoresController::class,'index']);
Route::get('proveedores/{id}',[ProveedoresController::class,'show']);
Route::post('proveedores',[ProveedoresController::class,'store']);
Route::put('proveedores/{id}',[ProveedoresController::class,'update']);
Route::delete('proveedores/{id}',[ProveedoresController::class,'destroy']);


// Faena
Route::get('faenas',[FaenaController::class,'index']);
Route::get('faenas/{id}',[FaenaController::class,'show']);
// estas rutas no usamos
Route::post('faenas',[FaenaController::class,'store']);
Route::put('faenas/{id}',[FaenaController::class,'update']);

// Esta ruta nos sirve tanto para insertar o actualizar la faena, viene cabecera detalle aqui
Route::post('faenas/saveFaena',[FaenaController::class,'saveFaena']);
Route::delete('faenas/{id}',[FaenaController::class,'destroy']);


Route::get('faenaDetalles',[FaenaDetallesController::class,'index']);
Route::get('faenaDetalles/{id}',[FaenaDetallesController::class,'show']);

Route::get('faenaDetalles/fae_codigo/{id}',[FaenaDetallesController::class,'showByID']);
Route::post('faenaDetalles',[FaenaDetallesController::class,'store']);
Route::put('faenaDetalles/{id}',[FaenaDetallesController::class,'update']);
Route::delete('faenaDetalles/{id}',[FaenaDetallesController::class,'destroy']);


// Romaneo
Route::get('romaneos',[RomaneoController::class,'index']);
Route::get('romaneos/{id}',[RomaneoController::class,'show']);

// Esta ruta nos sirve tanto para insertar o actualizar la faena, viene cabecera detalle aqui
Route::post('romaneos/saveRomaneo',[RomaneoController::class,'saveRomaneo']);
Route::delete('romaneos/{id}',[RomaneoController::class,'destroy']);

// detalles del romaneo
Route::get('romaneoDetalles',[RomaneoDetalleController::class,'index']);
Route::get('romaneoDetalles/{id}',[RomaneoDetalleController::class,'show']);

Route::get('romaneoDetalles/rom_codigo/{id}',[RomaneoDetalleController::class,'showByID']);
Route::post('romaneoDetalles',[RomaneoDetalleController::class,'store']);
Route::put('romaneoDetalles/{id}',[RomaneoDetalleController::class,'update']);
Route::delete('romaneoDetalles/{id}',[RomaneoDetalleController::class,'destroy']);
