<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center mt-2">
            <span class="profile-user-img img-fluid img-circle"  alt="User profile picture"> {{ $client->first_name[0] }}</span>
          </div> 

          <h3 class="profile-username text-center"> {{ $client->user->username }} </h3> 
          <p class="text-muted text-center"> 
            Client ID:  {{ $client->client_id }} <br>
            Product Sessions: {{count($product_purchase_sessions)}} <br>
            Transactions: {{count($transactions)}} <br> 
          </p>

       
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title text-white">Profile Data</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong><i class="fas fa-user mr-1"></i> Fullname </strong>

          <p class="text-muted">
            {{"$client->first_name $client->last_name $client->other_name"}}
          </p>

          <hr> 
          <strong><i class="fas fa-phone mr-1"></i> Telephone </strong> 
          <p class="text-muted">  {{ $client->phone }}  </p>

          <hr> 
          <strong><i class="fas fa-envelope mr-1"></i> Email </strong> 
          <p class="text-muted">  {{ $client->user->email }}  </p>

          <hr> 
          <strong><i class="fas fa-road mr-1"></i> Street Address </strong> 
          <p class="text-muted">  {{ $client->address }}  </p>

          <hr> 
          <strong><i class="fas fa-location-arrow mr-1"></i> LGA </strong> 
          <p class="text-muted">  {{ $client->agent->catchment->lga }}  </p>

          <hr> 
          <strong><i class="fas fa-tint mr-1"></i> Username </strong> 
          <p class="text-muted">  {{ $client->user->username }}  </p>
           
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#transactions" data-toggle="tab"> Transactions</a></li>
            <li class="nav-item"><a class="nav-link" href="#purchase_sess" data-toggle="tab"> Purchase Sessions </a></li> 
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
                 
                
            <div class="active tab-pane table-responsive" id="transactions"> 
              <table id="t1" class="table table-bordered table-striped" style="width:800px;">
                <thead>
                <tr>

                  <th>TRN ID</th>
                  <th>Product ID</th>
                  <th>Session ID</th>
                  <th>Amount</th>    <th>Balance</th>
                  <th>Type</th>
                  <th>Date</th> 
                  <th></th>  <th></th>  
                </tr>
                </thead>
               <tbody>
           
              @foreach ($client->product_purchase_session as $product_purchase_session) 
                  @if (count($product_purchase_session->transaction)>0) 
                  @php $last_trans_id = $product_purchase_session->transaction->last()->trans_id @endphp
                    <tr> 
                      <td colspan="7">Transactions on session: <b>{{$product_purchase_session->pps_id}} </b> </td>
                      <td colspan="3"> <a href="JavaScript:void(0)" onclick="select_trans_modal('{{$product_purchase_session->pps_id}}')" class="btn btn-primary btn-xs btn-block">Session Details</a> </td> 
                    </tr> 
                    @foreach($product_purchase_session->transaction->sortKeysDesc() as $transaction)
                      @if (count($transaction)>0) 
                        @php $allow_edit = false;
                        if ($transaction->trans_id==$last_trans_id) { $allow_edit= true; }      // set some initial values and conditions
                        @endphp
                        <tr>
                            <td> {{$transaction->trans_id}}   </td>
                            <td> {{$transaction->product_id}} </td>
                            <td> {{$transaction->pps_id}} </td>
                            <td> {{$transaction->amount}} </td>   <td> {{$transaction->new_bal}} </td>
                            <td> {{$transaction->type}}   </td>     
                            <td> {{$transaction->created_at}} </td>   
                            <td> 
                                @if ($allow_edit===true) 
                                  <a href="JavaScript:void(0)" onclick="trans_edit_modal('{{$transaction->trans_id}}')" class="btn btn-primary btn-xs btn-block"> <span class="fas fa-edit"></span> Update</a>  
                                @endif
                            </td>
                            <td>
                                @if ($allow_edit===true) 
                                <a href="JavaScript:void(0)" onclick="trans_delete_modal('{{$transaction->trans_id}}')" class="btn btn-danger btn-xs btn-block"> <span class="fas fa-trash"></span> Delete</a> 
                                @endif
                            </td>
                        </tr>
                      @endif
                  @endforeach
                  @else
                    
                  @endif 
              @endforeach

                </tbody> 
              </table>

            @php
              if (count($client->transaction)==0) {  
                echo '<p class="mt-2 text-center">No transactions found yet!</p>';
              }
            @endphp 
            </div>

            <div class="tab-pane table-responsive" id="purchase_sess"> 
              <table id="t1" class="table table-bordered table-striped" style="width:800px;">
                <thead>
                <tr>
                  <th>Session ID</th>
                  <th>Status</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Balance</th> 
                  <th>%</th> 
                  <th>Date</th>  <th></th> 
                  <th></th> 
                </tr>
                </thead>
               <tbody>
                      {{-- loop out clients here --}}
                         
                  @foreach($client->product_purchase_session as $product_purchase_session) 
                    @if (count($product_purchase_session->transaction)>0) 
                    @php
                      $percentage_bal =  round(($product_purchase_session->transaction->last()->new_bal/$product_purchase_session->product->install_price)*100, 1)
                    @endphp
                    @else
                      @php $percentage_bal=0; @endphp
                    @endif  
                  <tr>
                    <td> {{$product_purchase_session->pps_id}} </td>
                    <td> {{$product_purchase_session->status}} </td>
                    <td> {{$product_purchase_session->product->prd_name}} </td>
                    <td> {{$product_purchase_session->product->install_price}} </td>
                    <td>  
                        @if ($product_purchase_session->transaction->last())
                        {{ $product_purchase_session->transaction->last()->new_bal }}
                        @else
                          NULL
                        @endif 
                    </td>
                    <td> {{$percentage_bal}}% </td>  
                    <td> {{$product_purchase_session->created_at}} </td>  
                    <td> <a href="JavaScript:void(0)" onclick="select_pps_modal('{{$product_purchase_session->pps_id}}')" class="btn btn-primary btn-xs">product details</a> </td>  
                    <td> <a href="JavaScript:void(0)" onclick="delete_pps_modal('{{$product_purchase_session->pps_id}}')" class="btn btn-danger btn-xs">Delete Session</a> </td>   
                  </tr>
                  @endforeach
                </tbody> 
              </table>



              @php
                if (count($client->product_purchase_session)==0) {  
                  echo '<p class="mt-2 text-center">No purchase sessions found yet!</p> <hr>';
                }  
              @endphp  
            

              </div> 
          <!-- /.tab-pane -->
        
 
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>




      <div class="card">
        <div class="card-header"> 
            <div class="row">
                <div class="col-md-10"> Are  you sure to open for this client new purchase session on: <b>{{$product->prd_name}}</b> </div>
                <div class="col-md-2"> <button data-toggle="collapse" data-target="#product_details" class="btn btn-link btn-block btn-sm">show details</button> </div>
            </div>
        </div>
        {!! Form::open(['route' => ['client.new_purchase_session', []], 'method'=>'POST', 'files' => true]) !!} 
            <div class="card-body collapse" id="product_details">
                <div class="row ">
                    <div class="col-md-6 text-center">
                        <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
                        <input type="hidden" value="{{$product->product_id}}"  name="product_id" id="product_id"/>  
                        <input type="hidden" value="{{$client->client_id}}"  name="client_id" id="client_id"/>  
                    </div>   
                    <div class="col-md-6">
                        <table class="table w-100">
                            <tr><td>Product ID</td>  <td><b>{{$product->product_id}}</b></td></tr>
                            <tr><td>Name</td>        <td><b>{{$product->prd_name}}</b></td></tr>
                            <tr><td>Price</td>       <td><b>{{$product->install_price}}</b></td></tr>
                            <tr><td>Description</td> <td><b>{{$product->description}}</b></td></tr>
                        </table>
                    </div>   
                </div> 
            </div>
            <div class="card-footer">
                <p class="text-center mb-0"> <button type="submit" class="btn btn-primary btn-block">confirm new purchase session</button> </p>
            </div>
        {!! Form::close() !!} 
    </div>



      {{-- <div class="card">
        <div class="card-header p-2">
          <p class="mb-0">Click the button below to comfirm opening the new product session for this client</p>
        </div><!-- /.card-header -->
        <div class="card-body">
           <p class="text-center mb-0"> <button type="submit" class="btn btn-primary">New purchase session</button> </p>
        </div><!-- /.card-body -->
      </div> --}}
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>