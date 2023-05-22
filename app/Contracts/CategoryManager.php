<?php

namespace App\Contracts;

use App\Models\Category;
use Illuminate\Support\Collection;

/**
 * Permite o gerenciamento das categorias do Sistema
 */
interface CategoryManager
{
    /**
     * Permite a inserção de um objeto que implemente a interface CategoryComparator
     * numa estrutura de dados
     */
    public function addCategory(Category $category) : void;

    /**
     * Remove um objeto que implemente a interface CategoryComparator de
     * uma estrutura de dados
     */
    public function removeCategory(Category $category) : void;

    /**
     * Lista todos os objetos presentes na estrutura de dados
     */
    public function listCategories() : Collection;

    /**
     * Permite verificar se uma dada categoria está inserida na respectiva estrutura de armazenamento usada
     * 
     * @return bool
     */
    public function checkIfCategoryExist(ComparableCategory $category) : bool;
}