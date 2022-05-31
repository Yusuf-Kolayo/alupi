<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>  @yield('page_title') </title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{asset('store/css/bootstrap.min.css')}}"/> 
		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{asset('store/css/slick.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('store/css/slick-theme.css')}}"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="{{asset('store/css/nouislider.min.css')}}"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{asset('store/css/font-awesome.min.css')}}">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{asset('store/css/style.css')}}"/>
		<script src="{{asset('store/js/jquery.min.js')}}"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]--> 
	<style>
		#site_title { font-size: 27px; margin-top: 15px; display: inline-block; color: #d10024; font-family: serif; }
		.zoomin img { width: 100%; height: 100% -webkit-transition: all 0.5s ease; -moz-transition: all 0.5s ease; -ms-transition: all 0.5s ease; transition: all 0.5s ease; }
		.zoomin img:hover { -moz-transform: scale(1.2); -webkit-transform: scale(1.2); transform: scale(1.2); }
		 .zoom_frame { overflow: hidden; }



		 /*  MISSING BOOTSTRAP CSS  */
		 .shadow-sm { box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important; } .shadow { box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; } .shadow-lg { box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important; } .shadow-none { box-shadow: none !important; } .w-25 { width: 25% !important; } .w-50 { width: 50% !important; } .w-75 { width: 75% !important; } .w-100 { width: 100% !important; } .w-auto { width: auto !important; } .h-25 { height: 25% !important; } .h-50 { height: 50% !important; } .h-75 { height: 75% !important; } .h-100 { height: 100% !important; } .h-auto { height: auto !important; } .mw-100 { max-width: 100% !important; } .mh-100 { max-height: 100% !important; } .min-vw-100 { min-width: 100vw !important; } .min-vh-100 { min-height: 100vh !important; } .vw-100 { width: 100vw !important; } .vh-100 { height: 100vh !important; } .m-0 { margin: 0 !important; } .mt-0, .my-0 { margin-top: 0 !important; } .mr-0, .mx-0 { margin-right: 0 !important; } .mb-0, .my-0 { margin-bottom: 0 !important; } .ml-0, .mx-0 { margin-left: 0 !important; } .m-1 { margin: 0.25rem !important; } .mt-1, .my-1 { margin-top: 0.25rem !important; } .mr-1, .mx-1 { margin-right: 0.25rem !important; } .mb-1, .my-1 { margin-bottom: 0.25rem !important; } .ml-1, .mx-1 { margin-left: 0.25rem !important; } .m-2 { margin: 0.5rem !important; } .mt-2, .my-2 { margin-top: 0.5rem !important; } .mr-2, .mx-2 { margin-right: 0.5rem !important; } .mb-2, .my-2 { margin-bottom: 0.5rem !important; } .ml-2, .mx-2 { margin-left: 0.5rem !important; } .m-3 { margin: 1rem !important; } .mt-3, .my-3 { margin-top: 1rem !important; } .mr-3, .mx-3 { margin-right: 1rem !important; } .mb-3, .my-3 { margin-bottom: 1rem !important; } .ml-3, .mx-3 { margin-left: 1rem !important; } .m-4 { margin: 1.5rem !important; } .mt-4, .my-4 { margin-top: 1.5rem !important; } .mr-4, .mx-4 { margin-right: 1.5rem !important; } .mb-4, .my-4 { margin-bottom: 1.5rem !important; } .ml-4, .mx-4 { margin-left: 1.5rem !important; } .m-5 { margin: 3rem !important; } .mt-5, .my-5 { margin-top: 3rem !important; } .mr-5, .mx-5 { margin-right: 3rem !important; } .mb-5, .my-5 { margin-bottom: 3rem !important; } .ml-5, .mx-5 { margin-left: 3rem !important; } .p-0 { padding: 0 !important; } .pt-0, .py-0 { padding-top: 0 !important; } .pr-0, .px-0 { padding-right: 0 !important; } .pb-0, .py-0 { padding-bottom: 0 !important; } .pl-0, .px-0 { padding-left: 0 !important; } .p-1 { padding: 0.25rem !important; } .pt-1, .py-1 { padding-top: 0.25rem !important; } .pr-1, .px-1 { padding-right: 0.25rem !important; } .pb-1, .py-1 { padding-bottom: 0.25rem !important; } .pl-1, .px-1 { padding-left: 0.25rem !important; } .p-2 { padding: 0.5rem !important; } .pt-2, .py-2 { padding-top: 0.5rem !important; } .pr-2, .px-2 { padding-right: 0.5rem !important; } .pb-2, .py-2 { padding-bottom: 0.5rem !important; } .pl-2, .px-2 { padding-left: 0.5rem !important; } .p-3 { padding: 1rem !important; } .pt-3, .py-3 { padding-top: 1rem !important; } .pr-3, .px-3 { padding-right: 1rem !important; } .pb-3, .py-3 { padding-bottom: 1rem !important; } .pl-3, .px-3 { padding-left: 1rem !important; } .p-4 { padding: 1.5rem !important; } .pt-4, .py-4 { padding-top: 1.5rem !important; } .pr-4, .px-4 { padding-right: 1.5rem !important; } .pb-4, .py-4 { padding-bottom: 1.5rem !important; } .pl-4, .px-4 { padding-left: 1.5rem !important; } .p-5 { padding: 3rem !important; } .pt-5, .py-5 { padding-top: 3rem !important; } .pr-5, .px-5 { padding-right: 3rem !important; } .pb-5, .py-5 { padding-bottom: 3rem !important; } .pl-5, .px-5 { padding-left: 3rem !important; } .m-n1 { margin: -0.25rem !important; } .mt-n1, .my-n1 { margin-top: -0.25rem !important; } .mr-n1, .mx-n1 { margin-right: -0.25rem !important; } .mb-n1, .my-n1 { margin-bottom: -0.25rem !important; } .ml-n1, .mx-n1 { margin-left: -0.25rem !important; } .m-n2 { margin: -0.5rem !important; } .mt-n2, .my-n2 { margin-top: -0.5rem !important; } .mr-n2, .mx-n2 { margin-right: -0.5rem !important; } .mb-n2, .my-n2 { margin-bottom: -0.5rem !important; } .ml-n2, .mx-n2 { margin-left: -0.5rem !important; } .m-n3 { margin: -1rem !important; } .mt-n3, .my-n3 { margin-top: -1rem !important; } .mr-n3, .mx-n3 { margin-right: -1rem !important; } .mb-n3, .my-n3 { margin-bottom: -1rem !important; } .ml-n3, .mx-n3 { margin-left: -1rem !important; } .m-n4 { margin: -1.5rem !important; } .mt-n4, .my-n4 { margin-top: -1.5rem !important; } .mr-n4, .mx-n4 { margin-right: -1.5rem !important; } .mb-n4, .my-n4 { margin-bottom: -1.5rem !important; } .ml-n4, .mx-n4 { margin-left: -1.5rem !important; } .m-n5 { margin: -3rem !important; } .mt-n5, .my-n5 { margin-top: -3rem !important; } .mr-n5, .mx-n5 { margin-right: -3rem !important; } .mb-n5, .my-n5 { margin-bottom: -3rem !important; } .ml-n5, .mx-n5 { margin-left: -3rem !important; } .m-auto { margin: auto !important; } .mt-auto, .my-auto { margin-top: auto !important; } .mr-auto, .mx-auto { margin-right: auto !important; } .mb-auto, .my-auto { margin-bottom: auto !important; } .ml-auto, .mx-auto { margin-left: auto !important; }
		 .align-baseline { vertical-align: baseline !important; } .align-top { vertical-align: top !important; } .align-middle { vertical-align: middle !important; } .align-bottom { vertical-align: bottom !important; } .align-text-bottom { vertical-align: text-bottom !important; } .align-text-top { vertical-align: text-top !important; } .bg-primary { background-color: #3490dc !important; } a.bg-primary:hover, a.bg-primary:focus, button.bg-primary:hover, button.bg-primary:focus { background-color: #2176bd !important; } .bg-secondary { background-color: #6c757d !important; } a.bg-secondary:hover, a.bg-secondary:focus, button.bg-secondary:hover, button.bg-secondary:focus { background-color: #545b62 !important; } .bg-success { background-color: #38c172 !important; } a.bg-success:hover, a.bg-success:focus, button.bg-success:hover, button.bg-success:focus { background-color: #2d995b !important; } .bg-info { background-color: #6cb2eb !important; } a.bg-info:hover, a.bg-info:focus, button.bg-info:hover, button.bg-info:focus { background-color: #3f9ae5 !important; } .bg-warning { background-color: #ffed4a !important; } a.bg-warning:hover, a.bg-warning:focus, button.bg-warning:hover, button.bg-warning:focus { background-color: #ffe817 !important; } .bg-danger { background-color: #e3342f !important; } a.bg-danger:hover, a.bg-danger:focus, button.bg-danger:hover, button.bg-danger:focus { background-color: #c51f1a !important; } .bg-light { background-color: #f8f9fa !important; } a.bg-light:hover, a.bg-light:focus, button.bg-light:hover, button.bg-light:focus { background-color: #dae0e5 !important; } .bg-dark { background-color: #343a40 !important; } a.bg-dark:hover, a.bg-dark:focus, button.bg-dark:hover, button.bg-dark:focus { background-color: #1d2124 !important; } .bg-white { background-color: #fff !important; } .bg-transparent { background-color: transparent !important; } .border { border: 1px solid #dee2e6 !important; } .border-top { border-top: 1px solid #dee2e6 !important; } .border-right { border-right: 1px solid #dee2e6 !important; } .border-bottom { border-bottom: 1px solid #dee2e6 !important; } .border-left { border-left: 1px solid #dee2e6 !important; } .border-0 { border: 0 !important; } .border-top-0 { border-top: 0 !important; } .border-right-0 { border-right: 0 !important; } .border-bottom-0 { border-bottom: 0 !important; } .border-left-0 { border-left: 0 !important; } .border-primary { border-color: #3490dc !important; } .border-secondary { border-color: #6c757d !important; } .border-success { border-color: #38c172 !important; } .border-info { border-color: #6cb2eb !important; } .border-warning { border-color: #ffed4a !important; } .border-danger { border-color: #e3342f !important; } .border-light { border-color: #f8f9fa !important; } .border-dark { border-color: #343a40 !important; } .border-white { border-color: #fff !important; } .rounded-sm { border-radius: 0.2rem !important; } .rounded { border-radius: 0.25rem !important; } .rounded-top { border-top-left-radius: 0.25rem !important; border-top-right-radius: 0.25rem !important; } .rounded-right { border-top-right-radius: 0.25rem !important; border-bottom-right-radius: 0.25rem !important; } .rounded-bottom { border-bottom-right-radius: 0.25rem !important; border-bottom-left-radius: 0.25rem !important; } .rounded-left { border-top-left-radius: 0.25rem !important; border-bottom-left-radius: 0.25rem !important; } .rounded-lg { border-radius: 0.3rem !important; } .rounded-circle { border-radius: 50% !important; } .rounded-pill { border-radius: 50rem !important; } .rounded-0 { border-radius: 0 !important; } .clearfix::after { display: block; clear: both; content: ""; } .d-none { display: none !important; } .d-inline { display: inline !important; } .d-inline-block { display: inline-block !important; } .d-block { display: block !important; } .d-table { display: table !important; } .d-table-row { display: table-row !important; } .d-table-cell { display: table-cell !important; } .d-flex { display: flex !important; } .d-inline-flex { display: inline-flex !important; }
	     .h1, .h2, .h3, .h4, .h5, .h6 { margin-bottom: 0.5rem; font-weight: 500; line-height: 1.2; } h1, .h1 { font-size: 2.25rem; } h2, .h2 { font-size: 1.8rem; } h3, .h3 { font-size: 1.575rem; } h4, .h4 { font-size: 1.35rem; } h5, .h5 { font-size: 1.125rem; } h6, .h6 { font-size: 0.9rem; } .lead { font-size: 1.125rem; font-weight: 300; } .display-1 { font-size: 6rem; font-weight: 300; line-height: 1.2; } .display-2 { font-size: 5.5rem; font-weight: 300; line-height: 1.2; } .display-3 { font-size: 4.5rem; font-weight: 300; line-height: 1.2; } .display-4 { font-size: 3.5rem; font-weight: 300; line-height: 1.2; } hr { margin-top: 1rem; margin-bottom: 1rem; border: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); } small, .small { font-size: 80%; font-weight: 400; } mark, .mark { padding: 0.2em; background-color: #fcf8e3; } .list-unstyled { padding-left: 0; list-style: none; } .list-inline { padding-left: 0; list-style: none; } .list-inline-item { display: inline-block; } .list-inline-item:not(:last-child) { margin-right: 0.5rem; } .initialism { font-size: 90%; text-transform: uppercase; } .blockquote { margin-bottom: 1rem; font-size: 1.125rem; } .blockquote-footer { display: block; font-size: 80%; color: #6c757d; } .blockquote-footer::before { content: "â€”Â "; } .img-fluid { max-width: 100%; height: auto; } .img-thumbnail { padding: 0.25rem; background-color: #f8fafc; border: 1px solid #dee2e6; border-radius: 0.25rem; max-width: 100%; height: auto; } .figure { display: inline-block; } .figure-img { margin-bottom: 0.5rem; line-height: 1; } .figure-caption { font-size: 90%; color: #6c757d; } code { font-size: 87.5%; color: #f66d9b; word-wrap: break-word; } a > code { color: inherit; } kbd { padding: 0.2rem 0.4rem; font-size: 87.5%; color: #fff; background-color: #212529; border-radius: 0.2rem; } kbd kbd { padding: 0; font-size: 100%; font-weight: 700; } pre { display: block; font-size: 87.5%; color: #212529; } pre code { font-size: inherit; color: inherit; word-break: normal; } .pre-scrollable { max-height: 340px; overflow-y: scroll; } .container, .container-fluid, .container-xl, .container-lg, .container-md, .container-sm { width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; }
		 .fs-1{font-size:calc(1.375rem + 1.5vw)!important}.fs-2{font-size:calc(1.325rem + .9vw)!important}.fs-3{font-size:calc(1.3rem + .6vw)!important}.fs-4{font-size:calc(1.275rem + .3vw)!important}.fs-5{font-size:1.25rem!important}.fs-6{font-size:1rem!important}
		 @media (min-width:1200px){.fs-1{font-size:2.5rem!important}.fs-2{font-size:2rem!important}.fs-3{font-size:1.75rem!important}.fs-4{font-size:1.5rem!important}}
		 .header-search form .input { width: 69%; } .header-search form .search-btn {  width: 30%; }
		 .brd-2 { border: 2px solid #ccc; }
		 a.main-category { font-weight: 700; font-size: 13px; font-family: system-ui; }
	</style>
      @yield('headers')
</head>
<body>
   
	<!-- HEADER -->
	@include('components.store_header')
	<!-- /HEADER -->

	<!-- NAVIGATION --> 
		 @include('components.store_nav')
	<!-- /NAVIGATION -->


	<div class="container">
			 
		
		
				@include('components.alerts')
					
			 
				@yield('content')
		
		
		
		
			
	</div>


		<!-- FOOTER --> 
					@include('components.store_footer');
				<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		
		<script src="{{asset('store/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('store/js/slick.min.js')}}"></script>
		<script src="{{asset('store/js/nouislider.min.js')}}"></script>
		<script src="{{asset('store/js/jquery.zoom.min.js')}}"></script>
		<script src="{{asset('store/js/main.js')}}"></script>


         @yield('footers') 
</body>
</html>
