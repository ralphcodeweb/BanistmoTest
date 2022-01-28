<?php

use Illuminate\Support\Facades\Route;

Route::get('/version', function () {

    return phpinfo();

});

Route::get('/', function () {
    return view('welcome');
});
