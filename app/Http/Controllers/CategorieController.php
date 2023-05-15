<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Database\QueryException;

class CategorieController extends Controller
{

    public function index()
    {
        return Categorie::all();
    }

    /**
     * Salva uma nova categoria no banco de dados
     */
    public function store(Request $request)
    {
        if ($request->filled("name")) {            
            try {
                $categorie = new Categorie(["name" => $request->input("name")]);
                $categorie->save();
                return response("Categoria cadastrada!", 201);
            } catch (QueryException $ex) {
                return response("A categoria já está cadastrada!", 417);
            }            
        } else{
            return response("não foi possível cadastrar", 417);
        }
    }
}

