<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controller responsável por gerenciar o storage de arquivo das soluções
 */
class SolutionStorageController extends Controller
{
    /**
     * Faz o upload dos arquivos referentes a uma solução e redireciona para a rota que
     * retorna todos referentes a esta solução
     * 
     * @param Request $request
     * @return Redirect
     */
    public function upload(Request $request)
    {

        if ($request->filled("id")) {
            $id = $request->input("id");

            if (!Storage::directoryExists($id)) {
                Storage::makeDirectory($id);
            }

            $uploadedFile = $request->file("file");

            Storage::putFile($id, $uploadedFile);            
            return $this->index($id);
        }
    }

    /**
     * Retorna uma lista contendo os dados dos arquivos associados a uma solução, identificada por seu id e as retorna para a página.
     * 
     * @param int $id Identificador da solução
     * @return Response
     * 
     * @todo corrigir os links enviados 
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

        $urls = array_map($url_properties_creator, $file_names);

        var_dump($urls);

        return response($urls, 200);
    }

    /**
     * Deleta um arquivo associado a uma solução no storage e redireciona para a rota que 
     * irá recuperar todos os arquivos restantes.
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return Redirect
     */
    public function delete_file(Request $request, int $id)
    {
        if ($request->filled("file_name")) {

            $storage_path = $id . "/" . $request->input("file_name");
            Storage::delete($storage_path);

            return $this->index($id);
        }
    }

    /**
     * Deleta o diretório de uma solução baseado no id desta e em seguida redireciona para
     * a tela principal do sistema.
     * 
     * @param int $id Identificação do registro da solução
     * @return Redirect
     */
    public function delete_folder(int $id)
    {
        Storage::deleteDirectory($id);
    }
}
