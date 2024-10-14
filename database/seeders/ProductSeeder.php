<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Aspirin',
                'category' => 'Tablet',
                'active_ingredients' => 'Acetylsalicylic Acid',
                'batch_number' => 'BA12345678',
                'research_status' => 'Under Development',
                'manufacturing_date' => '2023-01-10',
                'expiration_date' => '2025-01-10',
            ],
            [
                'name' => 'Ibuprofen',
                'category' => 'Capsule',
                'active_ingredients' => 'Ibuprofen',
                'batch_number' => 'BA67890253',
                'research_status' => 'In Clinical Trials',
                'manufacturing_date' => '2023-02-20',
                'expiration_date' => '2026-02-20',
            ],
            [
                'name' => 'Paracetamol',
                'category' => 'Syrup',
                'active_ingredients' => 'Paracetamol',
                'batch_number' => 'BA11111111',
                'research_status' => 'Completed',
                'manufacturing_date' => '2022-11-30',
                'expiration_date' => '2024-11-30',
            ],
            [
                'name' => 'Amoxicillin',
                'category' => 'Injection',
                'active_ingredients' => 'Amoxicillin, Clavulanic Acid',
                'batch_number' => 'BA22222222',
                'research_status' => 'In Clinical Trials',
                'manufacturing_date' => '2023-05-15',
                'expiration_date' => '2026-05-15',
            ],
            [
                'name' => 'Omeprazole',
                'category' => 'Capsule',
                'active_ingredients' => 'Omeprazole',
                'batch_number' => 'BA33333333',
                'research_status' => 'Under Development',
                'manufacturing_date' => '2023-06-05',
                'expiration_date' => '2025-06-05',
            ],
            [
                'name' => 'Metformin',
                'category' => 'Tablet',
                'active_ingredients' => 'Metformin Hydrochloride',
                'batch_number' => 'BA44444444',
                'research_status' => 'Under Development',
                'manufacturing_date' => '2023-03-22',
                'expiration_date' => '2026-03-22',
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, ['id' => Str::uuid()]));
        }
    }
}

