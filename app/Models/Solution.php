<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modelo que gerencia as soluções do sistema
 */
class Solution extends Model
{
    use HasFactory;

    /**
     * @var string $table define o nome da tabela no banco de dados
     */
    protected $table = "solutions";

    /**
     * @var boolean $timestamps define se o modelo deve gerenciar as colunas de created_at e updated_at
     */
    public $timestamps = true;

    /**
     * @var array $fillable define quais campos o modelo permite ser preenchido.
     */
    protected $fillable = ["title", "solution_text", "folder_path"];

    /**
     * Configura o relacionamento de N para N entre soluções e categorias
     */
    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Adiciona uma categoria a solução
     * 
     * @param Category $category Categoria a ser adicionada
     */
    public function addCategory(Category $category) : void
    {
        $this->categories()->save($category);
    }    

    /**
     * Verifica se um dado título já foi cadastrado previamente no banco de dados
     * @return bool
     */
    public function check_if_title_already_registered() : bool
    {
        return !Solution::where("title", "LIKE", $this->title)->get()->isEmpty();
    }
}
