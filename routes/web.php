<?php

use Illuminate\Support\Facades\Route;

Route::get('/version', function () {

    return phpinfo();

});

Route::get('/', function () {
    return view('app');
});

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
