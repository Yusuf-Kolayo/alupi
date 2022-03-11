@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/responsive.css') }}">
<style>
    input.inp_decl { display: inline-block!important;  height: 21px;  width: 250px; font-size: 13px; }
    p.undertaken {  text-align: center;  font-weight: 600;   border-bottom: 1px solid; margin-bottom: 22px; }
    .li_decl { font-size: 13px; }
</style>



 

 <div class="w-100 text-right pb-2 mb-2 border-bottom">
     <h5 class="mb-0 float-left" >Agent Management</h5>
     <button data-toggle="collapse" data-target="#add_new" class="btn btn-primary btn-sm"> Add New </button>
 </div>
 <div class="mb-2" style="display:none;" id="error_msg"></div>

 <div class="login-sec-bg collapse mb-4" id="add_new" style="border: 1px solid #dfe0e2;"> 
    <form id="form_wizard" action="#" class="pt-1" name="registry_form">
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
                        <input required type="text" class="form-control" id="agt_referrer_id" name="agt_referrer_id" >
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="catchment_id"> {{__('Catchment')}}  </label>
                                <select name="catchment_id" id="catchment_id" required="" class="form-control ng-touched ng-dirty ng-valid">
                                    <option value=""></option>
                                    @foreach ($catchments as $catchment)
                                        <option value="{{$catchment->catchment_id}}">{{$catchment->catchment_id}} : {{$catchment->locations}}</option>
                                    @endforeach
                               </select>
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

        <h3>Guarantor</h3>
        <fieldset class="form-input">
            <h4>Your guarantor data</h4>
             {{--START=> Your guarantor data --}}
             <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                      <label for="grt_first_name"> {{__('First Name')}}  </label>
                      <input required type="text" class="form-control" id="grt_first_name" name="grt_first_name" >
                    </div>
                </div> 

               <div class="col-md-6">
                    <div class="form-group">
                      <label for="grt_last_name"> {{__('Last Name')}}  </label>
                      <input required type="text" class="form-control" id="grt_last_name" name="grt_last_name" >
                    </div>
                </div> 

                <div class="col-md-6">
                    <div class="form-group">
                      <label for="grt_other_name"> {{__('Other Name')}}  </label>
                      <input required type="text" class="form-control" id="grt_other_name" name="grt_other_name">
                    </div> 
                </div> 

                
                    <div class="col-md-6">
                       <div class="form-group">
                          <label for="grt_phone_number"> {{__('Phone Number')}}  </label>
                          <input required type="number" class="form-control" id="grt_phone_number" name="grt_phone_number">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="grt_age"> {{__('Age')}}  </label>
                            <input required type="number" class="form-control" id="grt_age" name="grt_age">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="grt_res_address"> {{__('Residential Address')}}  </label>
                            <input required type="text" class="form-control" id="grt_res_address" name="grt_res_address">
                        </div>
                   </div>

                 
                   <div class="col-md-6">
                    <div class="form-group">
                        <label for="grt_city"> {{__('City of Redsidence')}}  </label>
                        <input required type="text" class="form-control" id="grt_res_city" name="grt_res_city">
                        </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="grt_state"> {{__('State of Residence')}}  </label>
                         <select required class="form-control" name="grt_res_state" id="grt_state">
                            <option value=""></option>
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
                    <input required type="text" class="form-control" id="grt_occupation" name="grt_occupation">
                    </div>
                </div>


           <div class="col-md-6">
            <div class="form-group">
                <label for="grt_bis_name"> {{__('Business/Company Name')}}  </label>
                <input required type="text" class="form-control" id="grt_bis_name" name="grt_bis_name">
                </div>
           </div>


           <div class="col-md-6">
            <div class="form-group">
                <label for="grt_bis_address"> {{__('Business Address')}}  </label>
                <input required type="text" class="form-control" id="grt_bis_address" name="grt_bis_address">
                </div>
             </div>

           <div class="col-md-6">
           <div class="form-group">
            <label for="grt_relationship"> {{__('Relationship with Agent')}}  </label>
            <input required type="text" class="form-control" id="grt_relationship" name="grt_relationship">
         </div>
         </div>

        <div class="col-md-12 pt-4">
            <p class="undertaken">Guarantor Undertaken</p>
            <div class="li_decl">
               <p> I  <input type="text" required class="inp_decl" id="ut_grt_fullname" name="ut_grt_fullname"> whose particulars are as above personally recommend <input type="text" required class="inp_decl" id="ut_agt_fullname" name="ut_agt_fullname"> residing at <input type="text" required class="inp_decl" id="ut_agt_location" name="ut_agt_location"> 
                Employed by ADROITLINK-UP INT'L as <input type="text" required class="inp_decl" id="ut_agt_position" name="ut_agt_position">.</p>
                <br />  <br />
            
                    <p class="li_decl"><b>1:</b> I undertake to indemnify ADROITLINK-UP INT'L by reason of any default, conversion, embezzlement, theft and debt(s) whereby the company shall ascertain that He/She has wrongfully withheld money or monies and properties belonging to the company or from on boarding customers or current customers or vendor's.</p>
                    <p class="li_decl"><b>2:</b> I further undertake and agree to personally make good such properties or pay in cash, cheque the equivalence of such money so misused within thirty (30) days weekend and public holidays inclusive following a demand to pay same.</p>
                    <p class="li_decl"><b>3:</b> I further accept that by this guarantee, the company may name me as party to any civil Action against the  Officer for recovery of the properties and money so wrongfully converted, stolen and/ or embezzled.</p>
            
                    <p>  <input id="acceptTerms-2" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms-2">I agree with the company Terms and Conditions.</label></p>
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
                        <input required type="text" class="form-control" id="hr_staff_id" name="hr_staff_id">
                        </div> 
                    </div> 
                    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="hr_grt_response"> {{__('Guarantor Response')}}  </label>
                        <textarea required class="form-control" rows="5"id="grt_response" name="hr_grt_response"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="hr_remark"> {{__('HR Remarks')}}  </label> 
                        <textarea required class="form-control" rows="5" id="hr_remark" name="hr_remark"></textarea>
                        </div>
                    </div>   
          </div>
                 {{--END=> HR Verification --}}
        </fieldset>
    </form>			
</div>


 

{{-- div to be filled by ajax --}}
<div id="data_box">
    <div class="card">
        <div class="card-header"><b>{{ __('Registered Agents') }}</b></div>
        <div class="card-body table-responsive"> 
             <table id="" class="table table-bordered table-striped" style="width:1200px;">
              <thead>
              <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Other names</th>
                <th>Gender</th>
                <th>Phone number</th>
                <th>Chat number</th>
                <th>Email</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th> 
                <th>......</th> 
              </tr>
              </thead>
             <tbody>
           {{-- loop out agents here --}}
            
             @foreach($agents as $agent)
             @php $bg_class='';  if ($agent->catchment_id)  { $bg_class="fade_bd_blue"; } else {  $bg_class="fade_bd_red"; }
                 
             @endphp
             <tr class="{{$bg_class}}">   
             <td> {{$agent->agent_id}} </td>
             <td> {{$agent->agt_first_name}} </td>
             <td> {{$agent->agt_last_name}} </td>
             <td> {{$agent->agt_other_name}} </td>
             <td> {{$agent->agt_gender}} </td>
             <td> {{$agent->agt_phone_number}} </td>
             <td> {{$agent->agt_chat_number}} </td>
             <td> {{$agent->user->email}} </td>
             <td> {{$agent->agt_res_address}} </td>
             <td> {{$agent->agt_res_city}} </td> 
             <td> {{$agent->agt_res_state}} </td>   
             <td>  <a class="btn btn-primary btn-xs btn-block" href="{{ route('agent.show', ['agent'=>$agent->user->username]) }}"> <span class="fa fa-user"></span> Profile</a> </td>
             </tr>
            @endforeach
              </tbody>
              
            </table>
    
    
        </div>
    </div>
</div>










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
                url: '{{ url("/admin_agent/agent") }}',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() { 
                    $('#form_wizard').css("opacity",".5"); 
                },
                success: function(response) {   var error_msg='';   var success = false; console.warn(response); console.table(response);
                if (response.status==1) { 
                    $('#add_new').html('<p class="mb-2">Registration Succesful <br> <a href="'+{{route('login')}}+'" class="btn btn-primary">Log In</a> </p>')
                } else {
                    $('#error_msg').show(); 
                    for (const key of Object.keys(response)){
                         console.log(key, response[key]);  if (response[key].includes("registered successfully")) { success = true; }
                        error_msg += (' <div class="alert alert-success mb-1" style="font-size:14px;">'+response[key]+'</div>'); 
                    }
                    $('#error_msg').html(error_msg);
                    $('#form_wizard').css("opacity","");  
                    fetch_saved_data();

                    if (success === true) { $('#form_wizard').find("input[type=text], input[type=password], input[type=email], input[type=digits], input[type=date], input[type=number], textarea, select").val(""); }
                }
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
// fetch_saved_data ();

</script>




  <x-datatables />    {{-- datatables js scripts --}}

@endsection
