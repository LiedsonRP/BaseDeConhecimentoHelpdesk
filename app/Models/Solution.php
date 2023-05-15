<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function categories()
    {
        return $this->belongsToMany(Categorie::class);
    }

    /**
     * Adiciona uma categoria a solução
     * 
     * @param Category $category Categoria a ser adicionada 
     */
    public function addCategory(Category $category)
    {
        $this->categories()->save($category);
    }
}
