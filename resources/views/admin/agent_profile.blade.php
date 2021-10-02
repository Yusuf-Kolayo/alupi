@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/responsive.css') }}">
<style>
    input.inp_decl { display: inline-block!important;  height: 21px;  width: 250px; font-size: 13px; }
    p.undertaken {  text-align: center;  font-weight: 600;   border-bottom: 1px solid; margin-bottom: 22px; }
    .li_decl { font-size: 13px; }
</style>

             <!-- Content Header (Page header) --> 
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Agent Profile</h1>
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
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{url('images/avatar_dummy.png')}}"
                         alt="User profile picture">
                  </div>
                   
                  <h3 class="profile-username text-center"> {{ $user->username }} </h3>  
                  <p class="text-center mb-0" style="line-height: initial;">
                      Clients: {{count($user->agent->client)}} <br>
                      Transactions: {{count($user->agent->transaction)}} <br>
                      Product Sessions: {{count($user->agent->product_purchase_session)}} <br>
                  </p>
                  <p class="mb-0"><a href="{{route('chat_board', ['user_id'=>$user->user_id])}}" class="btn btn-outline-primary btn-block"> <i class="fa fa-comments"></i> chat </a></p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->




              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item" >
                      <b> <i class="fas fa-link"></i> Referral Link:</b>  <span id="copy_target">{{route('agent.show_referring_form', ['agent_id'=>$user->user_id])}}  </span> <br><br>
                       <p class="mb-0"> <button class="btn btn-outline-primary btn-block mt-2" id="copy_button">Copy Link</button> </p>
                    </li>  
                  </ul> 
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
                    <li class="nav-item"><a class="nav-link active" href="#clients" data-toggle="tab"> Clients </a></li>
                    <li class="nav-item"><a class="nav-link " href="#purchase_sess" data-toggle="tab"> Purchase Sessions </a></li>
                    <li class="nav-item"><a class="nav-link" href="#transactions" data-toggle="tab"> Transactions</a></li> 
                    <li class="nav-item"><a class="nav-link" href="#profile_data" data-toggle="tab"> Profile Data </a></li>
             @admin <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Manage</a></li> @endadmin
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">


                   


                      <div class="active tab-pane table-responsive" id="clients"> 
                        <table id="t1" class="table table-bordered table-striped" style="width:1000px;">
                          <thead>
                          <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Other_names</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Catchment ID</th>
                            <th>LGA</th> 
                            <th>...</th> 
                          </tr>
                          </thead>
                         <tbody>
                                {{-- loop out clients here --}}
                        
                         @foreach($user->agent->client as $client)
                         <tr>
                          <td> {{$client->client_id}} </td>
                          <td> {{$client->first_name}} </td>
                          <td> {{$client->last_name}} </td>
                          <td> {{$client->other_name}} </td>
                          <td> {{$client->phone}} </td>
                          <td> {{$client->user->email}} </td>
                          <td> {{$client->address}} </td>
                          <td> {{$client->agent->catchment->catchment_id}} </td>
                          <td> {{$client->agent->catchment->lga}} </td>  
                          <td>  <a class="btn btn-primary btn-xs btn-block" href="{{ route('client.show', ['client'=>$client->client_id]) }}"> <span class="fa fa-user"></span> Profile</a> </td>
                         </tr>
                        @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th> 
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th> 
                            <th></th> 
                          </tr>
                          </tfoot>
                        </table>
                     </div> 
                    <!-- /.tab-pane -->








                    
                    <div class="tab-pane" id="profile_data">
                      <div class="row">
                      <div class="col-12"> <p class="text-center mb-2 th_head"><b>PERSONAL INFO</b></p> </div>
                      <div class="col-md-6">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>   
                            <tr> <td><span class="th_span"> Agent ID</span> </td> <td> <b>  {{ $user->user_id }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Firstname</span> </td> <td> <b>   {{ $user->agent->agt_first_name }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Lastname</span> </td> <td> <b>   {{ $user->agent->agt_last_name }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Other name</span> </td> <td> <b>   {{ $user->agent->agt_other_name }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Referral ID</span> </td> <td> <b>   {{ $user->agent->referrer_id }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Email</span> </td> <td> <b>   {{ $user->email }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Phone number</span> </td> <td> <b>   {{ $user->agent->agt_phone_number }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Chat NUmber</span> </td> <td> <b>   {{ $user->agent->agt_chat_number }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Gender</span> </td> <td> <b>   {{ $user->agent->agt_gender }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Address</span> </td> <td> <b>   {{ $user->agent->agt_res_address }} </b> </td> </tr> 
                            <tr> <td><span class="th_span"> Current City</span> </td> <td> <b> {{ $user->agent->agt_res_city }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Current State</span> </td> <td> <b>   {{ $user->agent->agt_res_state }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Origin State</span> </td> <td> <b>   {{ $user->agent->agt_state_origin }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Origin LGA</span> </td> <td> <b>   {{ $user->agent->agt_lga_origin }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Home Town</span> </td> <td> <b>   {{ $user->agent->agt_home_town }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Birth Date</span> </td> <td> <b>   {{ $user->agent->agt_birth_date }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Birth Place</span> </td> <td> <b>   {{ $user->agent->agt_birth_place }} </b> </td> </tr>
                         </tbody> 
                        </table>
                        </div> 
                      </div>
                       <div class="col-md-6">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>   
                              <tr> <td><span class="th_span"> NOK Fullname</span> </td> <td> <b>  {{ $user->agent->nok_fullname }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> NOK Address</span> </td> <td> <b>   {{ $user->agent->nok_res_address }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> NOK City</span> </td> <td> <b>   {{ $user->agent->nok_res_city }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> NOK State</span> </td> <td> <b>   {{ $user->agent->nok_res_state }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> NOK Phone</span> </td> <td> <b>   {{ $user->agent->referrer_id }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> NOK Relationship</span> </td> <td> <b>   {{ $user->agent->nok_phone_number }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Fullname</span> </td> <td> <b> {{ $user->agent->grt_first_name }} {{ $user->agent->grt_last_name }} {{ $user->agent->grt_other_name }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Phone</span> </td> <td> <b> {{ $user->agent->grt_phone_number }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Age </span> </td> <td> <b>   {{ $user->agent->grt_age }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Address</span> </td> <td> <b>   {{ $user->agent->grt_res_address }} </b> </td> </tr> 
                              <tr> <td><span class="th_span"> GRT City</span> </td> <td> <b> {{ $user->agent->grt_res_city }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT State</span> </td> <td> <b>   {{ $user->agent->grt_res_state }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Occupation</span> </td> <td> <b>   {{ $user->agent->grt_occupation }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Business</span> </td> <td> <b>   {{ $user->agent->grt_bis_name }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Office Address</span> </td> <td> <b>   {{ $user->agent->grt_bis_address }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Relationship</span> </td> <td> <b>   {{ $user->agent->grt_relationship }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Undertaken</span> </td> <td> <b>   {{ $user->agent->grt_undertaken }} </b> </td> </tr>
                           </tbody> 
                          </table>
                          </div> 
                       </div>
                    </div>
                      <br>
                      </div>




                      <div class="tab-pane table-responsive" id="transactions"> 
                        <table id="t1" class="table table-bordered" style="width:800px;">
                          <thead>
                          <tr>
  
                            <th>TRN ID</th>
                            <th>Product ID</th>
                            <th>Session ID</th>
                            <th>Amount</th>    <th>Balance</th>
                            <th>Type</th>      <th>Status</th>
                            <th>Date</th> 
                            <th></th>  <th></th>  
                          </tr>
                          </thead>
                         <tbody>
                     
                        @foreach ($user->agent->product_purchase_session as $product_purchase_session) 
                            @if (count($product_purchase_session->transaction)>0) 
                            @php $last_trans_id = $product_purchase_session->transaction->last()->trans_id @endphp
                              <tr> 
                                <td colspan="8">Transactions on session: <b>{{$product_purchase_session->pps_id}} </b> </td>
                                <td colspan="3"> <a href="#" onclick="select_trans_modal('{{$product_purchase_session->pps_id}}')" class="btn btn-primary btn-xs btn-block">Session Details</a> </td> 
                              </tr> 
                              @foreach($product_purchase_session->transaction->sortKeysDesc() as $transaction) 
                                  @php $allow_edit = false;  $tr_bg_class = '';
                                  if ($transaction->trans_id==$last_trans_id) { $allow_edit= true; }      // set some initial values and conditions
                                  if ($transaction->status=='pending') { $tr_bg_class = 'fade_bd_red'; }
                                  if ($transaction->status=='approved') { $tr_bg_class = 'fade_bd_blue'; }     
                                  @endphp
                              <tr class="{{$tr_bg_class}}">
                                  <td> {{$transaction->trans_id}}   </td>
                                  <td> {{$transaction->product_id}} </td>
                                  <td> {{$transaction->pps_id}} </td>
                                  <td> {{$transaction->amount}} </td>   <td> {{$transaction->new_bal}} </td>
                                  <td> {{$transaction->type}}   </td>   <td> {{$transaction->status}}  </td>     
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
                        if (count($user->agent->transaction)==0) {  
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
                            <th>Date</th>  <th></th> 
                            <th></th> 
                          </tr>
                          </thead>
                         <tbody>
                                {{-- loop out clients here --}}
                                   
                            @foreach($user->agent->product_purchase_session as $product_purchase_session)
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
                              <td> <a href="#" onclick="delete_pps_modal('{{$product_purchase_session->pps_id}}')" class="btn btn-danger btn-xs">Delete Session</a> </td>   
                            </tr>
                            @endforeach
                          </tbody> 
                        </table>
  
  
  
                        @php
                          if (count($user->agent->product_purchase_session)==0) {  
                            echo '<p class="mt-2 text-center">No purchase sessions found yet!</p> <hr>';
                          }  
                        @endphp  
                      
  
                        </div> 
                    <!-- /.tab-pane -->
                  

                  @admin
                    <div class="tab-pane" id="settings">
                         <div class="row">

                        <div class="col-6">  <button type="button" class="btn btn-success btn-block m-1" data-toggle="modal" data-target="#update_data">
                          <span class="fas fa-edit"></span>  Update Data  </button> 
                        </div> 

                @if ($user->agent->acct_status=='pending')
                <div class="col-6">  <button type="button" class="btn btn-primary btn-block m-1" data-toggle="modal" data-target="#assign_catchment">
                  <span class="fas fa-th"></span> Assign Catchment </button>  
                </div> 
                @endif    


                        <div class="col-6">  <button type="button" class="btn btn-danger btn-block m-1" data-toggle="modal" data-target="#delete_data">
                          <span class="fas fa-trash"></span> Delete Account  </button> 
                        </div>

                    </div>      <!-- /.tab-pane -->
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











     
document.getElementById("copy_button").addEventListener("click", function() {
    copyToClipboard(document.getElementById("copy_target"));
    alert('Link copied! Now go and paste where you want')
});


function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

  </script> 



















      {{-- UPDATE FORM --}}
       <div class="modal fade" id="update_data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="max-width: 700px;">

              <div class="modal-header bg-primary">  
              <h4 class="modal-title text-white"> <span class="fas fa-edit"></span> Update Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span> 
              </button>
            </div>
            <div class="modal-body"> 
                  <div class="mb-2" style="display:none;" id="error_msg"></div> 
                  <div class="login-sec-bg mb-4" id="add_new" style="border: 1px solid #dfe0e2;"> 
                        <form id="form_wizard" action="#" class="pt-1" name="registry_form" method="post">   
                        <h3>Personal Data</h3>  
                        <fieldset class="form-input">
                            <h4>Your personal information</h4>
                            {{--START=> Your personal information --}}
                            <div class="row">  
                              <input type="hidden" name="_method" value="PUT">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_first_name"> {{__('First Name')}}  </label>
                                        <input required value="{{$user->agent->agt_first_name}}" type="text" class="form-control" id="agt_first_name" name="agt_first_name">
                                        </div>
                                    </div> 
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_last_name"> {{__('Last Name')}}  </label>
                                        <input required value="{{$user->agent->agt_last_name}}" type="text" class="form-control" id="agt_last_name" name="agt_last_name">
                                        </div> 
                                    </div> 
                                    
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_other_name"> {{__('Other Name')}}  </label>
                                        <input required value="{{$user->agent->agt_other_name}}" type="text" class="form-control" id="agt_other_name" name="agt_other_name">
                                        </div>
                                    </div>
                
                
                                    
                                      <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="agt_gender"> {{__('Gender')}}  </label>
                                              <select required id="agt_gender" class="form-control" name="agt_gender">
                                                <option value="{{$user->agent->agt_gender}}"> {{$user->agent->agt_gender}} </option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option> 
                                              </select>
                                            </div>
                                        </div>
                
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_email"> {{__('Email Address')}}  </label>
                                        <input required value="{{$user->email}}" type="email" class="form-control" id="agt_email" name="agt_email">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_phone_number"> {{__('Phone Number')}}  </label>
                                        <input required value="{{$user->agent->agt_phone_number}}" type="digits" class="form-control" id="agt_phone_number" name="agt_phone_number">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_chat_number"> {{__('Chat Number')}}  </label>
                                        <input required value="{{$user->agent->agt_chat_number}}" type="digits" class="form-control" id="agt_chat_number" name="agt_chat_number">
                                        </div>
                                    </div>
                
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_res_address"> {{__('Residential Address')}}  </label>
                                        <input required value="{{$user->agent->agt_res_address}}" type="text" class="form-control" id="agt_res_address" name="agt_res_address">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_res_city"> {{__('City of Residence')}}  </label>
                                        <input required value="{{$user->agent->agt_res_city}}" type="text" class="form-control" id="agt_res_city" name="agt_res_city">
                                        </div>
                                    </div>
                
                                        <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_res_state"> {{__('State of Residence')}}  </label>
                                        <select required id="agt_res_state" class="form-control" name="agt_res_state">
                                            <option value="{{$user->agent->agt_res_state}}">{{$user->agent->agt_res_state}}</option>
                                            <option value="Abia">Abia</option>
                                            <option value="Adamawa">Adamawa</option>
                                            <option value="Akwa Ibom">Akwa Ibom</option>
                                            <option value="Anambra">Anambra</option>
                                            <option value="Bauchi">Bauchi</option>
                                            <option value="Bayelsa">Bayelsa</option>
                                            <option value="Benue">Benue</option>
                                            <option value="Borno">Borno</option>
                                            <option value="Cross River">Cross River</option>
                                            <option value="Delta">Delta</option>
                                            <option value="Ebonyi">Ebonyi</option>
                                            <option value="Edo">Edo</option>
                                            <option value="Ekiti">Ekiti</option>
                                            <option value="Enugu">Enugu</option>
                                            <option value="FCT">FCT</option>
                                            <option value="Gombe">Gombe</option>
                                            <option value="Imo">Imo</option>
                                            <option value="JIgawa">Jigawa</option>
                                            <option value="Kaduna">Kaduna</option>
                                            <option value="Katsina">Katsina</option>
                                            <option value="Kebbi">Kebbi</option>
                                            <option value="Kwara">Kwara</option>
                                            <option value="Lagos">Lagos</option>
                                            <option value="Nasarawa">Nasarawa</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Ogun">Ogun</option>
                                            <option value="Ondo">Ondo</option>
                                            <option value="Osun">Osun</option>
                                            <option value="Oyo">Oyo</option>
                                            <option value="Plateau">Plateau</option>
                                            <option value="Rivers">Rivers</option>
                                            <option value="Sokoto">Sokoto</option>
                                            <option value="Taraba">Taraba</option>
                                            <option value="Zamfara">Zamfara</option>  
                                          </select>
                                        </div>
                                    </div>
                
                                        <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_state_origin"> {{__('State of Origin')}}  </label> 
                                        <select required  class="form-control" id="agt_state_origin" name="agt_state_origin">
                                            <option value="{{$user->agent->agt_state_origin}}">{{$user->agent->agt_state_origin}}</option>
                                            <option value="Abia">Abia</option>
                                            <option value="Adamawa">Adamawa</option>
                                            <option value="Akwa Ibom">Akwa Ibom</option>
                                            <option value="Anambra">Anambra</option>
                                            <option value="Bauchi">Bauchi</option>
                                            <option value="Bayelsa">Bayelsa</option>
                                            <option value="Benue">Benue</option>
                                            <option value="Borno">Borno</option>
                                            <option value="Cross River">Cross River</option>
                                            <option value="Delta">Delta</option>
                                            <option value="Ebonyi">Ebonyi</option>
                                            <option value="Edo">Edo</option>
                                            <option value="Ekiti">Ekiti</option>
                                            <option value="Enugu">Enugu</option>
                                            <option value="FCT">FCT</option>
                                            <option value="Gombe">Gombe</option>
                                            <option value="Imo">Imo</option>
                                            <option value="JIgawa">Jigawa</option>
                                            <option value="Kaduna">Kaduna</option>
                                            <option value="Katsina">Katsina</option>
                                            <option value="Kebbi">Kebbi</option>
                                            <option value="Kwara">Kwara</option>
                                            <option value="Lagos">Lagos</option>
                                            <option value="Nasarawa">Nasarawa</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Ogun">Ogun</option>
                                            <option value="Ondo">Ondo</option>
                                            <option value="Osun">Osun</option>
                                            <option value="Oyo">Oyo</option>
                                            <option value="Plateau">Plateau</option>
                                            <option value="Rivers">Rivers</option>
                                            <option value="Sokoto">Sokoto</option>
                                            <option value="Taraba">Taraba</option>
                                            <option value="Zamfara">Zamfara</option>  
                                          </select>
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_lga_origin"> {{__('LGA of Origin')}}  </label>
                                        <input required value="{{$user->agent->agt_lga_origin}}" type="text" class="form-control" id="agt_lga_origin" name="agt_lga_origin">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_home_town"> {{__('Home Town')}}  </label>
                                        <input required value="{{$user->agent->agt_home_town}}" type="text" class="form-control" id="agt_home_town" name="agt_home_town">
                                        </div>
                                    </div> 
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_birth_date"> {{__('Date of Birth')}}  </label>
                                        <input required value="{{$user->agent->agt_birth_date}}" type="date" class="form-control" id="agt_birth_date" name="agt_birth_date">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_birth_place"> {{__('Place of Birth')}}  </label>
                                        <input required value="{{$user->agent->agt_birth_place}}" type="text" class="form-control" id="agt_birth_place" name="agt_birth_place">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="agt_username"> {{__('Username')}}  </label>
                                          <input required value="{{$user->username}}" type="text" class="form-control" id="agt_username" name="agt_username">
                                          </div>
                                      </div> 
                              
                    
                                       
                            
                                </div>    
                            {{--END=> Your personal information --}}
                        </fieldset>
                
                        <h3>Next of Kin</h3>
                        <fieldset class="form-input">
                            <h4>Your next of kin data</h4>
                            {{--START=> Your next of kin data --}}
                            <div class="row">
                
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="nok_fullname"> {{__('Fullname')}}  </label>
                                      <input required value="{{$user->agent->nok_fullname}}" type="text" class="form-control" id="nok_fullname" name="nok_fullname" >
                                    </div>
                                </div> 
                
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="nok_res_address"> {{__('Residential Address')}}  </label>
                                      <input required value="{{$user->agent->nok_res_address}}" type="text" class="form-control" id="nok_res_address" name="nok_res_address">
                                    </div> 
                                </div> 
                
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nok_res_city"> {{__('City of Residence')}}  </label>
                                    <input required value="{{$user->agent->nok_res_city}}" type="text" class="form-control" id="nok_res_city" name="nok_res_city">
                                    </div>
                                </div>
                
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nok_res_state"> {{__('State of Residence')}}  </label>
                                    <select required  class="form-control" id="nok_res_state" name="nok_res_state">
                                        <option value="{{$user->agent->nok_res_state}}">{{$user->agent->nok_res_state}}</option>
                                        <option value="Abia">Abia</option>
                                        <option value="Adamawa">Adamawa</option>
                                        <option value="Akwa Ibom">Akwa Ibom</option>
                                        <option value="Anambra">Anambra</option>
                                        <option value="Bauchi">Bauchi</option>
                                        <option value="Bayelsa">Bayelsa</option>
                                        <option value="Benue">Benue</option>
                                        <option value="Borno">Borno</option>
                                        <option value="Cross River">Cross River</option>
                                        <option value="Delta">Delta</option>
                                        <option value="Ebonyi">Ebonyi</option>
                                        <option value="Edo">Edo</option>
                                        <option value="Ekiti">Ekiti</option>
                                        <option value="Enugu">Enugu</option>
                                        <option value="FCT">FCT</option>
                                        <option value="Gombe">Gombe</option>
                                        <option value="Imo">Imo</option>
                                        <option value="JIgawa">Jigawa</option>
                                        <option value="Kaduna">Kaduna</option>
                                        <option value="Katsina">Katsina</option>
                                        <option value="Kebbi">Kebbi</option>
                                        <option value="Kwara">Kwara</option>
                                        <option value="Lagos">Lagos</option>
                                        <option value="Nasarawa">Nasarawa</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Ogun">Ogun</option>
                                        <option value="Ondo">Ondo</option>
                                        <option value="Osun">Osun</option>
                                        <option value="Oyo">Oyo</option>
                                        <option value="Plateau">Plateau</option>
                                        <option value="Rivers">Rivers</option>
                                        <option value="Sokoto">Sokoto</option>
                                        <option value="Taraba">Taraba</option>
                                        <option value="Zamfara">Zamfara</option>  
                                      </select>
                                    </div>
                                </div>
                
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nok_phone_number"> {{__('Phone Number')}}  </label>
                                    <input required value="{{$user->agent->nok_phone_number}}" type="digits" class="form-control" id="nok_phone_number" name="nok_phone_number">
                                    </div>
                                </div>
                
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nok_relationship"> {{__('Relationship')}}  </label>
                                    <input required value="{{$user->agent->nok_relationship}}" type="text" class="form-control" id="nok_relationship" name="nok_relationship">
                                    </div>
                                </div> 
                
                        
                            </div>  
                              {{--END=> Your next of kin data --}}
                        </fieldset>
                
                        <h3>Guarantor</h3>
                        <fieldset class="form-input">
                            <h4>Your guarantor data</h4>
                            {{--START=> Your guarantor data --}}
                    <div class="row">
                
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="grt_first_name"> {{__('First Name')}}  </label>
                                      <input required value="{{$user->agent->grt_first_name}}" type="text" class="form-control" id="grt_first_name" name="grt_first_name" >
                                    </div>
                                </div> 
                
                              <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="grt_last_name"> {{__('Last Name')}}  </label>
                                      <input required value="{{$user->agent->grt_last_name}}" type="text" class="form-control" id="grt_last_name" name="grt_last_name" >
                                    </div>
                                </div> 
                
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="grt_other_name"> {{__('Other Name')}}  </label>
                                      <input required value="{{$user->agent->grt_other_name}}" type="text" class="form-control" id="grt_other_name" name="grt_other_name">
                                    </div> 
                                </div> 
                
                                
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="grt_phone_number"> {{__('Phone Number')}}  </label>
                                          <input required value="{{$user->agent->grt_phone_number}}" type="digits" class="form-control" id="grt_phone_number" name="grt_phone_number">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="grt_age"> {{__('Age')}}  </label>
                                            <input required value="{{$user->agent->grt_age}}" type="number" class="form-control" id="grt_age" name="grt_age">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="grt_res_address"> {{__('Residential Address')}}  </label>
                                            <input required value="{{$user->agent->grt_res_address}}" type="text" class="form-control" id="grt_res_address" name="grt_res_address">
                                        </div>
                                  </div>
                
                                
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grt_city"> {{__('City of Redsidence')}}  </label>
                                        <input required value="{{$user->agent->grt_res_city}}" type="text" class="form-control" id="grt_res_city" name="grt_res_city">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grt_state"> {{__('State of Residence')}}  </label>
                                        <select required class="form-control" name="grt_res_state" id="grt_state">
                                          <option value="{{$user->agent->grt_res_state}}">{{$user->agent->grt_res_state}}</option>
                                          <option value="Abia">Abia</option>
                                          <option value="Adamawa">Adamawa</option>
                                          <option value="Akwa Ibom">Akwa Ibom</option>
                                          <option value="Anambra">Anambra</option>
                                          <option value="Bauchi">Bauchi</option>
                                          <option value="Bayelsa">Bayelsa</option>
                                          <option value="Benue">Benue</option>
                                          <option value="Borno">Borno</option>
                                          <option value="Cross River">Cross River</option>
                                          <option value="Delta">Delta</option>
                                          <option value="Ebonyi">Ebonyi</option>
                                          <option value="Edo">Edo</option>
                                          <option value="Ekiti">Ekiti</option>
                                          <option value="Enugu">Enugu</option>
                                          <option value="FCT">FCT</option>
                                          <option value="Gombe">Gombe</option>
                                          <option value="Imo">Imo</option>
                                          <option value="JIgawa">Jigawa</option>
                                          <option value="Kaduna">Kaduna</option>
                                          <option value="Katsina">Katsina</option>
                                          <option value="Kebbi">Kebbi</option>
                                          <option value="Kwara">Kwara</option>
                                          <option value="Lagos">Lagos</option>
                                          <option value="Nasarawa">Nasarawa</option>
                                          <option value="Niger">Niger</option>
                                          <option value="Ogun">Ogun</option>
                                          <option value="Ondo">Ondo</option>
                                          <option value="Osun">Osun</option>
                                          <option value="Oyo">Oyo</option>
                                          <option value="Plateau">Plateau</option>
                                          <option value="Rivers">Rivers</option>
                                          <option value="Sokoto">Sokoto</option>
                                          <option value="Taraba">Taraba</option>
                                          <option value="Zamfara">Zamfara</option>  
                                        </select>
                                        </div>
                                    </div>
                
                
                
                
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="grt_occupation"> {{__('Occupation')}}  </label>
                                    <input required value="{{$user->agent->grt_occupation}}" type="text" class="form-control" id="grt_occupation" name="grt_occupation">
                                    </div>
                                </div>
                
                
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="grt_bis_name"> {{__('Business/Company Name')}}  </label>
                                <input required value="{{$user->agent->grt_bis_name}}" type="text" class="form-control" id="grt_bis_name" name="grt_bis_name">
                                </div>
                          </div>
                
                
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="grt_bis_address"> {{__('Business Address')}}  </label>
                                <input required value="{{$user->agent->grt_bis_address}}" type="text" class="form-control" id="grt_bis_address" name="grt_bis_address">
                              </div>
                          </div>
                
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="grt_relationship"> {{__('Relationship with Agent')}}  </label>
                            <input required type="text" value="{{$user->agent->grt_relationship}}" class="form-control" id="grt_relationship" name="grt_relationship">
                        </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group">
                              <label for="grt_undertaken"> {{__('Guarantor Undertake')}}  </label>
                              <textarea required rows="5" class="form-control" id="grt_undertaken" name="grt_undertaken">{{$user->agent->grt_undertaken}}</textarea>
                        </div>
                        </div>
                
  
                
                    </div>  
                            {{--END=> Your guarantor data --}}
                        </fieldset>
                
                        <h3>HR</h3>
                        <fieldset class="form-input">
                            <h4>HR Verification</h4>
                          {{--START=> HR Verification --}}
                          <div class="row"> 
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="staff_id"> {{__('Staff ID')}}  </label>
                                        <input required type="text" class="form-control" value="{{$user->agent->hr_staff_id}}" id="hr_staff_id" name="hr_staff_id">
                                        </div> 
                                    </div> 
                                    
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grt_response"> {{__('Guarantor Response')}}  </label>
                                        <textarea required class="form-control"  rows="5"id="hr_grt_response" name="hr_grt_response"> {{$user->agent->hr_grt_response}} </textarea>
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hr_remark"> {{__('HR Remarks')}}  </label> 
                                        <textarea required class="form-control" rows="5"  id="hr_remark" name="hr_remark"> {{$user->agent->hr_remark}} </textarea>
                                        </div>
                                    </div>   
                          </div>
                                {{--END=> HR Verification --}}
                        </fieldset> 
                      </form>
                  </div>  
             
            </div>
            <div class="modal-footer justify-content-between bg-light">
               
            </div>
     
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal --> 



      
      





@if ($user->agent->acct_status=='pending')
@php  $catchments = \App\Models\Catchment::all();   @endphp

      <div class="modal fade" id="assign_catchment">
        <div class="modal-dialog ">
          <div class="modal-content">
            {!! Form::open(['route' => ['agent.assign_catchment'], 'files' => false, 'method'=>'POST']) !!}
            <div class="modal-header bg-primary">  <input type="hidden" name="_method" value="POST">  <input type="hidden" name="agent_id" value="{{$user->user_id}}">
              <h6 class="modal-title text-white"> <span class="fs-2"> <span class="fas fa-th"></span> Catchment Assignment</span> </h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
                   
            <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="catchment_id"> {{__('Select Catchment')}}  </label>
                          <select name="catchment_id" id="catchment_id" required="" class="form-control ng-touched ng-dirty ng-valid">
                              <option value=""></option>
                              @foreach ($catchments as $catchment)
                                  <option value="{{$catchment->catchment_id}}">{{$catchment->catchment_id}} : {{$catchment->locations}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div> 
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@endif




      
      <div class="modal fade" id="delete_data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            {!! Form::open(['route' => ['agent.destroy', ['agent' => $user->username]], 'files' => false]) !!}
            <div class="modal-header bg-danger">  <input type="hidden" name="_method" value="DELETE">
              <h6 class="modal-title text-white"> <span class="fs-2"> <i class="icon fas fa-exclamation-triangle"></i> This account and all information connected will be moved to trash, are you sure to continue ?</span> </h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
                   
            <div class="modal-body">
                 <div class="row">
                     <div class="col-md-4">
                                        <!-- Profile Image -->
                                        <div class="card card-primary card-outline">
                                          <div class="card-body box-profile">
                                            <div class="text-center">
                                              <img class="profile-user-img img-fluid img-circle"
                                                   src="{{url('images/avatar_dummy.png')}}"
                                                   alt="User profile picture">
                                            </div>
                                             
                                            <h3 class="profile-username text-center"> {{ $user->username }} </h3>  
                                          </div>
                                          <!-- /.card-body -->
                                        </div>
                        <!-- /.card -->
                     </div>
                     <div class="col-md-8">
                      <div class="row">
                        <div class="col-12"> <p class="text-center mb-2 th_head"><b>PERSONAL INFO</b></p> </div>
                        <div class="col-md-6">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>   
                              <tr> <td><span class="th_span"> Agent ID</span> </td> <td> <b>  {{ $user->user_id }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Firstname</span> </td> <td> <b>   {{ $user->agent->agt_first_name }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Lastname</span> </td> <td> <b>   {{ $user->agent->agt_last_name }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Other name</span> </td> <td> <b>   {{ $user->agent->agt_other_name }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Referral ID</span> </td> <td> <b>   {{ $user->agent->referrer_id }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Email</span> </td> <td> <b>   {{ $user->email }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Phone number</span> </td> <td> <b>   {{ $user->agent->agt_phone_number }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Chat NUmber</span> </td> <td> <b>   {{ $user->agent->agt_chat_number }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Gender</span> </td> <td> <b>   {{ $user->agent->agt_gender }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Address</span> </td> <td> <b>   {{ $user->agent->agt_res_address }} </b> </td> </tr> 
                              <tr> <td><span class="th_span"> Current City</span> </td> <td> <b> {{ $user->agent->agt_res_city }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Current State</span> </td> <td> <b>   {{ $user->agent->agt_res_state }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Origin State</span> </td> <td> <b>   {{ $user->agent->agt_state_origin }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Origin LGA</span> </td> <td> <b>   {{ $user->agent->agt_lga_origin }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Home Town</span> </td> <td> <b>   {{ $user->agent->agt_home_town }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Birth Date</span> </td> <td> <b>   {{ $user->agent->agt_birth_date }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Birth Place</span> </td> <td> <b>   {{ $user->agent->agt_birth_place }} </b> </td> </tr>
                           </tbody> 
                          </table>
                          </div> 
                        </div>
                         <div class="col-md-6">
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>   
                                <tr> <td><span class="th_span"> NOK Fullname</span> </td> <td> <b>  {{ $user->agent->nok_fullname }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> NOK Address</span> </td> <td> <b>   {{ $user->agent->nok_res_address }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> NOK City</span> </td> <td> <b>   {{ $user->agent->nok_res_city }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> NOK State</span> </td> <td> <b>   {{ $user->agent->nok_res_state }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> NOK Phone</span> </td> <td> <b>   {{ $user->agent->referrer_id }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> NOK Relationship</span> </td> <td> <b>   {{ $user->agent->nok_phone_number }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Fullname</span> </td> <td> <b> {{ $user->agent->grt_first_name }} {{ $user->agent->grt_last_name }} {{ $user->agent->grt_other_name }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Phone</span> </td> <td> <b> {{ $user->agent->grt_phone_number }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Age </span> </td> <td> <b>   {{ $user->agent->grt_age }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Address</span> </td> <td> <b>   {{ $user->agent->grt_res_address }} </b> </td> </tr> 
                                <tr> <td><span class="th_span"> GRT City</span> </td> <td> <b> {{ $user->agent->grt_res_city }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT State</span> </td> <td> <b>   {{ $user->agent->grt_res_state }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Occupation</span> </td> <td> <b>   {{ $user->agent->grt_occupation }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Business</span> </td> <td> <b>   {{ $user->agent->grt_bis_name }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Office Address</span> </td> <td> <b>   {{ $user->agent->grt_bis_address }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Relationship</span> </td> <td> <b>   {{ $user->agent->grt_relationship }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Undertaken</span> </td> <td> <b>   {{ $user->agent->grt_undertaken }} </b> </td> </tr>
                             </tbody> 
                            </table>
                            </div> 
                         </div>
                      </div>
                     </div>
                 </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Proceed To Trash</button>
            </div>
            {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

 









<!-------------     SOME FREE GAP HERE  ----------------->



<!-- jquery.steps js -->
{{-- <script src='https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js'></script> --}}
<script src="{{ asset('dist/js/jquery.validate.js') }}"></script>
<script src="{{ asset('dist/js/jquery.steps.js') }}"></script>
<script src="{{ asset('dist/js/particles.js') }}"></script>


<script>
	var form = $("#form_wizard").show(); 
	form.steps({
		headerTag: "h3",
		bodyTag: "fieldset",
		transitionEffect: "slideLeft",
		onStepChanging: function (event, currentIndex, newIndex)
		{
			// Allways allow previous action even if the current form is not valid!
			if (currentIndex > newIndex)
			{ return true; }
			// Forbid next action on "third" step.
			// if (newIndex === 3 ) { return false; }

			// Needed in some cases if the user went back (clean up)
			if (currentIndex < newIndex)
			{
				// To remove error styles
				form.find(".body:eq(" + newIndex + ") label.error").remove();
				form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
			}
			form.validate().settings.ignore = ":disabled,:hidden";
			return form.valid();
            //return true;
		},
		onStepChanged: function (event, currentIndex, priorIndex)
		{
			// Used to skip the "Warning" step if the user is old enough.
			if (currentIndex === 2 && Number($("#age").val()) >= 18)
			{
				form.steps("next");
			}
			// Used to skip the "third" step.
			// if (currentIndex === 2 && priorIndex === 3)  { form.steps("previous");  }
		},
		onFinishing: function (event, currentIndex)
		{
			form.validate().settings.ignore = ":disabled";
			return form.valid();   
		},
		onFinished: function (event, currentIndex)
		{  
            // $("a[href='#finish']").click(function (e) { e.preventDefault();  form.submit(); });
            // $("a[href='#finish']").click(function (e) {  });
          var agt_first_name = $("#agt_first_name").val();
          if(agt_first_name == '') {
            $('#error_msg').show();
            $('#error_msg').html('All the required fields must be filled');
        } else{
            $('#error_msg').hide();

            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $("input[name=_token]").val()
                  }
              });
              // url: '{{ url("/agent") }}',
            $.ajax({
                type: 'post',
                url: '{{ route("agent.update", ['agent'=>$user->username]) }}',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() { 
                    $('#form_wizard').css("opacity",".5"); 
                },
                success: function(response){   var error_msg='';
                    $('#error_msg').show(); 
                    for (const key of Object.keys(response)){
                         console.log(key, response[key]);
                        error_msg += (' <div class="alert alert-success mb-1" style="font-size:14px;">'+response[key]+'</div>');
                    }
                    $('#error_msg').html(error_msg);
                    $('#form_wizard').css("opacity","");  
                    fetch_saved_data();
                }
            });
        }


        // ----------------------------------------------------- //

		}
	}).validate({
		errorPlacement: function errorPlacement(error, element) { element.before(error); },
		rules: {
			confirm: {
				equalTo: "#password"
			}
		}
	});




//-----------------------   SOME FREE GAP -----------------------//




    $('#form_wizard').on('submit', function(e){
        e.preventDefault(); 
    });



//----------------------     SOME FREE GAP    --------------------//  



</script>





@endsection
