{!! Form::open(['route' => ['category.destroy', [$category->id]], 'files' => false, 'method'=>'POST']) !!}   
    @method('DELETE')

    <div class="modal-body"> 

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabItem1"> <span> General </span> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem2"> <span> SEO </span> </a>
            </li>  
        </ul>
            

       <div class="tab-content">
              <div class="tab-pane active" id="tabItem1"> 
                  <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>  Category Name </label>
                            <input readonly type="text" class="form-control" value="{{$category->cat_name}}" required name="cat_name"/> 
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Category ID </label>
                            <input readonly type="text" class="form-control" value="{{$category->abbr}}" required name="abbr"/> 
                        </div>
                    </div> 
            
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>  Category Description </label>
                        <textarea name="description" id="textarea" class="form-control"  rows="1" readonly>{{$category->description}}</textarea>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>  Parent </label>
                        @if ($category->parent_id>0)
                        <input readonly type="text" class="form-control" value="{{ $category->parent->cat_name}}" required name="parent_id"/>  
                        @else
                        <input readonly type="text" class="form-control" value="NONE" required name="parent_id"/>  
                        @endif
                       
                      </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>  Position </label>
                            <input readonly type="text" class="form-control" value="{{$category->position}}" required name="position"/> 
                        </div>
                    </div> 
            

        </div>
    </div>

         <div class="tab-pane" id="tabItem2">                  
          <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>  Meta Tag Title </label>
                            <input readonly type="text" class="form-control" value="{{$category->meta_title}}" required name="meta_title"/> 
                        </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>  Meta Tag Description </label>
                        <textarea readonly name="meta_desc" class="form-control" rows="2">{{$category->meta_desc}}</textarea>
                      </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label>  Meta Tag Keywords </label>
                            <input readonly type="text" class="form-control" required value="{{$category->meta_keyword}}" name="meta_keyword"/> 
                        </div>
                    </div> 



                    </div>

                  
                    </div> 
              </div>
        </div>


    </div>

    <div class="modal-footer justify-content-between mt-4 border-top">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-danger" type="submit" name="submit" >Submit</button> 
    </div> 
{!! Form::close() !!}      