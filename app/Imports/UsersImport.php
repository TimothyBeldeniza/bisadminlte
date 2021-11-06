<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class UsersImport implements 
    ToModel, 
    WithHeadingRow, 
    SkipsOnError, 
    WithValidation,
    SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = new User([
            'lastName' => $row['last_name'],
            'firstName' => $row['first_name'],
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
        $user->syncPermissions([
            'barangay-official-list',
            'documents-scan-document',
            'module-request-document',

        ]);

        // dd($user->toArray());
        // dd($row['dob']);
        return $user;
    }

    public function rules(): array
    {
        return [
            '*.email' => ['email', 'unique:users,email'],
            '*.last_name' => ['required', 'regex:/^[a-zA-ZñÑ\s]+$/','string', 'max:255'],
            '*.first_name' => ['required','regex:/^[a-zA-ZñÑ\s]+$/', 'string', 'max:255'],
            '*.middle_name' => ['nullable','regex:/^[a-zA-ZñÑ\s]+$/', 'string', 'max:255'],
            '*.email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            '*.contact_no' => ['required','digits:10'],
            '*.house_no' => ['required', 'string'],
            '*.street' => ['required', 'string'],
            '*.dob' => ['required'],  
            '*.gender' => ['required', 'string'],
            '*.civil_status' => ['required', 'string'],
            '*.citizenship' => ['required','regex:/^[a-zA-ZñÑ\s]+$/', 'string'],
        ];
    }

}
