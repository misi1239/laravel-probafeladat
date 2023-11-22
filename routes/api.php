<?php

use App\Http\Controllers\name\CreateAction;
use App\Http\Controllers\name\DeleteAction;
use App\Http\Controllers\name\ShowAction;
use App\Http\Controllers\name\UpdateAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/create-name", CreateAction::class);
Route::put("/update-name/{id}", UpdateAction::class);
Route::delete("/delete-name/{id}", DeleteAction::class);
Route::get("/get-phone-book", ShowAction::class);
