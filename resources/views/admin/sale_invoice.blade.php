@extends('layouts.main')
@section('headers')
  <style>
      label { font-size: 14px; }        label.lbl_max { font-size: 12px; display:block; text-align:center; }
      input.inv_inp { height: 23px; } 
      input.inv_inp_max { width: 100%; text-align:center; }
  </style>
@endsection
@section('content')
 <div class="w-100 text-right mb-3">
     <h5 class="mb-0 float-left" >Sale Invoice Management</h5>
     <button data-toggle="collapse" data-target="#add_new" class="btn btn-primary btn-sm"> Add New </button>
 </div>
        <div class="card collapse" id="add_new">
            <div class="card-header"><b>Invoice Registry</b></div>

            <div class="card-body">
            
                <div class="row"> 
                    <div class="col-md-8 mx-auto">
                        <form action="{{route('sale_invoice.submit')}}" method="post">
                            <div class="row"> @csrf
                                <div class="col-md-12">
                                        <h3 class="mb-0 text-center">ADROITLINK-UP INT'L</h3>
                                        <p class="mb-0 text-center">…Making Plans Achievable!</p>
                                        <p class="mb-0 text-center">1, kudirat-abiola way, oregun, ikeja, lagos. Nigeria.</p>
                                </div>
                                <div class="col-md-4"> <p class="mb-0"><input type="text" readonly class="inv_inp" value="{{$doc_id}}" name="doc_id" required></p> </div>
                                <div class="col-md-4">
                                    <p class="mb-0 text-center"><b>SALE INVOICE</b></p>
                                </div>
                                <div class="col-md-4"></div>
                                
                                <div class="col-md-5">
                                   <table class="w-100 mt-2"  style="">
                                       
                                       <tr> <td><label for="">Client UID</label></td> <td> 
                                                 <select name="client_id" id="client_ids" class="inv_inp" required>
                                                     <option value=""></option>
                                                     @foreach ($clients as $client)
                                                         <option value="{{$client->client_id}}">{{$client->user->username}}</option>
                                                     @endforeach
                                                 </select>
                                            </td>  </tr>
                                   
                                   </table>
       
                                   <table class="w-100"  style="" id="client_data">
                                        <tr> <td><label for="">Street Address</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
                                        <tr> <td><label for="">E-Mail</label></td> <td><input type="text" class="inv_inp"  value=""></td>  </tr>
                                        <tr> <td><label for="">Phone No</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
                                        <tr> <td><label for="">LGA</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
                                        <tr> <td><label for="">Business Place</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
                                   </table>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                   <table class="w-100 mt-2"  style="">
                                    
                                       <tr> <td><label for="">Document Date:</label></td> <td><input name="issued_at" type="text" class="inv_inp" required></td>  </tr>
                                       <tr> <td><label for="">Due Date:</label></td> <td><input name="due_date" type="text" class="inv_inp" required></td>  </tr>
                                       <tr> <td><label for="">Processing Days:</label></td> <td><input name="processing_days" type="text" class="inv_inp"></td>  </tr>
                                       <tr> <td><label for="">Payment Terms:</label></td> <td><input name="pay_terms" type="text" class="inv_inp"></td>  </tr>
                                       <tr> <td><label for="">Shipment Method:</label></td> <td><input name="ship_method" type="text" class="inv_inp"></td>  </tr>
                                       <tr> <td><label for="">Vendors VAT:</label></td> <td><input name="vat" type="text" class="inv_inp"></td>  </tr>
                                       <tr> <td><label for="">Business Period:</label></td> <td><input name="biz_period" type="text" class="inv_inp"></td>  </tr>
                                      
                                   </table>
                                </div>
       
                                <div class="col-md-12 pt-2">
                                   <table class="w-100" >
                                       <tr><td colspan="3"><label for="" class="lbl_max">BUSINESS CENTER</label></td>  <td><input type="text" class="inv_inp" name="business_center"></td><td></td><td><label for="" class="lbl_max">DEPT/UNIT COST</label></td><td><input type="text" class="inv_inp" name="dept_unit_cost"></td><td></td> <td><label for="" class="lbl_max">BUSINESS CODE</label></td><td><input type="text" class="inv_inp" name="business_code" required></td></tr>
                                   </table>
                                    <table class="w-100" >
                                       <tr><td width="5%"><label class="lbl_max">BUDGET</label></td><td width="20%"><label class="lbl_max">DESCRIPTION</label></td><td width="5%"><label class="lbl_max">QUANTITY</label></td><td width="5%"><label class="lbl_max">UNIT COST</label></td><td width="5%"><label class="lbl_max">DISCOUNT</label></td><td width="5%"><label class="lbl_max">VAT</label></td><td width="5%"><label class="lbl_max">WHT</label></td> <td width="5%"><label class="lbl_max">AMOUNT</label></td> <td width="10%"><label class="lbl_max">LINE TOTAL</label></td></tr>
                                    @for ($i =1; $i < 7; $i++)
                                       
                                        <tr>
                                            <td><input type="text" class="inv_inp_max" name="budget_{{$i}}"></td>
                                            <td><input type="text" class="inv_inp_max" name="description_{{$i}}" ></td>
                                            <td><input type="text" class="inv_inp_max" name="quantity_{{$i}}"></td>
                                            <td><input type="text" class="inv_inp_max" name="unit_cost_{{$i}}"></td>
                                            <td><input type="text" class="inv_inp_max" name="discount_{{$i}}"></td>
                                            <td><input type="text" class="inv_inp_max" name="vat_{{$i}}"></td>
                                            <td><input type="text" class="inv_inp_max" name="wht_{{$i}}"></td> 
                                            <td><input type="text" class="inv_inp_max" name="amount_{{$i}}"></td> 
                                            <td><input type="text" class="inv_inp_max" name="line_total_{{$i}}"></td>
                                       </tr>
                                       
                                    @endfor
                                   </table>
                               </div>
       
                               <div class="col-md-5">
                                   <table class="w-100 mt-2"  style="">
                                       
                                       <tr> <td><label for="" class="lbl_max">CURRENCY CODE</label></td> <td><input type="text" class="inv_inp" name="currency_code"></td>  </tr>
                                       
                                   </table>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                   <table class="w-100 mt-2 mb-2"  style="">
                                       
                                       <tr> <td><label for="" class="lbl_max">SUB TOTAL</label></td> <td><input type="text" class="inv_inp" name="sub_total"></td>  </tr>
                                       <tr> <td><label for="" class="lbl_max">DISCOUNT</label></td> <td><input type="text" class="inv_inp" name="discount"></td>  </tr>
                                       <tr> <td><label for="" class="lbl_max">WITHOLDING TAX</label></td> <td><input type="text" class="inv_inp" name="with_holding_tax"></td>  </tr>
                                       <tr> <td><label for="" class="lbl_max">WITHHELD VAT</label></td> <td><input type="text" class="inv_inp" name="with_held_vat"></td>  </tr>
                                       <tr> <td><label for="" class="lbl_max">TOTAL</label></td> <td><input type="text" class="inv_inp" name="total_in_words"></td>  </tr>
                                     
                                   </table>
                                </div>
                                <div class="col-md-2">
                                   <label for="" class="lbl_max">TOTAL IN WORDS</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="inv_inp_max">
                                </div>
                                <div class="col-md-12">
                                    <table class="w-100">
                                          <tr> <td><label for="">Receiving Bank Name</label> </td> <td><input type="text" class="inv_inp_max" name="receiving_bank_name"></td> <td></td> <td><label for="">ALT Bank Name</label></td> <td><input type="text" class="inv_inp_max" name="alt_bank_name"></td> </tr>
                                          <tr> <td><label for="">Receiving Bank Account</label></td> <td><input type="text" class="inv_inp_max" name="receiving_bank_acct"></td> <td></td> <td><label for="">ALT Bank Acct</label></td> <td><input type="text" class="inv_inp_max" name="alt_bank_acct"></td> </tr>
                                    </table>
                                </div> 
                                <div class="col-md-12">
                                    <table class="w-100 mb-2">
                                        <tr> <td colspan="8"><label for="">Recipient</label></td>   </tr>
                                        <tr> <td><label for="">Requested By</label></td> <td><input type="text" class="inv_inp_max" name="requested_by"></td> <td></td> <td>Signature</td> <td><input type="text" class="inv_inp_max" name="requested_by_sign"></td> <td></td> <td>Date</td> <td><input type="text" class="inv_inp_max" name="date_requested"></td> </tr>
                                        <tr> <td><label for="">Prepared By	</label></td> <td><input type="text" class="inv_inp_max" name="prepared_by"></td> <td></td> <td>Signature</td> <td><input type="text" class="inv_inp_max" name="prepared_by_sign"></td> <td></td> <td>Date</td> <td><input type="text" class="inv_inp_max" name="date_prepared"></td> </tr>
                                        {{-- <tr> <td colspan="8"><label for="">Authourization</label></td>  </tr>
                                        <tr> <td><label for="">Approved By	</label></td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Signature</td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Date</td> <td><input type="text" class="inv_inp_max" ></td> </tr>
                                        <tr> <td><label for="">Approved By	</label></td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Signature</td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Date</td> <td><input type="text" class="inv_inp_max" ></td> </tr>
                                        <tr> <td><label for="">Approved By	</label></td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Signature</td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Date</td> <td><input type="text" class="inv_inp_max" ></td> </tr> --}}
                                    </table>
                                </div>
                                <div class="col-md-12 text-center border-top">
                                    <button class="btn btn-primary mt-5 w-100" type="submit">Submit</button>
                                </div>
       
       
       
                            </div>
                        </form>
                         
                        
                    </div> 
                </div>

            </div>
        </div>

     

  





        <div class="card">
            <div class="card-header"> <b>Recorded Invoices</b></div>
            <div class="card-body table-responsive">
                <table id="" class="table table-bordered table-striped" style="width:1200px;">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Date Issued</th>
                      <th>Due Date</th>
                      <th>Client UID</th>
                      <th>Payment Terms</th>
                      <th>Vendors VAT</th>
                      <th>Business Period</th>
                      <th>Business Code</th> 
                      <th>Currency Code</th> 
                      <th>Sub Total</th>
                      <th>Discount</th>
                      <th>With-H Tax</th>
                      <th>With-H Vat</th>
                      <th>Total</th>
                      <th></th> 
                    </tr>
                    
                    </thead>
                   <tbody>
                 {{-- loop out agents here --}}
                  
                @foreach($trans_docs as $trans_doc) 
                   <tr class=""> 
                   <td> {{$trans_doc->doc_id}} </td>  
                   <td> {{$trans_doc->issued_at}} </td>
                   <td> {{$trans_doc->due_date}} </td>
                   <td> {{$trans_doc->client->user->username}} </td>
                   <td> {{$trans_doc->payment_terms}} </td>
                   <td> {{$trans_doc->vendor_vat}} </td>
                   <td> {{$trans_doc->business_period}} </td>
                   <td> {{$trans_doc->business_code}} </td>
                   <td> {{$trans_doc->currency_code}} </td>
                   <td> {{$trans_doc->sub_total}} </td>
                   <td> {{$trans_doc->discount}} </td>
                   <td> {{$trans_doc->with_holding_tax}} </td> 
                   <td> {{$trans_doc->with_held_vat}} </td> 
                   <td> {{$trans_doc->total_in_figure}} </td>    
                   <td>  <a class="btn btn-primary btn-xs btn-block" href="{{route('sale_invoice.profile', ['doc_id'=>$trans_doc->doc_id])}}"> <span class="fa fa-user"></span> Invoice Profile</a> </td> 
                </tr>
                @endforeach
                    </tbody>
                    
                  </table>
            </div>
        </div>







 
     <div class="modal fade" id="purchase_invoice_modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            {{-- {!! Form::open(['route' => ['invoice.submit_purchase'], 'files' => false, 'id'=>'submit_purchase']) !!} --}}
             <div class="modal-header bg-secondary">  <input type="hidden" name="_method" value="PUT">
              <h4 class="modal-title text-white"> <span class="fa fa-edit"></span> SALE INVOICE </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span> 
              </button>
            </div>
            <div class="modal-body"> 
              
            </div>
            <div class="modal-footer justify-content-between bg-light">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
             {{-- {!! Form::close() !!} --}}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> 
      <!-- /.modal -->
  <script>
    $('#client_ids').change(function() { //   console.log($(this).val());
    var client_id = $(this).val();  

    var data2send={'client_id':client_id};       console.log(data2send);
    $('#client_data').html('<div class="text-center p-5 mt-4 bg-white"> <img src=" {{ asset('images/preloader1.gif') }} " class="img img-fluid mx-auto" alt=""> </div>');
    
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') } });
    $.ajax({
        url:"{{ route('sale_invoice.fetch_client_data_inv') }}",
        dataType:"text",
        method:"GET",
        data:data2send,
        success:function(resp) {
            $('#client_data').html(resp);
        }
    }); 
}); 
  </script>

@endsection
