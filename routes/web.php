<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\SolutionStorageController;

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

/**
 * Rota para página de login do sistema
 */
Route::get('/', function () {
    return view('pages/dashboard');
});

Route::view("/teste", "pages/imageTest");

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
        Route::post("/cadastrar", "store")->name("cadSolucao");
        /**
         * Rota que leva a função de retornar todos as soluções cadastradas no banco de dados         
         */
        Route::get("/solucoes", "searchSolutions")->name("mostrarSolucoes");
        /**
         * Rota que permite a edição do registro de uma categoria         
         */        
        Route::put("/edit/{id}", "update")->name("editarSolucao");
        /**
         * Redireciona para a página de edição da solução junto de seus dados
         */
        Route::get("/show-edit", "show")->name("cardView");
        /**
         * Rota que permite deletar uma solução         
         */
        Route::delete("/delete/{id}", "delete")->name("deletarSolucao");
    });

    /**
     * Rotas para o controller do storage
     */
    Route::controller(SolutionStorageController::class)->group(function() {
        /**
         * Rota de upload de arquivos
         * @todo
         */
        Route::post("/upload", "upload")->name("upload");
        /**
         * Rota de recuperação dos arquivos associados a solução
         * @todo
         */
        Route::get("/files/{id}", "index")->name("getFiles");
        /**
         * Rota para deletar um arquivo específico associado a solução
         * @todo
         */
        Route::delete("/file/delete/{id}", "delete_file")->name("deleteFile");
        /**
         * Rota para deletar o diretório e os arquivos associados
         * @todo
         */
        Route::delete("/directory/delete/{id}", "delete_folder")->name("deleteFolder");
    });  

    /**
     * Rota que leva para a página principal da aplicação
     * 
     */
    Route::view("/dashboard", "pages/dashboard")->name("dashboard");

});

/**
 * Grupo de rotas das categorias
 */
Route::prefix("/categoria")->group(function () {
    /**
     * Rotas para as funções de controller das categorias
     */
    Route::controller(CategoryController::class)->group(function () {
        /**
         * Rota que salva os dados de uma categoria no banco de dados         
         */
        Route::post("/cadastrar", "store")->name("cadCategoria");
        /**
         * Rota para retorno dos dados de todas as categorias pelo controller         
         */
        Route::get("/categorias", "index")->name("mostrarCategorias");
        /**
         * Rota que permite a deleção de uma categoria         
         */
        Route::get("/deletar/{id}", "delete")->name("deletarCategoria");
    });    
});
