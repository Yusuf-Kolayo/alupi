@extends('layouts.main')

@section('content') 

 <link rel="stylesheet" href="{{ asset('dist/css/reset.css') }}">
 <link rel="stylesheet" href="{{ asset('dist/css/responsive.css') }}">

 <script src="{{asset('plugins/ckeditor_4_16_1_standard/ckeditor.js')}}"></script>
 <link rel="stylesheet" href="{{asset('plugins/ckeditor_4_16_1_standard/samples/toolbarconfigurator/lib/codemirror/neo.css')}}">
 <style>
  #main #editor { background: #FFF;  padding: .375rem .75rem; border: 1px solid #ced4da; }
 </style>
         
  
      <!-- Main content -->

   @admin 
   <section class="content">
    <div class="container-fluid">
      <div class="card card-body p-3 mb-2"><p class="mb-0"><b>{{$product->prd_name}}</b></p></div>
      <div class="row">
        <div class="col-md-4">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
                <input type="hidden" value="{{$product->product_id}}"  name="product_id_delete_form" id="product_id_delete_form"/>  
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->




          {{-- <div class="card card-primary"> 
            <div class="card-body">
            <p class="mb-0 text-center"><b>::: ::: ::: ::: ::: :::</b></p>
            </div> 
          </div> --}}


          
          <div class="card card-primary"> 
            <div class="card-body" id="price_1">
              <p class="mb-1 text-center"> <i class="fa fa-flash"></i> Outright Price: <b class="NPP price">{{number_format($product->outright_price)}}</b> </p>
              <p class="mb-0 text-center"> <i class="fa fa-list"></i> Installment Price: <b class="NPP price">{{number_format($product->install_price)}}</b> </p>
            </div> 
          </div>
          <!-- /.card -->



        
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills"> 
                <li class="nav-item"><a class="nav-link active" href="#details" data-toggle="tab"> Details </a></li>
                <li class="nav-item"><a class="nav-link" href="#vd_prices" data-toggle="tab"> Vendor Prices </a></li>
                <li class="nav-item"><a class="nav-link " href="#purchase_sess" data-toggle="tab"> Purchase Sessions </a></li>  
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Manage</a></li>  
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">


               


                  <div class="active tab-pane table-responsive" id="details">  
                      <table class="table w-100">
                          <tr><td>Product ID</td>  <td><b>{{$product->product_id}}</b></td></tr>
                          <tr><td>Name</td>        <td><b>{{$product->prd_name}}</b></td></tr>
                          <tr><td>Installment Pay</td>       <td><b class="NIP"> {{number_format($product->install_price)}} </b></td></tr>
                          <tr><td>Outright Pay</td>          <td><b class="NOP"> {{number_format($product->outright_price)}} </b></td></tr>
                          <tr><td>Description</td> <td>{!!$product->description!!}</td></tr>
                      </table> 
                 </div> 
                <!-- /.tab-pane -->


                
                <div class="tab-pane" id="vd_prices"> 
                    <div class="table-responsive">
                      <table id="t1" class="table table-bordered w-100">
                        <thead>
                        <tr>

                          <th>SN</th>
                          <th>Vendor</th>
                          <th>Base Price</th>    <th>Outright Price</th>    <th>Installment Price</th>   
                          <th></th>   
                        </tr>
                        </thead>
                       <tbody>
                   
                          @php $sn=0; @endphp
                          @foreach($product->vendor_price as $vendor_price)  
                            @php $sn++;      $outright_price =  $vendor_price->outright_price_vnd();     $install_price = $vendor_price->install_price_vnd();   @endphp
                            <tr class="">
                                <td> {{$sn}} </td>
                                <td> {{$vendor_price->vendor->full_name}} </td>
                                <td> {{number_format($vendor_price->price)}} </td>         <td> {{number_format($outright_price)}} </td>    <td> {{number_format($install_price)}} </td>     
                                <td> <button class="btn btn-primary btn-sm btn-block" onclick="pick_vendor_price('{{$vendor_price->product_id}}','{{$vendor_price->id}}')">Assign Price</button> </td>                                       
                            </tr>
                          @endforeach
                         

                        </tbody> 
                      </table>    
                    </div> 
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

                            {{-- loop out product_purchase_session here --}}                               
                        @foreach($product->product_purchase_session as $product_purchase_session)
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
                  </div> 
                <!-- /.tab-pane -->
              

             
                <div class="tab-pane" id="settings">
                      <div class="row">
                        @admin
                          <div class="col-6"> <button class="btn btn-primary btn-block" onclick="update_product_modal('{{$product->product_id}}')"> <i class="fas fa-edit"></i> Edit</button>  </div>
                          <div class="col-6"> <button class="btn btn-danger btn-block" onclick="delete_product_modal('{{$product->product_id}}')"> <i class="fas fa-trash"></i> Delete</button>  </div>
                        @endadmin
                        @agent
                          <div class="col-12"> <button class="btn btn-outline-primary btn-block" onclick="select_product_modal('{{$product->product_id}}')"> Select </button>  </div>
                        @endagent
                     </div>
                </div>      <!-- /.tab-pane -->
             

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

   @else
      <section class="content">
        <div class="container-fluid">
          
        <div class="card">
          <div class="card-header">
            <p class="mb-0"><b>{{$product->prd_name}}</b></p>
          </div>
          <div class="card-body">
            <div class="row ">
              <div class="col-md-4 text-center">
                    <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
                    <input type="hidden" value="{{$product->product_id}}"  name="product_id_delete_form" id="product_id_delete_form"/>  
              </div>  
                  
              <div class="col-md-8">
                  <table class="table w-100">
                      <tr><td>Product ID</td>  <td><b>{{$product->product_id}}</b></td></tr>
                      <tr><td>Name</td>        <td><b>{{$product->prd_name}}</b></td></tr>
                      <tr><td>Price</td>       <td>
                                                    <p class="mb-0 price"><b id="PRC_{{$product->product_id}}"> 
                                                    @if ($product->vendor_price()->where('vendor_prices.vendor_id', auth()->user()->user_id)->value('price'))
                                                       {{number_format($product->vendor_price()->where('vendor_prices.vendor_id', auth()->user()->user_id)->value('price'))}}
                                                    @else
                                                    {{number_format($product->install_price)}}
                                                    @endif </b>
                                                    </p>
                                                </td></tr>
                      <tr><td>Description</td> <td>{!!substr($product->description, 0, 100)!!} ...</td></tr>
                  </table>

                  @vendor
                  <div class="row">
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
                  </div>
                  @endvendor
              </div>   
          </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <p class="mb-0"><b>Full Description</b></p>
          </div>
          <div class="card-body">
            <div class="row "> 
              <div class="col-md-12">
                  <div class="w-100"> {!!$product->description!!} </div>
              </div>   
          </div>
          </div>
        </div>




          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
   @endadmin

  




 

   @include('components.product_ext')



<!-------------     SOME FREE GAP HERE  ----------------->

 



@endsection
