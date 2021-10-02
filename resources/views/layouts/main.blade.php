<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 

      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', "ALUPI ITNL") }}</title>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
  
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}"> 

  <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}"> 

    <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

  <style> 
      label { font-weight: 400!important; } .img-size-50 { width: 38px; }
      .table td, .table th { padding: .25rem; font-size: 14px;}
      #example1_filter { text-align: right;  font-size: 13px; }
      #example1_filter input {  height: calc(1.5125rem + 2px); } 
      .buttons-html5, .buttons-print { font-size: 13px;  padding-top: 3px;  padding-bottom: 3px;   padding-left: 10px;  padding-right: 10px;  margin: 2px; }
      .page-link { padding: .3rem .55rem;  font-size: 12px; }
      #example1_wrapper { display: block;  width: 100%;   overflow-x: auto;  -webkit-overflow-scrolling: touch; }
.profile-user-img {
    border: 3px solid #2196f3;   margin: 0 auto;   padding: 2px;   color: #2196f3;   
    width: 100px;   background: #f1fbff;  font-family: monospace;   font-size: 30px; display: block;
}
.box_sh {border-radius: 5px;   box-shadow: 0px 0px 14px 0px #bebebe, -20px -20px 60px #ffffff;    margin-bottom: 25px; }
    th {  white-space: nowrap; }

    .th_span {  white-space: nowrap; }  .btn-app { height: 32px; padding: 6px 9px; margin: 0 10px 10px 0px;}
  .alert-danger { color: #e91e63;   background-color: #fff0f1;  border-color: #d32535; }
  .alert-success {  color: #014880;   background-color: #e0edf9;  border-color: #014880; }
  .list-group-item { border-bottom: 1px solid rgba(0,0,0,.125);  }
  .th_head { background-color: #f3f3f3; }
  th.th_head_sm { font-weight: 600;  font-size: 13px; }
  .table td, .table th {  border-TOP: 0px;  border-bottom: 1px solid #dee2e6; }
  a.btn { white-space: nowrap; }   button.btn { white-space: nowrap; }
  .nav-treeview .nav-item {  padding-left: 14px; }
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link { font-size: 14px; }
.fade_hd_red { background-color: #fdcece!important; }
.fade_bd_red { background-color: #fff0f0!important; } 

.fade_hd_green { background-color: #d7ffd7!important; }
.fade_bd_green { background-color: #f0fff0!important; }

.fade_hd_blue { background-color: #d7e9ff!important; }
.fade_bd_blue { background-color: #f0f4ff!important; }
.card-body { padding: .5rem; }
.note_each {
    font-size: 14px;
    white-space: inherit;
    display: inline-block;
}  .price { color: #007bff; }
.short_msg { white-space: break-spaces; margin-bottom: 2px; }

  @media (min-width: 576px) {
    .large_modal { max-width:90%!important; } 
    .medium_modal { max-width:70%!important; }
  }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="main">


 @php
//  FETCH MAIN CATEGORIES HERE DUE TO COMMON INTEREST AMONG THE USER TYPES
 $main_categories = App\Models\Category::where('parent_id', 0)->get();

 // fetch newly sent notifications belonging to current user
 $new_notifications = App\Models\Notification::where('receiver_id', auth()->user()->user_id)->latest()
 ->where('status', 'sent')->get();

 $notification_icon_array = array( 
   'new_purchase_reg' => 'fas fa-shopping-cart',
   'purchase_session_approved' => 'fas fa-legal',
);
 @endphp


  @include('components.top_nav') 

  <!-- Decide Appropriate Navbars -->
  @admin
     @include('components.admin_sidebar') 
  @endadmin 

  @agent
   @include('components.agent_sidebar') 
  @endagent 

  @client
   @include('components.client_sidebar') 
  @endclient

  @vendor
    @include('components.vendor_sidebar') 
  @endvendor

  


 
  
  <!-- Content Wrapper. Contains page content -->
  <main class=""> 
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid"> 
        <x-alerts />   
 
            @yield('content') 

          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header --> 
      </div>
</main>


  <!-- /.content-wrapper -->
  @include('components.footer')


   @if (auth()->user())
        <script>
        
            var patner_id = $('#patner_id').val(); 
        
            function fetch_chat () { 
                // after page loading or refresh
                if ($('#msg_body').length > 0) { var data2send={"patner_id":patner_id};  }
                                        else { var data2send={"patner_id":""};   }
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
                $.ajax({
                    url:"{{route('fetch_chat')}}",
                    dataType:"text",
                    method:"GET",
                    data:data2send,
                    success:function(resp) { 
                    if ($('#msg_body').length > 0) {  
                        $('#msg_body').html(JSON.parse(resp).chatboard_msg.replace(/\\/g, ""));    // console.warn(JSON.parse(resp).active_time);
                        $('#active_time').html(JSON.parse(resp).active_time.replace(/\\/g, ""));  

                         var element = document.getElementById("msg_body");
                        element.scrollTop = element.scrollHeight;    
                    }
                        $('#topnav_msg').html(JSON.parse(resp).topnav_msg.replace(/\\/g, ""));
            
                    }
                });
            }
             
            var intervalId = window.setInterval(function() {
            fetch_chat(); // fetch new chat data at 5 seconds interval
            }, 5000);
           
        </script>
   @endif

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


</body>
</html>
