<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Mail; 
use App\Models\Agent;
use App\Models\Catchment;
use App\Models\User;   
use App\Models\Verification_code;   
use App\Mail\Referee_email_val;   
use Illuminate\Support\Facades\Session;
 

class AgentController extends BaseController 
{

    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
        // $this->middleware('auth', ['except'=> ['show_referring_form','send_referee_mail','check_referee_code']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catchments = Catchment::all();   $agents = Agent::orderBY('id', 'desc')->get(); 
        return view('admin.agents', compact('catchments','agents')); ; 
    }


    public function ajax_fetch()
    {  
        $agents = Agent::all();   
        return view('admin.agents_ajax_fetch')->with('agents', $agents); 
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
    {    $usr_type = 'usr_agent';  // dd($request['catchment_id']);
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
        'nok_relationship' => 'Next of kin relationship',
        'grt_first_name' => 'Guarantor firstname',
        'grt_last_name' => 'Guarantor lastname',
        'grt_other_name' => 'Guarantor othername',
        'grt_age' => 'Guarantor age', 
        'grt_phone_number'=> 'Guarantor Phone number',
        'grt_res_address' => 'Guarantor residential address',
        'grt_res_city' => 'Guarantor current city',
        'grt_res_state' => 'Guarantor current state',
        'grt_occupation' => 'Guarantor occupation',
        'grt_bis_name' => 'Guarantor business name',
        'grt_bis_address' => 'Guarantor business address',
        'grt_relationship' => 'Guarantor relationship',
        'ut_grt_fullname' => 'Guarantor fullname at undertaken section',
        'ut_agt_fullname' => 'Agent fullname at undertaken section', 
        'ut_agt_location' => 'Agent location at undertaken section',
        'ut_agt_position' => 'Agent work position at undertaken section'
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
            'agt_res_city' => ['required', 'string', 'max:22'],
            'agt_res_state' => ['required', 'string', 'max:22'],
            'agt_state_origin' => ['required', 'string', 'max:22'],
            'agt_lga_origin' => ['required', 'string', 'max:22'],
            'agt_home_town' => ['required', 'string', 'max:22'],
            'agt_birth_date' => ['required', 'string'],
            'agt_birth_place' => ['required', 'string', 'max:55'],
            'agt_referrer_id' =>  ['string', 'nullable'],
            'agt_username' =>  ['required', 'string', 'max:22', 'unique:users,username'],
            'agt_password' =>  ['required', 'string', 'min:6', 'same:agt_password_rpt'],
            'agt_password' =>  ['required', 'string', 'min:6'], 
            'catchment_id' =>  ['required', 'string'],
            'nok_fullname' => ['required', 'string', 'max:100'],
            'nok_res_address' => ['required', 'string', 'max:100'],
            'nok_res_city' => ['required', 'string', 'max:22'],
            'nok_res_state' => ['required', 'string', 'max:22'],
            'nok_phone_number' => ['required', 'string', 'max:22'],
            'nok_relationship' => ['required', 'string', 'max:22'],
            'grt_first_name' => ['required', 'string', 'max:55'],
            'grt_last_name' => ['required', 'string', 'max:55'],
            'grt_other_name' => ['required', 'string', 'max:55'],  
            'grt_phone_number' => ['required', 'string', 'max:55'],
            'grt_age' => ['required', 'integer', 'before:-40 years'], 
            'grt_res_address' => ['required', 'string', 'max:100'],
            'grt_res_city' => ['required', 'string', 'max:22'],
            'grt_res_state' => ['required', 'string', 'max:22'],
            'grt_occupation' => ['required', 'string', 'max:55'],
            'grt_bis_name' => ['required', 'string', 'max:100'],
            'grt_bis_address' => ['required', 'string', 'max:100'],
            'grt_relationship' => ['required', 'string', 'max:22'],
            'ut_grt_fullname' => ['required', 'string', 'max:55'],
            'ut_agt_fullname' => ['required', 'string', 'max:55'], 
            'ut_agt_location' => ['required', 'string', 'max:100'],
            'ut_agt_position' => ['required', 'string', 'max:22'],
 
            'hr_staff_id' => ['required', 'string', 'max:55'],
            'hr_grt_response' => ['required', 'string', 'max:500'],
            'hr_remark' => ['required', 'string', 'max:500'],
           ]);
           
       $validator-> setAttributeNames($custom_error_messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(),200);
        } else {   // validation found zero errors

            // create undertaken statement
            $grt_undertaken = 'I '.$request['grt_first_name'].' whose particulars are as above personally recommend '.$request['agt_first_name'].' residing at '.$request['ut_agt_location'].' Employed by ADROITLINK-UP INT'."'".'L as '.$request['ut_agt_position'];

            $sql = DB::select("show table status like 'users'");  $acct_status = 'approved';
            $next_id = 100 + $sql[0]->Auto_increment;
            $agent = Agent::create([   
                'agent_id' => 'AGT-'.$next_id,
                'referrer_id' => $request['agt_referrer_id'], 
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
                'grt_first_name' =>  $request['grt_first_name'],
                'grt_last_name' =>  $request['grt_last_name'],
                'grt_other_name' =>  $request['grt_other_name'],  
                'grt_phone_number' =>  $request['grt_phone_number'],
                'grt_age' =>  $request['grt_age'], 
                'grt_res_address' =>  $request['grt_res_address'],
                'grt_res_city' =>  $request['grt_res_city'],
                'grt_res_state' =>  $request['grt_res_state'],
                'grt_occupation' =>  $request['grt_occupation'],
                'grt_bis_name' =>  $request['grt_bis_name'],
                'grt_bis_address' =>  $request['grt_bis_address'],
                'grt_relationship' =>  $request['grt_relationship'],
                'grt_undertaken' =>  $grt_undertaken,
 
                'hr_staff_id' =>  $request['hr_staff_id'],
                'hr_grt_response' =>  $request['hr_grt_response'],
                'hr_remark' =>  $request['hr_remark'],  
                'actor_id' => auth()->user()->id
            ]); 

            $user = User::create ([
                'user_id' => 'AGT-'.$next_id,
                'username' => strtolower($request['agt_username']),
                'email' => $request['agt_email'],
                'password' =>  Hash::make($request['agt_password']),
                'usr_type' => $usr_type
            ]);

            return response()->json(['message'=>'New agent ('.ucfirst($request['agt_first_name']).') registered successfully.']);
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
        $user = User::firstWhere('username', $id);  // dd($user);
        return view('admin.agent_profile')->with('user', $user);
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

    public function update(Request $request, $username)
    {  //  dd($request);
        $user_id = User::firstWhere('username', $username)->user_id;  // dd($user);
     
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
            'nok_relationship' => 'Next of kin relationship',
            'grt_first_name' => 'Guarantor firstname',
            'grt_last_name' => 'Guarantor lastname',
            'grt_other_name' => 'Guarantor othername',
            'grt_age' => 'Guarantor age', 
            'grt_phone_number'=> 'Guarantor Phone number',
            'grt_res_address' => 'Guarantor residential address',
            'grt_res_city' => 'Guarantor current city',
            'grt_res_state' => 'Guarantor current state',
            'grt_occupation' => 'Guarantor occupation',
            'grt_bis_name' => 'Guarantor business name',
            'grt_bis_address' => 'Guarantor business address',
            'grt_relationship' => 'Guarantor relationship'
        );
            $validator = Validator::make($request->all(),
               [
                'agt_first_name' => ['required', 'string', 'max:55'],
                'agt_last_name' => ['required', 'string', 'max:55'], 
                'agt_other_name' => ['required', 'string', 'max:55'], 
                'agt_phone_number' => ['required', 'string', 'max:22', 'unique:agents,agt_phone_number,'.$user_id.',agent_id'],
                'agt_chat_number' => ['required', 'string', 'max:22', 'unique:agents,agt_chat_number,'.$user_id.',agent_id'],
          //    'email' => 'required|string|email|max:99|unique:customers,email,'. $id .'id',
                'agt_gender' => ['required', 'string', 'max:11'],
                'agt_res_address' => ['required', 'string', 'max:100'],
                'agt_res_city' => ['required', 'string', 'max:22'],
                'agt_res_state' => ['required', 'string', 'max:22'],
                'agt_state_origin' => ['required', 'string', 'max:22'],
                'agt_lga_origin' => ['required', 'string', 'max:22'],
                'agt_home_town' => ['required', 'string', 'max:22'],
                'agt_birth_date' => ['required', 'string'],
                'agt_birth_place' => ['required', 'string', 'max:55'],
                'agt_referrer_id' =>  ['string', 'nullable'], 
                'nok_fullname' => ['required', 'string', 'max:100'],
                'nok_res_address' => ['required', 'string', 'max:100'],
                'nok_res_city' => ['required', 'string', 'max:22'],
                'nok_res_state' => ['required', 'string', 'max:22'],
                'nok_phone_number' => ['required', 'string', 'max:22'],
                'nok_relationship' => ['required', 'string', 'max:22'],
                'grt_first_name' => ['required', 'string', 'max:55'],
                'grt_last_name' => ['required', 'string', 'max:55'],
                'grt_other_name' => ['required', 'string', 'max:55'],  
                'grt_phone_number' => ['required', 'string', 'max:55'],
                'grt_age' => ['required', 'integer', 'before:-40 years'], 
                'grt_res_address' => ['required', 'string', 'max:100'],
                'grt_res_city' => ['required', 'string', 'max:22'],
                'grt_res_state' => ['required', 'string', 'max:22'],
                'grt_occupation' => ['required', 'string', 'max:55'],
                'grt_bis_name' => ['required', 'string', 'max:100'],
                'grt_bis_address' => ['required', 'string', 'max:100'],
                'grt_relationship' => ['required', 'string', 'max:22'],
     
                'hr_staff_id' => ['required', 'string', 'max:55'],
                'hr_grt_response' => ['required', 'string', 'max:500'],
                'hr_remark' => ['required', 'string', 'max:500'],
               ]);
               
           $validator-> setAttributeNames($custom_error_messages);
    
            if ($validator->fails()) {
                return response()->json($validator->messages(),200);
            } else {   // validation found zero errors
    
                 
                $affected1 = DB::table('agents')
                ->where('agent_id', $user_id)
                ->update([ 
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
                    'grt_first_name' =>  $request['grt_first_name'],
                    'grt_last_name' =>  $request['grt_last_name'],
                    'grt_other_name' =>  $request['grt_other_name'],  
                    'grt_phone_number' =>  $request['grt_phone_number'],
                    'grt_age' =>  $request['grt_age'], 
                    'grt_res_address' =>  $request['grt_res_address'],
                    'grt_res_city' =>  $request['grt_res_city'],
                    'grt_res_state' =>  $request['grt_res_state'],
                    'grt_occupation' =>  $request['grt_occupation'],
                    'grt_bis_name' =>  $request['grt_bis_name'],
                    'grt_bis_address' =>  $request['grt_bis_address'],
                    'grt_relationship' =>  $request['grt_relationship'],
                    'grt_undertaken' => $request['grt_undertaken'],
     
                    'hr_staff_id' =>  $request['hr_staff_id'],
                    'hr_grt_response' =>  $request['hr_grt_response'],
                    'hr_remark' =>  $request['hr_remark'], 
    
                    'actor_id' => auth()->user()->id
                ]); 
    
                 
                return response()->json(['message'=>'Agent ('.ucfirst("$username").') updated successfully.']);
            }
    

    }

 
    

    
    public function destroy($username)
    {
        $user = User::firstWhere('username', $username);  // dd($user); 
        $user_id = $user->user_id;
        $agent = Agent::firstWhere('agent_id', $user_id);   

        $user->delete();     $agent->delete();
        return redirect(route('agent.index'))->with('success', 'Agent deleted !');  
    }


    

    public function assign_catchment (Request $request)
    {
        $agent_id = $request['agent_id'];    // dd($request);
        $username = User::where('user_id', $agent_id)->value('username');  // dd($username); 

        $affected1 = DB::table('agents')
        ->where('agent_id', $agent_id)
        ->update([ 
            'catchment_id' => $request['catchment_id'],
            'acct_status' => 'approved'
        ]); 
        
        return redirect(route('agent.show', ['agent'=>$username]))->with('success', 'Catchment assigned successfully!');  
    }

 


 
}
