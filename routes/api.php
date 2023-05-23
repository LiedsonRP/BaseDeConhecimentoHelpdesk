<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SolutionController;

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

Route::get("/index", [SolutionController::class, "searchSolutions"]);
Route::get("/index-cat", [CategoryController::class, "index"]);
Route::post("/create", [SolutionController::class, "store"]);
Route::delete("/delete/{id}", [SolutionController::class, "delete"]);
Route::put("/edit/{id}", [SolutionController::class, "update"]);
Route::post("/create-category", [CategoryController::class, "store"]);
Route::delete("/del-category/{id}", [CategoryController::class, "delete"]);