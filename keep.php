<!-- THIS SNIPPET WAS WITHDRAWN FROM THE SHOP PAGE ON 7TH MARCH 2022  --> 
<!-- aside Widget -->

     <div class="aside">
								<h3 class="aside-title">Price Range Available</h3>
								<div class="checkbox-filter">
									@if ($price_array)
										<div class="input-checkbox">
											<input type="checkbox" name="price_range_1" checked id="1" value="{{$price_array[0]}}:{{$price_array[1]}}">
											<label for="1">
												<span></span>
												{!!naira()!!}{{number_format($price_array[0])}} - {!!naira()!!}{{number_format($price_array[1])}}
											</label>
										</div>

										<div class="input-checkbox">
											<input type="checkbox" name="price_range_2" checked id="2" value="{{$price_array[1]}}:{{$price_array[2]}}">
											<label for="2">
												<span></span>
												{!!naira()!!}{{number_format($price_array[1])}} - {!!naira()!!}{{number_format($price_array[2])}}
											</label>
										</div>

										<div class="input-checkbox">
											<input type="checkbox" name="price_range_3" checked id="3" value="{{$price_array[2]}}:{{$price_array[3]}}">
											<label for="3">
												<span></span>
												{!!naira()!!}{{number_format($price_array[2])}} - {!!naira()!!}{{number_format($price_array[3])}}
											</label>
										</div>
                            
										
										<div class="input-checkbox">
											<input type="checkbox" name="price_range_4" checked id="4" value="{{$price_array[3]}}:{{$price_array[4]}}">
											<label for="4">
												<span></span>
												{!!naira()!!}{{number_format($price_array[3])}} - {!!naira()!!}{{number_format($price_array[4])}}
											</label>
										</div>
									@else
										<div class="input-checkbox">
											<input type="checkbox" name="price_range_1" checked id="1" value="{{$price_array[0]}}:{{$price_array[0]}}">
											<label for="1">
												<span></span>
												{!!naira()!!}{{number_format($price_array[0])}} - {!!naira()!!}{{number_format($price_array[0])}}
											</label>
										</div>
									@endif 
									
								 
        </div>
    </div>
<!-- /aside Widget -->
<!-- THIS SNIPPET WAS WITHDRAWN FROM THE SHOP PAGE ON 7TH MARCH 2022  --> 