<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    // Define the corresponding model
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'name' => $this->faker->word,
            'category' => $this->faker->randomElement(['Tablet', 'Capsule', 'Injection']),
            'active_ingredients' => $this->faker->words(3, true),
            'batch_number' => strtoupper($this->faker->lexify('??')) . $this->faker->numerify('########'),
            'research_status' => $this->faker->randomElement(['Under Development', 'In Clinical Trials', 'Completed']),
            'manufacturing_date' => $this->faker->date('Y-m-d'),
            'expiration_date' => $this->faker->date('Y-m-d', '+1 year'),
        ];
    }
}

