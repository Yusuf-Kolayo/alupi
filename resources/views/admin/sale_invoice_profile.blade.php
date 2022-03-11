@extends('layouts.main')
@section('headers')
  <style>
      label { font-size: 14px; }        label.lbl_max { font-size: 12px; display:block; text-align:center; }
      input.inv_inp { height: 23px; } 
      input.inv_inp_max { width: 100%; text-align:center; }
      .border {padding: 5px; border: 1px solid #ccc;}
  </style>
@endsection
@section('content')
 {{-- <div class="w-100 text-right mb-3">
     <h5 class="mb-0 float-left" >Invoice Profile</h5>
 </div> --}}
        

    





        <div class="card">
            <div class="card-header"> <b>Invoice Profile</b></div>
            <div class="card-body table-responsive">
                <div class="row"> 
                    <div class="col-md-8">
                        <form class="border" action="{{route('purchase_invoice.submit')}}" method="post">
                            <div class="row"> @csrf
                                <div class="col-md-12">
                                        <h3 class="mb-0 text-center">ADROITLINK-UP INT'L</h3>
                                        <p class="mb-0 text-center">…Making Plans Achievable!</p>
                                        <p class="mb-0 text-center">1, kudirat-abiola way, oregun, ikeja, lagos. Nigeria.</p>
                                </div>
                                <div class="col-md-4"> <p class="mb-0"><input type="text" readonly class="inv_inp" value="{{$trans_doc->doc_id}}" name="doc_id" required></p>  </div>
                                <div class="col-md-4">
                                    <p class="mb-0 text-center"><b>SALE INVOICE</b></p>
                                </div>
                                <div class="col-md-4"></div>
                                
                                <div class="col-md-5">
                                    <table class="w-100 mt-2"  style="">
                                        
                                        <tr> <td><label for="">Client UID</label></td> <td> 
                                            <select name="client_id" id="client_ids" class="inv_inp" required>
                                                <option value="{{$trans_doc->client_id}}">{{$trans_doc->client->user->username}}</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{$client->client_id}}">{{$client->user->username}}</option>
                                                @endforeach
                                            </select>
                                    </td>  </tr>
                                    
                                    </table>
        
                                    <table class="w-100"  style="" id="client_data">
                                        <tr> <td><label for="">Street Address</label></td> <td><input type="text" class="inv_inp" value="{{$trans_doc->client->address}}"></td>  </tr>
                                        <tr> <td><label for="">E-Mail</label></td> <td><input type="text" class="inv_inp"  value="{{$trans_doc->client->user->email}}"></td>  </tr>
                                        <tr> <td><label for="">Phone No</label></td> <td><input type="text" class="inv_inp" value="{{$trans_doc->client->phone}}"></td>  </tr>
                                        <tr> <td><label for="">LGA</label></td> <td><input type="text" class="inv_inp" value="{{$trans_doc->client->agent->catchment->lga}}"></td>  </tr>
                                        <tr> <td><label for="">Business Place</label></td> <td><input type="text" class="inv_inp" value=""></td>  </tr>
                                    </table>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                   <table class="w-100 mt-2"  style="">
                                    
                                       <tr> <td><label for="">Document Date:</label></td> <td><input name="issued_at" type="text" value="{{$trans_doc->issued_at}}" class="inv_inp" required></td>  </tr>
                                       <tr> <td><label for="">Due Date:</label></td> <td><input name="due_date" type="text" class="inv_inp" value="{{$trans_doc->due_date}}" required></td>  </tr>
                                       <tr> <td><label for="">Processing Days:</label></td> <td><input name="processing_days" type="text" value="" class="inv_inp"></td>  </tr>
                                       <tr> <td><label for="">Payment Terms:</label></td> <td><input name="pay_terms" type="text" value="{{$trans_doc->payment_terms}}" class="inv_inp"></td>  </tr>
                                       <tr> <td><label for="">Shipment Method:</label></td> <td><input name="ship_method" value="{{$trans_doc->shipping_method}}" type="text" class="inv_inp"></td>  </tr>
                                       <tr> <td><label for="">Vendors VAT:</label></td> <td><input name="vat" type="text" value="{{$trans_doc->vendor_vat}}" class="inv_inp"></td>  </tr>
                                       <tr> <td><label for="">Business Period:</label></td> <td><input name="biz_period" type="text" value="{{$trans_doc->business_period}}" class="inv_inp"></td>  </tr>
                                      
                                   </table>
                                </div>
       
                                <div class="col-md-12 pt-2">
                                   <table class="w-100" >
                                       <tr>
                                            <td colspan="3"><label for="" class="lbl_max">BUSINESS CENTER</label></td> <td><input type="text" class="inv_inp" name="business_center" value="{{$trans_doc->business_center}}"></td>
                                            <td></td><td><label for="" class="lbl_max">DEPT/UNIT COST</label></td> <td><input type="text" class="inv_inp" name="dept_unit_cost" value="{{$trans_doc->dept_unit_cost}}"></td>
                                            <td></td> <td><label for="" class="lbl_max">BUSINESS CODE</label></td> <td><input type="text" class="inv_inp" name="business_code" required value="{{$trans_doc->business_code}}"></td>
                                        </tr>
                                   </table>
                                    <table class="w-100" >
                                       <tr>
                                            <td width="5%"><label class="lbl_max">BUDGET</label></td><td width="20%"><label class="lbl_max">DESCRIPTION</label></td>
                                            <td width="5%"><label class="lbl_max">QUANTITY</label></td><td width="5%"><label class="lbl_max">UNIT COST</label></td>
                                            <td width="5%"><label class="lbl_max">DISCOUNT</label></td><td width="5%"><label class="lbl_max">VAT</label></td>
                                            <td width="5%"><label class="lbl_max">WHT</label></td> <td width="5%"><label class="lbl_max">AMOUNT</label></td> 
                                            <td width="10%"><label class="lbl_max">LINE TOTAL</label></td>
                                        </tr>
                                    
                                    @php $i=0; @endphp
                                    @foreach ($trans_doc->trans_doc_details as $trans_doc_detail)
                                    @php $i++; @endphp
                                        <tr>
                                            <td><input type="text" class="inv_inp_max" name="budget_{{$i}}" value="{{$trans_doc_detail->budget_code}}"></td>
                                            <td><input type="text" class="inv_inp_max" name="description_{{$i}}" value="{{$trans_doc_detail->description}}" ></td>
                                            <td><input type="text" class="inv_inp_max" name="quantity_{{$i}}" value="{{$trans_doc_detail->quantity}}"></td>
                                            <td><input type="text" class="inv_inp_max" name="unit_cost_{{$i}}" value="{{$trans_doc_detail->unit_cost}}"></td>
                                            <td><input type="text" class="inv_inp_max" name="discount_{{$i}}" value="{{$trans_doc_detail->discount}}"></td>
                                            <td><input type="text" class="inv_inp_max" name="vat_{{$i}}" value="{{$trans_doc_detail->vat}}"></td>
                                            <td><input type="text" class="inv_inp_max" name="wht_{{$i}}" value="{{$trans_doc_detail->wht}}"></td> 
                                            <td><input type="text" class="inv_inp_max" name="amount_{{$i}}" value="{{$trans_doc_detail->amount}}"></td> 
                                            <td><input type="text" class="inv_inp_max" name="line_total_{{$i}}" value="{{$trans_doc_detail->line_total}}"></td>
                                        </tr>
                                    @endforeach
                                    @php $n=7-$i; @endphp
                                    @for ($i =$i; $i < $n; $i++)
                                       
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
                                       
                                       <tr> <td><label for="" class="lbl_max">CURRENCY CODE</label></td> <td><input type="text" class="inv_inp" name="currency_code" value="{{$trans_doc->currency_code}}"></td>  </tr>
                                       
                                   </table>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                   <table class="w-100 mt-2 mb-2"  style="">
                                       
                                       <tr> <td><label for="" class="lbl_max">SUB TOTAL</label></td> <td><input type="text" class="inv_inp" name="sub_total" value="{{$trans_doc->sub_total}}"></td>  </tr>
                                       <tr> <td><label for="" class="lbl_max">DISCOUNT</label></td> <td><input type="text" class="inv_inp" name="discount" value="{{$trans_doc->discount}}"></td>  </tr>
                                       <tr> <td><label for="" class="lbl_max">WITHOLDING TAX</label></td> <td><input type="text" class="inv_inp" name="with_holding_tax" value="{{$trans_doc->with_holding_tax}}"></td>  </tr>
                                       <tr> <td><label for="" class="lbl_max">WITHHELD VAT</label></td> <td><input type="text" class="inv_inp" name="with_held_vat" value="{{$trans_doc->with_held_vat}}"></td>  </tr>
                                       <tr> <td><label for="" class="lbl_max">TOTAL</label></td> <td><input type="text" class="inv_inp" name="total_in_figure" value="{{$trans_doc->total_in_figure}}"></td>  </tr>
                                     
                                   </table>
                                </div>
                                <div class="col-md-2">
                                   <label for="" class="lbl_max">TOTAL IN WORDS</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="inv_inp_max" value="{{$trans_doc->total_in_words}}">
                                </div>
                                <div class="col-md-12">
                                    <table class="w-100">
                                          <tr> <td><label for="">Receiving Bank Name</label> </td> <td><input type="text" class="inv_inp_max" name="receiving_bank_name" value="{{$trans_doc->receiving_bank_name}}"></td> <td></td> <td><label for="">ALT Bank Name</label></td> <td><input type="text" class="inv_inp_max" name="alt_bank_name" value="{{$trans_doc->alt_bank_name}}"></td> </tr>
                                          <tr> <td><label for="">Receiving Bank Account</label></td> <td><input type="text" class="inv_inp_max" name="receiving_bank_acct" value="{{$trans_doc->receiving_bank_acct}}"></td> <td></td> <td><label for="">ALT Bank Acct</label></td> <td><input type="text" class="inv_inp_max" name="alt_bank_acct" value="{{$trans_doc->alt_bank_acct}}"></td> </tr>
                                    </table>
                                </div> 
                                <div class="col-md-12">
                                    <table class="w-100 mb-2">
                                        <tr> <td colspan="8"><label for="">Recipient</label></td>   </tr>
                                        <tr> <td><label for="">Requested By</label></td> <td><input type="text" class="inv_inp_max" name="requested_by" value="{{$trans_doc->requested_by_id}}"></td> <td></td> <td>Signature</td> <td><input type="text" class="inv_inp_max" name="requested_by_sign"></td> <td></td> <td>Date</td> <td><input type="text" class="inv_inp_max" name="date_requested" value=""></td> </tr>
                                        <tr> <td><label for="">Prepared By	</label></td> <td><input type="text" class="inv_inp_max" name="prepared_by" value="{{$trans_doc->prepared_by_id}}"></td> <td></td> <td>Signature</td> <td><input type="text" class="inv_inp_max" name="prepared_by_sign"></td> <td></td> <td>Date</td> <td><input type="text" class="inv_inp_max" name="date_prepared"></td> </tr>
                                        {{-- <tr> <td colspan="8"><label for="">Authourization</label></td>  </tr>
                                        <tr> <td><label for="">Approved By	</label></td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Signature</td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Date</td> <td><input type="text" class="inv_inp_max" ></td> </tr>
                                        <tr> <td><label for="">Approved By	</label></td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Signature</td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Date</td> <td><input type="text" class="inv_inp_max" ></td> </tr>
                                        <tr> <td><label for="">Approved By	</label></td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Signature</td> <td><input type="text" class="inv_inp_max" ></td> <td></td> <td>Date</td> <td><input type="text" class="inv_inp_max" ></td> </tr> --}}
                                    </table>
                                </div>
                               
       
       
       
                            </div>
                        </form>
                         
                        
                    </div>
                    <div class="col-md-4">
                        <div class="border">
                            <a class="btn btn-primary btn-block " href="">Update Document</a>
                            <a class="btn btn-danger btn-block " href="">Delete Document</a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>







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
