<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangay;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BarangayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brgy = DB::table('barangay')
                ->select('id', 'name', 'zipCode', 'city', 'province', 'region', 
                        'logoPath', 'cityLogoPath')
                ->first();
        // dd($brgy);
        return view('barangay.index', ['brgy' => $brgy]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'cityLogoPath' => 'mimes:png|max:5048',
        'logoPath' => 'mimes:png|max:5048',
        'region' => ['required','string'],
        'province' => ['required','string'],
        'city' => ['required', 'regex:/^[a-zA-ZñÑ\s]+$/','string'],
        'name' => ['required','string'],
        'zipCode' => 'required', 'integer',
      ]);

      // dd($request->all());

      $oldCityLogo = public_path('images/city-logo.png');
      $oldLogo = public_path('images/brgy-logo.png');

      if($request->cityLogoPath && $request->logoPath)
      {
        File::delete($oldCityLogo);
        File::delete($oldLogo);
        
        $newCityLogo = "city-logo." . $request->cityLogoPath->extension();
        $request->cityLogoPath->move(public_path('images/'), $newCityLogo);
        
        $newLogo = "brgy-logo." . $request->logoPath->extension();
        $request->logoPath->move(public_path('images/'), $newLogo);


        Barangay::where('id', $id)->update([
          'name' => $request->name,
          'zipCode' => $request->zipCode,
          'city' => $request->city,
          'province' => $request->province,
          'region' => $request->region,
          'logoPath' => $newLogo,
          'cityLogoPath' => $newCityLogo,
        ]);
      }
      elseif($request->cityLogoPath)
      {
        File::delete($oldCityLogo);

        $newCityLogo = "city-logo.".$request->cityLogoPath->extension();

        $request->cityLogoPath->move(public_path('images/'), $newCityLogo);

        Barangay::where('id', $id)->update([
          'name' => $request->name,
          'zipCode' => $request->zipCode,
          'city' => $request->city,
          'province' => $request->province,
          'region' => $request->region,
          'cityLogoPath' => $newCityLogo,
        ]);

      }
      elseif($request->logoPath)
      {
        File::delete($oldLogo);

        $newLogo = "brgy-logo.".$request->logoPath->extension();

        $request->logoPath->move(public_path('images/'), $newLogo);

        Barangay::where('id', $id)->update([
          'name' => $request->name,
          'zipCode' => $request->zipCode,
          'city' => $request->city,
          'province' => $request->province,
          'region' => $request->region,
          'logoPath' => $newLogo,
        ]);

      }
      else
      {
        Barangay::where('id', $id)->update([
          'name' => $request->name,
          'zipCode' => $request->zipCode,
          'city' => $request->city,
          'province' => $request->province,
          'region' => $request->region,
        ]);
      }

      return redirect('/barangay')->with('success', 'Barangay Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function confirmBackup()
    {
        return view('barangay.confirm-backup');
    }

    public function backup()
    {
     
      Artisan::call('backup:run');

      return redirect('home')->with('success', 'System back up successful');
    }
}
