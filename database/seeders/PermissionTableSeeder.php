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
            'res-barangay-official-list',
            'barangay-official-create',
            'barangay-official-edit',
            'barangay-official-delete',
 
            'documents-show-ID',
            'documents-process',
            'documents-view',
            'documents-save-PDF',
            'documents-disapprove',

            'documents-types',
            'documents-types-create',
            'documents-types-edit',
            'documents-types-delete',

            //Scanner
            'res-documents-scan-document',
            'documents-scan-request',

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

            'res-module-request-document',
            'module-file-complaint',
            // 'module-service-management',
            
            'module-requested-documents',
            'module-filed-complaints',
            
            'module-usrmngmnt',




        ];

         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}
