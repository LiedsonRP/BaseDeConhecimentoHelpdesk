<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        dump($categories);
    }

    /**
     * Salva uma nova categoria no banco de dados
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
}
