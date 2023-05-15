<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function upload(Request $request) {
        
        foreach ($request->allFiles()['files'] as $file) {
            $file->store("solutions/".$request->input("id"));
        }
    }
}
