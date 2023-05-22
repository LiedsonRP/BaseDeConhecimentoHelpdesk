<?php

namespace App\Models;

use App\Contracts\CategoryManager;
use App\Contracts\ComparableCategory;

use App\Exceptions\CategoryNotAssociatedException;
use App\Exceptions\MinCategoryNumberNotRespectedException;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * Modelo que gerencia as soluções do sistema
 */
class Solution extends Model implements CategoryManager
{
    use HasFactory;

    /**
     * Define o número mínimo de categorias que a solução de estar associada
     */
    private const MIN_ASSOCIATED_CATEGORY_NUMBER = 1;

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
     * Verifica e retorna a quantidade de categorias associadas a respectiva solução;
     * 
     * @return int
     */
    public function getNumberOfCategories()
    {
        return $this->categories()->get()->count();
    }

    /**
     * Verifica se é possível remover uma categória da associação, respeitando o 
     * número mínimo de categorias que devem estar associadas.
     * 
     * @return bool
     */
    private function can_remove_a_category() : bool
    {
        $quant_categories_associated = $this->categories()->get()->count();
        return $quant_categories_associated - 1 >= self::MIN_ASSOCIATED_CATEGORY_NUMBER;        
    }

    /**
     * 
     * @todo
     */
    public function addCategory(Category $comparableCategory) : void
    {

    }
    /**
     * Remove a associação da solução com uma categoria específica. Entretanto esta ação apenas
     * poderá ser concluida no caso de ao final ainda possuir o número mínimo de categorias, retornando uma 
     * exceção caso isto não ocorra.
     * 
     * @throws MinCategoryNumberNotRespectedException
     * @throws CategoryNotAssociatedException
     * @todo
     */
    public function removeCategory(Category $comparableCategory) : void
    {
        if ($this->can_remove_a_category()) {
            throw new MinCategoryNumberNotRespectedException("A solução não terá o número mínimo de categorias associadas após o processo!");
        }
        
        $categories_associated = $this->listCategories();    

        $is_categories_associated = $categories_associated->contains(function(Category $category_associated) use ($comparableCategory) {
            return $category_associated->equals($comparableCategory);
        });

        if ($is_categories_associated) {
            $this->categories()->toggle($comparableCategory->id);
        } else {
            throw new CategoryNotAssociatedException("A categoria passada não possui uma associação com a solução!");
        }
    }    
    
    /**
     * Retorna todas as categorias associadas a respectiva solução;
     * 
     * @return Illuminate\Support\Collection
     */
    public function listCategories(): Collection
    {
        return $this->categories()->get();
    }

    /**
     * Verifica se uma categoria comparável está associada está associada a solução
     * 
     * @param ComparableCategory $category Categoria comparavel que será pesquisada
     * @return bool
     */
    public function checkIfCategoryExist(ComparableCategory $category): bool
    {
        $exists = $this->listCategories()->contains(function(ComparableCategory $category_associated) use ($category) {
            return $category_associated->equals($category);
        });

        return $exists;
    }

}
