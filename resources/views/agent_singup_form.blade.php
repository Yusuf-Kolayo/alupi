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

  <link rel="stylesheet" href="{{ asset('dist/css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/responsive.css') }}">
  <style>  .wizard>.steps>ul>li { width: 50%; }  </style>
  
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
            <div class="col-md-8 text-center pt-5 mx-auto">  <br> <br>
                 
                  
            <div class=" mx-auto ">
                <!-- /.login-logo -->
                <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="JavaScript:void(0)" class="h1"> {{ config('app.name', "ALUPI ITNL") }} </a>
                </div>
                <div class="card-body" id="reg_div"> 
                    <div class="mb-2" style="display:none;" id="error_msg"></div> 
            
                    <p class="login-box-msg"> Fill in the form below with the accurate information.</b></p>
            
                   
 
                        <div class="row">  

                          <div class="col-12">
                              @include('components.alerts')
                          </div>
                    
                     


                          <form id="form_wizard" action="#" class="pt-1" name="registry_form" method="POST">
                            <h3>Personal Data</h3>
                            <fieldset class="form-input">
                                <h4>Agent personal information</h4>
                                  {{-- START Your personal information   --}}
                                 <div class="row">
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_first_name"> {{__('First Name')}}  </label>
                                            <input required type="text" class="form-control" id="agt_first_name" name="agt_first_name" >
                                        </div>
                                        </div> 
                                        
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_last_name"> {{__('Last Name')}}  </label>
                                            <input required type="text" class="form-control" id="agt_last_name" name="agt_last_name">
                                        </div> 
                                        </div> 
                                        
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_other_name"> {{__('Other Name')}}  </label>
                                            <input required type="text" class="form-control" id="agt_other_name" name="agt_other_name">
                                        </div>
                                        </div>
                    
                    
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="agt_gender"> {{__('Gender')}}  </label>
                                                <select required id="agt_gender" class="form-control" name="agt_gender">
                                                    <option value=""></option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option> 
                                                  </select>
                                                </div>
                                            </div>
                    
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_email"> {{__('Email Address')}}  </label>
                                            <input required type="email" class="form-control" id="agt_email" name="agt_email">
                                            </div>
                                        </div>
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_phone_number"> {{__('Phone Number')}}  </label>
                                            <input required type="number" class="form-control" id="agt_phone_number" name="agt_phone_number">
                                            </div>
                                        </div>
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_chat_number"> {{__('Chat Number')}}  </label>
                                            <input required type="number" class="form-control" id="agt_chat_number" name="agt_chat_number">
                                            </div>
                                        </div>
                    
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_res_address"> {{__('Residential Address')}}  </label>
                                            <input required type="text" class="form-control" id="agt_res_address" name="agt_res_address">
                                            </div>
                                        </div>
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_res_city"> {{__('City of Residence')}}  </label>
                                            <input required type="text" class="form-control" id="agt_res_city" name="agt_res_city">
                                            </div>
                                        </div>
                    
                                            <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_res_state"> {{__('State of Residence')}}  </label>
                                            <select required id="agt_res_state" class="form-control" name="agt_res_state">
                                                <option value="">---</option>
                                                <option value="Abia">Abia</option>
                                                <option value="Adamawa">Adamawa</option>
                                                <option value="Akwa Ibom">Akwa Ibom</option>
                                                <option value="Anambra">Anambra</option>
                                                <option value="Bauchi">Bauchi</option>
                                                <option value="Bayelsa">Bayelsa</option>
                                                <option value="Benue">Benue</option>
                                                <option value="Borno">Borno</option>
                                                <option value="Cross River">Cross River</option>
                                                <option value="Delta">Delta</option>
                                                <option value="Ebonyi">Ebonyi</option>
                                                <option value="Edo">Edo</option>
                                                <option value="Ekiti">Ekiti</option>
                                                <option value="Enugu">Enugu</option>
                                                <option value="FCT">FCT</option>
                                                <option value="Gombe">Gombe</option>
                                                <option value="Imo">Imo</option>
                                                <option value="JIgawa">Jigawa</option>
                                                <option value="Kaduna">Kaduna</option>
                                                <option value="Katsina">Katsina</option>
                                                <option value="Kebbi">Kebbi</option>
                                                <option value="Kwara">Kwara</option>
                                                <option value="Lagos">Lagos</option>
                                                <option value="Nasarawa">Nasarawa</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Ogun">Ogun</option>
                                                <option value="Ondo">Ondo</option>
                                                <option value="Osun">Osun</option>
                                                <option value="Oyo">Oyo</option>
                                                <option value="Plateau">Plateau</option>
                                                <option value="Rivers">Rivers</option>
                                                <option value="Sokoto">Sokoto</option>
                                                <option value="Taraba">Taraba</option>
                                                <option value="Zamfara">Zamfara</option>  
                                              </select>
                                            </div>
                                        </div>
                    
                                            <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_state_origin"> {{__('State of Origin')}}  </label> 
                                            <select required  class="form-control" id="agt_state_origin" name="agt_state_origin">
                                                <option value="">---</option>
                                                <option value="Abia">Abia</option>
                                                <option value="Adamawa">Adamawa</option>
                                                <option value="Akwa Ibom">Akwa Ibom</option>
                                                <option value="Anambra">Anambra</option>
                                                <option value="Bauchi">Bauchi</option>
                                                <option value="Bayelsa">Bayelsa</option>
                                                <option value="Benue">Benue</option>
                                                <option value="Borno">Borno</option>
                                                <option value="Cross River">Cross River</option>
                                                <option value="Delta">Delta</option>
                                                <option value="Ebonyi">Ebonyi</option>
                                                <option value="Edo">Edo</option>
                                                <option value="Ekiti">Ekiti</option>
                                                <option value="Enugu">Enugu</option>
                                                <option value="FCT">FCT</option>
                                                <option value="Gombe">Gombe</option>
                                                <option value="Imo">Imo</option>
                                                <option value="JIgawa">Jigawa</option>
                                                <option value="Kaduna">Kaduna</option>
                                                <option value="Katsina">Katsina</option>
                                                <option value="Kebbi">Kebbi</option>
                                                <option value="Kwara">Kwara</option>
                                                <option value="Lagos">Lagos</option>
                                                <option value="Nasarawa">Nasarawa</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Ogun">Ogun</option>
                                                <option value="Ondo">Ondo</option>
                                                <option value="Osun">Osun</option>
                                                <option value="Oyo">Oyo</option>
                                                <option value="Plateau">Plateau</option>
                                                <option value="Rivers">Rivers</option>
                                                <option value="Sokoto">Sokoto</option>
                                                <option value="Taraba">Taraba</option>
                                                <option value="Zamfara">Zamfara</option>  
                                              </select>
                                            </div>
                                        </div>
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_lga_origin"> {{__('LGA of Origin')}}  </label>
                                            <input required type="text" class="form-control" id="agt_lga_origin" name="agt_lga_origin">
                                            </div>
                                        </div>
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_home_town"> {{__('Home Town')}}  </label>
                                            <input required type="text" class="form-control" id="agt_home_town" name="agt_home_town">
                                            </div>
                                        </div> 
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_birth_date"> {{__('Date of Birth')}}  </label>
                                            <input required type="date" class="form-control" id="agt_birth_date" name="agt_birth_date">
                                            </div>
                                        </div>
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_birth_place"> {{__('Place of Birth')}}  </label>
                                            <input required type="text" class="form-control" id="agt_birth_place" name="agt_birth_place">
                                            </div>
                                        </div>
                    
                                       <div class="col-md-12"><hr /></div>
                    
                                       <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agt_referrer_id"> {{__('Referrer ID')}}  </label>
                                            <input required type="text" value="{{session('referrer_agent_id')}}" readonly class="form-control" id="agt_referrer_id" name="agt_referrer_id" >
                                        </div>
                                        </div>
                                        

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="agt_username"> {{__('Username')}}  </label>
                                                <input required type="text" class="form-control" id="agt_username" name="agt_username">
                                            </div>
                                        </div> 
                        
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="agt_password"> {{__('Password')}}  </label>
                                                <input required type="password" class="form-control" id="agt_password" name="agt_password">
                                                </div>
                                            </div>
                        
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="agt_password_rpt"> {{__('Repeat Password')}}  </label>
                                                <input required type="password" class="form-control" id="agt_password_rpt" name="agt_password_rpt">
                                                </div>
                                            </div>
                    
                                         
                    
                                
                                     </div>    
                                {{--END=> Your personal information --}}
                            </fieldset>
                    
                            <h3>Next of Kin</h3>
                            <fieldset class="form-input">
                                <h4>Your next of kin data</h4>
                                {{--START=> Your next of kin data --}}
                                 <div class="row">
                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="nok_fullname"> {{__('Fullname')}}  </label>
                                          <input required type="text" class="form-control" id="nok_fullname" name="nok_fullname" >
                                        </div>
                                    </div> 
                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="nok_res_address"> {{__('Residential Address')}}  </label>
                                          <input required type="text" class="form-control" id="nok_res_address" name="nok_res_address">
                                        </div> 
                                    </div> 
                    
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nok_res_city"> {{__('City of Residence')}}  </label>
                                        <input required type="text" class="form-control" id="nok_res_city" name="nok_res_city">
                                        </div>
                                    </div>
                    
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nok_res_state"> {{__('State of Residence')}}  </label>
                                        <select required  class="form-control" id="nok_res_state" name="nok_res_state">
                                            <option value="">---</option>
                                            <option value="Abia">Abia</option>
                                            <option value="Adamawa">Adamawa</option>
                                            <option value="Akwa Ibom">Akwa Ibom</option>
                                            <option value="Anambra">Anambra</option>
                                            <option value="Bauchi">Bauchi</option>
                                            <option value="Bayelsa">Bayelsa</option>
                                            <option value="Benue">Benue</option>
                                            <option value="Borno">Borno</option>
                                            <option value="Cross River">Cross River</option>
                                            <option value="Delta">Delta</option>
                                            <option value="Ebonyi">Ebonyi</option>
                                            <option value="Edo">Edo</option>
                                            <option value="Ekiti">Ekiti</option>
                                            <option value="Enugu">Enugu</option>
                                            <option value="FCT">FCT</option>
                                            <option value="Gombe">Gombe</option>
                                            <option value="Imo">Imo</option>
                                            <option value="JIgawa">Jigawa</option>
                                            <option value="Kaduna">Kaduna</option>
                                            <option value="Katsina">Katsina</option>
                                            <option value="Kebbi">Kebbi</option>
                                            <option value="Kwara">Kwara</option>
                                            <option value="Lagos">Lagos</option>
                                            <option value="Nasarawa">Nasarawa</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Ogun">Ogun</option>
                                            <option value="Ondo">Ondo</option>
                                            <option value="Osun">Osun</option>
                                            <option value="Oyo">Oyo</option>
                                            <option value="Plateau">Plateau</option>
                                            <option value="Rivers">Rivers</option>
                                            <option value="Sokoto">Sokoto</option>
                                            <option value="Taraba">Taraba</option>
                                            <option value="Zamfara">Zamfara</option>  
                                          </select>
                                        </div>
                                    </div>
                    
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nok_phone_number"> {{__('Phone Number')}}  </label>
                                        <input required type="number" class="form-control" id="nok_phone_number" name="nok_phone_number">
                                        </div>
                                    </div>
                    
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nok_relationship"> {{__('Relationship')}}  </label>
                                        <input required type="text" class="form-control" id="nok_relationship" name="nok_relationship">
                                        </div>
                                    </div> 
                    
                            
                                 </div>  
                                  {{--END=> Your next of kin data --}}
                            </fieldset>



                          </form>
                
                          <!-- /.col -->
                        </div> 


                 
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
 







    <!-- jquery.steps js -->
{{-- <script src='https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js'></script> --}}
<script src="{{ asset('dist/js/jquery.validate.js') }}"></script>
<script src="{{ asset('dist/js/jquery.steps.js') }}"></script>
<script src="{{ asset('dist/js/particles.js') }}"></script>


<script>
	var form = $("#form_wizard").show(); 
	form.steps({
		headerTag: "h3",
		bodyTag: "fieldset",
		transitionEffect: "slideLeft",
		onStepChanging: function (event, currentIndex, newIndex)
		{
			// Allways allow previous action even if the current form is not valid!
			if (currentIndex > newIndex)
			{ return true; }
			// Forbid next action on "third" step.
			// if (newIndex === 3 ) { return false; }

			// Needed in some cases if the user went back (clean up)
			if (currentIndex < newIndex)
			{
				// To remove error styles
				form.find(".body:eq(" + newIndex + ") label.error").remove();
				form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
			}
			form.validate().settings.ignore = ":disabled,:hidden";
			return form.valid();
            //return true;
		},
		onStepChanged: function (event, currentIndex, priorIndex)
		{
			// Used to skip the "Warning" step if the user is old enough.
			if (currentIndex === 2 && Number($("#age").val()) >= 18)
			{
				form.steps("next");
			}
			// Used to skip the "third" step.
			// if (currentIndex === 2 && priorIndex === 3)  { form.steps("previous");  }
		},
		onFinishing: function (event, currentIndex)
		{
			form.validate().settings.ignore = ":disabled";
			return form.valid();   
		},
		onFinished: function (event, currentIndex)
		{  
            // $("a[href='#finish']").click(function (e) { e.preventDefault();  form.submit(); });
            // $("a[href='#finish']").click(function (e) {  });
          var agt_first_name = $("#agt_first_name").val();
          if(agt_first_name == '') {
            $('#error_msg').show();
            $('#error_msg').html('All the required fields must be filled');
        } else{
            $('#error_msg').hide();

            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $("input[name=_token]").val()
                  }
              });
            
            $.ajax({
                type: 'POST',
                url: '{{ route("agent.ref_submit_form") }}',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() { 
                    $('#form_wizard').css("opacity",".5"); 
                },
                success: function(response) {   var error_msg='';   var success = false; 
                    $('#error_msg').show(); 
                    for (const key of Object.keys(response)){
                         console.log(key, response[key]);  if (response[key].includes("registered successfully")) { success = true; }
                        error_msg += (' <div class="alert alert-success mb-1" style="font-size:14px;">'+response[key]+'</div>'); 
                    }
 
                    if (success == true) {   $('#reg_div').html('<p class="mb-0 text-center">Registration was successfull, proceed to log in below <br> <br> <a href="{{route('login')}}" class="btn btn-primary w-75">Log In</a></p>'); } 
                    else         { $('#error_msg').html(error_msg); }
                }
            });
        }


        // ----------------------------------------------------- //

		}
	}).validate({
		errorPlacement: function errorPlacement(error, element) { element.before(error); },
		rules: {
			confirm: {
				equalTo: "#password"
			}
		}
	});




//-----------------------   SOME FREE GAP -----------------------//




    $('#form_wizard').on('submit', function(e){
        e.preventDefault(); 
    });



//----------------------     SOME FREE GAP    --------------------//  


function fetch_saved_data () {
 
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const subcat_id = urlParams.get('id')


        // after page loading or refresh
        var data2send={'action':'load_saved_data'};
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('agent.ajax_fetch') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp){
                $('#data_box').html(resp);
            }
        });
}
fetch_saved_data ();

</script>



</body>
</html>
