<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolutionStorageController extends Controller
{
    /**
     * Faz o upload dos arquivos referentes a uma solução
     * @param Request $request
     */
    public function upload(Request $request)
    {    

        if ($request->filled("id")) {
            $id = $request->input("id");
            

            if (!Storage::directoryExists($id)) {
                Storage::makeDirectory($id);
            }                        

            $uploadedFiles = $request->allFiles()["files"];            

            for ($i = 0; $i < sizeof($uploadedFiles); $i++) {                
                $file = $uploadedFiles[$i];
                Storage::putFileAs($id, $file, $file->getClientOriginalName());
                unset($file);
            }

            return $this->index($id);
        }        
    }

    /**
     * Retorna uma lista contendo os dados dos arquivos associados a uma solução, identificada por seu id.
     * @param int $id Identificador da solução
     */
    public function index(int $id) 
    {
        $file_names = Storage::allFiles($id);     
        
        $url_properties_creator = function ($file_path) {
            
            $file_name = explode("/", $file_path)[1];            

            return [
                "file_name" => $file_name,
                "file_path" => Storage::url($file_path)
            ];
        };
        
        $url = array_map($url_properties_creator, $file_names);        

        return view("pages/test", ["files_url"=>$url, "id" => $id]);
    }

    /**
     * Deleta um arquivo associado a uma solução no storage
     * @param Request $request
     * @param int $id
     */
    public function delete_file(Request $request, int $id)
    {
        if ($request->filled("file_name")) {
            
            $storage_path = $id."/".$request->input("file_name");            
            Storage::delete($storage_path);
        }
    }

    /**
     * Deleta o diretório de uma solução baseado no id desta.
     * @param int $id Identificação do registro da solução
     */
    public function delete_folder(int $id)
    {
        Storage::deleteDirectory($id);
    }
}
