<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Solution;
use Illuminate\Support\Facades\DB;

/**
 * Controller responsável por gerenciar os registros de soluções no sistema
 */
class SolutionController extends Controller
{

    /**
     * Retorna as atualizações cadastradas no sistema, levando em conta os seguintes parâmetros de pesquisa:
     *  1 - Título
     *  2 - Categorias pesquisadas
     * 
     * As soluções que passarem por este filtro serão retornadas numa lista em JSON
     * 
     * @param Request $request
     * @return Response
     * 
     * @todo
     */
    public function searchSolutions(Request $request)
    {
        return Solution::with("categories")->get();
    }

    /**
     * Cadastra uma nova solução no sistema, fazendo o seu registro inicial no banco de dados.
     * 
     * Caso o registro seja bem sucedido, ocorre o redirecionamento para a página de edição da solução, senão 
     * é retornado para a página principal do sistema junto de uma mensagem de erro.
     * 
     * @param Request $request
     * @return Redirect
     * 
     * @todo
     */
    public function store(Request $request)
    {
        if ($request->filled(["title"])){            

            $solution = new Solution([
                "title" => $request->input(["title"]),
                "solution_text" => ""
            ]);

            $solution->save();            
        }
    }

    /**
     * Modifica os dados de uma solução do sistema, podendo ser uma modificação de conteúdo, categoria ou título.
     * 
     * Caso a modificação seja bem sucedida ocorre o redirecionamento para a página principal, senão é retornado uma mensagem de erro
     * informando o motivo da falha ao usuário
     * 
     * @param Request $request
     * @return Redirect
     * 
     * @todo
     */
    public function update(Request $request, int $id)
    {
        if ($request->filled(["title", "SolutionText", "categories"])){
            
            DB::beginTransaction();

            $solution = new Solution($request->only(["title",  "SolutionText"]));
            $solution->save();

            $categories = $request->input("categories");

            if (sizeof($categories) > 0) {

                foreach ($categories as $categorie_id) {
                    $categorie = Category::find($categorie_id);
                    $solution->categories()->save($categorie);
                }
            }

            DB::commit();
        }
    }

    /**
     * Deleta uma solução do sistema, sendo feito por meio de um delete físico no banco de dados e 
     * o redirecionamento para a rota que deletará a pasta da categoria
     * 
     * @param int $id Número de identificação da solução
     * @return Redirect
     * 
     * @todo
     */
    public function delete(int $id)
    {

    }
}
