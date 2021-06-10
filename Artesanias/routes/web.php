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

Route::get('/', function () {return view('index');});
Route::get('/admin', function () {return view('admin.index');});
Route::get('/admin/usuarios', function () {return view('admin.users');});
Route::get('/admin/productos', function () {return view('admin.productos');});

Route::get('/practica', function () {return view('practica');});
Route::get('/producto/{id}', function ($id) {
    return view('verproducto')->with('id',$id);
});
Route::get('/contacto', function () {
    $contacto="Edgar Aragon";
    $valores=5;
    $color="#ccc";
    return view('contacto')
        ->with('nombre',$contacto)
        ->with('fondo',$color)
        ->with('valores',$valores);

    }); 