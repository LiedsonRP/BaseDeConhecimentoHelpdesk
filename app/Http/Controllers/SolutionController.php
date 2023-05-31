<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use App\Models\SolutionSearchTool;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\DuplicateSolutionTitleException;
use App\Exceptions\MinCategoryNumberNotRespectedException;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * Controller responsável por gerenciar os registros de soluções no sistema
 */
class SolutionController extends Controller
{

    protected SolutionSearchTool $searchTool;

    public function __construct(SolutionSearchTool $searchTool)
    {
        $this->searchTool = $searchTool;
    }

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
        if ($request->filled("categories")) {

            foreach ($request->input("categories") as $category_id) {
                
                $category = Category::findOrFail($category_id);
                $this->searchTool->filter_by_category($category);
            }                        
        }

        if ($request->filled("title")) {
            $this->searchTool->search_title($request->input("title"));
        }

        $search_results = $this->searchTool->getResult(9);                        
        
        return response()->json($search_results);
    }

    /**
     * Cadastra uma nova solução no sistema, fazendo o seu registro inicial no banco de dados.
     * 
     * Caso o registro seja bem sucedido, ocorre o redirecionamento para a página de edição da solução, senão 
     * é retornado para a página principal do sistema junto de uma mensagem de erro.
     * 
     * @param Request $request
     * @return Response
     * 
     */
    public function store(Request $request)
    {
        if ($request->filled(["title"])) {

            try {

                $solution = new Solution([
                    "title" => $request->input(["title"]),
                    "solution_text" => ""
                ]);

                $solution->addSolution();

                return response()->view("pages/edit_solution", [
                    "id" => $solution->id,
                    "title" => $solution->title,
                    "solution_text" => $solution->solution_text,
                    "categories" => []
                ]);

            } catch (DuplicateSolutionTitleException $ex) {
                return back()->withInput()->withErrors("O título passado já foi usado em outra solução!");
            } catch (Exception $ex) {
                return back()->withInput()->withErrors("Ocorreu um erro interno, tente novamente mais tarde!");
            }
        }

        return back()->withInput()->withErrors("O título da solução deve ser informado!");
    }

    /**
     * Redireciona para a view de edição se soluções
     * @param Request $request
     * @return Response
     */
    public function show(Request $request) 
    {
        if ($request->filled("id")) {            
            $solution = $this->searchTool->getSingleSolution($request->input("id"));               
            return response()->view("pages/edit_solution", ["solution"=>$solution]);
        }

        return back()->withInput()->withErrors("Não foi possível acessar a solução!");
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
     */
    public function update(Request $request, int $id)
    {

        if ($request->filled(["title", "solution_text", "categories"])) {
            
            try {

                DB::transaction(function () use (&$id, &$request) {
                    
                    $RequestSolution = new Solution(["title"=>$request->input("title"), "solution_text"=>$request->input("solution_text")]);                   
                    
                    $solution = Solution::findOrFail($id);
                    $solution->updateSolution($RequestSolution);

                    $requestCategories = $request->input("categories");

                    $solution->add_categories_not_existent_by_id($requestCategories);
                    $solution->remove_categories_existent_by_id($requestCategories);
                });                

                return redirect()->route("dashboard");

            } catch (ModelNotFoundException $ex) {
                return back()->withInput()->withErrors("Categoria ou solução não encontrada!");
            } catch (MinCategoryNumberNotRespectedException $ex) {
                return back()->withInput()->withErrors("A solução deve ter no mínimo uma categoria associada!");
            }
        }

        return back()->withInput()->withErrors("Há informações faltando na sua solução!");
    }

    /**
     * Deleta uma solução do sistema, sendo feito por meio de um delete físico no banco de dados e 
     * o redirecionamento para a rota que deletará a pasta da categoria
     * 
     * @param int $id Número de identificação da solução
     * @param Request $request
     * @return Redirect
     *      
     */
    public function delete(Request $request, int $id)
    {
        try {
            $solution = Solution::findOrFail($id);
            $solution->deleteSolution($solution);

            return $this->searchSolutions($request);

        } catch (ModelNotFoundException $ex) {
            return back()->withInput()->withErrors("Solução não encontrada!");
        }
    }
}
