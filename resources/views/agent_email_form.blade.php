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
                    <a href="#" class="h1"> {{ config('app.name', "ALUPI ITNL") }} </a>
                </div>
                <div class="card-body"> 
            
            
            
                    <p class="login-box-msg"> Enter your email address below <i class="fas fa-arrow-circle-down"></i> </p>
            
                    {!! Form::open(['route' => ['agent.send_referee_mail'], 'method'=>'POST', 'files' => false]) !!}
                
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" value="" placeholder="johndoe@xmail.com" name="referee_email" required>
                        <input type="hidden" name="referrer_agent_id" id="referrer_agent_id" value="{{$referrer_agent->agent_id}}">
                    </div>
                  
                    <div class="row"> 
                        <div class="col-12">
                           <x-alerts />  {{-- @include('components.alerts')  --}} 
                        </div>
                        <div class="col-12">
                        <button name="btn_submit" type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div> 
                    </div>
                    {!! Form::close() !!}
                    <hr class="mt-2 mb-1">
                    <p class="mb-1">
                    {{-- <a href="{{route('login')}}">Already have account? log in</a> --}}
                    </p> 
            
                    
            
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
