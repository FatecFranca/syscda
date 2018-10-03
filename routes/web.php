<?php

Auth::routes();



Route::get('/w', 'Index\IndexController@index')->name('index');

