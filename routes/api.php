<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\MultipleUploadController;

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProductosImagenController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\FuncionariosController;

use App\Http\Controllers\FaenaController;
use App\Http\Controllers\FaenaDetallesController;

use App\Http\Controllers\RomaneoController;
use App\Http\Controllers\RomaneoDetalleController;

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\VentaController;
use App\Http\Controllers\VentaDetalleController;

use App\Http\Controllers\EntradaMercaderiaController;
use App\Http\Controllers\EntradaMercaderiaDetalleController;

use App\Http\Controllers\RomaneoCorteController;
use App\Http\Controllers\RomaneoCorteDetalleController;

use App\Http\Controllers\FacturaElectronicaController;


/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


//Route::post('login', 'Auth\AuthController@login')->name('login');
//Route::post('register', 'Auth\AuthController@register');



//Route::post('multiple-image-upload', 'API\MultipleUploadController@store');
//Route::post('uploadTest', 'API\MultipleUploadController@uploadTest');


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


// ruta de los funcionarios
Route::get('funcionarios',[FuncionariosController::class,'index']);
Route::get('funcionarios/{id}',[FuncionariosController::class,'show']);
Route::post('funcionarios',[FuncionariosController::class,'store']);
Route::put('funcionarios/{id}',[FuncionariosController::class,'update']);
Route::delete('funcionarios/{id}',[FuncionariosController::class,'destroy']);



// Faena
Route::get('faenas',[FaenaController::class,'index']);
Route::get('faenas/{id}',[FaenaController::class,'show']);
// estas rutas no usamos
Route::post('faenas',[FaenaController::class,'store']);
Route::put('faenas/{id}',[FaenaController::class,'update']);

// Esta ruta nos sirve tanto para insertar o actualizar la faena, viene cabecera detalle aqui
Route::post('faenas/saveFaena',[FaenaController::class,'saveFaena']);
Route::delete('faenas/{id}',[FaenaController::class,'destroy']);


Route::get('faenas/lotes/lista',[FaenaController::class,'faenaLotes']);
Route::get('faenas/tarjetas/{nroLote}',[FaenaController::class,'faenaTarjetas']);
Route::get('tarjetas-disponibles',[FaenaController::class,'tarjetasDisponibles']);


Route::get('faenaDetalles',[FaenaDetallesController::class,'index']);
Route::get('faenaDetalles/{id}',[FaenaDetallesController::class,'show']);

Route::get('faenaDetalles/fae_codigo/{id}',[FaenaDetallesController::class,'showByID']);
Route::post('faenaDetalles',[FaenaDetallesController::class,'store']);
Route::put('faenaDetalles/{id}',[FaenaDetallesController::class,'update']);
Route::delete('faenaDetalles/{id}',[FaenaDetallesController::class,'destroy']);


// Romaneo
Route::get('romaneos',[RomaneoController::class,'index']);
Route::get('romaneos/{id}',[RomaneoController::class,'show']);
Route::put('romaneos/{id}',[RomaneoController::class,'update']);

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


// Ventas
Route::get('ventas',[VentaController::class,'index']);
Route::get('ventas/{id}',[VentaController::class,'show']);
Route::get('ventas/maxNro/{establecimiento}/{emision}/{timbrado}',[VentaController::class,'MaxNroFactura']);
Route::get('ventas/enlaseQR/{id}',[VentaController::class,'EnlaceQR']);


// Esta ruta nos sirve tanto para insertar o actualizar la faena, viene cabecera detalle aqui
Route::post('ventas/saveVenta',[VentaController::class,'saveVenta']);
Route::put('ventas/{id}',[VentaController::class,'update']);
Route::delete('ventas/{id}',[VentaController::class,'destroy']);

// detalles del romaneo
Route::get('ventaDetalles',[VentaDetalleController::class,'index']);
Route::get('ventaDetalles/{id}',[VentaDetalleController::class,'show']);

Route::get('ventaDetalles/vta_codigo/{id}',[VentaDetalleController::class,'showByID']);
Route::post('ventaDetalles',[VentaDetalleController::class,'store']);
Route::put('ventaDetalles/{id}',[VentaDetalleController::class,'update']);
Route::delete('ventaDetalles/{id}',[VentaDetalleController::class,'destroy']);

Route::get('facturaElectronica',[FacturaElectronicaController::class,'index']);


// entradas
Route::get('entradas',[EntradaMercaderiaController::class,'index']);
Route::get('entradas/{id}',[EntradaMercaderiaController::class,'show']);
//Route::get('ventas/maxNro/{establecimiento}/{emision}/{timbrado}',[VentaController::class,'MaxNroFactura']);

// Esta ruta nos sirve tanto para insertar o actualizar la faena, viene cabecera detalle aqui
Route::post('entradas/saveEntrada',[EntradaMercaderiaController::class,'saveEntrada']);
Route::delete('entradas/{id}',[EntradaMercaderiaController::class,'destroy']);

// detalles del romaneo
Route::get('entradaDetalles',[EntradaMercaderiaDetalleController::class,'index']);
Route::get('entradaDetalles/{id}',[EntradaMercaderiaDetalleController::class,'show']);

Route::get('entradaDetalles/em_codigo/{id}',[EntradaMercaderiaDetalleController::class,'showByID']);
Route::post('entradaDetalles',[EntradaMercaderiaDetalleController::class,'store']);
Route::put('entradaDetalles/{id}',[EntradaMercaderiaDetalleController::class,'update']);
Route::delete('entradaDetalles/{id}',[EntradaMercaderiaDetalleController::class,'destroy']);


// romaneo de cortes
Route::get('cortes',[RomaneoCorteController::class,'index']);
Route::get('cortes/{id}',[RomaneoCorteController::class,'show']);

// Esta ruta nos sirve tanto para insertar o actualizar la faena, viene cabecera detalle aqui
Route::post('cortes/saveCorte',[RomaneoCorteController::class,'saveCorte']);
Route::delete('cortes/{id}',[RomaneoCorteController::class,'destroy']);

// detalles del romaneo
Route::get('corteDetalles',[RomaneoCorteDetalleController::class,'index']);
Route::get('corteDetalles/{id}',[RomaneoCorteDetalleController::class,'show']);

Route::get('corteDetalles/rc_codigo/{id}',[RomaneoCorteDetalleController::class,'showByID']);
Route::post('corteDetalles',[RomaneoCorteDetalleController::class,'store']);
Route::put('corteDetalles/{id}',[RomaneoCorteDetalleController::class,'update']);
Route::delete('corteDetalles/{id}',[RomaneoCorteDetalleController::class,'destroy']);



