<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class UsersImportController extends Controller
{
    public function show()
    {
        return view('users.import');
    }

    public function store(Request $request)
    {   
        $file = $request->file('file')->store('import');
        // dd($file);
        $import = new UsersImport;
        $import->import($file);
        
        // dd($import->failures());


        if($import->failures()->isNotEmpty()){
            return back()->withFailures($import->failures());
        }
     
        return redirect()->route('users.index')->with('success','Excel file imported successfully');
    }
}
