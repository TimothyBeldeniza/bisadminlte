<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barangay;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barangay::create([
          'name' => 'Upper Bicutan',
          'zipCode' => 1633,
          'city' => 'Taguig City',
          'province' => 'Metro Manila',
          'region' => 'National Capital Region',
          'logoPath' => 'brgy-logo.png',
          'cityLogoPath' => 'city-logo.png',
        ]);
    }
}
