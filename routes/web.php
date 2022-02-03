<?php

use Illuminate\Support\Facades\Route;

Route::get('/{optional?}', function () {

    return view('app');

})->name('basepath');
