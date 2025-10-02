<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CekAdmin;     

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('login');
});
