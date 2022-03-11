@if ($product_purchase_session->status=='pending')
@admin      {!! Form::open(['route' => ['client.approve_session'], 'files' => false, 'method'=>'POST']) !!}   @endadmin
@elseif ($product_purchase_session->status=='ongoing')
@agent      {!! Form::open(['route' => ['client.create_deposit'], 'files' => false, 'method'=>'POST']) !!}   @endagent
@admin      {!! Form::open(['route' => ['client.pause_session'], 'files' => false, 'method'=>'POST']) !!}   @endadmin
@elseif ($product_purchase_session->status=='paused')
@admin      {!! Form::open(['route' => ['client.approve_session'], 'files' => false, 'method'=>'POST']) !!}   @endadmin
@endif



<div class="modal-content">
    <div class="modal-header">
      <h6 class="modal-title" style="display:inline;font-size: 17px!important;font-weight: 400!important;"
        id="exampleModalLabel"> product purchase session for <b>{{$product_purchase_session->client->first_name}} ...</b> </h6>
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
                     <tr><td>Description</td> <td> <b>{!!$product_purchase_session->product->description!!}</b></td></tr>
                     <tr><td>Session Status</td> <td><b>{{$product_purchase_session->status}}</b></td></tr>
              @admin <tr><td>Agent</td>  <td><b>{{$product_purchase_session->client->agent->user->username}} </b></td></tr> @endadmin
        
                 </table> 
            </div>   

            @if ($product_purchase_session->status=='ongoing')
            @agent 
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="">New Deposit</label>
                         <input type="number" name="amount" id="amount" class="form-control" required>
                     </div>
                 </div> 
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value=""></option>
                            <option value="cash">CASH</option>
                            <option value="bank_deposit">BANK DEPOSIT</option>
                            <option value="mobile_transfer">MOBILE TRANSFER</option>
                            <option value="pos">POS</option>
                        </select>
                    </div>
                </div> 
           @endagent
           @endif

        </div>
      </div>
      <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       @if ($product_purchase_session->status=='pending')
       @admin <button class="btn btn-primary" type="submit" name="submit" >Approve Session</button> @endadmin
       @elseif ($product_purchase_session->status=='ongoing')
       @agent <button class="btn btn-primary" type="submit" name="submit" >Submit Transaction</button> @endagent
       @admin <button class="btn btn-primary" type="submit" name="submit" >Pause Session</button> @endadmin
       @elseif ($product_purchase_session->status=='paused')
       @admin <button class="btn btn-primary" type="submit" name="submit" >Continue Session</button> @endadmin
       @endif
      
      </div> 
  </div>
@admin       {!! Form::close() !!}    @endadmin
@if ($product_purchase_session->status=='ongoing')
    @agent       {!! Form::close() !!}    @endagent
@endif
 