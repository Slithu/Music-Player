<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\JamendoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/songs/fetch', [SongController::class, 'fetchFromApi']);

Route::get('/jamendo/tracks', [JamendoController::class, 'getTracks']);
