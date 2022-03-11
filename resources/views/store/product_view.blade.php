@extends('layouts.store')
	@section('page_title')
	  Adlupi - {{$product->prd_name}}
	@endsection
@section('headers')
    <style>
		.product-details .add-to-cart .add-to-cart-btn { border-radius: 0px;    margin: 2px; }
		.add-to-cart-btn2 {
			position: relative; border: 2px solid transparent; height: 40px; padding: 0 30px; background-color: #484848; color: #FFF; 
			text-transform: uppercase;    font-weight: 700; border-radius: 0px; -webkit-transition: 0.2s all; transition: 0.2s all; margin: 2px;
		}
		.product-details .product-available { margin-left:0px; }
		.product-details .product-name { display: inline-block; }
    </style>
@endsection
@section('content')
 

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="{{route('homepage')}}">Home</a></li>
						 
                            @if ($product->main_category)
                            <li><a href="JavaScript:void(0)">{{$product->main_category->cat_name}}</a></li>
                            @endif
							@if ($product->sub_category)
                              <li><a href="JavaScript:void(0)">{{$product->sub_category->cat_name}}</a></li>
                            @endif

							<li class="active">{{$product->prd_name}}</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="">
							</div>

							{{-- <div class="product-preview">
								<img src="./img/product03.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product06.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product08.png" alt="">
							</div> --}}
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-1  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								<img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="">
							</div>

							{{-- <div class="product-preview">
								<img src="./img/product03.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product06.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product08.png" alt="">
							</div> --}}
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-6">
						<div class="product-details">
							<h2 class="product-name">{{$product->prd_name}}</h2> <sup><span class="product-available">In Stock</span></sup>
							<div>
								{{-- <div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="JavaScript:void(0)">10 Review(s) | Add your review</a> --}}
							</div>
							<div>
								<h3 class="product-price">&#8358; {{number_format($product->outright_price)}} <span class="product-old-price">(Installment - &#8358; {{number_format($product->install_price)}})</span></h3>
							</div>
							<p>{!!$product->description!!}</p>

							{{-- <div class="product-options">
								<label>
									Size
									<select class="input-select">
										<option value="0">X</option>
									</select>
								</label>
								<label>
									Color
									<select class="input-select">
										<option value="0">Red</option>
									</select>
								</label>
							</div> --}}

					        <div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number" value="1" name="quantity" id="quantity">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
                                {!! Form::open(['route' => ['buy',['product_id'=>$product->product_id,'purchase_type'=>'buy_now']], 'method'=>'POST', 'files' => false, 'class'=>'mb-0 d-inline']) !!}
                                   <button type="submit" class="add-to-cart-btn mr-1 mt-2"><i class="fa fa-shopping-cart"></i> Buy Now</button>
                                    <input type="hidden" name="quantity" id="quantity1" value="1">
								{!! Form::close() !!}

                                {!! Form::open(['route' => ['buy',['product_id'=>$product->product_id,'purchase_type'=>'installment']], 'method'=>'POST', 'files' => false, 'class'=>'mb-0 d-inline']) !!}
                                   <button type="submit" class="add-to-cart-btn2 mt-2"><i class="fa fa-shopping-cart"></i> Installment</button>
                                   <input type="hidden" name="quantity" id="quantity2" value="1">
								{!! Form::close() !!}

							</div>

                            {{--
							<ul class="product-btns">
								<li><a href="JavaScript:void(0)"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
								<li><a href="JavaScript:void(0)"><i class="fa fa-exchange"></i> add to compare</a></li>
							</ul> --}}

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="JavaScript:void(0)">{{$product->sub_category->cat_name}}</a></li>
								<li><a href="JavaScript:void(0)">{{$product->main_category->cat_name}}</a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="JavaScript:void(0)"><i class="fa fa-facebook"></i></a></li>
								<li><a href="JavaScript:void(0)"><i class="fa fa-twitter"></i></a></li>
								<li><a href="JavaScript:void(0)"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="JavaScript:void(0)"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					{{-- <div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab2">Details</a></li>
								<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p>{{!!$product->description!!}}</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>{{!!$product->description!!}}</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>4.5</span>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>{{!!$product->description!!}}ar"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>{{!!$product->description!!}}ar"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>{{!!$product->description!!}}></i></a></li>
												</ul>
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form">
													<input class="input" type="text" placeholder="Your Name">
													<input class="input" type="email" placeholder="Your Email">
													<textarea class="input" placeholder="Your Review"></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<button class="primary-btn">Submit</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div> --}}
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Related Products</h3>
						</div>
					</div>
                    @php                        
                        // Illuminate\Support\Facades\DB::enableQueryLog();
                        //  print_r($product->sub_category->sub_products);
                        // $query = Illuminate\Support\Facades\DB::getQueryLog();
                        // dd($query);
                    @endphp
					<!-- product -->
                         @foreach ($product->sub_category->sub_products as $product)                             
                            <div class="col-md-3 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="">
                                        <div class="product-label">
                                            <span class="sale">-30%</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{$product->sub_category->cat_name}}</p>
                                        <h3 class="product-name"><a href="JavaScript:void(0)">{{shorten_string($product->prd_name, 15)}}</a></h3>
                                        <h4 class="product-price">&#8358; {{number_format($product->outright_price)}}  <span class="product-old-price">&#8358; {{number_format($product->install_price)}}</span></h4>
                                        <div class="product-rating">
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                    </div>
                                </div>
				         	</div>
                         @endforeach
					<!-- /product --> 

					<div class="clearfix visible-sm visible-xs"></div>

				 

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

     



  @section('footers')
      <script>
		    $('#quantity').change(function() {      // pass qauntity to the hidden quantity fields
				var quantity = $(this).val();       console.log(quantity);
				$('quantity1').val() = quantity;    $('quantity2').val() = quantity;
           });
	  </script>
  @endsection


 
@endsection