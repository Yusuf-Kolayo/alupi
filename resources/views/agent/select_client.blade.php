@extends('layouts.main')

@section('content') 


        <div class="card">
            <div class="card-header"> 
                <div class="row">
                    <div class="col-md-10"> Product selected: <b>{{$product->prd_name}}</b> </div>
                    <div class="col-md-2"> <button data-toggle="collapse" data-target="#product_details" class="btn btn-link btn-block btn-sm">show details</button> </div>
                </div>
            </div>
            <div class="card-body collapse" id="product_details"> 
                <div class="row ">
                    <div class="col-md-6 text-center">
                          <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
                          <input type="hidden" value="{{$product->product_id}}"  name="product_id_delete_form" id="product_id_delete_form"/>  
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
        </div>
        

        <div class="card">
            <div class="card-header"> Select a client </div>
            <div class="card-body table-responsive">  
                 <table id="t1" class="table table-bordered table-striped" style="width:960px;">
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
                    {{-- <th>LGA</th>  --}}
                    <th>...</th> 
                  </tr>
                  </thead>
                 <tbody>
                        
                {{-- loop out clients here --}} 
                 @foreach($clients as $client)
                 <tr>    
                  <td> {{$client->client_id}} </td>
                  <td> {{$client->first_name}} </td>
                  <td> {{$client->last_name}} </td>
                  <td> {{$client->other_name}} </td>
                  <td> {{$client->phone}} </td>
                  <td> {{$client->user->email}} </td>
                  <td> {{$client->address}} </td>
                  <td> {{$client->agent->catchment->catchment_id}} </td>
                  {{-- <td> {{$client->catchment->lga}} </td> --}}
                  <td> <a class="btn btn-primary btn-xs btn-block" href="JavaScript:void(0)" onclick="show_profile('{{$client->client_id}}', '{{$product->product_id}}')"> <span class="fa fa-user"></span> Profile</a> </td>
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
                    {{-- <th></th>  --}}
                  </tr>
                  </tfoot>
                </table>


            </div>
        </div>
 

 



        <div class="modal fade" id="show_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog large_modal" style="" role="document"> 
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" style="display:inline;" id="exampleModalLabel"> Client profile </h5>
                    <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                   <div class="modal-body" id="profile_ready_div">
                        <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>   
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{-- <button class="btn btn-primary" type="submit" name="update_product_btn" >Update</button> --}}
                    </div> 
                </div> 
            </div>
          </div>

 
<script> 
 // UPDATE PRODUCT MODAL
 function show_profile(client_id, product_id) {   
        $('#show_profile').modal('show');   console.log(client_id);   // window.stop(); 
        $('#update_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        var data2send={'client_id':client_id, 'product_id':product_id};  
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('client.show_profile_ajax_fetch') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp){
                $('#profile_ready_div').html(resp);
            }
	    }); 
    }
</script>
@endsection
