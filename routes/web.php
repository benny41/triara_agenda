<?php

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

Route::get('/','ContactoController@index');

Route::resource('contacto', 'ContactoController');
Route::get('elicontacto/{id}','ContactoController@elicontacto')->name('elicontacto');
Route::get('elicorreo/{id}','ContactoController@elicorreo')->name('elicorreo');
Route::get('elidir/{id}','ContactoController@elidir')->name('elidir');
Route::get('elitel/{id}','ContactoController@elitel')->name('elitel');
Route::post('contactoUpdate','ContactoController@contactoUpdate')->name('contactoUpdate');