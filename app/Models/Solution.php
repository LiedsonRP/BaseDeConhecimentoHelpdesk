<?php

namespace App\Models;

use App\Contracts\CategoryManager;
use App\Contracts\ComparableCategory;
use App\Exceptions\CategoryAlreadyAssociatedException;
use App\Exceptions\CategoryNotAssociatedException;
use App\Exceptions\DuplicateSolutionTitleException;
use App\Exceptions\MinCategoryNumberNotRespectedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    protected $fillable = ["title", "solution_text"];

    /**
     * Configura o relacionamento de N para N entre soluções e categorias
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Permite o cadastro de uma nova solução ao sistema, considerando que: o título da solução deve ser único, sendo gerado uma exceção caso contrário.
     * Na hora de sua criação deve também ser separado um espaço no Storage para seus possíveis arquivos multimídia
     *      
     * @throws DuplicateSolutionTitleException
     *      
     */
    public function addSolution(): void
    {
        if (!$this->check_if_title_not_exists()) {
            throw new DuplicateSolutionTitleException("O título passado já foi usado em outra solução!");
        }

        $this->save();
    }
    /**
     * Edita os dados de uma solução já cadastrada no sistema, sendo necessário informar o id da
     * solução a ser editada. Importante notar que nesta edição será verificado se o título passado já não está sendo usado
     *      
     * @param int $id Número de identificação da solução a ser editada
     * @throws DuplicateSolutionTitleException
     * @throws ModelNotFoundException
     * 
     * @todo
     */
    public function updateSolution(int $id): void
    {
        if (!$this->check_if_title_not_exists()) {
            throw new DuplicateSolutionTitleException("O título passado já foi usado em outra solução!");
        }

        $solution = Solution::findOrFail($id);

        $solution->update([
            "title" => $this->title,
            "solution_text" => $this->solution_text
        ]);
    }

    /**
     * Deleta as soluções e todas as associações de categoria vinculadas a ela. Isto apenas será possível caso
     * a solução já esteja cadastrada no banco;
     * 
     * @throws ModelNotFoundException
     */
    public function deleteSolution(int $id)
    {
    }

    /**
     * Associa uma nova categoria a solução. Isto apenas será possível caso a mesma não tenha sido previamente associada e se
     * a mesma exista no banco de dados
     * 
     * @throws ModelNotFoundException
     * @throws CategoryAlreadyAssociatedException     
     */
    public function addCategory(Category $category): void
    {
        if (!$category->checkIfCategoryExist($category)) {
            throw new ModelNotFoundException("A categoria não foi encontrada na base de dados!");
        }

        if ($this->checkIfCategoryExist($category)) {
            throw new CategoryAlreadyAssociatedException("A categoria passada já se encontra associada!");
        }

        $this->categories()->toggle($category->id);
    }
    /**
     * Remove a associação da solução com uma categoria específica. Entretanto esta ação apenas
     * poderá ser concluida no caso de ao final ainda possuir o número mínimo de categorias, retornando uma 
     * exceção caso isto não ocorra.
     * 
     * @throws MinCategoryNumberNotRespectedException
     * @throws CategoryNotAssociatedException    
     */
    public function removeCategory(Category $category): void
    {
        if (!$this->can_remove_a_category()) {
            throw new MinCategoryNumberNotRespectedException("A solução não terá o número mínimo de categorias associadas após o processo!");
        }

        if (!$this->checkIfCategoryExist($category)) {
            throw new CategoryNotAssociatedException("A categoria passada não possui uma associação com a solução!");
        }

        $this->categories()->toggle($category->id);
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
        $exists = $this->listCategories()->contains(function (ComparableCategory $category_associated) use ($category) {
            return $category_associated->equals($category);
        });

        return $exists;
    }

    /**
     * Verifica se é possível remover uma categória da associação, respeitando o 
     * número mínimo de categorias que devem estar associadas.
     * 
     * @return bool
     */
    private function can_remove_a_category(): bool
    {
        $quant_categories_associated = $this->categories()->get()->count();
        return ($quant_categories_associated - 1) >= self::MIN_ASSOCIATED_CATEGORY_NUMBER;
    }

    /**
     * Verifica se o título do objeto não foi utilizado em outra solução
     * 
     * @return bool
     */
    private function check_if_title_not_exists(): bool
    {
        return Solution::where("title", "LIKE", $this->title)->get()->isEmpty();
    }

    /**
     * Associa novas categorias a uma solução, ignorando aquelas que já estavam associadas. Ela segue a lógica que
     * se a categoria não se encontrava antes na lista de associações, mas está na nova, deve então ser adicionada. Ela ignora
     * as categorias que já estavam presentes
     *      
     * @param array $categories_id Lista contendo os ids das categorias
     */
    public function add_categories_not_existent_by_id(array $categories_id) : void
    {
        foreach ($categories_id as $id) {

            $category = Category::findOrFail($id);
            $exists = $this->checkIfCategoryExist($category);

            if (!$exists) {
                $this->addCategory($category);
            }
        }        
    }

    /**
     * Remove a associação de categorias com a solução baseado na lista de ids. Isto se dá pela lógica que, se o id existia 
     * anteriormente na lista de associações, mas não se encontra na nova lista, deve portanto ser descartado. O outros valores são ignorados
     *      
     * @param array $categories_id
     */
    public function remove_categories_existent_by_id(array $categories_id) : void
    {
        foreach ($this->listCategories() as $category) {

            if (!in_array($category->id, $categories_id)) {
                $this->removeCategory($category);
            }
        }
    }
}
