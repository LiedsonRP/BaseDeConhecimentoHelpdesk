<?php

namespace Tests\Unit;

use App\Exceptions\CategoryAlreadyAssociatedException;
use App\Models\Category;
use PHPUnit\Framework\TestCase;
use App\Models\Solution;

#php artisan test --filter=SolutionTest
class SolutionTest extends TestCase
{
    /**
     * Verifica se ele lança uma exceção no caso de se tentar associar uma
     * categoria já associada.
     * 
     * #php artisan test --filter=SolutionTest::test_if_addCategories_not_permit_add_a_associated_category
     */
    public function test_if_addCategories_not_permit_add_a_associated_category(): void
    {
        $solution_properties = [
            "title"=>"Como instalar o ArcGis",
            "solution_text" => "<p>teste</p>"
        ];

        $categories_associated = [
            New Category(["id"=>1, "name" =>"Software"]),
            New Category(["id"=>4, "name" =>"Impressora"]),            
        ];

        $categories_to_add = [
            New Category(["id"=>5, "name" =>"Rede"]),
            New Category(["id"=>6, "name" =>"Conexões"]),
            New Category(["id"=>4, "name" =>"Impressora"]),
        ];
        
        $this->expectException(CategoryAlreadyAssociatedException::class);
    
        $solution = new Solution($solution_properties);
        $solution->setRelation("categories", $categories_associated);

        $solution->addCategories($categories_to_add);


    }

    /**
     * A basic unit test example.
     */
    public function test_if_addCategory_can_associat_the_new_categories(): void
    {
        $this->assertTrue(true);
    }
}
