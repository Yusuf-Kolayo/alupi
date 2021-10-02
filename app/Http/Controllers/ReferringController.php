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
        //  $sent = Mail::to($referee_email)->send(new Referee_email_val($details));
        //  echo $referee_email;
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







    public function ref_submit_form (Request $request)
    {   // dd(session('referrer_agent_id'));
         $result = ['message'=>'', 'status'=>'0'];
         $usr_type = 'usr_agent';  // dd($request['catchment_id']);
         $custom_error_messages = array (
        'agt_first_name' => 'Agent first name',
        'agt_last_name' => 'Agent last name', 
        'agt_other_name' => 'Agent other name',
        'agt_email' => 'Agent email',
        'agt_phone_number' => 'Agent phone number',
        'agt_chat_number' => 'Agent chat number',
        'agt_gender' => 'Agent gender',
        'agt_res_address' => 'Agent residential address',
        'agt_res_city' => 'Agent current city',
        'agt_res_state' => 'Agent current state',
        'agt_state_origin' => 'Agent state of origin',
        'agt_lga_origin' => 'Agent LGA of origin',
        'agt_home_town' => 'Agent home town',
        'agt_birth_date' => 'Agent birth date',
        'agt_birth_place' => 'Agent birth place',
        'agt_username' => 'Agent username',
        'agt_password' => 'Agent password',
        'nok_fullname' => 'Next of kin fullname',
        'nok_res_address' => 'Next of kin address',
        'nok_res_city' => 'Next of kin city',
        'nok_res_state' => 'Next of kin current state',
        'nok_phone_number' => 'Next of kin phone number',
        'nok_relationship' => 'Next of kin relationship'
        );
        $validator = Validator::make($request->all(),
           [
            'agt_first_name' => ['required', 'string', 'max:55'],
            'agt_last_name' => ['required', 'string', 'max:55'], 
            'agt_other_name' => ['required', 'string', 'max:55'],
            'agt_email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'agt_phone_number' => ['required', 'string', 'max:22', 'unique:agents,agt_phone_number'],
            'agt_chat_number' => ['required', 'string', 'max:22', 'unique:agents,agt_chat_number'],
            'agt_gender' => ['required', 'string', 'max:11'],
            'agt_res_address' => ['required', 'string', 'max:100'],
            'agt_res_city' => ['required', 'string', 'max:228'],
            'agt_res_state' => ['required', 'string', 'max:228'],
            'agt_state_origin' => ['required', 'string', 'max:228'],
            'agt_lga_origin' => ['required', 'string', 'max:228'],
            'agt_home_town' => ['required', 'string', 'max:228'],
            'agt_birth_date' => ['required', 'string'],
            'agt_birth_place' => ['required', 'string', 'max:55'],
            'agt_referrer_id' =>  ['string', 'nullable'],
            'agt_username' =>  ['required', 'string', 'max:22', 'unique:users,username'],
            'agt_password' =>  ['required', 'string', 'min:6', 'same:agt_password_rpt'],
            'agt_password' =>  ['required', 'string', 'min:6'], 
            'catchment_id' =>  ['nullable', 'string'],
            'nok_fullname' => ['required', 'string', 'max:100'],
            'nok_res_address' => ['required', 'string', 'max:100'],
            'nok_res_city' => ['required', 'string', 'max:228'],
            'nok_res_state' => ['required', 'string', 'max:228'],
            'nok_phone_number' => ['required', 'string', 'max:228'],
            'nok_relationship' => ['required', 'string', 'max:228']
           ]);
           
       $validator-> setAttributeNames($custom_error_messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(),200);
        } else {   // validation found zero errors

            
            $sql = DB::select("show table status like 'users'");  $acct_status = 'pending';
            $next_id = 100 + $sql[0]->Auto_increment;
            $agent = Agent::create([   
                'agent_id' => 'AGT-'.$next_id,
                'referrer_id' => session('referrer_agent_id'), 
                'catchment_id' => $request['catchment_id'],
                'acct_status'  => $acct_status,
                'agt_first_name' => $request['agt_first_name'],
                'agt_last_name' =>  $request['agt_last_name'], 
                'agt_other_name' =>  $request['agt_other_name'], 
                'agt_phone_number' =>  $request['agt_phone_number'],
                'agt_chat_number' =>  $request['agt_chat_number'],
                'agt_gender' =>   $request['agt_gender'],
                'agt_res_address' =>  $request['agt_res_address'],
                'agt_res_city' =>  $request['agt_res_city'],
                'agt_res_state' =>  $request['agt_res_state'],
                'agt_state_origin' =>  $request['agt_state_origin'],
                'agt_lga_origin' =>  $request['agt_lga_origin'],
                'agt_home_town' =>  $request['agt_home_town'],
                'agt_birth_date' =>  $request['agt_birth_date'],
                'agt_birth_place' =>  $request['agt_birth_place'],
                'nok_fullname' =>  $request['nok_fullname'],
                'nok_res_address' =>  $request['nok_res_address'],
                'nok_res_city' =>  $request['nok_res_city'],
                'nok_res_state' =>  $request['nok_res_state'],
                'nok_phone_number' =>  $request['nok_phone_number'],
                'nok_relationship' =>  $request['nok_relationship'],
                'actor_id' => 0
            ]); 

            $user = User::create ([
                'user_id' => 'AGT-'.$next_id,
                'username' => strtolower($request['agt_username']),
                'email' => $request['agt_email'],
                'password' =>  Hash::make($request['agt_password']),
                'usr_type' => $usr_type
            ]);

            $arr_result = ['message'=>'registered successfully', 'status'=>'1'];
            return response()->json($arr_result);
        }

    }
          
}
