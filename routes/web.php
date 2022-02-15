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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/contato')->name('contato.')->group(function () {
    Route::get('/', 'App\Http\Controllers\ContatoController@index')->name('index');
    Route::post('/store', 'App\Http\Controllers\ContatoController@store');
    Route::get('/list', 'App\Http\Controllers\ContatoController@list');
    Route::delete('/delete/{contato}', 'App\Http\Controllers\ContatoController@destroy');
    Route::get('/edit/{contato}', 'App\Http\Controllers\ContatoController@edit');
    Route::get('/form', 'App\Http\Controllers\ContatoController@show');
});
