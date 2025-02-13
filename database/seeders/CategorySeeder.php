<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define category names
        $categories = ['Hatchback', 'Saloon', 'SUV', 'Pickup', 'Lorry'];

        // Insert categories into the database
        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category]);
        }
    }
}
