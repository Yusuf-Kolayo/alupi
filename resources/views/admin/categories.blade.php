@extends('layouts.main')

@section('content')
 <div class="w-100 text-right mb-3">
     <h5 class="mb-0 float-left" >Category Management</h5>
     <button data-toggle="collapse" data-target="#add_new" class="btn btn-primary btn-sm"> Add New </button>
 </div>
        <div class="card collapse" id="add_new">
            <div class="card-header">{{ __('Category Registry') }}</div> 
            <div class="card-body">
                
                {!! Form::open(['route' => ['category.store'], 'method'=>'POST', 'files' => true]) !!} 
                    <ul class="nav nav-pills m-1">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tabItem5"> <span> General </span> </a>  </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabItem6">     <span> SEO </span> </a>         </li>  
                    </ul>
 
                     <div class="tab-content mt-4">
                            <div class="tab-pane active" id="tabItem5"> 
                                <div class="row ">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>  Category Name </label>
                                                    <input type="text" class="form-control" required name="cat_name"/> 
                                                </div>
                                            </div> 

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Category ID </label>
                                                    <input type="text" class="form-control" required name="abbr"/> 
                                                </div>
                                            </div> 
                                    
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                <label>  Category Description </label>
                                                <textarea name="description" id="textarea" class="form-control"  rows="2"></textarea>
                                              </div>
                                            </div>
               
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label>  Parent </label>
                                                <select name="parent_id" class="form-control">
                                                    <option value="0">None</option> 
                                                @foreach ($all_categories as $main_category)
                                                    <option value="{{$main_category->id}}">{{$main_category->cat_name}}</option>
                                                @endforeach
                                                </select> 
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
                                    
              
                                </div>
                            </div>
              
                            <div class="tab-pane" id="tabItem6">                  
                                  <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>  Meta Tag Title </label>
                                                    <input type="text" class="form-control" required name="meta_title"/> 
                                                </div>
                                            </div>
              
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                <label>  Meta Tag Description </label>
                                                <textarea name="meta_desc" class="form-control"  rows="2"></textarea>
                                              </div>
                                            </div>
              
              
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>  Meta Tag Keywords </label>
                                                    <input type="text" class="form-control" required name="meta_keyword"/> 
                                                </div>
                                            </div>
              
                                  
                                            <div class="col-md-12">
                                                <div class="modal-footer" style="border-top: 0px;"> 
                                                    <input type="submit" class="btn btn-primary" value="Submit" name="submit"/>
                                                </div>
                                            </div>
                                    </div>
              
                                
                                  </div> 
                            </div>
                      </div> 
                {!! Form::close() !!}

            </div>
        </div>

     

 



        <div class="card mt-5">
          <div class="card-header">{{ __('Registered main categories') }}</div>
          <div class="card-body table-responsive"> 
               <table id="example1" class="table table-bordered table-striped" style="width:1100px;">
                <thead>
                <tr> 
                  <th>SN</th>
                  <th>Category</th>
                  <th>Cat-ID</th>
                  <th>Description</th>
                  <th>Meta-Title</th>
                  <th>Meta-Desc</th>
                  <th>Meta-Keyword</th>
                  <th>Position</th>
                  <th>Status</th>  
                  <th></th>   <th></th>    <th></th>  
                </tr>
                </thead>
               <tbody>
        {{-- loop out category here --}}
          @php  $sn = 0;  @endphp
          @foreach($main_categories as $main_category)
                    @php  $sn ++;  @endphp
            <tr>
               <td> {{$sn}} </td>
               <td> {{$main_category->cat_name}} </td>
               <td> {{$main_category->abbr}} </td>
               <td> {{$main_category->description}} </td>
               <td> {{$main_category->meta_title}} </td>
               <td> {{$main_category->meta_desc}} </td>
               <td> {{$main_category->meta_keyword}} </td> 
               <td> {{$main_category->position}} </td> 
               <td> {{$main_category->status}} </td>  
               
                <td>   
                    <button class="btn btn-primary btn-sm m-1" onClick="view_cat_modal('{{$main_category->id}}', 'no')"> <em class="fas fa-eye"></em> View Sub-category </button>  
                </td> 
                <td>
                    <a href="JavaScript:void(0)" class="btn btn-primary btn-sm m-1" onClick="update_cat_modal('{{$main_category->id}}', 'no')"> <em class="fas fa-edit"></em> Update</a>  
                </td> 
                <td>
                    <button class="btn btn-danger btn-sm m-1" onClick="delete_cat_modal('{{$main_category->id}}', 'no')"> <em class="fas fa-trash"></em> Delete</button> </td>
                </td> 
              </tr>
           @endforeach
                </tbody>
              </table>


          </div>
      </div>

























    {{-- VIEW SUB-CATEGORIES MODAL --}}
    <div class="modal fade" id="view_cat_modal">
        <div class="modal-dialog large_modal"  id="view_ready_div">  
        <div class="text-center mt-5"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>    
        </div>
    </div>



  
  
    
    <!-- UPDATE BANNER MODAL -->
<div class="modal fade" id="update_cat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"> 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="display:inline;" id="exampleModalLabel"> Update Category </h5>
          <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="update_ready_div">
           <div class="text-center mt-5 mb-5"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>
        </div>

  
      </div> 
    </div>
  </div>
  
  
  <!-- DELETE BANNER MODAL -->
  <div class="modal fade" id="delete_cat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="display:inline;" id="exampleModalLabel"> Delete Category</h5>
  
          <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
  
          <p class="mb-0" style="font-size:15px;">Are you sure to delete this category ? </p> 
        </div>

        <div id="delete_ready_div">
            <div class="text-center mt-5 mb-5"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>   
        </div>
      
      
      </div>
    </div>
  </div>



      

@section('page_scripts')
<script>
  function view_cat_modal(main_cat_id, parent) {
      var data2send={'main_cat_id':main_cat_id, 'element':'table'};
      $('#view_cat_modal').modal('show');  
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
      $.ajax({
          url:"{{ route('category.sub_cat_ajax_fetch') }}",
          dataType:"text",
          method:"GET",
          data:data2send,
          success:function(resp){
              $('#view_ready_div').html(resp);
          }
    }); 
  }



  
// UPDATE CATEGORY MODAL
function update_cat_modal(cat_id) {   
      $('#update_cat_modal').modal('show');  
      $('#update_ready_div').html('<div class="text-center mt-5 mb-5"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>');

      var data2send={'cat_id':cat_id};
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
      $.ajax({
          url:"{{ route('category.edit_category_ajax_fetch') }}",
          dataType:"text",
          method:"GET",
          data:data2send,
          success:function(resp){
              $('#update_ready_div').html(resp);
          }
    }); 
  }


   // DELETE CATEGORY MODAL
function delete_cat_modal(cat_id) {
      $('#delete_cat_modal').modal('show');
      $('#delete_ready_div').html('<div class="text-center mt-5 mb-5"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>');

      var data2send={'cat_id':cat_id};
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
      $.ajax({
          url:"{{ route('category.delete_category_ajax_fetch') }}",
          dataType:"text",
          method:"GET",
          data:data2send,
          success:function(resp){
              $('#delete_ready_div').html(resp);
          }
    }); 
  }
 

  </script>
  {{-- <x-datatables />    datatables js scripts --}}

@endsection

@endsection
