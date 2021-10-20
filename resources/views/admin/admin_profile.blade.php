@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/responsive.css') }}">
<style>
    input.inp_decl { display: inline-block!important;  height: 21px;  width: 250px; font-size: 13px; }
    p.undertaken {  text-align: center;  font-weight: 600;   border-bottom: 1px solid; margin-bottom: 22px; }
    .li_decl { font-size: 13px; }
</style>

             <!-- Content Header (Page header) --> 
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Agent Profile</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          
          <div class="row">
            <div class="col-md-3">
  
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{url('images/avatar_dummy.png')}}"
                         alt="User profile picture">
                  </div>
                   
                  <h3 class="profile-username text-center"> {{ $user->username }} </h3>  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->




              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item" >
                      <b> <i class="fas fa-link"></i> Referral Link:</b>  <span id="copy_target">{{route('agent.show_referring_form', ['agent_id'=>$user->user_id])}}  </span> <br><br>
                       <p class="mb-0"> <button class="btn btn-outline-primary btn-block mt-2" id="copy_button">Copy Link</button> </p>
                    </li>  
                  </ul> 
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->


  
            
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">  
                    <li class="nav-item"><a class="nav-link" href="#profile_data" data-toggle="tab"> Profile Data </a></li>
             @admin <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Manage</a></li> @endadmin
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">


                   

 

                    
                    <div class="tab-pane active" id="profile_data">
                      <div class="row">
                      <div class="col-12"> <p class="text-center mb-2 th_head"><b>PERSONAL INFO</b></p> </div>
                      <div class="col-md-6">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>   
                            <tr> <td><span class="th_span"> Agent ID</span> </td> <td> <b>  {{ $user->user_id }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Firstname</span> </td> <td> <b>   {{ $user->staff->agt_first_name }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Lastname</span> </td> <td> <b>   {{ $user->staff->agt_last_name }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Other name</span> </td> <td> <b>   {{ $user->staff->agt_other_name }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Referral ID</span> </td> <td> <b>   {{ $user->staff->referrer_id }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Email</span> </td> <td> <b>   {{ $user->email }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Phone number</span> </td> <td> <b>   {{ $user->staff->agt_phone_number }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Chat NUmber</span> </td> <td> <b>   {{ $user->staff->agt_chat_number }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Gender</span> </td> <td> <b>   {{ $user->staff->agt_gender }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Address</span> </td> <td> <b>   {{ $user->staff->agt_res_address }} </b> </td> </tr> 
                            <tr> <td><span class="th_span"> Current City</span> </td> <td> <b> {{ $user->staff->agt_res_city }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Current State</span> </td> <td> <b>   {{ $user->staff->agt_res_state }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Origin State</span> </td> <td> <b>   {{ $user->staff->agt_state_origin }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Origin LGA</span> </td> <td> <b>   {{ $user->staff->agt_lga_origin }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Home Town</span> </td> <td> <b>   {{ $user->staff->agt_home_town }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Birth Date</span> </td> <td> <b>   {{ $user->staff->agt_birth_date }} </b> </td> </tr>
                            <tr> <td><span class="th_span"> Birth Place</span> </td> <td> <b>   {{ $user->staff->agt_birth_place }} </b> </td> </tr>
                         </tbody> 
                        </table>
                        </div> 
                      </div>
                       <div class="col-md-6">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>   
                              <tr> <td><span class="th_span"> NOK Fullname</span> </td> <td> <b>  {{ $user->staff->nok_fullname }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> NOK Address</span> </td> <td> <b>   {{ $user->staff->nok_res_address }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> NOK City</span> </td> <td> <b>   {{ $user->staff->nok_res_city }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> NOK State</span> </td> <td> <b>   {{ $user->staff->nok_res_state }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> NOK Phone</span> </td> <td> <b>   {{ $user->staff->referrer_id }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> NOK Relationship</span> </td> <td> <b>   {{ $user->staff->nok_phone_number }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Fullname</span> </td> <td> <b> {{ $user->staff->grt_first_name }} {{ $user->staff->grt_last_name }} {{ $user->staff->grt_other_name }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Phone</span> </td> <td> <b> {{ $user->staff->grt_phone_number }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Age </span> </td> <td> <b>   {{ $user->staff->grt_age }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Address</span> </td> <td> <b>   {{ $user->staff->grt_res_address }} </b> </td> </tr> 
                              <tr> <td><span class="th_span"> GRT City</span> </td> <td> <b> {{ $user->staff->grt_res_city }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT State</span> </td> <td> <b>   {{ $user->staff->grt_res_state }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Occupation</span> </td> <td> <b>   {{ $user->staff->grt_occupation }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Business</span> </td> <td> <b>   {{ $user->staff->grt_bis_name }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Office Address</span> </td> <td> <b>   {{ $user->staff->grt_bis_address }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Relationship</span> </td> <td> <b>   {{ $user->staff->grt_relationship }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> GRT Undertaken</span> </td> <td> <b>   {{ $user->staff->grt_undertaken }} </b> </td> </tr>
                           </tbody> 
                          </table>
                          </div> 
                       </div>
                    </div>
                      <br>
                      </div>



 

                  @admin
                    <div class="tab-pane" id="settings">
                         <div class="row">
                             <div class="col-6">  <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#update_data">
                             <span class="fas fa-edit"></span>  Update Data  </button> </div>
                         <div class="col-6">  <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#delete_data">
                            <span class="fas fa-trash"></span> Trash Account  </button> </div>
                         </div>
                    </div>      <!-- /.tab-pane -->
                  @endadmin

                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>

 



















<script>

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

  </script> 



















     {{-- UPDATE FORM --}}
    <div class="modal fade" id="update_data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="max-width: 700px;">

              <div class="modal-header bg-primary">  
              <h4 class="modal-title text-white"> <span class="fas fa-edit"></span> Update Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span> 
              </button>
            </div>
            <div class="modal-body"> 
                  <div class="mb-2" style="display:none;" id="error_msg"></div> 
                  <div class="login-sec-bg mb-4" id="add_new" style="border: 1px solid #dfe0e2;"> 
                        <form id="form_wizard" action="#" class="pt-1" name="registry_form" method="post">   
                        <h3>Personal Data</h3>  
                        <fieldset class="form-input">
                            <h4>Your personal information</h4>
                            {{--START=> Your personal information --}}
                            <div class="row">  
                              <input type="hidden" name="_method" value="PUT">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_first_name"> {{__('First Name')}}  </label>
                                        <input required value="{{$user->staff->agt_first_name}}" type="text" class="form-control" id="agt_first_name" name="agt_first_name">
                                        </div>
                                    </div> 
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_last_name"> {{__('Last Name')}}  </label>
                                        <input required value="{{$user->staff->agt_last_name}}" type="text" class="form-control" id="agt_last_name" name="agt_last_name">
                                        </div> 
                                    </div> 
                                    
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_other_name"> {{__('Other Name')}}  </label>
                                        <input required value="{{$user->staff->agt_other_name}}" type="text" class="form-control" id="agt_other_name" name="agt_other_name">
                                        </div>
                                    </div>
                
                
                                    
                                      <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="agt_gender"> {{__('Gender')}}  </label>
                                              <select required id="agt_gender" class="form-control" name="agt_gender">
                                                <option value="{{$user->staff->agt_gender}}"> {{$user->staff->agt_gender}} </option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option> 
                                              </select>
                                            </div>
                                        </div>
                
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_email"> {{__('Email Address')}}  </label>
                                        <input required value="{{$user->email}}" type="email" class="form-control" id="agt_email" name="agt_email">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_phone_number"> {{__('Phone Number')}}  </label>
                                        <input required value="{{$user->staff->agt_phone_number}}" type="digits" class="form-control" id="agt_phone_number" name="agt_phone_number">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_chat_number"> {{__('Chat Number')}}  </label>
                                        <input required value="{{$user->staff->agt_chat_number}}" type="digits" class="form-control" id="agt_chat_number" name="agt_chat_number">
                                        </div>
                                    </div>
                
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_res_address"> {{__('Residential Address')}}  </label>
                                        <input required value="{{$user->staff->agt_res_address}}" type="text" class="form-control" id="agt_res_address" name="agt_res_address">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_res_city"> {{__('City of Residence')}}  </label>
                                        <input required value="{{$user->staff->agt_res_city}}" type="text" class="form-control" id="agt_res_city" name="agt_res_city">
                                        </div>
                                    </div>
                
                                        <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_res_state"> {{__('State of Residence')}}  </label>
                                        <select required id="agt_res_state" class="form-control" name="agt_res_state">
                                            <option value="{{$user->staff->agt_res_state}}">{{$user->staff->agt_res_state}}</option>
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
                                            <option value="{{$user->staff->agt_state_origin}}">{{$user->staff->agt_state_origin}}</option>
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
                                        <input required value="{{$user->staff->agt_lga_origin}}" type="text" class="form-control" id="agt_lga_origin" name="agt_lga_origin">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_home_town"> {{__('Home Town')}}  </label>
                                        <input required value="{{$user->staff->agt_home_town}}" type="text" class="form-control" id="agt_home_town" name="agt_home_town">
                                        </div>
                                    </div> 
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_birth_date"> {{__('Date of Birth')}}  </label>
                                        <input required value="{{$user->staff->agt_birth_date}}" type="date" class="form-control" id="agt_birth_date" name="agt_birth_date">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agt_birth_place"> {{__('Place of Birth')}}  </label>
                                        <input required value="{{$user->staff->agt_birth_place}}" type="text" class="form-control" id="agt_birth_place" name="agt_birth_place">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="agt_username"> {{__('Username')}}  </label>
                                          <input required value="{{$user->username}}" type="text" class="form-control" id="agt_username" name="agt_username">
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
                                      <input required value="{{$user->staff->nok_fullname}}" type="text" class="form-control" id="nok_fullname" name="nok_fullname" >
                                    </div>
                                </div> 
                
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="nok_res_address"> {{__('Residential Address')}}  </label>
                                      <input required value="{{$user->staff->nok_res_address}}" type="text" class="form-control" id="nok_res_address" name="nok_res_address">
                                    </div> 
                                </div> 
                
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nok_res_city"> {{__('City of Residence')}}  </label>
                                    <input required value="{{$user->staff->nok_res_city}}" type="text" class="form-control" id="nok_res_city" name="nok_res_city">
                                    </div>
                                </div>
                
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nok_res_state"> {{__('State of Residence')}}  </label>
                                    <select required  class="form-control" id="nok_res_state" name="nok_res_state">
                                        <option value="{{$user->staff->nok_res_state}}">{{$user->staff->nok_res_state}}</option>
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
                                    <input required value="{{$user->staff->nok_phone_number}}" type="digits" class="form-control" id="nok_phone_number" name="nok_phone_number">
                                    </div>
                                </div>
                
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nok_relationship"> {{__('Relationship')}}  </label>
                                    <input required value="{{$user->staff->nok_relationship}}" type="text" class="form-control" id="nok_relationship" name="nok_relationship">
                                    </div>
                                </div> 
                
                        
                            </div>  
                              {{--END=> Your next of kin data --}}
                        </fieldset>
                
                        <h3>Guarantor</h3>
                        <fieldset class="form-input">
                            <h4>Your guarantor data</h4>
                            {{--START=> Your guarantor data --}}
                    <div class="row">
                
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="grt_first_name"> {{__('First Name')}}  </label>
                                      <input required value="{{$user->staff->grt_first_name}}" type="text" class="form-control" id="grt_first_name" name="grt_first_name" >
                                    </div>
                                </div> 
                
                              <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="grt_last_name"> {{__('Last Name')}}  </label>
                                      <input required value="{{$user->staff->grt_last_name}}" type="text" class="form-control" id="grt_last_name" name="grt_last_name" >
                                    </div>
                                </div> 
                
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="grt_other_name"> {{__('Other Name')}}  </label>
                                      <input required value="{{$user->staff->grt_other_name}}" type="text" class="form-control" id="grt_other_name" name="grt_other_name">
                                    </div> 
                                </div> 
                
                                
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="grt_phone_number"> {{__('Phone Number')}}  </label>
                                          <input required value="{{$user->staff->grt_phone_number}}" type="digits" class="form-control" id="grt_phone_number" name="grt_phone_number">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="grt_age"> {{__('Age')}}  </label>
                                            <input required value="{{$user->staff->grt_age}}" type="number" class="form-control" id="grt_age" name="grt_age">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="grt_res_address"> {{__('Residential Address')}}  </label>
                                            <input required value="{{$user->staff->grt_res_address}}" type="text" class="form-control" id="grt_res_address" name="grt_res_address">
                                        </div>
                                  </div>
                
                                
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grt_city"> {{__('City of Redsidence')}}  </label>
                                        <input required value="{{$user->staff->grt_res_city}}" type="text" class="form-control" id="grt_res_city" name="grt_res_city">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grt_state"> {{__('State of Residence')}}  </label>
                                        <select required class="form-control" name="grt_res_state" id="grt_state">
                                          <option value="{{$user->staff->grt_res_state}}">{{$user->staff->grt_res_state}}</option>
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
                                    <label for="grt_occupation"> {{__('Occupation')}}  </label>
                                    <input required value="{{$user->staff->grt_occupation}}" type="text" class="form-control" id="grt_occupation" name="grt_occupation">
                                    </div>
                                </div>
                
                
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="grt_bis_name"> {{__('Business/Company Name')}}  </label>
                                <input required value="{{$user->staff->grt_bis_name}}" type="text" class="form-control" id="grt_bis_name" name="grt_bis_name">
                                </div>
                          </div>
                
                
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="grt_bis_address"> {{__('Business Address')}}  </label>
                                <input required value="{{$user->staff->grt_bis_address}}" type="text" class="form-control" id="grt_bis_address" name="grt_bis_address">
                              </div>
                          </div>
                
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="grt_relationship"> {{__('Relationship with Agent')}}  </label>
                            <input required type="text" value="{{$user->staff->grt_relationship}}" class="form-control" id="grt_relationship" name="grt_relationship">
                        </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group">
                              <label for="grt_undertaken"> {{__('Guarantor Undertake')}}  </label>
                              <textarea required rows="5" class="form-control" id="grt_undertaken" name="grt_undertaken">{{$user->staff->grt_undertaken}}</textarea>
                        </div>
                        </div>
                
  
                
                    </div>  
                            {{--END=> Your guarantor data --}}
                        </fieldset>
                
                        <h3>HR</h3>
                        <fieldset class="form-input">
                            <h4>HR Verification</h4>
                          {{--START=> HR Verification --}}
                          <div class="row"> 
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="staff_id"> {{__('Staff ID')}}  </label>
                                        <input required type="text" class="form-control" value="{{$user->staff->hr_staff_id}}" id="hr_staff_id" name="hr_staff_id">
                                        </div> 
                                    </div> 
                                    
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grt_response"> {{__('Guarantor Response')}}  </label>
                                        <textarea required class="form-control"  rows="5"id="hr_grt_response" name="hr_grt_response"> {{$user->staff->hr_grt_response}} </textarea>
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hr_remark"> {{__('HR Remarks')}}  </label> 
                                        <textarea required class="form-control" rows="5"  id="hr_remark" name="hr_remark"> {{$user->staff->hr_remark}} </textarea>
                                        </div>
                                    </div>   
                          </div>
                                {{--END=> HR Verification --}}
                        </fieldset> 
                      </form>
                  </div>  
             
            </div>
            <div class="modal-footer justify-content-between bg-light">
               
            </div>
     
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal --> 














      
      <div class="modal fade" id="delete_data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            {!! Form::open(['route' => ['agent.destroy', ['agent' => $user->username]], 'files' => false]) !!}
            <div class="modal-header bg-danger">  <input type="hidden" name="_method" value="DELETE">
              <h6 class="modal-title text-white"> <span class="fs-2"> <i class="icon fas fa-exclamation-triangle"></i> This account and all information connected will be moved to trash, are you sure to continue ?</span> </h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
                   
            <div class="modal-body">
                 <div class="row">
                     <div class="col-md-4">
                                        <!-- Profile Image -->
                                        <div class="card card-primary card-outline">
                                          <div class="card-body box-profile">
                                            <div class="text-center">
                                              <img class="profile-user-img img-fluid img-circle"
                                                   src="{{url('images/avatar_dummy.png')}}"
                                                   alt="User profile picture">
                                            </div>
                                             
                                            <h3 class="profile-username text-center"> {{ $user->username }} </h3>  
                                          </div>
                                          <!-- /.card-body -->
                                        </div>
                        <!-- /.card -->
                     </div>
                     <div class="col-md-8">
                      <div class="row">
                        <div class="col-12"> <p class="text-center mb-2 th_head"><b>PERSONAL INFO</b></p> </div>
                        <div class="col-md-6">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>   
                              <tr> <td><span class="th_span"> Agent ID</span> </td> <td> <b>  {{ $user->user_id }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Firstname</span> </td> <td> <b>   {{ $user->staff->agt_first_name }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Lastname</span> </td> <td> <b>   {{ $user->staff->agt_last_name }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Other name</span> </td> <td> <b>   {{ $user->staff->agt_other_name }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Referral ID</span> </td> <td> <b>   {{ $user->staff->referrer_id }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Email</span> </td> <td> <b>   {{ $user->email }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Phone number</span> </td> <td> <b>   {{ $user->staff->agt_phone_number }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Chat NUmber</span> </td> <td> <b>   {{ $user->staff->agt_chat_number }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Gender</span> </td> <td> <b>   {{ $user->staff->agt_gender }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Address</span> </td> <td> <b>   {{ $user->staff->agt_res_address }} </b> </td> </tr> 
                              <tr> <td><span class="th_span"> Current City</span> </td> <td> <b> {{ $user->staff->agt_res_city }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Current State</span> </td> <td> <b>   {{ $user->staff->agt_res_state }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Origin State</span> </td> <td> <b>   {{ $user->staff->agt_state_origin }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Origin LGA</span> </td> <td> <b>   {{ $user->staff->agt_lga_origin }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Home Town</span> </td> <td> <b>   {{ $user->staff->agt_home_town }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Birth Date</span> </td> <td> <b>   {{ $user->staff->agt_birth_date }} </b> </td> </tr>
                              <tr> <td><span class="th_span"> Birth Place</span> </td> <td> <b>   {{ $user->staff->agt_birth_place }} </b> </td> </tr>
                           </tbody> 
                          </table>
                          </div> 
                        </div>
                         <div class="col-md-6">
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>   
                                <tr> <td><span class="th_span"> NOK Fullname</span> </td> <td> <b>  {{ $user->staff->nok_fullname }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> NOK Address</span> </td> <td> <b>   {{ $user->staff->nok_res_address }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> NOK City</span> </td> <td> <b>   {{ $user->staff->nok_res_city }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> NOK State</span> </td> <td> <b>   {{ $user->staff->nok_res_state }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> NOK Phone</span> </td> <td> <b>   {{ $user->staff->referrer_id }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> NOK Relationship</span> </td> <td> <b>   {{ $user->staff->nok_phone_number }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Fullname</span> </td> <td> <b> {{ $user->staff->grt_first_name }} {{ $user->staff->grt_last_name }} {{ $user->staff->grt_other_name }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Phone</span> </td> <td> <b> {{ $user->staff->grt_phone_number }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Age </span> </td> <td> <b>   {{ $user->staff->grt_age }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Address</span> </td> <td> <b>   {{ $user->staff->grt_res_address }} </b> </td> </tr> 
                                <tr> <td><span class="th_span"> GRT City</span> </td> <td> <b> {{ $user->staff->grt_res_city }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT State</span> </td> <td> <b>   {{ $user->staff->grt_res_state }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Occupation</span> </td> <td> <b>   {{ $user->staff->grt_occupation }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Business</span> </td> <td> <b>   {{ $user->staff->grt_bis_name }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Office Address</span> </td> <td> <b>   {{ $user->staff->grt_bis_address }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Relationship</span> </td> <td> <b>   {{ $user->staff->grt_relationship }} </b> </td> </tr>
                                <tr> <td><span class="th_span"> GRT Undertaken</span> </td> <td> <b>   {{ $user->staff->grt_undertaken }} </b> </td> </tr>
                             </tbody> 
                            </table>
                            </div> 
                         </div>
                      </div>
                     </div>
                 </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Proceed To Trash</button>
            </div>
            {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

 





 




@endsection
