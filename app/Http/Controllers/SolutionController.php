<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Solution;
use Illuminate\Support\Facades\DB;

class SolutionController extends Controller
{

    public function index()
    {
        return Solution::all();
    }

    public function store(Request $request)
    {
        if ($request->filled(["title", "SolutionText", "categories"])){
            DB::beginTransaction();

            $solution = new Solution($request->only(["title",  "SolutionText"]));
            $solution->save();

            $categories = $request->input("categories");

            if (sizeof($categories) > 0) {

                foreach ($categories as $categorie_id) {
                    $categorie = Categorie::find($categorie_id);
                    $solution->categories()->save($categorie);
                }
            }

            DB::commit();
        }
    }
}
