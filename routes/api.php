<?php

use App\Http\Controllers\API\coursecontroller;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){
Route::post('/course',[coursecontroller::class,'save'])->middleware('admin');
Route::get('/course',[coursecontroller::class,'show']);
Route::patch('/course/{id}',[coursecontroller::class,'update']);
Route::delete('/course/{id}',[coursecontroller::class,'delete']);
Route::post('/logout',[Auth::class,'logout']);
});



Route::post('/register',[Auth::class,'register']);
Route::post('/login',[Auth::class,'login']);