<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware(['auth','verified']);
        $this->middleware('permission:module-usrmngmnt', ['only' => ['index']]);
        $this->middleware('permission:usrmngmnt-show', ['only' => ['show']]);
        $this->middleware('permission:usrmngmnt-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:usrmngmnt-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {   
        if($request->input('from') && $request->input('to')){

            $fromDate = $request->input('from') . ' 00:00:00';
            $toDate = $request->input('to') . ' 23:59:59';

            $data = User::whereBetween('created_at', [$fromDate, $toDate])->where('id', '>', 1)->get();

            // $data = User::where('firstName', 'Like', '%' . request('term') . '%')
            // ->orWhere('lastName', 'Like', '%' . request('term') . '%')
            // ->orWhere('middleName', 'Like', '%' . request('term') . '%')
            // ->get();

        }
        else
        {
            $data = User::orderBy('id','ASC')->where('id', '>', 1)->get();

        }

        
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id', '>', 1)->pluck('name','name');

        // dd(compact('roles'));
        // exit();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'lastName' => ['required', 'regex:/^[a-zA-ZñÑ\s]+$/','string', 'max:255'],
            'firstName' => ['required','regex:/^[a-zA-ZñÑ\s]+$/', 'string', 'max:255'],
            'middleName' => ['nullable','regex:/^[a-zA-ZñÑ\s]+$/', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'contactNo' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:11'],
            'contactNo' => ['required','digits:11'],
            'houseNo' => ['required', 'string'],
            'street' => ['required', 'string'],
            // 'zipCode' => ['required', 'integer'],
            // 'province' => ['required', 'string'],
            // 'city' => ['required', 'string'],
            'dob' => ['required', 'date'],  
            'sex' => ['required', 'string'],
            'civilStatus' => ['required', 'string'],
            'citizenship' => ['required','regex:/^[a-zA-ZñÑ\s]+$/', 'string'],
            'image' => 'mimes:jpg,png,jpeg|max:5048',

        ]);
        
        if($request->image)
        {
          $newImageName = sha1(time()) . '-' . $request->lastName . '.' . $request->firstName . '.' . $request->middleName . '.' .$request->image->extension();
          $request->image->move(public_path('images/users'), $newImageName);
          
          $user = User::create([
              'lastName' => $request->input('lastName'),
              'firstName' => $request->input('firstName'),
              'middleName' => $request->input('middleName'),
              'email' => $request->input('email'),
              'password' => Hash::make($request->input('password')),
              'contactNo' =>  $request->input('contactNo'),
              'houseNo' => $request->input('houseNo'),
              'street' => $request->input('street'),
              'dob' => $request->input('dob'),
              'sex' => $request->input('sex'),
              'civilStatus' => $request->input('civilStatus'),
              'citizenship' => $request->input('citizenship'),
              'profilePath' => $newImageName,
          ]);
        }
        else
        {
          $user = User::create([
            'lastName' => $request->input('lastName'),
            'firstName' => $request->input('firstName'),
            'middleName' => $request->input('middleName'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'contactNo' =>  $request->input('contactNo'),
            'houseNo' => $request->input('houseNo'),
            'street' => $request->input('street'),
            'dob' => $request->input('dob'),
            'sex' => $request->input('sex'),
            'civilStatus' => $request->input('civilStatus'),
            'citizenship' => $request->input('citizenship'),
            'profilePath' => 'default.png',
          ]);
        }
        
        // $input = $request->all();
        // $input['password'] = Hash::make($input['password']);
        // dd($input);
        // $user = User::create($input);
        
        if($request->input('roles'))
        {
            $user->assignRole($request->input('roles'));
        } 
        else 
        {
            $user->assignRole('Resident');
        }

        if($request->input('roles') == 'Councilor')
        {
            $user->syncPermissions([
                'module-usrmngmnt', 
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

                'barangay-official-list',
                'module-request-document',
                'documents-scan-document',
            ]);
            
        }
        else if($request->input('roles') == 'Secretary')
        {
            $user->syncPermissions([
                'module-usrmngmnt',
                'module-requested-appointments',
                'module-requested-document',
                'documents-show-ID',
                'documents-process',
                'documents-view',
                'documents-save-PDF',
                'documents-disapprove',
                'documents-types',
                'documents-types-create',
                'documents-types-edit',
                'documents-types-delete',
                'documents-types-delete',
                'documents-walk-in',

                'documents-scan-document',
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

                'barangay-official-list',
                'module-request-document',
                'documents-scan-document',
                'module-usrmngmnt',
            ]);
        }
        else if($request->input('roles') == 'Treasurer')
        {
            $user->syncPermissions([
                'module-usrmngmnt',
                'module-requested-document',
                'barangay-official-list',
                'documents-scan-document',
                'module-request-document',
                'module-usrmngmnt',
            ]);
        }

        else if($request->input('roles') == 'Clerk')
        {
            $user->syncPermissions([
                'module-usrmngmnt',
                'module-requested-appointments',
                'module-requested-document',
                'documents-show-ID',
                'documents-process',
                'documents-view',
                'documents-save-PDF',
                'documents-disapprove',
                'documents-scan-document',
                'documents-scan-request',
                'barangay-official-list',
                'module-request-document',
                'module-usrmngmnt',
            ]);
        }
        else if($request->input('roles') == 'Chairman')
        {
            $user->syncPermissions([
                'module-usrmngmnt',
                'module-requested-document',
                'barangay-official-list',
                'module-filed-complaints',
                'complaint-show-details',
                'complaint-view-settle-form',
                'complaint-save-settle-form',
                'complaint-view-complaint-form',
                'complaint-save-complaint-form',
                'complaint-view-escalation-form',
                'complaint-save-escalation-form',
                
                'module-request-document',
                'documents-scan-document',
                'module-usrmngmnt',
            ]);
        }
        else
        {
            $user->syncPermissions([
                'barangay-official-list',
                'documents-scan-document',
                'module-request-document',
                'module-request-appointment',
                'complaint-view-settle-form',
                'complaint-save-settle-form',
                'complaint-view-complaint-form',
                'complaint-save-complaint-form',
                'complaint-view-escalation-form',
                'complaint-save-escalation-form',
            ]);
        }

        if(Auth::check()){
            return redirect()->route('users.index')->with('success','User created successfully');
        } else{
            return redirect()->route('login')->with('success','Registered successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        // $permissions = $user->getAllPermissions();
        return view('users.show',compact('user'));
        
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
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();

      //   $permission = Permission::get();
      //   $userPermissions= DB::table("model_has_permissions")->where("model_has_permissions.model_id",$id)
      //   ->pluck('model_has_permissions.permission_id', 'model_has_permissions.permission_id')
      //   ->all();
      //   $userPermissions = $user->getPermissionNames()->all();
      //   dd($userPermissions);
      //   exit();

        return view('users.edit',compact('user','roles','userRole'));
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
            'roles' => 'required',
        ]);
    
        $user = User::find($id);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        
        $user->assignRole($request->input('roles'));
        if($request->input('roles') == 'Councilor')
        {
            $user->syncPermissions([
                'module-usrmngmnt',
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

                'barangay-official-list',
                'module-request-document',
                'documents-scan-document',
            ]);
            
        }
        else if($request->input('roles') == 'Secretary')
        {
            $user->syncPermissions([
                'module-usrmngmnt',
                'module-requested-appointments',
                'module-requested-document',
                'documents-show-ID',
                'documents-process',
                'documents-view',
                'documents-save-PDF',
                'documents-disapprove',
                'documents-types',
                'documents-types-create',
                'documents-types-edit',
                'documents-types-delete',
                'documents-types-delete',
                'documents-walk-in',

                'documents-scan-document',
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

                'barangay-official-list',
                'module-request-document',
                'documents-scan-document',
            ]);
        }
        else if($request->input('roles') == 'Treasurer')
        {
            $user->syncPermissions([
                'module-usrmngmnt',
                'module-requested-document',
                'barangay-official-list',
                'documents-scan-document',
                'module-request-document',
            ]);
        }

        else if($request->input('roles') == 'Clerk')
        {
            $user->syncPermissions([
                'module-usrmngmnt',
                'module-requested-appointments',
                'module-requested-document',
                'documents-show-ID',
                'documents-process',
                'documents-view',
                'documents-save-PDF',
                'documents-disapprove',
                'documents-scan-document',
                'documents-scan-request',
                'barangay-official-list',
                'module-request-document',
            ]);
        }
        else if($request->input('roles') == 'Chairman')
        {
            $user->syncPermissions([
                'module-usrmngmnt',
                'module-requested-document',
                'barangay-official-list',
                'module-filed-complaints',
                'complaint-show-details',
                'complaint-view-settle-form',
                'complaint-save-settle-form',
                'complaint-view-complaint-form',
                'complaint-save-complaint-form',
                'complaint-view-escalation-form',
                'complaint-save-escalation-form',
                
                'module-request-document',
                'documents-scan-document',
            ]);
        }
        else
        {
            $user->syncPermissions([
                'barangay-official-list',
                'documents-scan-document',
                'module-request-document',
                'module-request-appointment',
                'complaint-view-settle-form',
                'complaint-save-settle-form',
                'complaint-view-complaint-form',
                'complaint-save-complaint-form',
                'complaint-view-escalation-form',
                'complaint-save-escalation-form',
    
            ]);
        }

        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // User::find($id)->delete();

        $user = User::where('id',$id)->first();
        if($user->delete())
            return redirect()->route('users.index')->with('success','User deleted successfully');

        // return redirect()->route('users.index')
        //                 ->with('success','User deleted successfully');
    }
}
