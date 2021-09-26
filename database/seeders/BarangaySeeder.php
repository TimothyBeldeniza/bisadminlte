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
          'name' => 'Barangay Name',
          'zipCode' => 1111,
          'city' => 'City',
          'province' => 'Province',
          'region' => 'Region',
          'logoPath' => 'brgy-logo.png',
          'cityLogoPath' => 'city-logo.png',
        ]);
    }
}
