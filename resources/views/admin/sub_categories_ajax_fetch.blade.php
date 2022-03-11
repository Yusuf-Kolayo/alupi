@if ($element=='table')

  <div class="modal-content">

    <div class="modal-header">
      <h6 class="modal-title"> <i class="fas fa-cubes"></i>  {{ ucfirst($main_cat_name) }} sub-categories</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body table-responsive"> 
  
          <table id="example1" class="table table-bordered table-striped">
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
                <th>Parent</th>  
                <th></th>    <th></th>  <th></th>  
              </tr>
              </thead>
             <tbody>
        {{-- loop out category here --}}
          @php  $sn = 0;  @endphp
          @foreach ($sub_categories as $sub_category)
          @php  $sn ++;  @endphp
          <tr>
             <td> {{$sn}} </td>
             <td> {{$sub_category->cat_name}} </td>
             <td> {{$sub_category->abbr}} </td>
             <td> {{$sub_category->description}} </td>
             <td> {{$sub_category->meta_title}} </td>
             <td> {{$sub_category->meta_desc}} </td>
             <td> {{$sub_category->meta_keyword}} </td> 
             <td> {{$sub_category->position}} </td> 
             <td> {{$sub_category->status}} </td>  
             <td> {{$sub_category->parent->cat_name}} </td>  
              <td>   
                <button class="btn btn-primary btn-sm m-1" onClick="view_cat_modal('{{$sub_category->id}}', 'no')"> <em class="fas fa-eye"></em> View Sub-category </button>  
              </td>
              <td>
                  <a href="JavaScript:void(0)" class="btn btn-primary btn-sm m-1" onClick="update_cat_modal('{{$sub_category->id}}', 'no')"> <em class="fas fa-edit"></em> Update</a>  
              </td> 
              <td>
                  <button class="btn btn-danger btn-sm m-1" onClick="delete_cat_modal('{{$sub_category->id}}', 'no')"> <em class="fas fa-trash"></em> Delete</button> </td>
              </td> 
            </tr>
          @endforeach
              </tbody>
              <tfoot>
              <tr>
              <th></th>    <th></th>    <th></th>    <th></th> 
              <th></th>   <th></th>     <th></th>    <th></th>    <th></th> 
              <th></th>    <th></th>    <th></th>    <th></th> 
              </tr>
          </tfoot>
    </table>
      </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      {{-- <button class="btn btn-primary" type="submit" name="continue_rescue" id="continue_rescue">  <i class="fas fa-arrow-right"></i> </button> --}}
    </div>
  
  </div>

@endif

@if ($element=='select')
     <option value=""></option>
    @foreach ($sub_categories as $sub_category)
     <option value="{{$sub_category->id}}">{{$sub_category->cat_name}}</option>
    @endforeach
@endif
