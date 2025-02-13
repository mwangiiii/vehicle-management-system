<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Propulsion;

class PropulsionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define propulsion types
        $propulsions = ['Petrol', 'Diesel', 'Electric', 'Hybrid', 'PHEV'];

        // Insert propulsion types into the database
        foreach ($propulsions as $propulsion) {
            Propulsion::updateOrCreate(['type' => $propulsion]);
        }
    }
}
