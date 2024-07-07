<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Api test for creation of Product with Response 201 of creation.
     *
     * @return void
     */
    /** @test */
    public function test_product_creation()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'T-Shirt',
            'description' => 'Multiple Sizes',
            'price' => 24,
            'stock' => 1
        ]);

        $response->assertStatus(201);

        // Checking the response structure and content
        $response->assertJsonStructure([
            'id',
            'name',
            'description',
            'price',
            'stock',
            'created_at',
            'updated_at'
        ])->assertJson([
            'name' => 'T-Shirt',
            'description' => 'Multiple Sizes',
            'price' => 24,
            'stock' => 1
        ]);

        // Checking the database to ensure the exist in DataBase
        $this->assertDatabaseHas('products', [
            'name' => 'T-Shirt',
            'description' => 'Multiple Sizes',
            'price' => 24,
            'stock' => 1
        ]);
    }
}
