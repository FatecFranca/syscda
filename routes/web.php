<?php

Auth::routes();



Route::get('/', 'Index\IndexController@index')->name('index');

Route::resource('addresses', 'Address\AddressController');
Route::resource('chapels', 'Chapel\ChapelController');
Route::resource('dioceses', 'Diocese\DioceseController');
Route::resource('foranias', 'Forania\ForaniaController');
Route::resource('parishes', 'Parish\ParishController');
Route::resource('rgi', 'RGI\RgiController');

