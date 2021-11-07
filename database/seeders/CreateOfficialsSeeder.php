<?php

namespace Database\Seeders;
use App\Models\BarangayOfficials;
use Illuminate\Database\Seeder;

class CreateOfficialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BarangayOfficials::create([
            'firstName' => 'Alexander',
            'lastName' => 'Penolio', 
            'middleName' => null, 
            'position' => 'Chairman', 
            'imagePath' => 'default.png',
        ]);
        BarangayOfficials::create([
            'firstName' => 'Gemma',
            'lastName' => 'Espejon', 
            'middleName' => null, 
            'position' => 'Councilor', 
            'imagePath' => 'default.png',
        ]);
        BarangayOfficials::create([
            'firstName' => 'Noel',
            'lastName' => 'Zabala', 
            'middleName' => null, 
            'position' => 'Councilor', 
            'imagePath' => 'default.png',
        ]);
        BarangayOfficials::create([
            'firstName' => 'Queen Dolly',
            'lastName' => 'Carreon', 
            'middleName' => null, 
            'position' => 'Councilor', 
            'imagePath' => 'default.png',
        ]);
        BarangayOfficials::create([
            'firstName' => 'Shiela',
            'lastName' => 'Camangian', 
            'middleName' => null, 
            'position' => 'Councilor', 
            'imagePath' => 'default.png',
        ]);
        BarangayOfficials::create([
            'firstName' => 'Robert',
            'lastName' => 'Teodosio', 
            'middleName' => null, 
            'position' => 'Councilor', 
            'imagePath' => 'default.png',
        ]);
        BarangayOfficials::create([
            'firstName' => 'Rogie',
            'lastName' => 'Gumaro', 
            'middleName' => null, 
            'position' => 'Councilor', 
            'imagePath' => 'default.png',
        ]);
        BarangayOfficials::create([
            'firstName' => 'Elma',
            'lastName' => 'Manalo', 
            'middleName' => null, 
            'position' => 'Councilor', 
            'imagePath' => 'default.png',
        ]);
        BarangayOfficials::create([
            'firstName' => 'Maiko Charmaine',
            'lastName' => 'Guzman', 
            'middleName' => null, 
            'position' => 'SK Chairman', 
            'imagePath' => 'default.png',
        ]);
        BarangayOfficials::create([
            'firstName' => 'Nemia',
            'lastName' => 'Boco', 
            'middleName' => null, 
            'position' => 'Secretary', 
            'imagePath' => 'default.png',
        ]);
        BarangayOfficials::create([
            'firstName' => 'Cyril',
            'lastName' => 'Papa', 
            'middleName' => null, 
            'position' => 'Treasurer', 
            'imagePath' => 'default.png',
        ]);
    }
}
