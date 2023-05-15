<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
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

Route::prefix("/solucao")->group(function () {
    Route::controller(SolutionController::class)->group(function () {
        Route::post("/cadastrar", "store");
        Route::get("/solucoes", "index");
    });  
});

Route::prefix("/categoria")->group(function () {
    Route::controller(CategorieController::class)->group(function () {
        Route::post("/cadastrar", "store");
        Route::get("/categorias", "index");
    });    
});
