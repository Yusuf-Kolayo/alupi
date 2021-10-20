<div class="row ">
    <div class="col-md-6 text-center">
          <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
          <input type="hidden" value="{{$product->product_id}}"  name="product_id_delete_form" id="product_id_delete_form"/>  
    </div>  
        
    <div class="col-md-6">
         <table class="table w-100">
             <tr><td>Product ID</td>  <td><b>{{$product->product_id}}</b></td></tr>
             <tr><td>Name</td>        <td><b>{{$product->prd_name}}</b></td></tr>
             <tr><td>Price</td>       <td><b>{{$product->price}}</b></td></tr>
             <tr><td>Description</td> <td><b>{!!$product->description!!}</b></td></tr>
         </table>
    </div>   
</div>






<script>  

$(document).ready(function(){
$('#product_delete_form').on('submit', function(e){
e.preventDefault(); 
var product_id = $('#product_id_delete_form').val();  console.warn(product_id);
$.ajax({
type: 'POST',
url: '{{ route("product.destroy", ["product"=>$product->product_id]) }}',
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
      $('#delete_product_modal').modal('hide'); 
       delete_product_div(product_id);
   } 
}
});




});
});




 

</script>