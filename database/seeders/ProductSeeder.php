<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();  // Create a new Faker instance

        // Generate a manufacturing date from 2023 onwards
        $manufacturingDate = $faker->dateTimeBetween('2023-01-01', 'now')->format('Y-m-d');
        // Generate an expiration date at least 1 year and up to 3 years after the manufacturing date
        $expirationDate = $faker->dateTimeBetween($manufacturingDate, $manufacturingDate . ' +3 years')->format('Y-m-d');
        
        // Possible categories and statuses
        $categories = ['Tablet', 'Capsule', 'Syrup', 'Injection'];
        $statuses = ['Under Development', 'In Clinical Trials', 'Completed'];
        $activeIngredients = [
            'Acetylsalicylic Acid', 
            'Ibuprofen', 
            'Paracetamol', 
            'Amoxicillin, Clavulanic Acid', 
            'Omeprazole', 
            'Metformin Hydrochloride', 
            'Ciprofloxacin', 
            'Doxycycline', 
            'Prednisone', 
            'Simvastatin'
        ];

        // Seed 5 random products
        for ($i = 0; $i < 5; $i++) {
            Product::create([
                'id' => (string) Str::uuid(),
                'name' => $faker->randomElement(['Aspirin', 'Ibuprofen', 'Paracetamol', 'Amoxicillin', 'Omeprazole', 'Metformin', 'Ciprofloxacin', 'Doxycycline', 'Prednisone', 'Simvastatin']),
                'category' => $faker->randomElement($categories),
                'active_ingredients' => $faker->randomElement($activeIngredients),  // Pick from the list of active ingredients
                'batch_number' => strtoupper($faker->lexify('??')) . $faker->numerify('########'),  // Generates batch numbers like 'AB12345678'
                'research_status' => $faker->randomElement($statuses),
                'manufacturing_date' => $manufacturingDate,
                'expiration_date' => $expirationDate,
            ]);
        }
    }
}


