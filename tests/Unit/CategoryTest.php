<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Category;


#php artisan test --filter=CategoryTest
class CategoryTest extends TestCase
{
    /**
     * Checa se duas categorias são iguais caso o id
     * ou nome serem iguais
     * 
     * #php artisan test --filter=CategoryTest::test_if_categories_are_equals
     */
    public function test_if_categories_are_equals(): void
    {
        $category1 = new Category(["name" => "Hardware"]);
        $category2 = new Category(["name" => "Hardware"]);

        $this->assertTrue($category1->equals($category2));

        $category1->name = "Software";
        
        $category2->id = 1;
        $category1->id = 1;

        $this->assertTrue($category1->equals($category2));
    }

    /**
     * Checa se duas categorias são diferentes apenas se tanto id ou nome
     * serem diferentes
     * 
     * #php artisan test --filter=CategoryTest::test_if_categories_are_not_equals
     */
    public function test_if_categories_are_not_equals(): void
    {

        $category1 = new Category(["name" => "Hardware"]);
        $category1->id = 1;
        $category2 = new Category(["name" => "Software"]);
        $category2->id = 2;

        $this->assertFalse($category1->equals($category2));
    }
}
