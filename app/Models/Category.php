<?php

namespace App\Models;

use App\Contracts\CategoryManager;
use App\Contracts\ComparableCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Exceptions\MinCategoryNumberNotRespectedException;
use App\Exceptions\CategoryAlreadyExistException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Modelo que gerencia as categorias do sistema
 */
class Category extends Model implements CategoryManager, ComparableCategory
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
     * Adiciona uma nova categoria ao sistema, salvando-a na base de dados
     * caso seu nome e ID não estejam já cadastrados. Ela retornará uma 
     * exceção caso a categoria passada já exista;
     * 
     * @param Category $category Categoria que deve ser adicionada
     * @throws CategoryAlreadyExistException
     */
    public function addCategory(Category $category) : void
    {        
        if ($this->checkIfCategoryExist($category)) {
            throw new CategoryAlreadyExistException("A categoria passada já está cadastrada!");
        } 
            
        $category->save();
        
    }

    /**
     * Deleta uma categoria da base de dados, retirando sua ligação com todos 
     * as soluções linkadas a ela, apenas se nenhuma delas ficar com nenhuma categoria
     * após a deleção. Caso venha a ficar sem categoria ou a categoria
     * não exista, será dado uma Exceção.
     * 
     * @param Category $category Categoria que deve ser removida
     * @throws MinCategoryNumberNotRespectedException
     * @throws ModelNotFoundException
     * @todo
     */
    public function removeCategory(Category $category) : void 
    {        
        $solutions_associated = $category->solutions()->get();
        $solutions_have_min_quant_categories = $solutions_associated->every(function (Solution $solution) {
            
            $new_quant_categories = $solution->getNumberOfCategories() - 1;
            return $new_quant_categories >= 1;

        });        

        if ($solutions_have_min_quant_categories) {            
            //$category->solutions()->toggle($solutions_associated->get("id"));
        } else {
            throw new MinCategoryNumberNotRespectedException("Uma ou mais soluções não ficaram com o número mínimo de categorias!");
        }
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

    /**
     * Verifica se uma Categoria comparável já existe no banco de dados de categorias
     * 
     * @param ComparableCategory $category categoria que será pesquisada na estrutura
     * @return bool
     */
    public function checkIfCategoryExist(ComparableCategory $category): bool
    {
        $exists =  $this->listCategories()->contains(function(Category $category_stored) use ($category) {
            return $category_stored->equals($category);
        });

        return $exists;
    }

    /**
     * Verifica se a respctiva instancia de categória é igual a uma
     * outra, levando em conta que serão considerados iguais caso seu
     * nome ou id sejam iguais.
     * 
     * @param ComparableCategory $category Categoria a ser comparada
     * @return bool
     */
    public function equals(ComparableCategory $category) : bool
    {
        return $category->id == $this->id || $category->name == $this->name;
    }
    
}
