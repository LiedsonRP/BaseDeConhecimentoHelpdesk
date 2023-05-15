<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Solution;
use Illuminate\Support\Facades\DB;

class SolutionController extends Controller
{

    public function index()
    {
        return Solution::with("categories")->get();
    }

    /**
     * Cadastra uma nova solução no sistema, fazendo tanto seu registro no banco de dados, como criando
     * uma pasta para armazenar seus arquivos multimídia
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

    public function update(Request $request)
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
}
