                <div class="row "> @method('PATCH')
                      <div class="col-md-12 text-center pb-4">
                            <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
                      </div>  
                          
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>  Product Picture </label>
                              <input type="file" class="form-control"  name="img_name" id="update_img_name"/>  
                              <input type="hidden" value="{{$product->product_id}}"  name="product_id_update_form" id="product_id_update_form"/>  
                            </div>   
                      </div>   
  
                      <div class="col-md-6">
                          <div class="form-group">
                              <label> Name </label>
                              <input type="text" class="form-control" value="{{$product->prd_name}}" required name="prd_name"/> 
                          </div>
                      </div> 
  
  
   
                      <div class="col-md-12">
                          <div class="form-group">
                            <label> Description </label>
                            <textarea name="description" id="editor2" class="ck_editor form-control"  rows="2">{!!$product->description!!}</textarea>
                          </div>
                        </div>
  
  
                      <div class="col-md-6">
                          <div class="form-group">
                            <label> Brand </label>
                            <select name="brand_id" id="brand_id" class="form-control">
                              <option value="{{$product->brand->id}}">{{$product->brand->brd_name}}</option> 
                              @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->brd_name}}</option>
                              @endforeach
                             </select> 
                          </div>
                      </div>
  
  
                      <div class="col-md-6">
                          <div class="form-group">
                            <label> Price </label>
                            <input type="number" name="price" value="{{$product->price}}" id="price" class="form-control">
                          </div>
                      </div>
   
  
                      <div class="col-md-6">
                          <div class="form-group">
                            <label> Main Category </label>
                            <select name="main_category_id" id="main_category_id_update_form" onchange="fetch_sub_cat();" class="form-control">
                              <option value="{{$product->main_category->id}}">{{$product->main_category->cat_name}}</option> 
                              @foreach ($main_categories as $main_category)
                                <option value="{{$main_category->id}}">{{$main_category->cat_name}}</option>
                              @endforeach
                             </select> 
                          </div>
                      </div>
  
  
                      <div class="col-md-6">
                          <div class="form-group">
                            <label> Sub Category </label>
                            <select name="sub_category_id" class="form-control" id="sub_category_id_update_form">
                                <option value="{{$product->sub_category->id}}">{{$product->sub_category->cat_name}}</option> 
                            </select> 
                          </div>
                      </div> 
                      
  
                   
   
  
                  </div>
            





<script>   CKEDITOR.replace( 'editor2' );   //
   $(".cke_editable").keyup(function(){   console.log('message');   });

// FETCH IMAGE INTO SELECT FIELD ON ADD PRODUCT FORM
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();    
        reader.onload = function(e) {
          $('#update_preview_img').attr('src', e.target.result);
        } 
        reader.readAsDataURL(input.files[0]);
      }
    } 
    $("#update_img_name").change(function() { readURL(this); }); 



    // SOME FREE GAP HERE PLS


    $(document).ready(function(){
    $('#product_update_form').on('submit', function(e){
        e.preventDefault(); 

        for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
        
        var product_id = $('#product_id_update_form').val() ; console.warn(product_id);
            $.ajax({
                type: 'POST',
                url: '{{ route("product.update", ["product"=>$product->product_id]) }}',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() { /* $('#product_update_form').attr("disabled","disabled"); */  },
                success: function(response){ //console.log(response); 
                    console.warn(response.message); 
                    if (response.status == 0) { alert('An error occurred, please try again ...'); } 
                    else { 
                        $('#update_product_modal').modal('hide'); 
                         refresh_product_div(product_id);
                     } 
                }
            });
    
 


    });
});




    // FETCH SUB-CATEGORY INTO SELECT FIELD ON ADD PRODUCT FORM
    function fetch_sub_cat() {
        var main_cat_id = $('#main_category_id_update_form').val();
        var data2send={'main_cat_id':main_cat_id, 'element':'select'};  
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('category.sub_cat_ajax_fetch') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp){
                $('#sub_category_id_update_form').html(resp);
            }
	    }); 
    }

</script>