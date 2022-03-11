@extends('layouts.main')

@section('content')
 <div class="w-100 text-right mb-3">
     <h5 class="mb-0 float-left" >Brand Management</h5>
     <button data-toggle="collapse" data-target="#add_new" class="btn btn-primary btn-sm"> Add New </button>
 </div>
        <div class="card collapse" id="add_new">
            <div class="card-header"> <h6> Brand Registry </h6> </div> 
            <div class="card-body">
                
                {!! Form::open(['route' => ['brand.store'], 'method'=>'POST', 'files' => true]) !!} 
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>  Brand Name </label>
                            <input type="text" class="form-control" required name="brd_name"/> 
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Brand ID </label>
                            <input type="text" class="form-control" required name="abbr"/> 
                        </div>
                    </div> 
            
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>  Brand Description </label>
                        <textarea name="description" id="textarea" class="form-control"  rows="2"></textarea>
                      </div>
                    </div>
 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>  Position </label>
                            <select name="position" id="position" class="form-control">
                            <option value="1">1</option>     <option value="2">2</option>
                            <option value="3">3</option>     <option value="4">4</option>
                            <option value="5">5</option>     <option value="6">6</option>
                            <option value="7">7</option>     <option value="8">8</option>
                            <option value="9">9</option>     <option value="10">10</option>
                            <option value="11">11</option>     <option value="12">12</option>
                            </select>
                        </div>
                    </div> 
            

                     
                    <div class="col-md-12">
                        <div class="modal-footer" style="border-top: 0px;"> 
                            <input type="submit" class="btn btn-primary" value="Submit" name="submit"/>
                        </div>
                    </div>

        </div>
                {!! Form::close() !!}

            </div>
        </div>

     


        <div class="card">
          <div class="card-header">{{ __('Registered main categories') }}</div>
          <div class="card-body"> 
               <table id="example1" class="table table-bordered table-striped" >
                <thead>
                <tr> 
                  <th>SN</th>
                  <th>Brand</th>
                  <th>Brand-ID</th>
                  <th>Description</th>  
                  <th>Position</th>  
                  <th></th>   <th></th>    
                </tr>
                </thead>
               <tbody>
        {{-- loop out brand here --}}
          @php  $sn = 0;  @endphp
          @foreach($brands as $brand)
                    @php  $sn ++;  @endphp
            <tr>
               <td> {{$sn}} </td>
               <td> {{$brand->brd_name}} </td>
               <td> {{$brand->abbr}} </td>
               <td> {{$brand->description}} </td>   
               <td> {{$brand->position}} </td>   
                <td>
                    <a href="JavaScript:void(0)" class="btn btn-primary btn-sm m-1" onClick="update_brand_modal('{{$brand->id}}', 'no')"> <em class="fas fa-edit"></em> Update</a>  
                </td> 
                <td>
                    <button class="btn btn-danger btn-sm m-1" onClick="delete_brand_modal('{{$brand->id}}', 'no')"> <em class="fas fa-trash"></em> Delete</button> </td>
                </td> 
              </tr>
           @endforeach
                </tbody> 
              </table>


          </div>
      </div>












    {{-- UPDATE MODAL  --}} 
    <div class="modal fade" id="update_brand_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog medium_modal" style="" role="document" id="update_ready_div">
    
         <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>  
    
      </div>
    </div> 



    {{-- DELETE MODAL  --}} 
    <div class="modal fade" id="delete_brand_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog medium_modal" style="" role="document" id="delete_ready_div">
    
         <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>  
    
      </div>
    </div> 





      

 @section('page_scripts')
 <script>
    function update_brand_modal(brand_id) { 
        $('#update_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#update_brand_modal').modal('show');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });

        $.ajax({
        type:'POST',
        url:"{{ route('update_brand_fetch') }}",
        data: {'brand_id':brand_id},
    
            success:function(data) {
            $('.verify').show();
            $('#update_ready_div').html(data);  
            }
        }); 
    }




    function delete_brand_modal(brand_id) { 
        $('#delete_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#delete_brand_modal').modal('show');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });

        $.ajax({
        type:'POST',
        url:"{{ route('delete_brand_fetch') }}",
        data: {'brand_id':brand_id},
    
            success:function(data) {
            $('.verify').show();
            $('#delete_ready_div').html(data);  
            }
        }); 
    }
  </script>
     <x-datatables />    {{-- datatables js scripts --}}
 @endsection



@endsection
