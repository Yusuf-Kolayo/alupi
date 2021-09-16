<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;


class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       

      public function __construct() {
        $this->middleware('auth');
        parent::__construct();
      }



    public function index()
    { 
        $products = Product::all();
        $main_categories = Category::where('parent_id', 0)->get();  
        return view('admin.products', compact('products','main_categories')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.products')->with('products',$products); 
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
            'img_name' => ['required', 'image'],
            'prd_name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'brand_id' => ['required', 'string', 'max:55'],
            'price' => ['required', 'string', 'max:55'],
            'main_category_id' => ['required', 'string', 'max:55'],
            'sub_category_id' => ['required', 'string', 'max:55']
        ]); 
    
    
        $brand_abbr = DB::table('brands')->where('id', $data['brand_id'])->value('abbr');
        $sub_cat_abbr = DB::table('categories')->where('id', $data['sub_category_id'])->value('abbr');
        $sql = DB::select("show table status like 'products'");
        $next_id = 100 + $sql[0]->Auto_increment;   
        $product_id = "$brand_abbr-$sub_cat_abbr-$next_id";
   
        
        $file = $request->file('img_name');  $random_string = Str::random(20); 
        $ogImage = Image::make($file);
        $originalPath = 'app/public/uploads/products_img/'; 
        $filename = time().'-'. $random_string .'.'. $file->getClientOriginalExtension();
        $ogImage =  $ogImage->save(storage_path($originalPath.$filename));
 

        $products = Product::create([  
            'product_id' => $product_id,
            'prd_name' => $data['prd_name'],
            'description' => $data['description'], 
            'img_name' => $filename,
            'brand_id' => $data['brand_id'],
            'price' => $data['price'],
            'main_category_id' => $data['main_category_id'],
            'sub_category_id' => $data['sub_category_id']
        ]); 
        
        return redirect()->route('product.sub', ['sub_category_id'=>$data['sub_category_id']])->with('success', 'product updated Successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function sub($sub_category_id)
    {
        $brands = Brand::all();
        $main_categories = Category::where('parent_id', 0)->get();  
        $sub_category = Category::where('id', $sub_category_id)->firstOrFail();  
        $products = Product::where('sub_category_id', $sub_category_id)->simplePaginate(12);
 
        return view('admin.products_catalog', 
          compact('products','main_categories','brands','sub_category_id','sub_category'));
    }

    

    
    public function update_product_ajax_fetch(Request $request)
    {   $brands = Brand::all();
        $main_categories = Category::where('parent_id', 0)->get(); 

        $product_id = $request['product_id']; // dd($request['product_id']); 
        $product = Product::where('product_id', $product_id)->firstOrFail();
        return view('admin.product_update_ajax_fetch', compact('product','brands','main_categories')); 
    }


    public function show_details_ajax_fetch(Request $request)
    {  
        $product_id = $request['product_id']; 
        $product = Product::where('product_id', $product_id)->firstOrFail(); // dd($product); 
        return view('admin.product_details_ajax_fetch', compact('product')); 
    }





    public function refresh_product_ajax_fetch(Request $request)
    {   
        $product_id = $request['product_id']; // dd($request['product_id']);  
        $product = Product::where('product_id', $product_id)->firstOrFail();
        if ($product) {
            return view('admin.product_refresh_ajax_fetch', compact('product')); 
        }  
    }



    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product_profile')->with('product',$product);
    }

    public function trash($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product_trash')->with('product',$product);
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
    public function update(Request $request, $product_id)
    {
        // dd ($product_id);
        $data = request()->validate([
            'img_name' => ['nullable', 'image'],
            'prd_name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'brand_id' => ['required', 'string', 'max:55'],
            'price' => ['required', 'string', 'max:55'],
            'main_category_id' => ['required', 'string', 'max:55'],
            'sub_category_id' => ['required', 'string', 'max:55']
        ]); 

            // $product = Product::find($product_id); 
            $product = Product::where('product_id', $product_id)->firstOrFail();
            $previous_image = DB::table('products')->where('product_id', $product_id)->value('img_name');
            

            if ($product) {

                if ($request->hasFile('img_name')) {  

                    $file = $request->file('img_name');  $random_string = Str::random(20); 
                    $ogImage = Image::make($file);
                    $originalPath = 'app/public/uploads/products_img/'; 
                    $filename = time().'-'. $random_string .'.'. $file->getClientOriginalExtension();
                    $ogImage =  $ogImage->save(storage_path($originalPath.$filename));

                    DB::table('products')->where('product_id', $product_id)
                    ->update([
                        'prd_name' => $data['prd_name'], 
                        'description' => $data['description'],
                        'brand_id' => $data['brand_id'],
                        'price' => $data['price'],
                        'main_category_id' => $data['main_category_id'],
                        'sub_category_id' => $data['sub_category_id'],
                        'img_name' => $filename
                    ]); 
                  
                } else { 
                    DB::table('products')->where('product_id', $product_id)
                    ->update([
                        'prd_name' => $data['prd_name'], 
                        'description' => $data['description'],
                         'brand_id' => $data['brand_id'],
                         'price' => $data['price'],
                         'main_category_id' => $data['main_category_id'],
                         'sub_category_id' => $data['sub_category_id']
                    ]); 
                }
        
                if ($request->hasFile('img_name')) {  
                   unlink(public_path().'/storage/uploads/products_img/'.$previous_image);
                }
                
                return response()->json(['message'=>'Product ['.$product_id.'] updated successfully.','status'=>1]);
            
            } else {
                return response()->json(['message'=>'An error occurred','status'=>0]);
            }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $product = Product::where('product_id', $product_id)->firstOrFail();
        $product_img = $product->img_name;
       
        if ($product) {
          $deleted_rows = Product::where('product_id', $product_id)->delete();
          if ($deleted_rows>0) {
            unlink(public_path().'/storage/uploads/products_img/'.$product_img); 
          }
           return response()->json(['message'=>'Product ['.$product_id.'] deleted successfully.','status'=>1]);
        }  else {
           return response()->json(['message'=>'An error occurred, please try again','status'=>0]);
        } 
    }
}
