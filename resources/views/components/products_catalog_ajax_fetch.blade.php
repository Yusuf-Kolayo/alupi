@php  if (count($products)>0) { @endphp
    <div id="data_box">
      <div class="row">
      @foreach ($products as $product)
  
  
        <div class="col-md-4" id="DIV-{{$product->product_id}}">
          <div class="card card-bordered my-1">
              <div class="card-header border-bottom p-0 bg-white">
                <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid">
              </div>
              <div class="card-body"> 
                  <h6><a href="{{route('product.show', ['product'=>$product->product_id])}}">{{$product->prd_name}}</a></h6> 
                  <p class="mb-0 price"><b>Price: {{number_format($product->outright_price)}} - {{number_format($product->install_price)}}</b></p>
                  <p>{!!$product->description!!}</p>
                  <div class="row">
                    @admin
                      <div class="col-6"> <button class="btn btn-primary btn-block" onclick="update_product_modal('{{$product->product_id}}')"> <i class="fas fa-edit"></i> Edit</button>  </div>
                      <div class="col-6"> <button class="btn btn-danger btn-block" onclick="delete_product_modal('{{$product->product_id}}')"> <i class="fas fa-trash"></i> Delete</button>  </div>
                    @endadmin
                    @agent
                      <div class="col-12"> <button class="btn btn-outline-primary btn-block" onclick="select_product_modal('{{$product->product_id}}')"> Select </button>  </div>
                    @endagent
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
                @php
                if ($products->currentPage()==1) {
                    if ($products->hasMore==true) { $prev_class= 'disabled'; $next_class= ''; $prev_onclick=''; $next_onclick='fetch_next('.$products->currentPage().')'; } 
                                             else { $prev_class= ''; $next_class= 'disabled'; $prev_onclick='fetch_prev('.$products->currentPage().')'; $next_onclick='';  }  
                } else {  //current page more > 1
                    if ($products->hasMore==true) { $prev_class= ''; $next_class= ''; $prev_onclick='fetch_prev('.$products->currentPage().')'; $next_onclick='fetch_next('.$products->currentPage().')'; } 
                                             else { $prev_class= ''; $next_class= 'disabled'; $prev_onclick='fetch_prev('.$products->currentPage().')'; $next_onclick=''; }  
                } 
                @endphp
                
                  <li class="page-item {{$prev_class}}"><a class="page-link" href="JavaScript:void(0)" onclick="{{$prev_onclick}}">Prev</a></li> 
                  <li class="page-item {{$next_class}}"><a class="page-link" href="JavaScript:void(0)" onclick="{{$next_onclick}}">Next</a></li>
            </ul>
            </div>
          </div>
      </div>
    </div>
  
  
  
  
    <script>    CKEDITOR.replace('editor1');   </script>
  
  
     @include('components.product_ext')
  
  @php } @endphp