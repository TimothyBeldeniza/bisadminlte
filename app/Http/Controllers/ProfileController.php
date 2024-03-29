<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = User::find($id);
        // dd($user);
        return view('profiles.edit',compact('user'));
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
        $this->validate($request, [
            'lastName' => ['regex:/^[a-zA-ZñÑ\s]+$/','required', 'string', 'max:255'],
            'firstName' => ['regex:/^[a-zA-ZñÑ\s]+$/','required', 'string', 'max:255'],
            'middleName' => ['nullable','regex:/^[a-zA-ZñÑ\s]+$/', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contactNo' => ['integer'],
            'houseNo' => ['required', 'string'],
            'street' => ['required', 'string'],
            // 'zipCode' => ['required', 'integer'],
            // 'province' => ['required', 'string'],
            // 'city' => ['regex:/^[a-zA-ZñÑ\s]+$/','required', 'string'],
            'dob' => ['required', 'date'],  
            // 'gender' => ['required', 'string'],
            'civilStatus' => ['required', 'string'],
            'citizenship' => ['regex:/^[a-zA-ZñÑ\s]+$/', 'string', 'max:255'],
            'image' => 'mimes:jpg,png,jpeg|max:5048',

        ]);

        if($request->image)
        {
            $newImageName = sha1(time()) . '-' . $request->lastName . ',' . $request->firstName . '.' . $request->middleName . $request->image->extension() ;   
            $request->image->move(public_path('images/users'), $newImageName);
            
            User::where('id',$id)->update([
                'lastName' => $request->input('lastName'),
                'firstName' => $request->input('firstName'),
                'middleName' => $request->input('middleName'),
                'contactNo' =>  $request->input('contactNo'),
                'houseNo' => $request->input('houseNo'),
                'street' => $request->input('street'),
                'dob' => $request->input('dob'),
                'civilStatus' => $request->input('civilStatus'),
                'citizenship' => $request->input('citizenship'),
                'profilePath' => $newImageName
            ]);
        } 
        else 
        {
            User::where('id',$id)->update([
                'lastName' => $request->input('lastName'),
                'firstName' => $request->input('firstName'),
                'middleName' => $request->input('middleName'),
                'contactNo' =>  $request->input('contactNo'),
                'houseNo' => $request->input('houseNo'),
                'street' => $request->input('street'),
                'dob' => $request->input('dob'),
                'civilStatus' => $request->input('civilStatus'),
                'citizenship' => $request->input('citizenship'),
            ]);
        }


        $input = $request->all();
        // if(!empty($input['password'])){ 
        //     $input['password'] = Hash::make($input['password']);
        // }else{
        //     $input = Arr::except($input,array('password'));    
        // }
    
        $user = User::find($id);

        // dd($input);
        // exit();
        $user->update($input);
        // DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        // $user->assignRole($request->input('roles'));
    
        return back()->with('success','Profile updated successfully');
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
}
