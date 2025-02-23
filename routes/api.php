<?php

use App\Http\Controllers\FaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/face/store', [FaceController::class, 'store']);
Route::post('/face/match', [FaceController::class, 'match']);