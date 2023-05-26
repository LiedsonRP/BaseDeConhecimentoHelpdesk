<?php

namespace App\Models;

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
     * @return Illuminate\Support\Collection
     */
    public function getResult() : Collection
    {
        $results = $this->builder->orderBy("solution_number", "asc")->select()->distinct(["title"])->get()->pluck("solution_number");
        
        $solutions = $results->map(function($id) {
            $solution = Solution::find($id)->load("categories");                
            
            $categories  = $solution->categories()->get()->map(function (Category $category) {
                return new Category($category->attributesToArray());
            });

            $solution->setRelation("categories", $categories);
            
            return $solution;
        });        

        return $solutions;
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
}