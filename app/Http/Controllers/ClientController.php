<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Client;
use App\Models\User; 
use App\Models\Product_purchase_session;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Product;
use App\Models\Activity;


class ClientController extends BaseController
{

    
    public function __construct() {
      $this->middleware('auth');
      parent::__construct();
    }
 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        $usr_type = auth()->user()->usr_type;
        if ($usr_type=='usr_admin') {
            $agent_id = auth()->user()->user_id;
            $clients = Client::all();  // dd($clients);
         } else if ($usr_type=='usr_agent') {
            $agent_id = auth()->user()->user_id;
            $clients = Client::where('agent_id', $agent_id)->get();  // dd($clients);
         } 
       return view('agent.clients_list')->with('clients',$clients); 
    }


        
    public function select_client (Request $request)
    {  
        $product_id = $request['product_id_delete_form']; 
        // dd($request);  dd($product_id); 
        $product = Product::where('product_id', $product_id)->firstOrFail();

        $agent_id = auth()->user()->user_id;
        $clients = Client::where('agent_id', $agent_id)->get(); 

        return view('agent.select_client', compact('product','clients')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('agent.client_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'first_name' => ['required', 'string', 'max:55'],
            'last_name' => ['required', 'string', 'max:55'],
            'other_name' => ['nullable', 'string', 'max:55'],
            'phone' => ['required', 'string', 'max:55', 'unique:clients'],
            'email' => ['required', 'string', 'email', 'max:99', 'unique:users'],
            'address' => ['required', 'string', 'max:200'],
            'username' => ['required', 'string', 'max:55', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'same:confirm_password'],
            'confirm_password' => ['required', 'string', 'min:6']
        ]); 

        $sql = DB::select("show table status like 'users'");
        $next_id = 100 + $sql[0]->Auto_increment;   $usr_type = 'usr_client';
        $client_id = 'CLT-'.$next_id;  $agent_id = auth()->user()->user_id;
        $catchment_id = auth()->user()->agent->catchment_id;

        $client = Client::create([  
            'client_id' => $client_id,
            'agent_id' => $agent_id, 
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'other_name' => $data['other_name'],
            'phone' => $data['phone'],
            'address' => $data['address']
        ]);

        $user = User::create ([
            'user_id' => $client_id,
            'username' => strtolower($request['username']),
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'usr_type' => $usr_type
        ]);
    
    
        // save user activity
        $type = 'new_client_reg';
        $activity = '<b>'.ucfirst(auth()->user()->username).' ['.$agent_id.']</b> registered a new client <b> '.strtolower($request['username']).' ['.$client_id.']</b>';
        $user = Activity::create ([
            'user_id' => auth()->user()->user_id,
            'usr_type' => auth()->user()->usr_type,
            'type' => $type,
            'activity' => $activity
        ]);

        return redirect()->route('client.index')->with('success', 'New client ('.$data['username'].') registered Successfuly into your catchment: '.$catchment_id);
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client_id)
    {
        $client = Client::where('client_id', $client_id)->firstOrFail();
        $main_categories = Category::where('parent_id', 0)->get(); 
        $product_purchase_sessions = Product_purchase_session::where('client_id', $client->client_id)->orderBy('id', 'desc')->get();  
        $transactions = Transaction::where('client_id', $client->client_id)->orderBy('id', 'desc')->get(); 

        return view('agent.client_profile', compact('client','product_purchase_sessions','transactions','main_categories'));    
    }



    public function show_profile_ajax_fetch(Request $request)
    {   
        $client_id = $request['client_id'];  $product_id = $request['product_id']; 
        $client = Client::where('client_id', $client_id)->firstOrFail(); // dd($client);   
        $product = Product::where('product_id', $product_id)->firstOrFail();
        $product_purchase_sessions = Product_purchase_session::where('client_id', $client->client_id)->get();  
        $transactions = Transaction::where('client_id', $client->client_id)->get();  
        
        return view('agent.show_profile_ajax_fetch', compact('client','transactions','product_purchase_sessions','product')); 
          
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);  // dd($client);
        return view('agent.client_edit')->with('client',$client);
    }


 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $client_id)
    {  // dd($client_id);
        $data = request()->validate([
            'first_name' => ['required', 'string', 'max:55'],
            'last_name' => ['required', 'string', 'max:55'],
            'other_name' => ['nullable', 'string', 'max:55'],
            'phone' => ['required', 'string', 'max:55', 'unique:clients,phone,'. $client_id . ',client_id'],
            'email' => 'required|string|email|max:99|unique:users,email,'. $client_id .',user_id',
            'address' => ['required', 'string', 'max:200']
        ]);
        
         Client::where('client_id', $client_id)
         ->update([  
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'other_name' => $data['other_name'],
            'phone' => $data['phone'], 
            'address' => $data['address']
        ]); 

        User::where('user_id', $client_id)
        ->update([  
           'email' => $data['email']
        ]); 
    
        return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'Profile updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id)
    {  // dd($client_id);
       $client = Client::where('client_id', $client_id)->firstOrFail(); 
       $client->delete();      
       return redirect()->route('client.index')->with('success', 'Account and related records deleted successfully');
    }
}
