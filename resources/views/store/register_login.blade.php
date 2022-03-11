@extends('layouts.store')
	@section('page_title')
	  Adlupi - Accounts
	@endsection
@section('headers')
    <style>
    .product-details .add-to-cart .add-to-cart-btn { border-radius: 0px;    margin: 2px; }
    .add-to-cart-btn2 {
        position: relative; border: 2px solid transparent; height: 40px; padding: 0 30px; background-color: #484848; color: #FFF; 
        text-transform: uppercase;    font-weight: 700; border-radius: 0px; -webkit-transition: 0.2s all; transition: 0.2s all; margin: 2px;
    }
    /* h4 { font-family: fangsong; text-align: center; } */
    </style>
@endsection
@section('content')

   
 

     
      <section>
            <div class="container-fluid">
                  <div class="row mt-5 mb-5">
                        <div class="col-md-12">
                            
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                    <div class="col-md-3">
                                        {!! Form::open(['route' => ['login_submit'], 'method'=>'POST', 'files' => false]) !!}
                                            <div class="bg-warning p-5">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="mb-5 lead fs-4">Fill the fields below to log in if you have an account already</h4> <br>
                                                    </div>
                                                    <div class="col-md-12"> <label for="">Email Address</label>  </div>
                                                    <div class="col-md-12"> <input type="email" name="email" class="form-control mb-2"> </div>
                
                                                    <div class="col-md-12"> <label for="">Password</label>  </div>
                                                    <div class="col-md-12"> <input type="password" name="password" class="form-control mb-5"> </div>

                                                    <div class="col-md-12">
                                                        <p class="mb-0 text-center">
                                                           <input type="submit" value="Submit" class="btn btn-primary btn-block mx-auto">
                                                        </p>
                                                   </div>
                                                </div>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                <div class="col-md-2 p-5">
                                      <div class="p-5">
                                           <p class="mb-0 display-2"> OR </p>
                                      </div>
                                </div>
                                <div class="col-md-7">
                                 <div class="bg-light brd-2 p-5">
                                    {!! Form::open(['route' => ['register_submit'], 'method'=>'POST', 'files' => false]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="mb-5 lead fs-4">Fill the fields below to create an account if you don't have any</h4> <br>
                                            </div>
                                            <div class="col-md-3"> <label for="">Firstname</label>  </div>
                                            <div class="col-md-9"> <input type="text" name="first_name" class="form-control mb-2"> </div>
            
                                            <div class="col-md-3"> <label for="">Lastname</label>  </div>
                                            <div class="col-md-9"> <input type="text" name="last_name" class="form-control mb-2"> </div>
            
                                            <div class="col-md-3"> <label for="">State</label>  </div>
                                            <div class="col-md-9"> 
                                                <select name="state" class="form-control mb-2" id="">
                                                    <option value="lagos">Lagos</option>
                                                </select>
                                            </div>
            
                                            <div class="col-md-3"> <label for="">Address</label>  </div>
                                            <div class="col-md-9"> <input type="text" name="address" class="form-control mb-2"> </div>

                                            <div class="col-md-3"> <label for="">Phone Number</label>  </div>
                                            <div class="col-md-9"> <input type="tel" name="phone" class="form-control mb-2"> </div>
                    
                                            <div class="col-md-3"> <label for="">Email Address</label>  </div>
                                            <div class="col-md-9"> <input type="email" name="email" class="form-control mb-2"> </div>

                                             <div class="col-md-3"> <label for="">Username</label>  </div>
                                            <div class="col-md-9"> <input type="text" name="username" class="form-control mb-2"> </div>
            
                                            <div class="col-md-3">  <label for="">Password</label>  </div>
                                            <div class="col-md-9"> <input type="password" name="password" class="form-control mb-2" /> </div>

                                            <div class="col-md-3">  <label for="">Repeat Password</label>  </div>
                                            <div class="col-md-9"> <input type="password" name="confirm_password" class="form-control mb-5" /> </div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                 <p class="mb-0 text-center">
                                                    <input type="submit" value="Submit" class="btn btn-danger mt-2 btn-block">
                                                 </p>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}

                                </div>
                                </div>
                         </div>
                        </div>
                       
                  </div>
            </div>
      </section>





 
@endsection