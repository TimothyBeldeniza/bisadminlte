<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //admin only
            
            'barangay-official-create',
            'barangay-official-edit',
            'barangay-official-delete',
 
            'documents-show-ID',
            'documents-process',
            'documents-view',
            'documents-save-PDF',
            'documents-disapprove', 
            'documents-scan-request',
            'documents-walk-in', 

            'documents-types',
            'documents-types-create',
            'documents-types-edit',
            'documents-types-delete',           

            'complaint-show-details',
            'complaint-settle',
            'complaint-view-settle-form',
            'complaint-save-settle-form',
            'complaint-escalate',
            'complaint-view-complaint-form',
            'complaint-save-complaint-form',
            'complaint-view-escalation-form',
            'complaint-save-escalation-form',
            'complaint-reject',
            
            'usrmngmnt-show',
            'usrmngmnt-edit',
            'usrmngmnt-delete',

            //Modules/pages

            'module-file-complaint',
            'module-requested-document',
            'module-filed-complaints',
            'module-usrmngmnt',
            'module-requested-appointments',

            //Resident 
            'barangay-official-list',
            'documents-scan-document',
            'module-request-document',
            'module-request-appointment'

        ];

         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}
