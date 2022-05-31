@extends('layouts.main')

@section('content')  
    
    @agent
      <div class="w-100 text-right mb-3" style="display: inline-block;">
          <h5 class="mb-0 float-left"> <i class="fas fa-shopping-cart"></i> Product Catalog</h5>
      </div>
    @endagent
    
        <h5 class="">Priced Products</b></h5>




  <div id="data_box">
    <div class="row">
        @foreach ($vendor_prices as $vendor_price)

            <div class="col-md-4" id="DIV-{{$vendor_price->product->product_id}}">
                <div class="card">
                    <div class="card-header">
                      <img src="{{asset('storage/uploads/products_img/'.$vendor_price->product->img_name)}}" alt="" class="img img-fluid">
                    </div>
                    <div class="card-body"> 
                      <h6><a href="{{route('product.show', ['product'=>$vendor_price->product->product_id])}}" style="color:#383a46;">{{$vendor_price->product->prd_name}}</a></h6> 
                      @admin    
                          <p class="mb-0 price"><b>Price: {{number_format($vendor_price->product->install_price)}}</b></p>
                      @endadmin  
                      @vendor    
                           <p class="mb-0 price"><b>Price: <span id="PRC_{{$vendor_price->product->product_id}}">
                              @if ($vendor_price->product->vendor_price()->where('vendor_prices.vendor_id', auth()->user()->user_id)->value('price'))
                                {{number_format($vendor_price->product->vendor_price()->where('vendor_prices.vendor_id', auth()->user()->user_id)->value('price'))}}
                              @else
                                ---
                              @endif  </span></b>
                            </p>
                      @endvendor     
                      <p>{!!substr($vendor_price->product->description, 0,150)!!} ...</p>
               
                         <div class="row" id="OPT_{{$vendor_price->product->product_id}}"> 
                        @admin
                          <div class="col-6"> <button class="btn btn-primary btn-block" onclick="update_product_modal('{{$vendor_price->product->product_id}}')"> <i class="fas fa-edit"></i> Edit</button>  </div>
                          <div class="col-6"> <button class="btn btn-danger btn-block" onclick="delete_product_modal('{{$vendor_price->product->product_id}}')"> <i class="fas fa-trash"></i> Delete</button>  </div>
                        @endadmin
                        @agent
                          <div class="col-12"> <button class="btn btn-outline-primary btn-block" onclick="select_product_modal('{{$vendor_price->product->product_id}}')"> Select </button>  </div>
                        @endagent

                        @vendor
                          <div class="col-8">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-database"></i></span>
                                </div>
                                <input type="number" class="form-control" name="INP_{{$vendor_price->product->product_id}}" id="INP_{{$vendor_price->product->product_id}}" required>
                            </div>
                          </div>
                          <div class="col-4"> <button class="btn btn-outline-primary btn-block" onclick="submit_vendor_price('{{$vendor_price->product->product_id}}')" type="submit"> Submit</button>  </div>
                          <div class="col-12" id="ERR_{{$vendor_price->product->product_id}}"></div>
                          @endvendor
                      </div>
               
                    </div>
                </div>
            </div>
        @endforeach  
    </div>
    <div class="row">
        <div class="col-12">
          {{$vendor_prices->links()}}
        </div>
    </div>
  </div>



  @include('components.product_ext')



@endsection
