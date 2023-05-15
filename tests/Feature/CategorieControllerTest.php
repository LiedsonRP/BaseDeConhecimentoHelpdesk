<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

# php artisan test --filter=CategorieControllerTest
class CategorieControllerTest extends TestCase
{
    /**
     * # php artisan test --filter=CategorieControllerTest::test_example
     * 
     * A basic feature test example.
     */
    public function test_is_category_stored(): void
    {
        $category_name = "Software";        
        $response = $this->post('/categoria/cadastrar',["name" => $category_name]);

        $response->assertStatus(200);
    }
}
