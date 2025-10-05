<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CekAdmin;     
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::middleware([CekAdmin::class])->group(function () { 
    
    Route::get('/',[DashboardController::class, 'list_user']);
    Route::get('/logout',[LoginController::class, 'logout']);

});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login-act',[LoginController::class, 'login_act']);
