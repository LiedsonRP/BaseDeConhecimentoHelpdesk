<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;

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
     * Recebe uma Collection de categorias (Category) e as associa 
     * a solução, caso, já não a possua. Se uma das categorias da lista for
     * já estiver associada, toda a transação será cancelada.
     * 
     * @param Collection $categoryCollection Coleção com as categorias
     * @todo
     */
    public function addCategories(Collection $categoryCollection) : void
    {
        if ($this->are_categories_associated($categoryCollection)) {
            
        }
    }
    
    /**
     * Recebe uma Collection de categorias (Category) e as remove da 
     * solução, caso, as possua e se ao final restar ao menos um número mínimo
     * de categorias. Caso a operação falhe em alguma categoria toda a 
     * transação é cancelada.
     * 
     * @todo
     * @param Collection $categoryCollection Coleção com as categorias
     */
    public function removeCategories(Collection $categoryCollection) : void
    {

    }

    /**
     * Verifica se uma a solução já possui algumas das categorias passadas
     * como parâmetro numa Collection de categorias, caso sim, retorna 
     * True, senão False caso uma das categorias estejam já associadas.
     * 
     * @param Collection $categoryCollection Coleção com as categorias
     * @return boolean
     * 
     */
    private function are_categories_associated(Collection $categoryCollection) 
    {
        $solution_categories = $this->categories()->get();
        $solution_categories->contains(function(Category $category) {
            return $categoryCollection->
        });
    }

    /**
     * Verifica se um dado título já foi cadastrado previamente no banco de dados
     * retornando True caso já cadastrado e False do contrário
     * 
     * @return bool
     */
    public function check_if_title_already_registered() : bool
    {
        return !Solution::where("title", "LIKE", $this->title)->get()->isEmpty();
    }    
}
