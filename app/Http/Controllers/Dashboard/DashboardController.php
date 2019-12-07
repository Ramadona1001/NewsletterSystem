<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Subscribes;
use Auth;
use Crypt;
use Hash;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPasswordMail;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['forgetpassword','forgetpasswordpost','newpassword','newpasswordpost']);
    }
    
    public function index(){
        $subscribe = Subscribes::count();
        return view('dashboard.index',compact('subscribe'));
    }


    
  


    public function newpassword($id){
        $user = User::findOrfail(Crypt::decrypt($id));
        return view('auth.newpassword',compact('user'));
    }
    
    public function newpasswordpost(Request $request,$id){
        $user = User::findOrfail($id);
        $request->validate(['password'=>'required|string']);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('Dashboard');
    }

    public function forgetpassword(){
        return view('auth.forgetpassword');
    }

    public function forgetpasswordpost(Request $request){
        $email = $request->email;
        $user = User::where('email',$email)->get()->first();

        if ($user != null) {
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
            $content = $protocol.$_SERVER['HTTP_HOST'].'/newpassword/'.Crypt::encrypt($user->id);
            Mail::to($email)->send(new ForgetPasswordMail($content));
            return redirect()->route('Dashboard');
        }else{
            return redirect()->route('Dashboard');
        }

    }
}
