<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileController;  

Route::get('/', function(){  return 'successed'; }); // Test route

Route::post('/login', [MobileController::class, 'login']); 
Route::post('/register', [MobileController::class, 'register']); 
Route::get('/users/{page?}', [MobileController::class, 'users']); 
Route::post('/cari', [MobileController::class, 'cari']); 