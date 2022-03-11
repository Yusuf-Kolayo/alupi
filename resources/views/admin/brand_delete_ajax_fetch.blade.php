{!! Form::open(['route' => ['brand.destroy', [$brand->id]], 'files' => false, 'method'=>'POST']) !!}   
@method('DELETE')  
<div class="modal-content">
    <div class="modal-header">
      <h6 class="modal-title" style="display:inline;font-size: 17px!important;font-weight: 400!important;"
        id="exampleModalLabel">Updating Brand <ins>{{$brand->brd_name}}</ins> </h6>
      <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body" >
        <div class="row ">

            <div class="col-md-6">
                <div class="form-group">
                    <label>  Brand Name </label>
                    <input type="text" class="form-control" value="{{$brand->brd_name}}" required name="brd_name" readonly/> 
                </div>
            </div> 
        
            <div class="col-md-6">
                <div class="form-group">
                    <label> Brand ID </label>
                    <input type="text" class="form-control" value="{{$brand->abbr}}"  name="abbr" readonly/> 
                </div>
            </div> 
        
            <div class="col-md-6">
              <div class="form-group">
                <label>  Brand Description </label>
                <input  name="description" id="description" class="form-control"  value="{{$brand->description}}" readonly/>
              </div>
            </div>
         
            <div class="col-md-6">
                <div class="form-group">
                    <label>  Position </label> 
                    <input  name="position" id="position" class="form-control"  value="{{$brand->position}}" readonly/>
                </div>
            </div>  
             
             
        </div>
      </div>
      <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button class="btn btn-danger" type="submit" name="submit" >Submit</button> 
      </div> 
  </div>
   {!! Form::close() !!}      