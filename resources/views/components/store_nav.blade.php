		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="{{route('homepage')}}">Home</a></li>  
						@foreach ($store_data['main_categories'] as $main_category)  
								<li>
									<a href="{{route('shop.shop_by_categories', ['cat_id'=>$main_category->id, 'slug'=>$main_category->slug(), 'cate'=>'main'])}}">{{$main_category->cat_name}}</a>
								</li> 
				     	@endforeach  
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>