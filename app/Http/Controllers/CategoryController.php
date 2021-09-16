<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Category;


class CategoryController extends BaseController
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
        $main_categories = Category::where('parent_id', 0)->get(); 
        return view('admin.categories')->with('main_categories',$main_categories);
    }



    public function sub_cat_ajax_fetch(Request $request)
    {  
        $main_cat_id = $request['main_cat_id'];    $element = $request['element'];   // dd($request['cat_id']); 
        $main_cat_name = DB::table('categories')->where('id', $main_cat_id)->value('cat_name');
        $sub_categories = Category::where('parent_id', $main_cat_id)->get();
        return view('admin.sub_categories_ajax_fetch', compact('sub_categories','main_cat_name', 'element')); 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $main_categories = Category::where('parent_id', 0)->get(); 
        return view('admin.categories')->with('main_categories',$main_categories); 
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
            'cat_name' => ['required', 'string', 'max:100', 'unique:categories'],
            'abbr' => ['required', 'string', 'max:3', 'unique:categories'],
            'description' => ['required', 'string', 'max:1000'],
            'meta_title' => ['required', 'string', 'max:100'],  
            'meta_desc' => ['required', 'string', 'max:1000'],  
            'meta_keyword' => ['required', 'string', 'max:100'], 
            'parent_id' => ['required', 'string', 'max:55'],     
            'position' => ['required', 'string', 'max:55']
        ]); 
    
        $categories = Category::create([
            'cat_name' => $data['cat_name'],
            'abbr' => strtoupper($data['abbr']),
            'description' => $data['description'], 
            'meta_title' => $data['meta_title'],
            'meta_desc' => $data['meta_desc'],
            'meta_keyword' => $data['meta_keyword'],
            'parent_id' => $data['parent_id'],
            'position' => $data['position'],
            'status' => 'active'
        ]); 
    
        return redirect()->route('category.index')->with('success', 'New category ('.$data['cat_name'].') created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category_profile')->with('category',$category);
    }

    public function trash($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category_trash')->with('category',$category);
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
            'category_name' => ['required', 'string', 'max:55', 'unique:categories,category_name,'. $id . 'id'],
            'description' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:22'],
            'lga' => ['required', 'string', 'max:55']
        ]); 

         Category::where('id', $id)
         ->update([  
            'category_name' => $data['category_name'],
            'description' => $data['description'],
            'state' => $data['state'],
            'lga' => $data['lga']
        ]); 

        return redirect()->route('category.show', ['category'=>$id])->with('success', 'category updated Successfully.');

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
