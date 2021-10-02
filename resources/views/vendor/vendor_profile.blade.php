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
                @admin  <p class="mb-0"><a href="{{route('chat_board', ['user_id'=>$user->user_id])}}" class="btn btn-outline-primary btn-block"> <i class="fa fa-comments"></i> chat </a></p> @endadmin
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
                    <li class="nav-item"><a class="nav-link active" href="#prices" data-toggle="tab"> Prices </a></li> 
                    <li class="nav-item"><a class="nav-link" href="#profile_data" data-toggle="tab"> Profile Data </a></li>
             @admin <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Manage</a></li> @endadmin
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">


                   


                    <div class="active tab-pane table-responsive" id="prices"> 
                      <table id="t1" class="table table-bordered w-100">
                        <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Product</th>
                          <th>Vendor Price</th>   
                          <th>---</th>   
                        </tr>
                        </thead>
                       <tbody> 
                          @php $sn=0; @endphp
                          @foreach($vendor_prices as $vendor_price)  
                            @php $sn++; @endphp
                            <tr class="">
                                <td> {{$sn}} </td>
                                <td> {{$vendor_price->product->prd_name}} </td>
                                <td> {{number_format($vendor_price->price)}} </td>     
                                <td>  <a href="{{route('product.show', ['product'=>$vendor_price->product_id])}}" class="btn btn-primary btn-sm btn-block">Details</a> </td>                                       
                            </tr>
                          @endforeach 
                        </tbody> 
                      </table>   
                    </div> 
                  <!-- /.tab-pane -->








                    
                    <div class="tab-pane" id="profile_data">
                      <div class="row">
                      <div class="col-12"> <p class="text-center mb-2 th_head"><b>BUSINESS INFO</b></p> </div>
                      <div class="table-responsive px-2">
                        <table class="table">
                          <tbody>   
                            <tr> <td><span class="th_span"> Agent ID</span> </td> <td> <b>  {{ $user->user_id }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Fullname</span> </td> <td> <b>   {{ $user->vendor->full_name }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Description</span> </td> <td> <b>   {{ $user->vendor->description }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Office Address</span> </td> <td> <b>   {{ $user->vendor->address }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Email Address</span> </td> <td> <b>   {{ $user->email }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Telephone A</span> </td> <td> <b>   {{ $user->vendor->phone_a }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Telephone B</span> </td> <td> <b>   {{ $user->vendor->phone_b }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Username</span> </td> <td> <b>   {{ $user->username }} </b> </td> </tr>
                       </tbody> 
                        </table>
                        </div>  
                   

                    </div>
                      <br>
                      </div>


 
                    @vendor
                      <div class="tab-pane" id="settings">
                           <div class="row">
                               <div class="col-6">  <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#update_data">
                               <span class="fas fa-edit"></span>  Update Data  </button> </div>
                           <div class="col-6">  <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#delete_data">
                              <span class="fas fa-trash"></span> Trash Account  </button> </div>
                           </div>
                      </div>      <!-- /.tab-pane -->
                    @endvendor

                  

                  @admin
                    <div class="tab-pane" id="settings">
                         <div class="row">
                             <div class="col-6">  <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#update_data">
                             <span class="fas fa-edit"></span>  Update Data  </button> </div>
                         <div class="col-6">  <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#delete_data">
                            <span class="fas fa-trash"></span> Trash Account  </button> </div>
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
                        <form id="" action="#" class="pt-1" name="registry_form" method="post">   
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
 

      
      <div class="modal fade" id="delete_data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            {!! Form::open(['route' => ['vendor.destroy', ['vendor' => $user->username]], 'files' => false]) !!}
            <div class="modal-header bg-danger">  <input type="hidden" name="_method" value="DELETE">
              <h6 class="modal-title text-white"> <span class="fs-2"> <i class="icon fas fa-exclamation-triangle"></i> This account and all information connected will be moved to trash, are you sure to continue ?</span> </h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
                   
            <div class="modal-body">
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



 



@endsection
