<?php

Auth::routes();



Route::get('/', 'Index\IndexController@index')->name('index');

Route::resource('addresses', 'Address\AddressController');
Route::resource('chapels', 'Chapel\ChapelController');
Route::resource('dioceses', 'Diocese\DioceseController');
Route::resource('foranias', 'Forania\ForaniaController');
Route::resource('parishes', 'Parish\ParishController');

Route::resource('people', 'Person\PersonController');
Route::post('people/type_people/types/store', 'Person\PersonController@typePeopleTypesStore')->name('people.type_people.types.store');
Route::delete('people/type_people/destroy/{person_id}/{type_person_id}', 'Person\PersonController@typePeopleTypesDestroy')->name('people.type_people.types.destroy');

Route::resource('type_people', 'Types\TypePeople');
Route::resource('rgi', 'RGI\RgiController');

