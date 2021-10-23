<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = new User([
            'lastName' => $row['first_name'],
            'firstName' => $row['last_name'],
            'middleName' => $row['middle_name'],
            'email' => $row['email'],
            'password' => Hash::make('password'),
            'contactNo' =>  $row['contact_no'],
            'houseNo' => $row['house_no'],
            'street' => $row['street'],
            'dob' =>  \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dob']))->format('Y-m-d'),
            'gender' => $row['gender'],
            'civilStatus' => $row['civil_status'],
            'citizenship' => $row['citizenship'],
            'profilePath' => 'default.png',
        ]);

        $user->assignRole('Resident');
        $user->syncPermissions(DB::table('permissions')->where('name', 'like', '%res%')->pluck('name'));

        // dd($user->toArray());

        return $user;
    }
}
