<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Mail; 
use App\Models\Agent; 
use App\Models\User;   
use App\Models\Verification_code;   
use App\Mail\Referee_email_val;   
use Illuminate\Support\Facades\Session;
 

class ReferringController extends Controller 
{

    public function __construct()
    {
         
    }

     
 

    //  ----------------------------------------------------------------------  //




    public function show_referring_form ($agent_id)
    { 
        // dd($agent_id);
        $referrer_agent = Agent::where('agent_id', $agent_id)->firstOrFail();
        return view('agent_email_form', compact('referrer_agent'));
    }



    public function send_referee_mail (Request $request)
    {   // dd($request);

        $data = request()->validate([
            'referee_email' => ['required', 'string', 'email', 'max:100']
        ]); 

        $referrer_agent_id = $request['referrer_agent_id']; 
        $referee_email = $request['referee_email'];
        $referrer_agent = Agent::where('agent_id', $referrer_agent_id)->firstOrFail();
        
        $i = 1;
        while($i<=1) {
            $code = random_int(1000000, 9999999);  //  dd($code);
            $verification_code = Verification_code::where('code', $code)->first();
            if ($verification_code) { $i=1; } 
            else { 
                $verification = Verification_code::create ([
                    'code' => $code,
                    'channel_type' => 'email',
                    'channel_value' => $referee_email,
                    'status' =>  'sent'
                ]);
                $i++;
            }
        }  
        
        $details = ['code'=> $code];
          //$sent = Mail::to($referee_email)->send(new Referee_email_val($details));
          //echo $referee_email;
        //   if ($sent) {
            session(['ref_email_val'=>true, 'referrer_agent_id'=>$referrer_agent_id]); 
            return view('agent_code_form', compact('referee_email','referrer_agent'));
        //   } else {
        //     session(['ref_email_val'=>false, 'referrer_agent_id'=>$referrer_agent_id]); 
        //     $error = 'An error occurred when trying to send verification code, pls try again';
        //     Session::flash(['message', $error]);
        //     return view('agent_email_form', compact('referrer_agent'));
        //   }
       
    }



    public function check_referee_code (Request $request)
    {   // dd($request); 
        $data = request()->validate([
            'referee_code' => ['required', 'string', 'max:100']
        ]); 

        $referrer_agent_id = $request['referrer_agent_id'];
        $referee_code  = $request['referee_code'];
        $referee_email  = $request['referee_email'];

        $referrer_agent = Agent::where('agent_id', $referrer_agent_id)->firstOrFail();
        // dd($referrer_agent);
        $verification_code = Verification_code::where(['code'=> $referee_code, 'channel_type'=>'email', 'channel_value'=>$referee_email])->first();
 
        if ($verification_code) {
            $msg = 'Email verification was successfull, now fill in the form below with the accurate information';
            Session::flash('message', $msg);
            return view('agent_singup_form', compact('referee_email','referrer_agent'));
        } else {
            $error = 'Invalid verification, please check for the correct code';
            Session::flash('message', $error);
            return view('agent_code_form', compact('error','referee_email','referrer_agent'));
        } 


    }
}
