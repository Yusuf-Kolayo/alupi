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
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">


  <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">

    <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
</head>
<body>  <br> <br> <br> 
 
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
     
        <div class="row">
            <div class="col-md-12 text-center pt-5">  <br> <br>
                 
                  
            <div class="login-box mx-auto ">
                <!-- /.login-logo -->
                <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="JavaScript:void(0)" class="h1"> {{ config('app.name', "ALUPI ITNL") }} </a>
                </div>
                <div class="card-body"> 
            
            
            
                    <p class="login-box-msg"> A <b>verification code</b> has been sent to the email address submitted, 
                        pls check your inbox first, <b>if you can't find it there check your spam folders as well.</b></p>
            
                    {!! Form::open(['route' => ['agent.check_referee_code'], 'method'=>'get', 'files' => false]) !!}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="text" class="form-control" value="{{$referee_email}}" name="referee_email" readonly>
                        <input type="hidden" name="referrer_agent_id" id="referrer_agent_id" value="{{$referrer_agent->agent_id}}">
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="number" class="form-control" placeholder="Enter 7-digit code" name="referee_code" required>
                    </div>
                    
                    <div class="row">  
                        <div class="col-12">
                            @include('components.alerts') 
                        </div>
                      <div class="col-12">
                        <button name="btn_submit" type="submit" class="btn btn-primary btn-block">Submit</button>
                      </div>
                      <!-- /.col -->

                    </div>
                    {!! Form::close() !!}
                    {{-- <hr class="mt-2 mb-1">
                    <p class="mb-1">
                    <a href="{{route('login')}}">Already have account? log in</a>
                    </p>  --}}
            
                    
            
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.login-box -->
            



            </div>
             
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
 

</body>
</html>
