<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 

use App\Http\Controllers\MobileappsVer1;     
// Route::get('/', [MobileappsVer1::class, 'def']);
Route::get('/', function(){
    return 'successed';
}); 