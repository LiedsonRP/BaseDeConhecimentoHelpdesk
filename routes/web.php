<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SolutionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("/solucao")->group(function () {
    Route::controller(SolutionController::class)->group(function () {
        Route::post("/cadastrar", "store");
        Route::get("/solucoes", "index");
    });    
});

Route::prefix("/categoria")->group(function () {
    Route::controller(SolutionController::class)->group(function () {
        Route::post("/cadastrar", "store");
        Route::get("/categorias", "index");
    });    
});
