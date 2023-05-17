<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\QueryException;


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
     * 
     * @todo
     */
    public function index()
    {
        $categories = Category::all();

        dd(response()->json($categories));
    }

    /**
     * Salva uma nova categoria no banco de dados, contanto que ela 
     * já não esteja previamente cadastrada. 
     * 
     * Ao final irá redirecionar para a rota de retorno das categorias
     * 
     * @param Request $request     
     * 
     * @todo
     */
    public function store(Request $request)
    {        

        if ($request->filled("name")) {
            try {
                $category = new Category(["name" => $request->input("name")]);
                $category->save();

                return redirect()->route("mostrarCategorias");
            } catch (QueryException $ex) {                
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Deleta uma categoria cadastrada no sistema, retirando sua atribuição 
     * de todas as soluções do sistema e retorna as restantes
     * 
     * @param int $id     
     * 
     * @todo
     */
    public function delete($id)
    {

    }
}
