<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\ActivityLog;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Session;
use Alert;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = User::all();
        if (Session::has('success')) {
            Alert::success(session('success'), 'success');
        }
        ActivityLog::activityLogs("Open Users",Auth::user()->id);
        return view('dashboard.pages.users.index',compact('users'));
    }

  
    public function create()
    {
        $roles = DB::table('roles')->select('id','name')->get();
        ActivityLog::activityLogs("Open Users Form",Auth::user()->id);
        return view('dashboard.pages.users.create',compact('roles'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255|min:2',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:20',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        foreach ($request->role_id as $role) {
            $user->assignRole($role);
        }
        ActivityLog::activityLogs("Add User ".$user->name,Auth::user()->id);

        return redirect()->route('Users')->with('success',__('tr.User Added'));
    }

  
    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $user = User::findOrfail($id);
        $user_roles = array();
        if (count($user->roles) > 0) {
            foreach ($user->roles as $role) {
                array_push($user_roles,$role->id);
            }
            $roles = DB::select('SELECT * FROM roles WHERE id NOT IN ('.implode(',',$user_roles).')');
        }else{
            $roles = Role::all();
        }
        ActivityLog::activityLogs("Edit User Form",Auth::user()->id);
        return view('dashboard.pages.users.edit',compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);

        $request->validate([
            'name' => 'required|unique:roles|max:255|min:2',
            'email' => 'unique:users,email,'.$user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $roles = Role::all();

        foreach ($roles as $role) {
            $user->removeRole($role->id);
        }

        foreach ($request->role_id as $user_role) {
            $user->assignRole($user_role);
        }

        ActivityLog::activityLogs("Update Users".$user->name,Auth::user()->id);

        return redirect()->route('Users')->with('success',__('tr.User Updated'));
        
    }

    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $roles = Role::all();
        foreach ($roles as $role) {
            $user->removeRole($role->id);
        }
        ActivityLog::activityLogs("Delete User".$user->name,Auth::user()->id);
        $user->delete();

        return redirect()->route('Users')->with('success',__('tr.User Deleted'));
    }

    public function assignRoles($id){
        $user = User::findOrfail($id);
        $user_roles = [];
        if(count($user->roles) > 0){
            foreach ($user->roles as $user_role) {
                array_push($user_roles,$user_role->id);
            }
            $roles = DB::select('select * from roles where id not in ('.implode(',',$user_roles).')');
        }else{
            $roles = Role::all();
        }
        ActivityLog::activityLogs("Assign Roles To Users Form",Auth::user()->id);
        return view('dashboard.pages.users.assign_roles',compact('roles','user'));
    }

    public function assignRolesPost(Request $request,$id){
        $roles = Role::all();
        $user = User::findOrfail($id);
        
        foreach ($roles as $role) {
            $user->removeRole($role->id);
        }

        foreach ($request->role_id as $user_role) {
            $user->assignRole($user_role);
        }
        ActivityLog::activityLogs("Assign Roles To  User".$user->roles,Auth::user()->id);
        return redirect()->route('Users')->with('success',__('tr.Roles Assigned To User'));
    }

    public function myProfile(){
        $user = User::findOrfail(Auth::user()->id);
        $user_roles = array();
        if (count($user->roles) > 0) {
            foreach ($user->roles as $role) {
                array_push($user_roles,$role->id);
            }
            $roles = DB::select('SELECT * FROM roles WHERE id NOT IN ('.implode(',',$user_roles).')');
        }else{
            if (Auth::user()->hasRole('Admin')) {
                $roles = Role::all();
            }else{
                $roles = Role::where('name','!=','Admin');
            }
        }
        ActivityLog::activityLogs("Open Profile",Auth::user()->id);
        return view('dashboard.pages.users.profile',compact('user','roles'));
    }
    
    public function myProfileUpdate(Request $request){
        $user = User::findOrfail(Auth::user()->id);
        $request->validate([
            'name' => 'required|unique:roles|max:255|min:2',
            'email' => 'unique:users,email,'.$user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $roles = Role::all();

        foreach ($roles as $role) {
            $user->removeRole($role->id);
        }

        foreach ($request->role_id as $user_role) {
            $user->assignRole($user_role);
        }
        ActivityLog::activityLogs("Update Profile",Auth::user()->id);
        return redirect()->route('Dashboard');
    }
}
