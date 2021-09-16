@extends('layouts.main')

@section('content')
  

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Client Profile</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
  
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center mt-2">
                    <span class="profile-user-img img-fluid img-circle"  alt="User profile picture"> {{ strtoupper($client->user->username[0]) }}</span>
                  </div>
  
                  <h3 class="profile-username text-center"> {{ ucfirst($client->user->username) }} </h3> 
                  <p class="text-muted text-center mb-2" style="font-size: 14px;"> 
                    Client ID:  {{ $client->client_id }} <br>
                    Product Sessions: {{count($product_purchase_sessions)}} <br>
                    Transactions: {{count($transactions)}} <br> 
                    Agent: {{$client->agent->user->username}} <br> 
                  </p>
                  <p class="mb-0"><a href="{{route('chat_board', ['user_id'=>$client->client_id])}}" class="btn btn-outline-primary btn-block"> <i class="fa fa-comments"></i> chat </a></p>
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
                <div class="card-body p-3">
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
                    @admin
                    <li class="nav-item"><a class="nav-link" href="#deliveries" data-toggle="tab">Deliveries</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Manage</a></li> 
                    @endadmin
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane table-responsive" id="transactions"> 
                      <table id="t1" class="table table-bordered table-striped" style="width:900px;">
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
                   
                      @foreach ($product_purchase_sessions as $product_purchase_session) 
                          @if (count($product_purchase_session->transaction)>0) 
                          @php $last_trans_id = $product_purchase_session->transaction->last()->trans_id @endphp
                            <tr> 
                              <td colspan="7">Transactions on session: <b>{{$product_purchase_session->pps_id}} </b> </td>
                              <td colspan="3"> <a href="#" onclick="select_trans_modal('{{$product_purchase_session->pps_id}}')" class="btn btn-primary btn-xs btn-block">Session Details</a> </td> 
                            </tr> 
                            @foreach($product_purchase_session->transaction->sortKeysDesc() as $transaction)
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
                                      <a href="#" onclick="trans_edit_modal('{{$transaction->trans_id}}')" class="btn btn-primary btn-xs btn-block"> <span class="fas fa-edit"></span> Update</a>  
                                    @endif
                                </td>
                                <td>
                                    @if ($allow_edit===true) 
                                    <a href="#" onclick="trans_delete_modal('{{$transaction->trans_id}}')" class="btn btn-danger btn-xs btn-block"> <span class="fas fa-trash"></span> Delete</a> 
                                    @endif
                                </td>
                            </tr>
                          @endforeach
                          @else
                            
                          @endif 
                      @endforeach

                        </tbody> 
                      </table>

                    @php
                      if (count($transactions)==0) {  
                        echo '<p class="mt-2 text-center">No transactions found yet!</p>';
                      }
                    @endphp 
                    </div>
                    <div class="tab-pane table-responsive" id="purchase_sess"> 
                      <table id="t1" class="table table-bordered table-striped" style="">
                        <thead>
                        <tr>
                          <th>Session ID</th>
                          <th>Status</th>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Balance</th> 
                          <th>%</th> 
                          <th>Date</th>  <th></th> @admin <th></th> @endadmin
                        </tr>
                        </thead>
                       <tbody>
                              {{-- loop out clients here --}}
                                 
                          @foreach($product_purchase_sessions as $product_purchase_session)
                          @if (count($product_purchase_session->transaction)>0) 
                              @php
                                $percentage_bal =  round(($product_purchase_session->transaction->last()->new_bal/$product_purchase_session->product->price)*100, 1)
                              @endphp
                          @else
                              @php $percentage_bal=0; @endphp
                          @endif
                          <tr>
                            <td> {{$product_purchase_session->pps_id}} </td>
                            <td> {{$product_purchase_session->status}} </td>
                            <td> {{$product_purchase_session->product->prd_name}} </td>
                            <td> {{$product_purchase_session->product->price}} </td>
                            <td>  
                                @if ($product_purchase_session->transaction->last())
                                {{ $product_purchase_session->transaction->last()->new_bal }}
                                @else
                                  NULL
                                @endif 
                            </td>
                            <td> {{$percentage_bal}}% </td>  
                            <td> {{$product_purchase_session->created_at}} </td>  
                            <td> <a href="#" onclick="select_pps_modal('{{$product_purchase_session->pps_id}}')" class="btn btn-primary btn-xs">product details</a> </td>  
                            @admin  <td> <a href="#" onclick="delete_pps_modal('{{$product_purchase_session->pps_id}}')" class="btn btn-danger btn-xs">Delete Session</a> </td> @endadmin 
                          </tr>  
                          @endforeach
                        </tbody> 
                      </table>



                      @php
                        if (count($product_purchase_sessions)==0) {  
                          echo '<p class="mt-2 text-center">No purchase sessions found yet!</p> <hr>';
                        }  
                      @endphp  
                    

                      </div>
                    <!-- /.tab-pane -->
                    @admin
                      <div class="tab-pane" id="deliveries"> 
                      </div> 

                      <!-- /.tab-pane --> 
                      <div class="tab-pane" id="settings">
                         <div class="row">
                             <div class="col-6">  <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#update_data">
                             <span class="fas fa-edit"></span>  Update Data  </button> </div>
                         <div class="col-6">  <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#delete_data">
                            <span class="fas fa-trash"></span> Delete Account  </button> </div>
                         </div>
                    </div> 
                    @endadmin
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>

 


      <div class="modal fade" id="update_data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            {!! Form::open(['route' => ['client.update', ['client' => $client->client_id]], 'files' => true]) !!}
             <div class="modal-header bg-primary">  <input type="hidden" name="_method" value="PUT">
              <h4 class="modal-title"> <span class="fas fa-edit"></span> Update Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span> 
              </button>
            </div>
            <div class="modal-body"> 
                             
                       <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname">  First Name  </label>
                                <input required value="{{ $client->first_name }}" type="text" class="form-control" id="first_name" name="first_name" >
                              </div>
                           </div> 
      
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name"> Last Name </label>
                                <input required value="{{ $client->last_name }}" type="text" class="form-control" id="last_name" name="last_name">
                              </div>
                           </div>
 
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname"> Other Names <small>(opt)</small>  </label>
                                <input type="text" value="{{ $client->other_name }}" class="form-control" id="other_name" name="other_name">
                              </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">  Telephone </label>
                                <input required value="{{ $client->phone }}" type="text" class="form-control" id="phone" name="phone">
                              </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">  Full Address </label>
                                <input required value="{{ $client->user->email }}" type="email" class="form-control" id="email" name="email">
                              </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="str_address"> {{__('Street Address')}} </label>
                                <input required value="{{ $client->address }}" type="text" class="form-control" id="address" name="address">
                              </div>
                           </div>
                      

                         
 
                       </div>  
            </div>
            <div class="modal-footer justify-content-between bg-light">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
             {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal --> 

      





      <div class="modal fade" id="delete_data">
        <div class="modal-dialog large_modal">
          <div class="modal-content">
            {!! Form::open(['route' => ['client.destroy', ['client' => $client->client_id]], 'files' => false]) !!}
            <div class="modal-header bg-danger">  <input type="hidden" name="_method" value="DELETE">
              <h6 class="modal-title text-white" style="text-transform: inherit;"> <span class="fs-1"> <i class="icon fas fa-exclamation-triangle"></i> Permanently deleting user account:  <ins><i>{{$client->user->username}}</i></ins></span> </h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                 <div class="row">
                     <div class="col-md-4">
                                        <!-- Profile Image -->
                        <div class="card card-primary card-outline mb-0">
                            <div class="card-body box-profile">
                            <div class="text-center mt-2">
                                <span class="profile-user-img img-fluid img-circle"  alt="User profile picture"> {{ $client->user->username[0] }}</span>
                            </div>
            
                            <h3 class="profile-username text-center"> {{ $client->user->username }} </h3> 
                            <p class="text-muted text-center"> 
                              Product Sessions: {{count($product_purchase_sessions)}} <br>
                              Transactions: {{count($transactions)}} <br> 
                            </p>
            
                         
            
                        
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                     </div>
                     <div class="col-md-8">
                        <table class="table mb-0">
                            <tr> <th class="p_tb_th">Fullname</th> <td class="p_tb_td">{{ "$client->first_name $client->last_name $client->other_name"}}</td> </tr>
                            <tr> <th class="p_tb_th">Telephone</th> <td class="p_tb_td">{{ $client->phone }}</td> </tr> 
                            <tr> <th class="p_tb_th">Email</th> <td class="p_tb_td">{{ $client->user->email }}</td> </tr> 
                            <tr> <th class="p_tb_th">Full Address</th> <td class="p_tb_td">{{ $client->address }}</td> </tr>   
                            <tr> <th class="p_tb_th">Username</th> <td class="p_tb_td">{{ $client->user->username }}</td> </tr> 
                        </table>
                        <p class="mt-2 mb-0 text-danger" style="font-size: 14px;font-family: system-ui;font-weight: 500;"> 
                          <b>Note:</b> deleting this user account will also delete all product purchase sessions, 
                          transacions and other records connected with this account, are you sure to continue ? </p>
                     </div>
                  
                 </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger"> Confirm Delete</button>
            </div>
            {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->









 
{{-- SELECT PRODUCT PURCHASE MODAL  --}} 
<div class="modal fade" id="select_pps_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog medium_modal" style="" role="document" id="pps_ready_div">
  
    <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>  
  
  </div>
</div> 




{{-- DELETE PRODUCT PURCHASE MODAL  --}} 
<div class="modal fade" id="delete_pps_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog medium_modal" style="" role="document" id="delete_pps_ready_div">
  
    <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>  
  
  </div>
</div> 






 
{{-- TRANSACTION DETAILS MODAL  --}} 
<div class="modal fade" id="select_trans_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog medium_modal" style="" role="document" id="trans_ready_div">
  
    <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>  
  
  </div>
</div> 



{{-- TRANSACTION EDIT MODAL  --}} 
<div class="modal fade" id="trans_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="" role="document" id="trans_edit_ready_div">
  
    <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>  
  
  </div>
</div> 




{{-- TRANSACTION DELETE MODAL  --}} 
<div class="modal fade" id="trans_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="" role="document" id="trans_delete_ready_div">
  
    <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>  
  
  </div>
</div> 





  <script>
    // SELECT PRODUCT MODAL
    function select_pps_modal(pps_id) { 
      $('#pps_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#select_pps_modal').modal('show');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });

        $.ajax({
        type:'GET',
        url:"{{ route('client.pps_details_ajax_fetch') }}",
        data: {"pps_id":pps_id },

          success:function(data) {
            $('.verify').show();
            $('#pps_ready_div').html(data);  
          }
        }); 
     }




    // DELEET PRODUCT MODAL
    function delete_pps_modal(pps_id) { 
      $('#delete_pps_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#delete_pps_modal').modal('show');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });

        $.ajax({
        type:'GET',
        url:"{{ route('client.pps_delete_ajax_fetch') }}",
        data: {"pps_id":pps_id },

          success:function(data) {
            $('.verify').show();
            $('#delete_pps_ready_div').html(data);  
          }
        }); 
     }







         // SELECT PRODUCT MODAL
    function select_trans_modal(pps_id) {
        $('#trans_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#select_trans_modal').modal('show'); 
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });

        $.ajax({
        type:'GET',
        url:"{{ route('client.trans_details_ajax_fetch') }}",
        data: {"pps_id":pps_id },

          success:function(data) {
            $('.verify').show();
            $('#trans_ready_div').html(data);  
          }
        }); 
     }



       

    // EDIT PRODUCT MODAL
    function trans_edit_modal(trans_id) {
      $('#trans_edit_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#trans_edit_modal').modal('show'); 
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
        type:'GET',
        url:"{{ route('transaction.edit_trans_ajax_fetch') }}",
        data: {"trans_id":trans_id },

          success:function(data) {
            $('.verify').show();
            $('#trans_edit_ready_div').html(data);  
          }
        }); 
     }






    // DELETE PRODUCT MODAL
    function trans_delete_modal(trans_id) {
      $('#trans_delete_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#trans_delete_modal').modal('show'); 
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
        type:'GET',
        url:"{{ route('transaction.delete_trans_ajax_fetch') }}",
        data: {"trans_id":trans_id },

          success:function(data) {
            $('.verify').show();
            $('#trans_delete_ready_div').html(data);  
          }
        }); 
     }
  </script> 

@endsection
