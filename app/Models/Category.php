<?php

namespace App\Models;

use App\Contracts\CategoryManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Exceptions\MinCategoryNumberNotRespectedException;
use App\Exceptions\CategoryAlreadyExistException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Modelo que gerencia as categorias do sistema
 */
class Category extends Model implements CategoryManager
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
        return $category->id == $this->id || $category->name == $this->name;
    }

    /**
     * Adiciona uma nova categoria ao sistema, salvando-a na base de dados
     * caso seu nome e ID não estejam já cadastrados. Ela retornará uma 
     * exceção caso a categoria passada já exista;
     * 
     * @throws CategoryAlreadyExistException
     */
    public function addCategory(Category $comparableCategory) : void
    {
        $categoryList = $this->listCategories();
        $already_exists = $categoryList->contains(function($associatedCategory) use ($comparableCategory){
            return $associatedCategory->equals($comparableCategory);            
        });                

        if ($already_exists) {
            throw new CategoryAlreadyExistException("A categoria passada já está cadastrada!");
        } else {
            $comparableCategory->save();
        }
    }

    /**
     * Deleta uma categoria da base de dados, retirando sua ligação com todos 
     * as soluções linkadas a ela, apenas se nenhuma delas ficar com nenhuma categoria
     * após a deleção. Caso venha a ficar sem categoria ou a categoria
     * não exista, será dado uma Exceção.
     * 
     * @throws MinCategoryNumberNotRespectedException
     * @throws ModelNotFoundException
     * @todo
     */
    public function removeCategory(Category $comparableCategory) : void 
    {        
        dd($comparableCategory->solutions()->get());
    }

    /**
     * Retorna uma use Illuminate\Support\Collection listando todas
     * as categorias cadastradas no sistema.
     * 
     * @return Illuminate\Suport\Collection categorias listadas no sistema
     */
    public function listCategories() : Collection 
    {
        return Category::all();
    }
    
}
