{!! Form::open(['route' => ['category.update', [$category->id]], 'files' => false, 'method'=>'POST']) !!}   
    @method('PATCH')

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
                            <input type="text" class="form-control" value="{{$category->cat_name}}" required name="cat_name"/> 
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Category ID </label>
                            <input type="text" class="form-control" value="{{$category->abbr}}" required name="abbr"/> 
                        </div>
                    </div> 
            
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>  Category Description </label>
                        <textarea name="description" id="textarea" class="form-control"  rows="2">{{$category->description}}</textarea>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>  Parent </label>
                        <select name="parent_id" class="form-control">
                           @if ($category->parent_id>0)
                              <option value="{{$category->parent_id}}">{{ $category->parent->cat_name}}</option>
                           @endif
                           
                            <option value="0">NONE</option> 
                        @foreach ($main_categories as $main_category)
                            <option value="{{$main_category->id}}">{{$main_category->cat_name}}</option>
                        @endforeach
                        </select> 
                      </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>  Position </label>
                            <select name="position" id="position" class="form-control">
                            <option value="{{$category->position}}">{{$category->position}}</option> 
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

         <div class="tab-pane" id="tabItem2">                  
          <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>  Meta Tag Title </label>
                            <input type="text" class="form-control" value="{{$category->meta_title}}" required name="meta_title"/> 
                        </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>  Meta Tag Description </label>
                        <textarea name="meta_desc" class="form-control" rows="2">{{$category->meta_desc}}</textarea>
                      </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label>  Meta Tag Keywords </label>
                            <input type="text" class="form-control" required value="{{$category->meta_keyword}}" name="meta_keyword"/> 
                        </div>
                    </div> 



                    </div>

                  
                    </div> 
              </div>
        </div>


    </div>

    <div class="modal-footer justify-content-between mt-4 border-top">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" name="submit" >Submit</button> 
    </div> 
{!! Form::close() !!}      