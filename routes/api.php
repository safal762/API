<?php

use App\Http\Controllers\API\coursecontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/course',[coursecontroller::class,'save']);
Route::get('/course',[coursecontroller::class,'show']);
Route::patch('/course/{id}',[coursecontroller::class,'update']);
Route::delete('/course/{id}',[coursecontroller::class,'delete']);