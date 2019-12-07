<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactMail;
use Alert;
use Session;
use App\ActivityLog;

class ContactsController extends Controller
{
    
    public function index(){
        $contacts = Contacts::all();
        if (Session::has('success')) {
            Alert::success(session('success'), 'success');
        }
        ActivityLog::activityLogs("Open All Contacts",Auth::user()->id);
        return view('dashboard.pages.contacts.index',compact('contacts'));
    }

    public function send(Request $request){
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);

        $email = $request->email;
        $subject = $request->subject;
        $content = $request->content;
        $from = Auth::user()->name;
        $toname = $request->toname;

        Mail::to($email)->send(new SendContactMail($from,$toname,$email,$subject,$content));
        ActivityLog::activityLogs("Send Mail To".$email,Auth::user()->id);
        return redirect()->route('Contacts')->with('success',__('tr.Message Sent'));
    }
}
