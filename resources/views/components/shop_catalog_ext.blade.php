@section('footers')
        <script>

        function get_checked_price_ranges () {
            var price_ranges = [];
            let inputs = document.getElementsByClassName('price_range');     console.log(inputs);
            let inputs_arr = Array.from(inputs);   
                for (var item of inputs_arr) {
                    if (item.checked===true) { price_ranges.push(item.value);  } 
                }
            return price_ranges;
        }



       
        // fetch catalog based on predefined ordering 
        $('#select_ordering').change(function() { //   console.log($(this).val());
            var ordering = $(this).val(); 	var fetch_id = $('#fetch_id').val();  var fetch_mode = $('#fetch_mode').val();
            var price_ranges = get_checked_price_ranges();

            var data2send={'ordering':ordering,'fetch_id':fetch_id, 'fetch_mode': fetch_mode, 'price_ranges': price_ranges};       console.log(data2send);
            $('#product_ready_div').html('<div class="text-center p-1 bg-white"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') } });
            $.ajax({
                url:"{{ route('shop.fetch_catalog_ajax') }}",
                dataType:"text",
                method:"GET",
                data:data2send,
                success:function(resp) {
                    $('#product_ready_div').html(resp);
                }
            }); 
        });


        
        // fetch the next page of the catalog
        function fetch_next (current_page) { 
            var ordering   = $('#select_ordering').val();	     var page = current_page + 1;
            var fetch_id = $('#fetch_id').val();  var fetch_mode = $('#fetch_mode').val();       
            var price_ranges = get_checked_price_ranges();

            var data2send={'ordering':ordering,'fetch_id':fetch_id, 'fetch_mode': fetch_mode, 'price_ranges': price_ranges, 'page':page};  


        $('#product_ready_div').html('<div class="text-center p-1 bg-white"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('shop.fetch_catalog_ajax') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp) { $('#product_ready_div').html(resp); }
        }); 
        }


        function fetch_prev (current_page) { 
        var ordering   = $('#select_ordering').val();	  var page = current_page - 1;  
        var fetch_id = $('#fetch_id').val();  var fetch_mode = $('#fetch_mode').val();       
        var price_ranges = get_checked_price_ranges();

            var data2send={'ordering':ordering,'fetch_id':fetch_id, 'fetch_mode': fetch_mode, 'price_ranges': price_ranges, 'page':page};  

        $('#product_ready_div').html('<div class="text-center p-1 bg-white"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('shop.fetch_catalog_ajax') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp) { $('#product_ready_div').html(resp); }
        }); 
        }




        $('.checkbox-inline').change(function() {
            var price_ranges=[];
            $("input").each(function() {
                if ($(this).is(':checked')) {
                //   var checked = ($(this).val());
                //   price_ranges.push(checked);
                    price_ranges.push(this.value); 
                }  
            });  console.log(price_ranges); 

            var ordering   = $('#select_ordering').val();	     var fetch_id = $('#fetch_id').val();  var fetch_mode = $('#fetch_mode').val(); 
            // var price_ranges = get_checked_price_ranges();

            var data2send={'ordering':ordering,'fetch_id':fetch_id, 'fetch_mode': fetch_mode, 'price_ranges': price_ranges};  


        $('#product_ready_div').html('<div class="text-center p-1 bg-white"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('shop.fetch_catalog_ajax') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp) { $('#product_ready_div').html(resp); }
        }); 

        });

        </script>
@endsection