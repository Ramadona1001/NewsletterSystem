<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscribes;
use App\Jobs\SendMailQueue;


class HomeController extends Controller
{
   
    public function index()
    {
        return view('index');
    }

    public function subscribe(Request $request){

        $request->validate([
            'email' => 'required|email',
        ]);

        if ($request->ajax()) {
            if (!Subscribes::checkSubscribe($request->email)) { // Not Subscribe

                $email = $request->email;
                $from_name = 'Newsletter System';
                $subject = 'Welcome Subscriber';
                $content = 'Welcome Subscriber';
    
    
                $subscribe = new Subscribes();
                $subscribe->email = $request->email;
                $subscribe->status = 1;
                
                $subscribe->save();
    
                
                SendMailQueue::dispatch($from_name,$email,$subject,$content); //send mail by queue
               
                $response = array(
                    'status' => 'success',
                );
                return response()->json($response); 

            }else{
                $response = array(
                    'status' => 'failed',
                );
                return response()->json($response); 
            }
        }

       

    }
}
