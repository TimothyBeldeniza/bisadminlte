<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentTypes;


class DocumentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
  * @return void
     */
    public function run()
    {
        $clear = 'This is to certify that <<lastName>>, <<firstName>>, of legal age, <<civilStatus>>, and resident of <<houseNo>>, <<brgy>>, <<city>>, <<province>>.

He/She is a law-abiding citizen and has NO DEROGATORY record/s in this office up to this date.
        
This certification is being issued upon the request of the interested party connection with the requirement for whatever legal purposes that may serve them best, in this case, it is a <<purpose>> requirement.';

        $indi = 'This is to certify that <<lastName>>, <<firstName>>, of legal age, <<civilStatus>>, <<citizenship>> citizen, and resident of <<houseNo>>, <<street>>, <<brgy>>, <<city>>, <<province>>.

Further, certify that the above-named person belongs to the Indigent Family in this Barangay.
        
This certification is being issued upon the request of the interested party connection with the requirement for whatever legal purposes that may serve them best, in this case, it is a <<purpose>> requirement.';

        $resi = '<<firstName>> <<lastName>>

Resident of this Barangay, and with postal address <<houseNo>> <<street>> <<brgy>> <<city>>, within the territorial jurisdiction of this Barangay.
        
This certification/clearance has been issued upon the request of the above-mentioned name for <<purpose>> purpose on this Barangay that it may serve for him/her best.';
        
        $indigency = DocumentTypes::create([
          'docType' => 'Indigency',
          'template' => $indi,
          'price' => 0,
        ]);

        $clearance = DocumentTypes::create([
          'docType' => 'Clearance',
          'template' => $clear,
          'price' => 50,
        ]);

        $residency = DocumentTypes::create([
         'docType' => 'Residency',
         'template' => $resi,
         'price' => 0,
        ]);
    }
}
