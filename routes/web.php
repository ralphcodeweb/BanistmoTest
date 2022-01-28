<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/version', function () {

    return phpinfo();

});

Route::get('/', function () {
    return view('auth.login');
});


Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'middleware' => 'auth'
], function(){

	Route::get('/', 'AdminController@index')->name('dashboard');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
