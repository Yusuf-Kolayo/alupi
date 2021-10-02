<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;  
use App\Models\Vendor;
use App\Models\Activity; 
use App\Models\Product; 
use App\Models\Vendor_price;


class VendorController extends BaseController
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
       $vendors = Vendor::all();
       return view('vendor.vendors_list')->with('vendors',$vendors); 
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
            'full_name' => ['required', 'string', 'max:55'],
            'description' => ['required', 'string', 'max:200'],
            'address' => ['nullable', 'string', 'max:100'],
            'phone_a' => ['required', 'string', 'max:22', 'unique:vendors'],
            'phone_b' => ['required', 'string', 'max:22', 'unique:vendors'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'username' => ['required', 'string', 'max:55', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'same:confirm_password'],
            'confirm_password' => ['required', 'string', 'min:6']
        ]); 

        $sql = DB::select("show table status like 'users'");
        $next_id = 100 + $sql[0]->Auto_increment;   $usr_type = 'usr_vendor';
        $vendor_id = 'VND-'.$next_id;   $staff_id = auth()->user()->user_id;

        $vendor = Vendor::create([  
            'vendor_id' => $vendor_id, 
            'full_name' => $data['full_name'],
            'description' => $data['description'],
            'address' => $data['address'],
            'phone_a' => $data['phone_a'],
            'phone_b' => $data['phone_b'],
            'address' => $data['address']
        ]);

        $user = User::create ([
            'user_id' => $vendor_id,
            'username' => strtolower($data['username']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'usr_type' => $usr_type
        ]);
    
    
        // save user activity
        $type = 'new_vendor_reg';
        $activity_msg = '<b>'.ucfirst(auth()->user()->username).' ['.$staff_id.']</b> registered a new vendor <b> '.strtolower($data['username']).' ['.$vendor_id.']</b>';
        $activity = Activity::create ([
            'user_id' => auth()->user()->user_id,
            'usr_type' => auth()->user()->usr_type,
            'type' => $type,
            'activity' => $activity_msg
        ]);
        
        return redirect()->route('vendor.index')->with('success', 'New vendor ('.$data['username'].') registered Successfuly');
     
    }



     // logged vendor submits priice
     public function submit_vendor_price(Request $request) {
         $product_id = $request['product_id'];    $price = (int) $request['price'];
         $vendor_id  = auth()->user()->user_id;
         $vendor_price = Vendor_price::updateOrCreate(
             ['product_id'=>$product_id, 'vendor_id'=>$vendor_id],
             ['vendor_id'=>$vendor_id, 'price'=>$price]
         );

         $product = Product::where('product_id', $product_id)->first();
        // save user activity
        $type = 'vendor_price_update';
        $activity_msg = '<b>'.ucfirst(auth()->user()->username).' ['.auth()->user()->user_id.']</b> updated price for <b>'.$product->prd_name.' ['.$product_id.']</b>';
        $activity = Activity::create ([
            'user_id' => auth()->user()->user_id,
            'usr_type' => auth()->user()->usr_type,
            'type' => $type,
            'activity' => $activity_msg
        ]);

         return response()->json(['price'=> number_format($price),'status'=>1]);
     }







    public function pick_vendor_price(Request $request) { // dd($request);
        $product_id = $request['product_id'];    $vendor_price_id = (int) $request['vendor_price_id'];
        $vendor_price = Vendor_price::find($vendor_price_id); $new_price =  $vendor_price->price;
        $vendor_id = $vendor_price->vendor_id;   
        $product = Product::where('product_id', $product_id)->first();
     
        if(Product::where('product_id', $product_id)
        ->update(['price' => $new_price])>0) {  // if update successfull

            $vendor = Vendor::where('vendor_id', $vendor_id)->first();
    
            // save user activity
            $type = 'pick_vendor_price';
            $activity_msg = '<b>'.ucfirst(auth()->user()->username).' ['.auth()->user()->user_id.']</b> pick the price of <b>'.$vendor_price.'</b> from <b>'.$vendor->full_name.'</b> for <b>'.$product->prd_name.' ['.$product_id.']</b>';
            $activity = Activity::create ([
                'user_id' => auth()->user()->user_id,
                'usr_type' => auth()->user()->usr_type,
                'type' => $type,
                'activity' => $activity_msg
            ]);
     
             $new_price = Product::where('product_id', $product_id)->value('price');    
             return response()->json(['new_price'=> number_format($new_price),'status'=>1]);
        }
        
    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vendor_id)
    {
        $user = User::where('user_id', $vendor_id)->orWhere('username', $vendor_id)->firstOrFail();  
        $vendor_prices = Vendor_price::where('vendor_id', $vendor_id)->paginate(20);  
        return view('vendor.vendor_profile', compact('user','vendor_prices'));    
    }



    public function my_priced_products ($vendor_id=null)
    {   if ($vendor_id==null) { $vendor_id = auth()->user()->user_id; }
        $vendor_prices = Vendor_price::where('vendor_id', $vendor_id)->paginate(20);  
       // dd($vendor_price);
        return view('vendor.priced_products', compact('vendor_prices'));    
    }


    public function my_unpriced_products ($vendor_id=null)
    {   if ($vendor_id==null) { $vendor_id = auth()->user()->user_id; }  
     
       $products = DB::table('products')
                   ->select('products.*')
                   ->join('vendor_prices as vendor_prices', 'products.product_id', '=', 'vendor_prices.product_id', 'left outer')
                   ->where('vendor_prices.vendor_id', null)
                   ->paginate(20);

                  
        return view('vendor.unpriced_products', compact('products'));    
    }



    public function show_profile_ajax_fetch(Request $request)
    {   
        $vendor_id = $request['client_id'];  $product_id = $request['product_id']; 
        $client = Client::where('client_id', $vendor_id)->firstOrFail(); // dd($client);   
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
    }


 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vendor_id)
   {

   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vendor_id)
    {   }
}
