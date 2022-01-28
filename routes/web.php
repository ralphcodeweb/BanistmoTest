<?php

use Illuminate\Support\Facades\Route;

Route::get('/version', function () {

    return phpinfo();

});

Route::get('/', function () {
    return view('welcome');
});


Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	//'middleware' => 'auth'
], function(){

	Route::get('/', 'AdminController@index')->name('dashboard');
});