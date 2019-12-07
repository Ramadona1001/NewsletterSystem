<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscribes;
use App\Jobs\SendMailQueue;

class SubscribesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $subscribes = Subscribes::all();
        return view('dashboard.pages.users.index',compact('subscribes'));
    }

    public function sendmail(Request $request,$id){
        if ($request->ajax()) {
            $subscribe = Subscribes::findOrfail($id);
            $email = $subscribe->email;
            $from_name = 'Newsletter System';
            $subject = 'Welcome Subscriber';
            $content = 'Welcome Subscriber';
            SendMailQueue::dispatch($from_name,$email,$subject,$content);
            $response = array(
                'status' => 'success',
            );
            return response()->json($response);
        }
    }

    public function sendmails(Request $request){
        if ($request->ajax()) {
            $subscribeRequest = explode('&',$request->subscribes);
            foreach ($subscribeRequest as $subscribe) {
                $subscribe = Subscribes::findOrfail(explode('=',$subscribe)[1]);
                $email = $subscribe->email;
                $from_name = 'Newsletter System';
                $subject = 'Welcome Subscriber';
                $content = 'Welcome Subscriber';
                SendMailQueue::dispatch($from_name,$email,$subject,$content);
            }
            $response = array(
                'status' => 'success',
            );
            return response()->json($response);
        }
    }
}
