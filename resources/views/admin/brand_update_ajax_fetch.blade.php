{!! Form::open(['route' => ['brand.update', [$brand->id]], 'files' => false, 'method'=>'POST']) !!}   
@method('PATCH')  
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
                    <input type="text" class="form-control" value="{{$brand->brd_name}}" required name="brd_name"/> 
                </div>
            </div> 
        
            <div class="col-md-6">
                <div class="form-group">
                    <label> Brand ID </label>
                    <input type="text" class="form-control" value="{{$brand->abbr}}" required name="abbr"/> 
                </div>
            </div> 
        
            <div class="col-md-6">
              <div class="form-group">
                <label>  Brand Description </label>
                <textarea name="description" id="textarea" class="form-control"  rows="2">{{$brand->description}}</textarea>
              </div>
            </div>
         
            <div class="col-md-6">
                <div class="form-group">
                    <label>  Position </label>
                    <select name="position" id="position" class="form-control">
                    <option value="{{$brand->position}}">{{$brand->position}}</option>
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
      <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit" name="submit" >Submit</button> 
      </div> 
  </div>
   {!! Form::close() !!}      