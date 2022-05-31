<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
// use App\Models\Business_info;
// use App\Models\Store_slider;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Client;
use App\Models\Activity;
use App\Models\User;
use App\Models\Agent;
use App\Models\Notification;
Use App\Models\Product_purchase_session;


class ShopController extends BaseController
{
    
    public $title = 'shop';
    public $store_data;
    

    public function __construct() {
        $business_info = [];
        $main_categories = Category::where('parent_id', 0)->get();
        $brands = Brand::all();
        $this->store_data = ['business_info'=>$business_info, 'main_categories'=>$main_categories, 'brands'=>$brands];
    }



    // loads up homepage
    public function home()
    {   $store_data = $this->store_data;  // dd($store_data);
        return view('store.home', compact('store_data'));
    }


    // loads up shop-page
    // public function shop_category()
    // {   $store_data = $this->store_data; 
    //     return view('store.category', compact('store_data'));
    // }
    

    // loads up register_login page
    public function register_login()
    {   $store_data = $this->store_data;      
        return view('store.register_login', compact('store_data'));
    }


    public function login_submit (Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $email = $request['email'];
         
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
               
                $client_id = User::where('email', $email)->first()->user_id;            // fetch user_id after log in              
                $first_agent_id = Agent::first()->agent_id;     // get first agent ID
        
            // Register a product purchase session for client if session for product selected
            // still persists 
            if ($request->cookie('purchase_attempt')) { 
                $purchase_type = explode('::',$request->cookie('purchase_attempt'))[0]; 
                $product_id    = explode('::',$request->cookie('purchase_attempt'))[1]; 
                $quantity      = explode('::',$request->cookie('purchase_attempt'))[2]; 

                $cc = $this->register_purchase_session($client_id, $purchase_type, $quantity, $product_id, $first_agent_id);
                if ($cc===false) {   
                    return redirect()->route('homepage')->with('error', 'Something went wrong, please retry selecting & making an order for your product again');
                }
            } 


            return redirect()->intended('dashboard');
        }
   

        return redirect("register_login")->withSuccess('Login details are not valid');
    }



    public function shop_sign_out () {

        Session::flush();
        Auth::logout();
  
        return redirect()->route("homepage");
    }



    public function register_submit (Request $request)
    { 

                DB::transaction(function() use($request) {

                $data = request()->validate([
                    'first_name' => ['required', 'string', 'max:55'],
                    'last_name' => ['required', 'string', 'max:55'],
                    'phone' => ['required', 'string', 'max:55', 'unique:clients'],
                    'email' => ['required', 'string', 'email', 'max:99', 'unique:users'],
                    'state' => ['required', 'string', 'max:200'],
                    'address' => ['required', 'string', 'max:200'],
                    'username' => ['required', 'string', 'max:55', 'unique:users'],
                    'password' => ['required', 'string', 'min:6', 'same:confirm_password'],
                    'confirm_password' => ['required', 'string', 'min:6']
                ]); 

                $sql = DB::select("show table status like 'users'");
                $next_id = 100 + $sql[0]->Auto_increment;   $usr_type = 'usr_client';
                $client_id = 'CLT-'.$next_id;   

            
                // get first agent ID
                $first_agent_id = Agent::first()->agent_id;
                
                $client = Client::create([  
                    'client_type' => 'self_reg',
                    'client_id' => $client_id, 
                    'agent_id' => $first_agent_id, 
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'], 
                    'phone' => $data['phone'],
                    'state' => $data['state'],
                    'address' => $data['address']
                ]);

                $user = User::create ([
                    'user_id' => $client_id,
                    'status' => 'active',
                    'username' => strtolower($data['username']),
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'usr_type' => $usr_type
                ]);

            
                // notify admins of this activity
                $type = 'new_client_reg';
                $message = '</b>New client <b> '.strtolower($data['first_name']).' '.strtolower($data['last_name']).' ['.$client_id.']</b> registered from store sign-up form';
                $admninistrators = User::where('usr_type', 'usr_admin')->get();
                foreach ($admninistrators as $key => $admninistrator) {
                    $notification = Notification::create ([
                        'actor_id' => $client_id,
                        'receiver_id' => $admninistrator->user_id,
                        'type' => $type,
                        'message' => $message,
                        'status' => 'sent',
                        'main_foreign_key' => $client_id
                    ]);
            
                } 

            // Register a product purchase session for client if session for product selected
            // still persists
            if ($request->cookie('purchase_attempt')) { 
                    $purchase_type = explode('::',$request->cookie('purchase_attempt'))[0]; 
                    $product_id    = explode('::',$request->cookie('purchase_attempt'))[1]; 
                    $quantity      = explode('::',$request->cookie('purchase_attempt'))[2]; 

                    $cc = $this->register_purchase_session($client_id, $purchase_type, $quantity, $product_id, $first_agent_id);
                    if ($cc===false) {  
                        return redirect()->route('homepage')->with('error', 'Something went wrong, please retry selecting & making an order for your product again');
                    }
                } else {   
                    return redirect()->route('homepage')->with('error', 'Something went wrong, please retry selecting & making an order for your product again');
                }

            });

     
         // log the new customer IN
        $credentials = request()->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('my_profile');
        }

    }




    public function register_purchase_session($client_id, $purchase_type, $quantity, $product_id, $agent_id) {
        
        DB::transaction(function() use($client_id, $purchase_type, $quantity, $product_id, $agent_id) {
       
                $sql = DB::select("show table status like 'product_purchase_sessions'");
                $next_id = 100 + $sql[0]->Auto_increment;   
                $pps_id = 'PPS-'.$next_id;   $status = 'pending';
               

                $user = Product_purchase_session::create ([
                    'pps_id' => $pps_id,
                    'product_id' => $product_id,
                    'client_id' => $client_id,
                    'agent_id' => $agent_id,
                    'purchase_type' => $purchase_type,
                    'quantity' => $quantity,
                    'status' =>  $status 
                ]);
                
                $client = Client::where('client_id', $client_id)->first();
                // dd($client_id);
                // notify admins of this activity
                $type = 'new_purchase_reg';
                $message = 'A customer - <b>'.$client->user->username.' ['.$client_id.']</b> just registered a new product purchase session';
                $admninistrators = User::where('usr_type', 'usr_admin')->get();
                foreach ($admninistrators as $key => $admninistrator) {
                    $notification = Notification::create ([
                        'actor_id' => $agent_id,
                        'receiver_id' => $admninistrator->user_id,
                        'type' => $type,
                        'message' => $message,
                        'status' => 'sent',
                        'main_foreign_key' => $client_id
                    ]);
            
                }

                // save user activity
                $type = 'new_purchase_reg';
                $activity = $client->user->username.' ['.$client_id.']</b> just registered a new product purchase session';
                $user = Activity::create ([
                    'user_id' => $client->user->user_id,
                    'usr_type' => $client->user->usr_type,
                    'type' => $type,
                    'activity' => $activity
                ]); 

           
            });

       return true;  //  if all went well
    }




    //  loads up shop page [default]
    public function shop_default ()
    {
        $store_data = $this->store_data; 
        $products = Product::simplePaginate(12);
        // if ($cate=='main') {$cate_mode='main_category_id';     $view='store.shop_by_categories';} 
        //               else {$cate_mode='sub_category_id';  $view='store.shop_by_sub_categories';}

        if (count($products)>0) {  // if product found 
            $h_price = Product::orderBy('outright_price', 'desc')->first()->outright_price; 
            $l_price = Product::orderBy('outright_price', 'asc')->first()->outright_price; 
            $margin = $h_price-$l_price;    $margin_div = (int) $margin/4;

            if ($h_price==$l_price) { 
                $price_array = array($l_price, $h_price);
            } else {
                $a = $l_price; $b = $a + $margin_div ; $c = $b + $margin_div; $d = $c + $margin_div; $e = $h_price;
                $price_array = array($a, $b, $c, $d, $e);
            }
        } else {  // no product found under category
                $price_array = null; 
        }

        return view('store.shop_default', compact('store_data', 'products', 'price_array'));
    }






    //  loads up shop page [by categories]
    public function shop_by_categories (Request $request, $cat_id, $slug, $cate)
    {
        $store_data = $this->store_data; 
        $category = Category::where('id', $cat_id)->first(); 
        if ($cate=='main') {$cate_mode='main_category_id';     $view='store.shop_by_categories';} 
                      else {$cate_mode='sub_category_id';  $view='store.shop_by_sub_categories';}

        // if ((count($category->products)>0)||(count($category->sub_products)>0)) {  // product found under category
        //     $h_price = Product::where($cate_mode, $cat_id)->orderBy('outright_price', 'desc')->first()->outright_price; 
        //     $l_price = Product::where($cate_mode, $cat_id)->orderBy('outright_price', 'asc')->first()->outright_price; 
        //     $margin = $h_price-$l_price;    $margin_div = (int) $margin/4;

        //     if ($h_price==$l_price) { 
        //         $price_array = array($l_price, $h_price);
        //     } else {
        //         $a = $l_price; $b = $a + $margin_div ; $c = $b + $margin_div; $d = $c + $margin_div; $e = $h_price;
        //         $price_array = array($a, $b, $c, $d, $e);
        //     }
        // } else {  // no product found under category
        //         $price_array = null; 
        // }

        $products = $category->products()->simplePaginate(12);  
        if (count($products)==0) { 
            // if not found among main-categories switch to sub-categories instead
            $products = $category->sub_products()->simplePaginate(12);   
        }
        return view($view, compact('store_data', 'category','products'));
    }




        //  loads up shop page [by categories]
        // public function shop_by_sub_categories (Request $request, $cat_id, $slug, $cate)
        // {
        //     $store_data = $this->store_data; 
        //     $category = Category::where('id', $cat_id)->first();
        //     if ($cate=='main') {$cate_mode='main_category_id';     $view='store.shop_by_categories';} 
        //                   else {$cate_mode='sub_category_id';  $view='store.shop_by_sub_categories';}
    
        //     if ((count($category->products)>0)||(count($category->sub_products)>0)) {  // product found under category
        //         $h_price = Product::where($cate_mode, $cat_id)->orderBy('outright_price', 'desc')->first()->outright_price; 
        //         $l_price = Product::where($cate_mode, $cat_id)->orderBy('outright_price', 'asc')->first()->outright_price; 
        //         $margin = $h_price-$l_price;    $margin_div = (int) $margin/4;
    
        //         if ($h_price==$l_price) { 
        //             $price_array = array($l_price, $h_price);
        //         } else {
        //             $a = $l_price; $b = $a + $margin_div ; $c = $b + $margin_div; $d = $c + $margin_div; $e = $h_price;
        //             $price_array = array($a, $b, $c, $d, $e);
        //         }
        //     } else {  // no product found under category
        //             $price_array = null; 
        //     }
    
        //     $products = $category->products()->simplePaginate(12); 
        //     return view($view, compact('store_data', 'category', 'price_array','products'));
        // }



    
    //  loads up shop page [vy brands]
    public function shop_by_brands (Request $request, $brand_id, $slug)
    {
        $store_data = $this->store_data;
        $brand = Brand::where('id', $brand_id)->first();

        $order_criteria = 'prd_name';   $order_mode = 'asc';
        $products = $brand->products()->simplePaginate(12); 
        // $products = Product::where('brand_id', $brand_id)->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
       
        if (count($products)>0) {  // product found under category
            $h_price = Product::where('brand_id', $brand_id)->orderBy('outright_price', 'desc')->first()->outright_price; 
            $l_price = Product::where('brand_id', $brand_id)->orderBy('outright_price', 'asc')->first()->outright_price; 
            $margin = $h_price-$l_price;    $margin_div = (int) $margin/4;

            if ($h_price==$l_price) { 
                $price_array = array($l_price, $h_price);
            } else {
                $a = $l_price; $b = $a + $margin_div ; $c = $b + $margin_div; $d = $c + $margin_div; $e = $h_price;
                $price_array = array($a, $b, $c, $d, $e);
            }
        } else {  // no product found under category
                $price_array = null; 
        }

       return view('store.shop_by_brands', compact('store_data', 'brand', 'price_array', 'products'));
    }


      // submit search query to appropriate route for handling;
    //   public function search_products(Request $request) {
    //       $query = $request['search_input'];  //  dd($request['search_input']);
    //       return redirect()->route('store.shop_by_search', ['query'=>$query]);
    //   }


        //  handle search query, process and return serached results
        public function shop_by_search (Request $request)
        {
            $store_data = $this->store_data;
            $keyword = $request['keyword'];  // dd($keyword);
            
            $order_criteria = 'prd_name';   $order_mode = 'asc';
            $products = Product::where('prd_name', 'LIKE', '%'.$keyword.'%')->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
            if (count($products)>0) {  // product found under category
                $h_price = Product::where('prd_name', 'LIKE', '%'.$keyword.'%')->orderBy('outright_price', 'desc')->first()->outright_price; 
                $l_price = Product::where('prd_name', 'LIKE', '%'.$keyword.'%')->orderBy('outright_price', 'asc')->first()->outright_price; 
                $margin = $h_price-$l_price;    $margin_div = (int) $margin/4;
    
                if ($h_price==$l_price) { 
                    $price_array = array($l_price, $h_price);
                } else {
                    $a = $l_price; $b = $a + $margin_div ; $c = $b + $margin_div; $d = $c + $margin_div; $e = $h_price;
                    $price_array = array($a, $b, $c, $d, $e);
                }
            } else {  // no product found under category
                    $price_array = null; 
            }
    
            // dd($price_array);
    
            return view('store.shop_by_search', compact('store_data', 'keyword', 'price_array', 'products'));
        }



    // fetch_catalog_ajax
    public function fetch_catalog_ajax (Request $request)
    {  DB::enableQueryLog();
        
       $ordering = $request['ordering'];     $fetch_id = $request['fetch_id'];     $fetch_mode = $request['fetch_mode'];  
       $order_criteria = '';                 $order_mode = '';         $price_ranges  = $request['price_ranges'];
       // dd("$fetch_mode - $fetch_id");

       if ($ordering=='prd_name_asc') {
           $order_criteria = 'prd_name'; $order_mode = 'asc';
       } else if ($ordering=='prd_name_desc') {
           $order_criteria = 'prd_name'; $order_mode = 'desc';
       } else if ($ordering=='prd_price_asc') {
           $order_criteria = 'outright_price'; $order_mode = 'asc';
       } else if ($ordering=='prd_price_desc') {
           $order_criteria = 'outright_price'; $order_mode = 'desc';
       }
       // dd($id);

       if ($fetch_mode=='prd_name') {  // if user is searching for a product name
        if (count($price_ranges)==4) {
            // 'prd_name', 'LIKE', '%'.$query.'%' 
            $products = Product::where($fetch_mode, 'LIKE', '%'.$fetch_id.'%')
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];   $price_range3 = $price_ranges[2];     $price_range4 = $price_ranges[3];
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1];  $d = explode(':', $price_range3)[1]; $e = explode(':', $price_range4)[1];
    
                           $query->WhereBetween('outright_price', [$a, $b]) 
                                 ->orWhereBetween('outright_price', [$b, $c]) 
                                 ->orWhereBetween('outright_price', [$c, $d]) 
                                 ->orWhereBetween('outright_price', [$d, $e]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
           
           } else if (count($price_ranges)==3) {
    
            $products = Product::where($fetch_mode, 'LIKE', '%'.$fetch_id.'%')
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];   $price_range3 = $price_ranges[2];   
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1];  $d = explode(':', $price_range3)[1]; 
    
                           $query->WhereBetween('outright_price', [$a, $b]) 
                                 ->orWhereBetween('outright_price', [$b, $c]) 
                                 ->orWhereBetween('outright_price', [$c, $d]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           } else if (count($price_ranges)==2) {
    
            $products = Product::where($fetch_mode, 'LIKE', '%'.$fetch_id.'%')
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];  
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1]; 
    
                           $query->WhereBetween('outright_price', [$a, $b]) 
                                 ->orWhereBetween('outright_price', [$b, $c]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           } else if (count($price_ranges)==1) {
    
            $products = Product::where($fetch_mode, 'LIKE', '%'.$fetch_id.'%')
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];  
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  
    
                           $query->WhereBetween('outright_price', [$a, $b]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           }
       } else {  // when user not searching for a product name
        if (count($price_ranges)==4) {
    
            $products = Product::where($fetch_mode, $fetch_id)
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];   $price_range3 = $price_ranges[2];     $price_range4 = $price_ranges[3];
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1];  $d = explode(':', $price_range3)[1]; $e = explode(':', $price_range4)[1];
    
                           $query->WhereBetween('outright_price', [$a, $b]) 
                                 ->orWhereBetween('outright_price', [$b, $c]) 
                                 ->orWhereBetween('outright_price', [$c, $d]) 
                                 ->orWhereBetween('outright_price', [$d, $e]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
           
           } else if (count($price_ranges)==3) {
    
            $products = Product::where($fetch_mode, $fetch_id)
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];   $price_range3 = $price_ranges[2];   
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1];  $d = explode(':', $price_range3)[1]; 
    
                           $query->WhereBetween('outright_price', [$a, $b]) 
                                 ->orWhereBetween('outright_price', [$b, $c]) 
                                 ->orWhereBetween('outright_price', [$c, $d]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           } else if (count($price_ranges)==2) {
    
            $products = Product::where($fetch_mode, $fetch_id)
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];  
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1]; 
    
                           $query->WhereBetween('outright_price', [$a, $b]) 
                                 ->orWhereBetween('outright_price', [$b, $c]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           } else if (count($price_ranges)==1) {
    
            $products = Product::where($fetch_mode, $fetch_id)
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];  
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  
    
                           $query->WhereBetween('outright_price', [$a, $b]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           }
       }


      // dd(DB::getQueryLog());
       return view('store.fetch_catalog_ajax', compact('products'));
    }



    // fetch product details
    public function product_view (Request $request)
    {   $store_data = $this->store_data;
        $product_id = $request['product_id'];   $prd_name = $request['prd_name']; 
        $product = Product::where('id', $product_id)->first();  // dd($product);
        return view('store.product_view', compact('product','store_data'));
    }


 


    // register buy attempt
    public function buy (Request $request, $purchase_type, $product_id)
    {   $quantity = $request['quantity'];
      

        if (auth()->check()) { 
           if (auth()->user()->usr_type=='usr_client') {  // check if logged user is client

            // get first agent ID
            $first_agent_id = Agent::first()->agent_id;       $client_id = auth()->user()->user_id;

            $cc = $this->register_purchase_session($client_id, $purchase_type, $quantity, $product_id, $first_agent_id);
           }   // js_alert('got here !');

             return redirect()->route('my_profile'); 
        } else {
            $purchase_attempt = $purchase_type.'::'.$product_id.'::'.$quantity;  $minutes = 120;
            Cookie::queue('purchase_attempt', $purchase_attempt, $minutes);      // save purchase details in cookie

            return redirect()->route('register_login');  // if not logged in
        }
        
    }

    
    
    // checkout_buy_now
    // public function checkout_buy_now (Request $request)
    // {    
    //     $store_data = $this->store_data;

    //     if ($request->cookie('purchase_attempt')) { 
    //         $product_id = explode('::',$request->cookie('purchase_attempt'))[1]; 
    //         $product_attp = Product::where('product_id', $product_id)->first();
    //         return view('store.checkout_buy_now', compact('product_attp', 'store_data'));
    //     }  else {   
    //         return redirect()->route('homepage');
    //     }
     
    // }


    // checkout_installment
    public function checkout_installment (Request $request)
    {    
        $store_data = $this->store_data;

        if ($request->cookie('purchase_attempt')) { 
            $product_id = explode('::',$request->cookie('purchase_attempt'))[1]; 
            $product_attp = Product::where('product_id', $product_id)->first();
            return view('store.checkout_installment', compact('product_attp', 'store_data'));
        }  else {   
            return redirect()->route('homepage');
        }
     
    }



        
}
