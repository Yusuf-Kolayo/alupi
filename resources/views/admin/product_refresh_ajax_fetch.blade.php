<div class="card">
    <div class="card-header border-bottom p-0 zoomin frame">
      <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid">
    </div>
    <div class="card-body"> 
       <h6><a href="{{route('product.show', ['product'=>$product->product_id])}}" style="color:#383a46;">{{$product->prd_name}}</a></h6> 
       <p class="mb-0 price"> <b>{{number_format($product->outright_price)}} : {{number_format($product->install_price)}} </b> </p>
       <p>{!!$product->description!!}</p>
      <div class="row">
        <div class="col-6"> <button class="btn btn-primary btn-block" onclick="update_product_modal('{{$product->product_id}}')"> <i class="fas fa-edit"></i> Edit</button>  </div>
        <div class="col-6"> <button class="btn btn-primary btn-block btn-danger"> <i class="fas fa-trash"></i> Delete</button>  </div>
      </div>
    </div>
</div>