<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $admin = User::create([
         'lastName' => 'Admin',
         'firstName' => 'Admin',
         'middleName' => null,
         'email' => 'admin@email.com',
         'email_verified_at' => date('Y-m-d H:i:s'),
         'password' => bcrypt('admin@email.com'),
         'contactNo' => 9123456789,
         'houseNo' => 'Admin House No',
         'street' => 'Admin Street',
         'dob' => '1999-10-9',
         'gender' => 'Male',
         'civilStatus' => 'Single',
         'citizenship' => 'Filipino',
         'remember_token' => NULL,
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
         'deleted_at' => NULL,
         'profilePath' => 'default.png'
      ]);

      $chairman = User::create([
         'lastName' => 'Chairman',
         'firstName' => 'Chairman',
         'middleName' => 'Chairman',
         'email' => 'Chairman@gmail.com',
         'email_verified_at' => date('Y-m-d H:i:s'),
         'password' => bcrypt('Chairman@gmail.com'),
         'contactNo' => 9162128056,
         'houseNo' => 'Chairman',
         'street' => 'Chairman',
         'dob' => '2000-08-03',
         'gender' => 'Male',
         'civilStatus' => 'Single',
         'citizenship' => 'Filipino',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
         'deleted_at' => NULL,
         'profilePath' => 'default.png'
      ]);

      $sec = User::create([
         'lastName' => 'Secretary',
         'firstName' => 'Secretary',
         'middleName' => 'Secretary',
         'email' => 'Secretary@gmail.com',
         'email_verified_at' => date('Y-m-d H:i:s'),
      'password' => bcrypt('Secretary@gmail.com'),
         'contactNo' => 9162128056,
         'houseNo' => 'Secretary',
         'street' => 'Secretary',
         'dob' => '2000-08-03',
         'gender' => 'Female',
         'civilStatus' => 'Single',
         'citizenship' => 'Filipino',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
         'deleted_at' => NULL,
         'profilePath' => 'default.png'
      ]);

      $coun = User::create([
         'lastName' => 'Councilor',
         'firstName' => 'Councilor',
         'middleName' => 'Councilor',
         'email' => 'Councilor@gmail.com',
         'email_verified_at' => date('Y-m-d H:i:s'),
      'password' => bcrypt('Councilor@gmail.com'),
         'contactNo' => 9162128056,
         'houseNo' => 'Councilor',
         'street' => 'Councilor',
         'dob' => '2000-08-03',
         'gender' => 'Female',
         'civilStatus' => 'Single',
         'citizenship' => 'Filipino',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
         'deleted_at' => NULL,
         'profilePath' => 'default.png'
      ]);

      $trea = User::create([
         'lastName' => 'Treasurer',
         'firstName' => 'Treasurer',
         'middleName' => 'Treasurer',
         'email' => 'Treasurer@gmail.com',
         'email_verified_at' => date('Y-m-d H:i:s'),
      'password' => bcrypt('Treasurer@gmail.com'),
         'contactNo' => 9162128056,
         'houseNo' => 'Treasurer',
         'street' => 'Treasurer',
         'dob' => '2000-08-03',
         'gender' => 'Female',
         'civilStatus' => 'Single',
         'citizenship' => 'Filipino',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
         'deleted_at' => NULL,
         'profilePath' => 'default.png'
      ]);

      $clerk = User::create([
         'lastName' => 'Clerk',
         'firstName' => 'Clerk',
         'middleName' => 'Clerk',
         'email' => 'Clerk@gmail.com',
         'email_verified_at' => date('Y-m-d H:i:s'),
      'password' => bcrypt('Clerk@gmail.com'),
         'contactNo' => 9162128056,
         'houseNo' => 'Clerk',
         'street' => 'Clerk',
         'dob' => '2000-08-03',
         'gender' => 'Male',
         'civilStatus' => 'Single',
         'citizenship' => 'Filipino',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
         'deleted_at' => NULL,
         'profilePath' => 'default.png'
      ]);

      $timots = User::create([
      'lastName' => 'Beldeniza',
      'firstName' => 'Timothy',
      'middleName' => NULL,
      'email' => 'bsdtimothy@gmail.com',
      'email_verified_at' => date('Y-m-d H:i:s'),
      'password' => bcrypt('password'),
      'contactNo' => 9302990870,
      'houseNo' => 'Blk 31 Lot 1 Purok 4 Central Bicutan Taguig City',
      'street' => 'Poolan',
      'dob' => '1999-10-9',
      'gender' => 'Male',
      'civilStatus' => 'Single',
      'citizenship' => 'Filipino',
      'remember_token' => NULL,
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
      'deleted_at' => NULL,
      'profilePath' => 'default.png'
      ]);

      $barts = User::create([
         'lastName' => 'Bartolome',
         'firstName' => 'Jon Jeremiah',
         'middleName' => 'Espina',
         'email' => 'bartolomejonjeremiah@gmail.com',
         'email_verified_at' => date('Y-m-d H:i:s'),
      'password' => bcrypt('password'),
         'contactNo' => 9760014639,
         'houseNo' => 'Unit 322 Bldg A6 Urban Deca Homes',
         'street' => 'McArthur Hwy',
         'dob' => '1999-11-14',
         'gender' => 'Male',
         'civilStatus' => 'Single',
         'citizenship' => 'Filipino',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
         'deleted_at' => NULL,
         'profilePath' => 'default.png'
      ]);

      $baste = User::create([
         'lastName' => 'Cabiades',
         'firstName' => 'Sebastian Carlo',
         'middleName' => 'Olarte',
         'email' => 'cabiadess@gmail.com',
         'email_verified_at' => date('Y-m-d H:i:s'),
      'password' => bcrypt('1234'),
         'contactNo' => 9162128056,
         'houseNo' => '#29',
         'street' => 'Duhat St.',
         'dob' => '2000-08-03',
         'gender' => 'Male',
         'civilStatus' => 'Single',
         'citizenship' => 'Filipino',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
         'deleted_at' => NULL,
         'profilePath' => 'default.png'
      ]);

      Role::create(['name' => 'Admin']);
      Role::create(['name' => 'Resident']);
      Role::create(['name' => 'Clerk']);
      Role::create(['name' => 'Councilor']);
      Role::create(['name' => 'Secretary']);
      Role::create(['name' => 'Chairman']);
      Role::create(['name' => 'Treasurer']);
      // Role::create(['name' => 'Zone Leader']);
      $permissions = Permission::pluck('id','id')->all();

      // $role->syncPermissions($permissions);
      

      $admin->assignRole([$role->id]);
      // $admin->syncPermissions($permissions);
      $admin->syncPermissions($permissions);

      $chairman->assignRole('Chairman');
      $chairman->syncPermissions([
         'module-requested-documents',
         'res-barangay-official-list',
         'module-filed-complaints',
         'complaint-show-details',
         'complaint-view-settle-form',
         'complaint-save-settle-form',
         'complaint-view-complaint-form',
         'complaint-save-complaint-form',
         'complaint-view-escalation-form',
         'complaint-save-escalation-form',
         
         'res-module-request-document',
         'res-documents-scan-document',
      ]);

      $sec->assignRole('Secretary');
      $sec->syncPermissions([
         'module-requested-documents',
         'documents-show-ID',
         'documents-process',
         'documents-view',
         'documents-save-PDF',
         'documents-disapprove',
         'documents-types',
         'documents-types-create',
         'documents-types-edit',
         'documents-types-delete',

         'res-documents-scan-document',
         'documents-scan-request',

         'module-file-complaint',
         'module-filed-complaints',
         'complaint-show-details',
         'complaint-view-settle-form',
         'complaint-save-settle-form',
         'complaint-view-complaint-form',
         'complaint-save-complaint-form',
         'complaint-view-escalation-form',
         'complaint-save-escalation-form',

         'res-barangay-official-list',
         'res-module-request-document',
         'res-documents-scan-document',
      ]);

      $coun->assignRole('Councilor');
      $coun->syncPermissions([
         'module-filed-complaints',
         'module-file-complaint',
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

         'res-barangay-official-list',
         'res-module-request-document',
         'res-documents-scan-document',
      ]);

      $trea->assignRole('Treasurer');
      $trea->syncPermissions([
         'module-requested-documents',
         // 'module-filed-complaints',
         'res-barangay-official-list',
         'res-documents-scan-document',
         'res-module-request-document',
      ]);

      $clerk->assignRole('Clerk');
      $clerk->syncPermissions([
         'module-requested-documents',
         'documents-show-ID',
         'documents-process',
         'documents-view',
         'documents-save-PDF',
         'documents-disapprove',
         'res-documents-scan-document',
         'documents-scan-request',
         'res-barangay-official-list',
         'res-module-request-document',
      ]);

      $timots->assignRole('Resident');
      $timots->syncPermissions(DB::table('permissions')->where('name', 'like', '%res%')->pluck('name'));

      $barts->assignRole('Resident');
      $barts->syncPermissions(DB::table('permissions')->where('name', 'like', '%res%')->pluck('name'));

      $baste->assignRole('Resident');
      $baste->syncPermissions(DB::table('permissions')->where('name', 'like', '%res%')->pluck('name'));
    }
}
