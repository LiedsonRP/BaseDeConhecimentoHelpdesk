<?php

namespace App\Models;

use Collator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class SolutionSearchTool
{

    /**
     * @var string Nome da view de pesquisa
     */
    private const SOLUTIONS_VIEW_NAME = 'view_solutions';
    /**
     * @var Illuminate\Database\Query\Builder Construtor de consulta SQL
     */
    private Builder $builder;

    public function __construct()
    {
        $this->builder = DB::table(self::SOLUTIONS_VIEW_NAME);
    }

    /**
     * Retorna os resultados da pesquisa na forma de uma collection, retirando os resultados duplicados
     * 
     * @param int $items_number Número de items na paginação
     * @return array
     */
    public function getResult(int $items_number) : array
    {
        $database_pagination = $this->builder->select()->distinct(["title"])->paginate($items_number);
        $id_collection = collect($database_pagination->items());        
        $results = $this->format_solution_results($id_collection);
        
        return ["data"=>$results, 
        "current_page" => $database_pagination->currentPage(),
        "last_page" => $database_pagination->lastPage()];
    }

    /**
     * Formata os resultados da pesquisa na view para o padrão aceito no projeto
     * @param Illuminate\Support\Collection
     * @return Collection 
     */
    private function format_solution_results(Collection $solution_list) : Collection
    {        
        return $solution_list->map(function($solution_record) {            
            $solution = new Solution([
                "id" => $solution_record->solution_number,
                "title" => $solution_record->title,
                "created_at" => $solution_record->created_at,
                "updated_at" => $solution_record->updated_at,
            ]);                
            $solution->load("categories");
            
            $categories  = $solution->categories()->get()->map(function (Category $category) {
                return new Category($category->attributesToArray());
            });

            $solution->setRelation("categories", $categories);
            
            return $solution;
        });        
    }

    /**
     * Filtra num conjunto de dados do builder de acordo com um conjunto de categorias passadas
     * como parâmetro de pesquisa
     * 
     * @param array $categories_list categorias de filtro     
     */
    public function filter_by_category(Category $category) : void
    {                
        $this->builder->orWhere("category_name", "LIKE", $category->name);                
    }

    /**
     * Faz uma pesquisa por título no banco de soluções. Esta pesquisa é cumulativa com os filtros
     * @param string $title Título ou parte dele
     */
    public function search_title(String $title) : void
    {        
        $title_param = $title."%";
        $this->builder->where("title", "LIKE", $title_param);         
    }

    /**
     * Retorna uma solução cadastrada na base de dados junto de suas categorias e dados
     * 
     * @param int $id Número de identificação no banco de dados
     * @return Solution
     */
    public function getSingleSolution(int $id) : Solution
    {
        $this->builder->where("solution_number", $id);                
        $result = $this->getResult(1);
        return $result["data"]->last();
                
    }
}