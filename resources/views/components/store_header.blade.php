		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="JavaScript:void(0)"><i class="fa fa-envelope-o"></i> support@adlupi.com</a></li>
						<li><a href="JavaScript:void(0)"><i class="fa fa-phone"></i> 0810 844 9208, 0703 366 4844</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="JavaScript:void(0)"><i class="fa fa-map-marker"></i> 1, Kudirat Abiola Way, Oregun, Ikeja, Lagos, Nigeria</a></li>
	                </ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="{{route('homepage')}}" class="logo">
									{{-- <img src="./img/logo.png" alt=""> --}}
									<b id="site_title">ADLUPI</b>
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{route('shop.shop_by_search')}}" method="get" autocomplete="off"> 
									<input name="keyword" class="form-control" placeholder="Search products here">
									<button class="d-none" type="submit">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Account -->
								<div>
									@guest
										<a href="{{route('register_login')}}">
											<i class="fa fa-user-o"></i>
											<span>My Account</span> 
										</a>
									@else
										<a href="{{route('dashboard')}}">
											<i class="fa fa-user-o"></i>
											<span>Dashboard</span> 
										</a>
									@endguest
								</div>
								<!-- /Account -->
 

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">3</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="JavaScript:void(0)">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="JavaScript:void(0)">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="JavaScript:void(0)">View Cart</a>
											<a href="JavaScript:void(0)">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="JavaScript:void(0)">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>