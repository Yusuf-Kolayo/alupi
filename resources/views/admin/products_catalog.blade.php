@extends('layouts.main')

@section('content')

<script src="{{asset('plugins/ckeditor_4_16_1_standard/ckeditor.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/ckeditor_4_16_1_standard/samples/toolbarconfigurator/lib/codemirror/neo.css')}}">
<style>
  #main #editor { background: #FFF;  padding: .375rem .75rem; border: 1px solid #ced4da; }
 
</style>

    @admin
    <div class="w-100 text-right mb-3">
        <h5 class="mb-0 float-left"> <i class="fas fa-shopping-cart"></i> Catalog Management</h5>
        <button data-toggle="collapse" data-target="#add_new" class="btn btn-primary btn-sm"> Add New </button>
    </div>
    <div class="card collapse" id="add_new">
        <div class="card-header">{{ __('Product Registry') }}</div> 
        <div class="card-body">
            
            {!! Form::open(['route' => ['product.store'], 'method'=>'POST', 'files' => true]) !!} 
          <div class="row ">
                <div class="col-md-12 text-center pb-4">
                      <img src="{{asset('images/product_place_holder.jpeg')}}" alt="" class="img img-fluid" id="preview_img" style="height:200px;"/>
                </div>  
                    
                <div class="col-md-6">
                    <div class="form-group">
                        <label>  Product Picture </label>
                        <input type="file" class="form-control" required name="img_name" id="img_name"/>  
                      </div>   
                </div>   

                <div class="col-md-6">
                    <div class="form-group">
                        <label> Name </label>
                        <input type="text" class="form-control" required name="prd_name"/> 
                    </div>
                </div> 



                <div class="col-md-12">
                    <div class="form-group">
                      <label> Description </label>
                      <textarea name="description" id="editor1" class="ck_editor form-control"  rows="2"></textarea>
                    </div>
                  </div>
   

                <div class="col-md-6">
                    <div class="form-group">
                      <label> Brand </label>
                      <select name="brand_id" id="brand_id" class="form-control">
                        <option value=""></option> 
                        @foreach ($brands as $brand)
                          <option value="{{$brand->id}}">{{$brand->brd_name}}</option>
                        @endforeach
                        </select> 
                    </div>
                </div>




                <div class="col-md-6">
                  <div class="form-group">
                    <label> Outright Price </label>
                    <input type="number" name="outright_price" value="" id="outright_price" class="form-control">
                  </div>
              </div>
              

                
                <div class="col-md-6">
                    <div class="form-group">
                      <label> Installment Price </label>
                      <input type="number" name="install_price" id="install_price" class="form-control">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                      <label> Main Category </label>
                      <select name="main_category_id" id="main_category_id" onchange="fetch_sub_cat();" class="form-control">
                        <option value=""></option> 
                        @foreach ($main_categories as $main_category)
                          <option value="{{$main_category->id}}">{{$main_category->cat_name}}</option>
                        @endforeach
                        </select> 
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                      <label> Sub Category </label>
                      <select name="sub_category_id" class="form-control" id="sub_category_id" onchange="fetch_child_cat();" >
                        <option value=""></option>  
                    </select> 
                    </div>
                </div> 


                <div class="col-md-6">
                    <div class="form-group">
                      <label> Child Category </label>
                      <select name="child_category_id" class="form-control" id="child_category_id">
                        <option value=""></option>  
                    </select> 
                    </div>
                </div> 
                

                <div class="col-md-12  pt-4">
                      <input type="submit" value="Submit" class="btn btn-primary btn-block w-75 mx-auto">
                </div>




            </div>
            {!! Form::close() !!} 
        </div> 
    </div> 
    @endadmin

    @agent
      <div class="w-100 text-right mb-3" style="display: inline-block;">
          <h5 class="mb-0 float-left"> <i class="fas fa-shopping-cart"></i> Product Catalog</h5>
      </div>
    @endagent
    
     
        <div class="row" style="">

          <div class="col-md-8">
            <p class="mb-0">{{$sub_category->parent->cat_name}}> <b>{{$sub_category->cat_name}}</b></p>
          </div>
          <div class="col-md-4">  
            <div class="row">
                <div class="col-4 pr-0">
                   <label for="" class="_select">Brand <em class="icon ni ni-chevrons-right" style="float: right;padding-top: 3px;"></em> </label>
                </div>
                <div class="col-8">
                  <input type="hidden" name="cat_id" id="cat_id" value="{{$sub_category->id}}">
                  <select name="brand_select" id="brand_select" class="form-control">
                    <option value="0">ALL</option> 
                     @foreach ($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->brd_name}}</option>
                     @endforeach
                  </select>
                </div>
            </div>
           
          </div>
          
        </div>


     
 @php  if (count($products)>0) { @endphp
  <div id="data_box" class="pt-2 mt-2">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4" id="DIV-{{$product->product_id}}">
                <div class="card">
                    <div class="card-header border-bottom p-0 zoomin frame">
                      <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid">
                    </div>
                    <div class="card-body"> 
                      <h6><a href="{{route('product.show', ['product'=>$product->product_id])}}" style="color:#383a46;">{{$product->prd_name}}</a></h6> 
                      @vendor    
                           <p class="mb-0 price"><b>Price: <span id="PRC_{{$product->product_id}}">
                              @if ($product->vendor_price()->where('vendor_prices.vendor_id', auth()->user()->user_id)->value('price'))
                                {{number_format($product->vendor_price()->where('vendor_prices.vendor_id', auth()->user()->user_id)->value('price'))}}
                              @else
                                ---
                              @endif  </span></b>
                            </p>
                      @else
                           <p class="mb-0 price"><b>Price: {{number_format($product->outright_price)}} - {{number_format($product->install_price)}}</b></p>
                      @endvendor     
                      <p>{!!substr($product->description, 0,150)!!} ...</p>
               
                         <div class="row" id="OPT_{{$product->product_id}}"> 
                        @admin
                          <div class="col-6"> <button class="btn btn-primary btn-block" onclick="update_product_modal('{{$product->product_id}}')"> <i class="fas fa-edit"></i> Edit</button>  </div>
                          <div class="col-6"> <button class="btn btn-danger btn-block" onclick="delete_product_modal('{{$product->product_id}}')"> <i class="fas fa-trash"></i> Delete</button>  </div>
                        @endadmin
                        @agent
                          <div class="col-12"> <button class="btn btn-outline-primary btn-block" onclick="select_product_modal('{{$product->product_id}}')"> Select </button>  </div>
                        @endagent

                        @vendor
                          <div class="col-8">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-database"></i></span>
                                </div>
                                <input type="number" class="form-control" name="INP_{{$product->product_id}}" id="INP_{{$product->product_id}}" required>
                            </div>
                          </div>
                          <div class="col-4"> <button class="btn btn-outline-primary btn-block" onclick="submit_vendor_price('{{$product->product_id}}')" type="submit"> Submit</button>  </div>
                          <div class="col-12" id="ERR_{{$product->product_id}}"></div>
                          @endvendor
                      </div>
               
                    </div>
                </div>
            </div>
        @endforeach  
    </div>

  

             <div class="row mt-2">
              <div class="col-12">
                <div>
            <ul class="pagination pagination-sm">
               
                @php // dd($products->currentPage());
                if ($products->currentPage()==1) {
                    if ($products->hasMorePages()==true) { $prev_class= 'disabled'; $next_class= ''; $prev_onclick=''; $next_onclick='fetch_next('.$products->currentPage().')'; } 
                                             else { $prev_class= 'disabled'; $next_class= 'disabled'; $prev_onclick='fetch_prev('.$products->currentPage().')'; $next_onclick='';  }  
                } else {  //current page more > 1
                    if ($products->hasMorePages()==true) { $prev_class= ''; $next_class= ''; $prev_onclick='fetch_prev('.$products->currentPage().')'; $next_onclick='fetch_next('.$products->currentPage().')'; } 
                                             else { $prev_class= ''; $next_class= 'disabled'; $prev_onclick='fetch_prev('.$products->currentPage().')'; $next_onclick=''; }  
                } 
                @endphp
                
                  <li class="page-item {{$prev_class}}"><a class="page-link" href="JavaScript:void(0)" onclick="{{$prev_onclick}}">Prev</a></li> 
                  <li class="page-item {{$next_class}}"><a class="page-link" href="JavaScript:void(0)" onclick="{{$next_onclick}}">Next</a></li>
              
            </ul>
            </div>
              </div>
          </div>




  <script>    CKEDITOR.replace('editor1');   </script>

   

   @include('components.product_ext')

@php } else { @endphp
    
     <p class="h6 mt-5 text-center">No items found under this category</p>
  @php }  @endphp
 
    @section('page_scripts')
           <script>
                 $('#brand_select').change(function() {  
              var brand_id = $(this).val();    var cat_id = $('#cat_id').val();  var page = {{$products->currentPage()}}; // console.log(cat_id);
              var data2send={'brand_id':brand_id, 'cat_id':cat_id, 'page':page};  
              $('#data_box').html('<div class="text-center mt-3 p-4 bg-white border rounded"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
              $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
              $.ajax({
                  url:"{{ route('fetch_product_by_brand') }}",
                  dataType:"text",
                  method:"GET",
                  data:data2send,
                  success:function(resp) { $('#data_box').html(resp); }
            }); 
           });



          function fetch_next (current_page) {
              var brand_id = $('#brand_select').val();    var cat_id = $('#cat_id').val();  var page = current_page + 1; // console.log(cat_id);
              var data2send={'brand_id':brand_id, 'cat_id':cat_id, 'page':page};  

              $('#data_box').html('<div class="text-center mt-3 p-4 bg-white border rounded"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
              $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
              $.ajax({
                  url:"{{ route('fetch_product_by_brand') }}",
                  dataType:"text",
                  method:"GET",
                  data:data2send,
                  success:function(resp) { $('#data_box').html(resp); }
            }); 
          }


          function fetch_prev (current_page) {
              var brand_id = $('#brand_select').val();    var cat_id = $('#cat_id').val();  var page = current_page - 1; // console.log(cat_id);
              var data2send={'brand_id':brand_id, 'cat_id':cat_id, 'page':page};  

              $('#data_box').html('<div class="text-center mt-3 p-4 bg-white border rounded"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
              $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
              $.ajax({
                  url:"{{ route('fetch_product_by_brand') }}",
                  dataType:"text",
                  method:"GET",
                  data:data2send,
                  success:function(resp) { $('#data_box').html(resp); }
            }); 
          }


           </script>
    @endsection



@endsection
