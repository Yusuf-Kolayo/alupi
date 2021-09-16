<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Brand;


class BrandController extends BaseController
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
        $brands = Brand::all();
        return view('admin.brands')->with('brands',$brands);
    }


 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
      
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
            'brd_name' => ['required', 'string', 'max:100', 'unique:brands'],
            'abbr' => ['required', 'string', 'max:3', 'unique:brands'],
            'description' => ['required', 'string', 'max:1000'],    
            'position' => ['required', 'string', 'max:55']
        ]); 
    
        $brand = Brand::create([
            'brd_name' => $data['brd_name'],
            'abbr' => strtoupper($data['abbr']),
            'description' => $data['description'],  
            'position' => $data['position'],
            'status' => 'active'
        ]); 
    
        return redirect()->route('brand.index')->with('success', 'New brand ('.$data['brd_name'].') created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand_profile')->with('brand',$brand);
    }

    public function trash($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand_trash')->with('brand',$brand);
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
    public function update(Request $request, $id)
    {
        
        $data = request()->validate([
            'brand_name' => ['required', 'string', 'max:55', 'unique:brands,brand_name,'. $id . 'id'],
            'description' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:22'],
            'lga' => ['required', 'string', 'max:55']
        ]); 

         Brand::where('id', $id)
         ->update([  
            'brand_name' => $data['brand_name'],
            'description' => $data['description'],
            'state' => $data['state'],
            'lga' => $data['lga']
        ]); 

        return redirect()->route('brand.show', ['brand'=>$id])->with('success', 'brand updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
