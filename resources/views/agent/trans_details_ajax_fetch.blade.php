<div class="modal-content">
    <div class="modal-header">
      <h6 class="modal-title" style="display:inline;font-size: 17px!important;font-weight: 400!important;"
        id="exampleModalLabel"> Details for product purchase session: <b>{{$product_purchase_session->pps_id}}</b> </h6>
      <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body" >
        <div class="row ">
            <div class="col-md-6 text-center">
                  <img src="{{asset('storage/uploads/products_img/'.$product_purchase_session->product->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
                  <input type="hidden" value="{{$product_purchase_session->pps_id}}"  name="pps_id" id="pps_id"/>  
                  <input type="hidden" value="{{$product_purchase_session->client_id}}"  name="client_id" id="client_id"/>  
            </div>  
                
            <div class="col-md-6">
                 <table class="table w-100">
                    <tr><td>Session ID</td>  <td> <b>{{$product_purchase_session->pps_id}}</b></td></tr>
                    <tr><td>Client Name</td> <td> <b>{{$product_purchase_session->client->first_name}} {{$product_purchase_session->client->last_name}} {{$product_purchase_session->client->other_name}}</b></td></tr>
                    <tr><td>Product ID</td>  <td> <b>{{$product_purchase_session->product->product_id}}</b></td></tr>
                     <tr><td>Product Name </td>       <td><b>{{$product_purchase_session->product->prd_name}}</b></td></tr>
                     <tr><td>Product Price</td>       <td><b>{{number_format($product_purchase_session->product->install_price)}}</b></td></tr>
                     <tr><td>Description</td> <td> <b>{{$product_purchase_session->product->description}}</b></td></tr>
                     <tr><td>Session Status</td> <td><b>{{$product_purchase_session->status}}</b></td></tr>
                     <tr><td>Created At</td> <td><b>{{$product_purchase_session->created_at}}</b></td></tr>
                     @admin <tr><td>Agent</td>  <td><b>{{$product_purchase_session->client->agent->user->username}} </b></td></tr> @endadmin
        
                 </table> 
            </div>    

        </div>
      </div>
      <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> 
  </div> 
 