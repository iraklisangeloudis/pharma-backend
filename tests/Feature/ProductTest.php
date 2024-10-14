<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_product()
    {
        $data = [
            'name' => 'Aspirin',
            'category' => 'Tablet',
            'active_ingredients' => 'Acetylsalicylic Acid',
            'batch_number' => 'AB12345678',
            'research_status' => 'Under Development',
            'manufacturing_date' => '2024-01-01',
            'expiration_date' => '2025-01-01',
        ];

        // Simulate a POST request to the API
        $response = $this->postJson('/api/products', $data);

        // Assert that the product was created successfully
        $response->assertStatus(201);

        // Verify the product is in the database
        $this->assertDatabaseHas('products', $data);
    }

    public function test_it_can_fetch_all_products()
    {
        // Create a few products in the database
        Product::factory()->create(['name' => 'Aspirin']);
        Product::factory()->create(['name' => 'Paracetamol']);

        // Simulate a GET request to the API
        $response = $this->getJson('/api/products');

        // Assert that the response is OK (200)
        $response->assertStatus(200);

        // Check that the returned data contains the 2 products
        $response->assertJsonCount(2); 
    }

    public function test_it_can_update_a_product()
    {
        // Create a product in the database
        $product = Product::factory()->create([
            'name' => 'Aspirin',
            'category' => 'Tablet',
            'active_ingredients' => 'Acetylsalicylic Acid',
            'batch_number' => 'AB12345678',
            'research_status' => 'Under Development',
            'manufacturing_date' => '2024-01-01',
            'expiration_date' => '2025-01-01',
        ]);

        // Define the new data for the update
        $updatedData = [
            'name' => 'Updated Aspirin',
            'category' => 'Capsule',
            'active_ingredients' => 'Updated Acetylsalicylic Acid',
            'batch_number' => 'AB12345678', 
            'research_status' => 'In Clinical Trials',
            'manufacturing_date' => '2024-02-01',
            'expiration_date' => '2025-02-01',
        ];

        // Simulate a PUT request to update the product
        $response = $this->putJson("/api/products/{$product->id}", $updatedData);

        // Assert that the update was successful (200 OK)
        $response->assertStatus(200);

        // Verify that the product was updated in the database
        $this->assertDatabaseHas('products', $updatedData);
    }
}
