<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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

/**
 * Grupo de rotas que engloba a manipulação e vizualização de páginas e dados das soluções
 */
Route::prefix("/solucao")->group(function () {
    /**
     * Grupo de rotas que permite acesso as funções do controller de soluções
     */
    Route::controller(SolutionController::class)->group(function () {
        /**
         * Rota que leva a função de cadastrar uma solução no controller de soluções
         */
        Route::post("/cadastrar", "store");
        /**
         * Rota que leva a função de retornar todos as soluções cadastradas no banco de dados
         */
        Route::get("/solucoes", "index");
    });
    /**
     * Grupo de rotas que permite o acesso e manipulação do storage
     */
    Route::prefix("storage")->group(function () {
        
    });
});

Route::prefix("/categoria")->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        /**
         * Rota que salva os dados de uma categoria no banco de dados
         */
        Route::post("/cadastrar", "store")->name("cadCategoria");
        /**
         * Rota para retorno dos dados de todas as categorias pelo controller
         */
        Route::get("/categorias", "index")->name("mostrarCategorias");
    });

    Route::view("/form-teste", "pages/test");

    /**
     * Rota para a página de gerenciamento de categorias [Falta criar a página]
     */
    Route::view('gerenciar-categoria', '[viewName]');
});
