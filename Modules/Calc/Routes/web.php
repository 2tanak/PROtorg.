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
Route::prefix('calc')->group(function() {
        Route::get('/', 'CalcController@index')->name('calc_home');
		Route::post('create', 'CalcController@saveCreate')
        ->name('calc_save');


});
