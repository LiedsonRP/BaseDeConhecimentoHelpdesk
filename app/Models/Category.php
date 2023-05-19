<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que gerencia as categorias do sistema
 */
class Category extends Model
{
    use HasFactory;

    /**
     * Define o nome da tabela do banco de dados que o model referencia
     */
    protected $table = "categories";
    /**
     * Define que a tabela não gerencia colunas de created_at e updated_at
     */
    public $timestamps = false;
    /**
     * Indica quais campos podem ser preenchidos
     */
    protected $fillable = ["name"];

    /**
     * Configura o relacionamento de N para N entre categorias e soluções
     */
    public function solutions()
    {
        return $this->belongsToMany(Solution::class);
    }

    public function check_if_category_exists()
    {
        return Category::where("name", "LIKE", $this->name)->get()->isEmpty();        
    }

    /**
     * Verifica se a respctiva instancia de categória é igual a uma
     * outra, levando em conta que serão considerados iguais caso seu
     * nome ou id sejam iguais.
     * 
     * @param Category $category Categoria a ser comparada
     * @return bool
     */
    public function equals(Category $category) : bool
    {
        return $category->id == $this->id && $category->name == $this->name;
    }
    
}
