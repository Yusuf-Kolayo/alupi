<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use Illuminate\Support\Facades\Auth; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Active_state;    
use App\Models\User; 
use App\Models\Vendor;
use App\Models\Agent;  
use App\Models\Client; 
use App\Models\Product_purchase_session; 
use App\Models\Transaction; 
use App\Models\Activity; 
use App\Models\Notification;   
use App\Models\Message;   
use App\Models\Vendor_price;        



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
 

    public function index()
    {


        $dash_data = array();      $curr_user = auth()->user();  // get user data
        if ($curr_user->usr_type=='usr_admin')       { $view= 'admin.dashboard'; 
            $no_clients = Client::count();    $no_vendors = Vendor::count();
            $no_purchase_sesions = Product_purchase_session::count();
            $no_transactions = Transaction::count();
            $no_activities = Activity::count();   $no_agents = Agent::count();
            $dash_data = compact('no_agents','no_vendors','no_clients','no_purchase_sesions', 'no_transactions', 'no_activities');
        } 
        else if ($curr_user->usr_type=='usr_agent')  { $view='agent.dashboard';   
            $no_clients = Client::where('agent_id', auth()->user()->user_id)->count();
            $no_purchase_sesions = Product_purchase_session::where('agent_id', auth()->user()->user_id)->count();
            $no_transactions = Transaction::where('agent_id', auth()->user()->user_id)->count();
            $no_activities = Activity::where('user_id', auth()->user()->user_id)->count();
            $dash_data = compact('no_clients','no_purchase_sesions', 'no_transactions', 'no_activities');
        }
        else if ($curr_user->usr_type=='usr_client') { $view='client.dashboard'; 
            $no_purchase_sesions = Product_purchase_session::where('client_id', auth()->user()->user_id)->count();
            $no_transactions = Transaction::where('client_id', auth()->user()->user_id)->count();
            $no_activities = Activity::where('user_id', auth()->user()->user_id)->count();
            $dash_data = compact('no_purchase_sesions', 'no_transactions', 'no_activities');
        }
        else if ($curr_user->usr_type=='usr_vendor') { $view='vendor.dashboard';  

            $no_priced_product = Vendor_price::where('vendor_id', auth()->user()->user_id)->count(); // dd($no_priced_product);
            $no_unpriced_product = DB::table('products')
            ->select('products.*')
            ->join('vendor_prices as vendor_prices', 'products.product_id', '=', 'vendor_prices.product_id', 'left outer')
            ->where('vendor_prices.vendor_id', null)->count();

            $dash_data = compact('no_priced_product', 'no_unpriced_product');
        }
     
        return view($view, $dash_data);  
    }


    public function resolve_notification($notification_id)
    {
        $notification = Notification::findOrFail($notification_id);
        if ($notification->type=='new_client_web_reg') {
            $client_id = $notification->main_foreign_key; 

            $affected1 = DB::table('notifications')
            ->where('id', $notification_id)
            ->update([ 'status' => 'seen' ]); 

            return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'switch to the <i>purchase sessions tab</i> to see new product purchases for this client');
        } 
        else if ($notification->type=='new_client_agt_reg') {
            $client_id = $notification->main_foreign_key; 

            $affected1 = DB::table('notifications')
            ->where('id', $notification_id)
            ->update([ 'status' => 'seen' ]); 

            return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'switch to the <i>purchase sessions tab</i> to see new product purchases for this client');
        } 
        else if ($notification->type=='new_purchase_reg') {
            $client_id = $notification->main_foreign_key; 

            $affected1 = DB::table('notifications')
            ->where('id', $notification_id)
            ->update([ 'status' => 'seen' ]); 

            return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'switch to the <i>purchase sessions tab</i> to see new product purchases for this client');
        } elseif ($notification->type=='purchase_session_approved') {
            $client_id = $notification->main_foreign_key; 

            $affected1 = DB::table('notifications')
            ->where('id', $notification_id)
            ->update([ 'status' => 'seen' ]); 

            return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'switch to the <i>purchase sessions tab<i> to see new product purchases for this client');
        }
    } 


    public function all_notifications ()
    {  
       return view('components.notifications');
    }
 
    
    public function my_profile ()
    {
       if (auth()->user()->usr_type=='usr_admin') {
          return redirect()->route('admin.my_profile', ['admin'=>auth()->user()->username]);
         } elseif (auth()->user()->usr_type=='usr_agent') {
          return redirect()->route('agent.show', ['agent'=>auth()->user()->username]);
         } elseif (auth()->user()->usr_type=='usr_client') {
          return redirect()->route('client.show', ['client'=>auth()->user()->user_id]);
         } elseif (auth()->user()->usr_type=='usr_vendor') {
          return redirect()->route('vendor.show', ['vendor'=>auth()->user()->user_id]);
         }
    } 
 


    public function chat_board ($receiver_id=null)
    { 
      $chat_patner = User::where('user_id', $receiver_id)->first();      $curr_user_id = auth()->user()->user_id;       $chat_patners = array();
      $chat_patner_ids = array_unique(json_decode(Message::where('sender_id', $curr_user_id)->pluck('receiver_id')));   //  dd($chat_patner_ids); 
      foreach ($chat_patner_ids as $key => $chat_patner_id) {
         $user_info = User::where('user_id', $chat_patner_id)->first(); 

         $channel1 = $curr_user_id.'_'.$chat_patner_id;   $channel2 = $chat_patner_id.'_'.$curr_user_id;
         $last_msg_rows = Message::where('channel', $channel1)->orWhere('channel', $channel2)->get()->last();  // dd($last_msg_rows);
         
         $chat_patners[] = [$user_info, $last_msg_rows];
      } 
      
      return view('chat_board', compact('chat_patner', 'chat_patners'));
    }   
    
    
    
    public function post_msg (Request $request)
    { // dd($request);   
      $receiver_id = $request['patner_id'];         $message = $request['message'];
      $sender_id = auth()->user()->user_id;       $status  = 'sent';   $msg_type  = 'raw_txt';
      $channel = auth()->user()->user_id.'_'.$receiver_id;   $timestamp = time();
      $response = ['status'=>'failed'];

      $message1 = Message::create ([
        'sender_id' => $sender_id,
        'receiver_id' => $receiver_id,
        'channel' => $channel,
        'msg_type' => $msg_type,
        'message' => $message,
        'status' => $status, 
        'timestamp' => $timestamp 
     ]);   $response = ['status'=>'sent'];

     return response()->json($response); 
    } 




    public function post_file (Request $request)
    { // dd($request);   

        $data = request()->validate([
            'file_msg' => ['required', 'image']
        ]); 

      $receiver_id = $request['patner_id'];    
      $sender_id = auth()->user()->user_id;       $status  = 'sent';   $msg_type  = 'file_img';
      $channel = auth()->user()->user_id.'_'.$receiver_id;   $timestamp = time();
      $response = ['status'=>'failed'];

      $file = $request->file('file_msg');   
      $ogImage = Image::make($file);
      $originalPath = 'app/public/uploads/chats_file/';  $random_string = Str::random(20);
      $filename = time().'-'. $random_string .'.'. $file->getClientOriginalExtension();
      $ogImage =  $ogImage->save(storage_path($originalPath.$filename));


      $message = Message::create ([
        'sender_id' => $sender_id,
        'receiver_id' => $receiver_id,
        'channel' => $channel,
        'msg_type' => $msg_type,
        'message' => $filename,
        'status' => $status,
        'timestamp' => $timestamp 
     ]);   $response = ['status'=>'sent'];

     return response()->json($response); 
    } 


    public function fetch_chat (Request $request)
    {      // dd($request); 
              $receiver_id = $request['patner_id'];      $user_id = auth()->user()->user_id;     // dd($receiver_id);
              $channel1 = $user_id.'_'.$receiver_id;   $channel2 = $receiver_id.'_'.$user_id;
              $messages = Message::where('channel', $channel1)->orWhere('channel', $channel2)->paginate(50);    
              $timestamp = Active_state::where('user_id', $receiver_id)->value('timestamp'); 
              $patner_username = User::where('user_id', $receiver_id)->value('username'); 
              $active_time =  $this::get_time($timestamp, $patner_username);   // dd($time);

              $chatboard_msg = '<div class="d-block">';

              foreach ($messages->sortKeys() as $message) {
              if($message) {
              
                  if ($message['status']=='sent') {  $eye = '<i class="ion-android-done"><\/i >';  } 
                                              else {  $eye = '<i class="ion-android-done-all"><\/i >';  } 
                
                  if ($message['msg_type']=='raw_txt')  { $msg =  $message['message']; } else { $msg =  '<img class="img img-fluid" src="'. asset('storage/uploads/chats_file/'.$message['message']) .'"/>'; }
                                              
                  if (auth()->user()->user_id==$message['sender_id'])    {
                  $chatboard_msg .= '<p class="comp mb-1">'.$msg.'<span class="tmcomp"> <b style="font-size:12px">'.$eye.' you:<\/b> <br>'.$message['created_at'].'<\/span > <\/p >';  
                  } else {
                  $chatboard_msg .= '<p class="cust mb-1">'.$msg.'<span class="tmcus"> <b style="font-size:12px"><span class="ion-ios-contact-outline"><\/span > '.$message->sender->username.'<\/b ><br >'.$message['created_at'].'<\/span> <\/p >';
                
                  DB::table('messages')->where('id', $message['id'])->update(['status' => 'seen']);  
                      }
                  }
              }
              $chatboard_msg .= '<\/div >
              <p class="d-block text-center mt-2 mb-0" id="msg_base">...<\/p >';


            // NOW LETS FETCH CONVERSATIONS

            $curr_user_id = auth()->user()->user_id;       $chat_patners = array();
            $chat_patner_ids = array_unique(json_decode(Message::where(['receiver_id'=> $curr_user_id, 'status'=>'sent'])->pluck('sender_id')));   //  dd($chat_patner_ids); 
            foreach ($chat_patner_ids as $key => $chat_patner_id) {
                $user_info = User::where('user_id', $chat_patner_id)->first(); 

                $channel1 = $curr_user_id.'_'.$chat_patner_id;   $channel2 = $chat_patner_id.'_'.$curr_user_id;
                $last_msg_rows = Message::where('channel', $channel1)->orWhere('channel', $channel2)->get()->last();  // dd($last_msg_rows);
                
                $chat_patners[] = [$user_info, $last_msg_rows];
            }  
    

        $topnav_msg = '
        <a class="nav-link" data-toggle="dropdown" href="JavaScript:void(0)">
          <i class="far fa-comments"><\/i>';

          if (count($chat_patners)>0) {
              $topnav_msg .= '<span class="badge badge-danger navbar-badge">'.count($chat_patners).'</span>';
          } 
          $topnav_msg .= '</a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> ';
          

          foreach ($chat_patners as $user) {
                      // dd($user);
                      // if ($user[0]->usr_type=='usr_admin') { 
                      //     $fullname = $user[0]->staff->agt_first_name.' '.$user[0]->staff->agt_first_name;   
                      // } elseif ($user[0]->usr_type=='usr_agent') {
                      //     $fullname = $user[0]->agent->agt_first_name.' '.$user[0]->agent->agt_last_name;
                      // }  elseif ($user[0]->usr_type=='usr_client') {
                      //     $fullname = $user[0]->client->first_name.' '.$user[0]->client->last_name;
                      // } 
                
              $topnav_msg .= '
              <a href="'.route('chat_board', ['user_id'=>$user[0]->user_id]).'" class="dropdown-item px-1">    
                  <div class="media">
                    <img src="'.asset('images/avatar_dummy.png').'" alt="User Avatar" class="img-size-50 ml-1 mr-2 img-circle">
                    <div class="media-body">
                      <h3 class="dropdown-item-title">'.$user[0]->username.'<\/h3>';

                      if ($user[1]->msg_type=='raw_txt')  { $msg2 = substr($user[1]->message,0,30);  } 
                      else { $msg2 =  '<span class="fa fa-image" style="font-size: 20px;"></span>'; }

                        if ($user[1]) {
                        $topnav_msg .= '
                        <p class="text-sm short_msg">'.$msg2.' ...<\/p>
                        <p class="text-sm text-muted mb-0"><i class="far fa-clock mr-1"><\/i>'.$user[1]->created_at.'<\/p>';
                        } else { $topnav_msg .= '<p class="text-sm short_msg">---<\/p>'; }

                    $topnav_msg .= '
                  <\/div>
                <\/div>
              <\/a>
              <div class="dropdown-divider"><\/div>';
          }

    
            $topnav_msg .= '
          <a href="'.route('chat_board', ['chat_patner'=>[]]).'" class="dropdown-item dropdown-footer">See All Messages<\/a>
        <\/div>';

   
 
          return response()->json(['chatboard_msg'=>$chatboard_msg, 'topnav_msg'=>$topnav_msg, 'active_time'=>$active_time]);
        // return view('chat_box_ajax_fetch', compact('messages'));
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





