<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Active_state;    
use App\Models\User; 



class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public $user_id = ;



    public function __construct()
    {   
        $this->middleware('auth');   
        $this->middleware(function ($request, $next) { // dd(Auth::user());
            $user_id= Auth::user()->user_id; 
            $active_state = Active_state::where('user_id', $user_id)->first();
            if ($active_state) {
                DB::table('active_states')->where('user_id', $user_id)
                ->update([
                    'timestamp' => time()
                ]); 
            } else {
                $active_state = Active_state::create ([
                    'user_id' => $user_id,
                    'timestamp' => time()
                ]);
            }

            return $next($request);
        });

 
 
}





        public function get_time($sec, $patner_username) {
            $now = time();  
            $secdiff = $now-$sec;
            if ($secdiff==0)  { $time= '<i class="fa fa-user fg_skyblue"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">online<\/small >';  }
            
            elseif (($secdiff>0)&&($secdiff<=59))  { 
                if ($secdiff==1)  {  $time= '<i class="fa fa-user fg_skyblue"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">online - '.$secdiff.' sec<\/small >'; }
            elseif ($secdiff>1)  {  $time= '<i class="fa fa-user fg_skyblue"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">online - '.$secdiff.' sec<\/small >'; }  
            }
            
            elseif (($secdiff>=60)&&($secdiff<=3599))  { $tm = (int) ($secdiff/60);   
                
                if ($tm==1)  {   $time= '<i class="fa fa-user fg_skyblue"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">active - '.$tm.' min<\/small >';}
                elseif ($tm>1)  {  $time= '<i class="fa fa-user fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">active - '.$tm.' mins<\/small >';} 
                }
            
            elseif (($secdiff>=3600)&&($secdiff<=86399))  { $tm = (int) ($secdiff/3600);  
                
                if ($tm==1)  {  $time= '<i class="fa fa-user fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">offline - '.$tm.' hr<\/small >'; }
                elseif ($tm>1)  {  $time= '<i class="fa fa-user fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">offline - '.$tm.' hrs<\/small >'; } 
            }
            
            elseif (($secdiff>=86400)&&($secdiff<=604800))  { $tm = (int) ($secdiff/86400);  
                
            if ($tm==1)  {  $time= '<i class="fa fa-user fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">offline - '.$tm.' day<\/small >'; }
            elseif ($tm>1)  {   $time= '<i class="fa fa-user fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">offline - '.$tm.' days<\/small >'; } 
            }
            elseif ($secdiff>=604801)  {  $time= '<i class="fa fa-user fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">offline - '.date('d-M-Y',$sec).'<\/small >';  }
            
            return $time;
        } 


}





