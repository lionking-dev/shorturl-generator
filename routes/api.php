<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/submit', 'App\Http\Controllers\UrlController@submit');
Route::get('/{id}', 'App\Http\Controllers\UrlController@redirectToOriginalUrl');
Route::post('/check-url', 'App\Http\Controllers\UrlController@checkUrl');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

