<?php

Auth::routes();



Route::get('/', 'Index\IndexController@index')->name('index');

