<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/course-data', function () {
    return response()->json([
        "success"=>"false",
        "message"=>"unauthorized",
    ]);
})->name('login');

