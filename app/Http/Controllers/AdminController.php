<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Notification;  
use App\Models\User;  
use App\Models\Message;  
use App\Models\Active_state;  


class AdminController extends BaseController
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $curr_user = auth()->user();  // get user data
        if ($curr_user->usr_type=='usr_admin')       { $view= 'admin.dashboard';  } 
        else if ($curr_user->usr_type=='usr_agent')  { $view='agent.dashboard';   }
        else if ($curr_user->usr_type=='usr_client') { $view='client.dashboard';  }
        else if ($curr_user->usr_type=='usr_vendor') { $view='vendor.dashboard';  }
     
        return view($view,   [  'curr_user'=>$curr_user  ]);  
    }


 




    




    
    public function my_profile ()
    {
        $user = auth()->user();      // get user data 
        return view('admin.admin_profile', ['user'=> $user]);  
    }




 
     

 
}
