<?php

namespace App\Http\Controllers;

use App\Exceptions\CategoryAlreadyExistException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;
use Exception;

/**
 * Controller responsável por gerenciar as tags de categoria de solução do sistema
 */
class CategoryController extends Controller
{

    /**
     * Retorna todas as categorias cadastradas no sistema, retornando-as como 
     * uma resposta em JSON
     * 
     * @return Response     
     */
    public function index() : Response
    {
        $categories = (new Category())->listCategories();
        return response($categories);
    }

    /**
     * Salva uma nova categoria no banco de dados, contanto que ela 
     * já não esteja previamente cadastrada. 
     * 
     * Ao final irá redirecionar para a rota de retorno das categorias
     * 
     * @param Request $request
     * @return Response
     *      
     */
    public function store(Request $request) : Response
    {

        if ($request->filled("name")) {

            try {
                
                $category = new Category(["name" => $request->input("name")]);
                $category->addCategory($category);

                return $this->index();
                
            } catch(CategoryAlreadyExistException $ex) {
                
                return response([
                    "sucess" => false,
                    "message" => "A categoria cadastrada já existe!"
                ]); 
            }                                               
        }

        return response([
            "sucess" => false,
            "message" => "O nome da categoria deve ser informado!"
        ]);
    }

    /**
     * Deleta uma categoria cadastrada no sistema, retirando sua atribuição 
     * de todas as soluções do sistema e retorna as restantes
     * 
     * @param int $id     
     * @return Response 
     */
    public function delete(int $id) : Response
    {
        try {
            
            $category = Category::findOrFail($id);
            $category->removeCategory($category);

            return $this->index();

        } catch(Exception $ex) {
            response([
                "sucess" => false,
                "message" => "Ocorreu um erro interno interno, tente novamente mais tarde!"
            ]);
        }
    }
}
