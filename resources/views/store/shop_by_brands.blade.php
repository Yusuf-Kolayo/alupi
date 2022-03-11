@extends('layouts.store')
	@section('page_title')
    {{ config('app.name', "ALUPI ITNL") }} - Shop By Brands
	@endsection
@section('headers')

@endsection
@section('content')

   




     <!-- BREADCRUMB -->
		{{-- <div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">All Categories</a></li>
							<li><a href="#">Accessories</a></li>
							<li class="active">Headphones (227,490 Results)</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div> --}}
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">

                            @foreach ($store_data['main_categories'] as $main_category)  
                                <div class="input-checkbox">
									{{-- <input type="checkbox" id="{{$main_category->slug()}}"> --}}
									<label for="{{$main_category->slug()}}">
										<span></span>
                                        <a class="main-category" href="{{route('shop.shop_by_categories', ['cat_id'=>$main_category->id, 'slug'=>$main_category->slug(), 'cate'=>'main'])}}">{{$main_category->cat_name}}</a>
									{{-- <small>(120)</small> --}}
									</label>
								</div>  
                           @endforeach
                            
                                
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						{{-- <div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div> --}}
						<!-- /aside Widget -->



						{{-- THE PRICE WIDGET WAS WITHDRAWN FROM THIS SPOT 7TH MARCH 2022 --}}


						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Brand</h3>
							<div class="checkbox-filter">
								@foreach ($store_data['brands'] as $brand) 
						    		 
						    	    <div class="input-checkbox">
										{{-- <input type="checkbox" id="{{$brand->slug()}}"> --}}
										<label for="{{$brand->slug()}}">
											<span></span>
											<a href="{{route('shop.shop_by_brands', ['brand_id'=>$brand->id, 'slug'=>$brand->brd_name])}}">{{$brand->brd_name}}</a>
											{{-- <small>(578)</small> --}}
										</label>
									</div> 

								@endforeach 
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						{{-- <div class="aside">
							<h3 class="aside-title">Top selling</h3>
							<div class="product-widget">
								<div class="product-img">
									<img src="{{asset('store/img/product01.png')}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									<img src="{{asset('store/img/product02.png')}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									<img src="{{asset('store/img/product03.png')}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
						</div> --}}
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							{{-- <div class="store-sort">
								<label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div> --}}
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
							@if (count($products)>0)
							<div class="row">
								@foreach ($products as $product) 
										<!-- product -->
										<div class="col-md-4 col-xs-6"> 
											<div class="product zoom_frame">
												<div class="product-img zoomin">
													<img class="" src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="">
													<div class="product-label">
														<span class="sale">-30%</span>
														<span class="new">NEW</span>
													</div>
												</div>
												<div class="product-body">
													<p class="product-category">{{$product->sub_category->cat_name}}</p>
													<h3 class="product-name"><a href="{{route('product_view', ['product_id'=>$product->id,'prd_name'=>$product->prd_name])}}">{{shorten_string($product->prd_name, 15)}}</a></h3>
													<h4 class="product-price">{{number_format($product->outright_price)}} <span class="product-old-price">{{number_format($product->install_price)}}</span></h4>
													<div class="product-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
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
										<!-- /product --> 
								@endforeach
							</div>
							@else
								<p class="text-center mt-4 p-3 bg-light">no products found under this category!</p>
							@endif
												 
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">Showing 20-100 products</span>
							{{-- <ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul> --}}

							<div class="pull-right">
                                {{$products->links()}}
                            </div>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		 








 
@endsection