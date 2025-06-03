<?php

use App\Http\Controllers\api\GuruApi;
use App\Http\Controllers\api\IndustriApi;
use App\Http\Controllers\api\PklApi;
use App\Http\Controllers\api\SiswaApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('siswa',SiswaApi::class);
Route::apiResource('guru',GuruApi::class);
Route::apiResource('industri',IndustriApi::class);
Route::apiResource('pkl',PklApi::class);