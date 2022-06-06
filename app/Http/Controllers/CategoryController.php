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
        $all_categories = Category::all();
        $main_categories = Category::where('parent_id', 0)->get();
        return view('admin.categories', compact('main_categories','all_categories'));
    }



    public function sub_cat_ajax_fetch(Request $request)
    {  
        $main_cat_id = $request['main_cat_id'];    $element = $request['element'];   // dd($request['cat_id']); 
        $main_cat_name = DB::table('categories')->where('id', $main_cat_id)->value('cat_name');
        $sub_categories = Category::where('parent_id', $main_cat_id)->get();
        return view('admin.sub_categories_ajax_fetch', compact('sub_categories','main_cat_name', 'element')); 
    }


    
    public function child_cat_ajax_fetch(Request $request)
    {  
        $sub_cat_id = $request['sub_cat_id'];    $element = $request['element'];   // dd($request['cat_id']); 
        $main_cat_name = DB::table('categories')->where('id', $sub_cat_id)->value('cat_name');
        $child_categories = Category::where('parent_id', $sub_cat_id)->get();
        return view('admin.child_categories_ajax_fetch', compact('child_categories','main_cat_name', 'element')); 
    }


   
    
    public function create()
    {  
        $main_categories = Category::where('parent_id', 0)->get(); 
        return view('admin.categories')->with('main_categories',$main_categories); 
    }

   
    
    public function store(Request $request)
    {
        $data = request()->validate([
            'cat_name' => ['required', 'string', 'max:100', 'unique:categories'],
            'abbr' => ['required', 'string', 'max:3', 'unique:categories'],
            'description' => ['required', 'string', 'max:1000'],
            'meta_title' => ['nullable', 'string', 'max:100'],  
            'meta_desc' => ['nullable', 'string', 'max:1000'],  
            'meta_keyword' => ['nullable', 'string', 'max:100'], 
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
   
    
         // fetch through ajax: a form to update category
    public function edit_category_ajax_fetch (Request $request)
    {  
        $category_id = $request['cat_id'];

        $category = Category::findOrFail($category_id);  //dd($category);
        $main_categories = Category::where('parent_id', 0)->get(); 
        return view('admin.category_edit_ajax_fetch', compact('category','main_categories'));

    }




        // fetch through ajax: a form to delete category
        public function delete_category_ajax_fetch (Request $request)
        {
           
            $category_id = $request['cat_id'];
    
            $category = Category::findOrFail($category_id);  //dd($category);
            return view('admin.category_delete_ajax_fetch', compact('category'));
    
        }


   
     

    // update a category data
    public function update(Request $request, $id)
    {  
 
        $data = request()->validate([
            'cat_name' => ['required', 'string', 'max:55', 'unique:categories,cat_name,'. $id . 'id'], 
            'abbr' => ['required', 'string', 'max:3', 'unique:categories,abbr,'. $id . 'id'],
            'description' => ['required', 'string', 'max:1000'],
            'meta_title' => ['required', 'string', 'max:100'],  
            'meta_desc' => ['required', 'string', 'max:1000'],  
            'meta_keyword' => ['required', 'string', 'max:100'], 
            'parent_id' => ['required', 'string', 'max:55'],
            'position' => ['required', 'string', 'max:55']

        ]); 

         Category::where('id', $id)
         ->update([  
            'cat_name' => $data['cat_name'],
            'abbr' => strtoupper($data['abbr']),
            'description' => $data['description'], 
            'meta_title' => $data['meta_title'],
            'meta_desc' => $data['meta_desc'],
            'meta_keyword' => $data['meta_keyword'],
            'parent_id' => $data['parent_id'],
            'position' => $data['position']
        ]); 

        return redirect()->route('category.index')->with('success', 'category updated successfully');
      
    }

  
    


    // destroy a category from db
    public function destroy($id)
    { 

        $category = Category::where('id', $id)->firstOrFail(); 
        if ($category) {
            $deleted_rows = Category::where('id', $id)->delete();
        }   


        return redirect()->route('category.index')->with('success', 'category updated successfully');        
    }

}
