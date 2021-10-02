@extends('layouts.main')

@section('content')
 
 
<div class="w-100 text-right mb-3">
 <h5 class="mb-0 float-left"> <i class="fas fa fa-building-o"></i> Vendors Management</h5>
  <button data-toggle="collapse" data-target="#add_new" class="btn btn-primary btn-sm"> Add New </button>
</div>
 

     <div class="card collapse" id="add_new">
         <div class="card-header">{{ __('Vendor Registry') }}</div> 
         <div class="card-body">
             

          {!! Form::open(['route' => ['vendor.store'], 'method'=>'POST', 'files' => true]) !!}
          <div class="row"> 
              <div class="col-md-8 mx-auto pt-4">
               
                 <div class="row">

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="fullname"> {{__('Fullame')}} </label>
                          <input required type="text" class="form-control" id="full_name" name="full_name" >
                        </div>
                     </div> 



                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="fullname"> {{__('Address')}}  </label>
                          <input type="text" class="form-control" id="address" name="address">
                        </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="phone"> {{__('Telephone A')}} </label>
                          <input required type="text" class="form-control" id="phone_a" name="phone_a">
                        </div>
                     </div> 

                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone"> {{__('Telephone B')}} </label>
                            <input required type="text" class="form-control" id="phone_b" name="phone_b">
                          </div>
                       </div> 

                     <div class="col-md-12">
                        <div class="form-group">
                            <label for="fullname"> {{__('Description')}} </label>
                             <textarea required type="text" class="form-control" id="description" name="description" rows="2"></textarea> 
                          </div>
                       </div>

        
                       <div class="col-12">
                           <hr>
                       </div>

                       <div class="col-md-6">
                        <div class="form-group">
                            <label for="username"> {{__('Email Address')}} </label>
                            <input required type="text" class="form-control" id="email" name="email">
                        </div>
                       </div>


                       <div class="col-md-6">
                        <div class="form-group">
                            <label for="username"> {{__('Username')}} </label>
                            <input required type="text" class="form-control" id="username" name="username">
                        </div>
                       </div>

                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="password"> {{__('Password')}} </label>
                          <input required type="password" class="form-control" id="password" name="password">
                      </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="password"> {{__('Confirm Password')}} </label>
                          <input required type="password" class="form-control" id="password" name="confirm_password">
                      </div>
                     </div>

                     <div class="col-md-12 pt-3">
                      <div class="form-group w-50 mx-auto"> 
                          <input type="submit" class="btn btn-primary btn-block" id="submit" value="Save vendor" name="submit">
                      </div>
                     </div>

                 </div>
                  
              </div> 
          </div>
          {!! Form::close() !!}


         </div> 
     </div> 

        <div class="card">
            <div class="card-header">{{ __('Registered Vendors') }}</div>
            <div class="card-body table-responsive"> 
                 <table id="t1" class="table table-bordered table-striped" style="width:1100px;">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Description</th>  
                    <th>Office Address</th>
                    <th>Telephone A</th>
                    <th>Telephone B</th>
                    <th>Email Address</th>  
                    <th>Username</th>  
                    <th>...</th> 
                  </tr>
                  </thead>
                 <tbody>
                        {{-- loop out Vendors here --}}
                
                 @foreach($vendors as $vendor)
                 <tr>
                  <td> {{$vendor->vendor_id}} </td>
                  <td> {{$vendor->full_name}} </td>
                  <td> {{$vendor->description}} </td>  
                  <td> {{$vendor->address}} </td>
                  <td> {{$vendor->phone_a}} </td>
                  <td> {{$vendor->phone_b}} </td>
                  <td> {{$vendor->user->email}} </td> 
                  <td> {{$vendor->user->username}} </td> 
                  <td>  <a class="btn btn-primary btn-xs" href="{{ route('vendor.show', ['vendor'=>$vendor->vendor_id]) }}"> <span class="fa fa-user"></span> Profile</a> </td>
                 </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th> 
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th> 
                    <th></th> 
                  </tr>
                  </tfoot>
                </table>


            </div>
        </div>
 

   
    <x-datatables />    {{-- datatables js scripts --}}
@endsection
