<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator; 
use App\Models\Client;
use App\Models\Vendor;
use App\Models\Trans_doc;  
use App\Models\Trans_docs_detail;  


class InvoiceController extends BaseController
{

    
    public function __construct() {
       $this->middleware('auth');
       parent::__construct();
    }
 


    // PURCHASE INVOICE


    public function purchase_invoice_index () 
    {  
       $vendors = Vendor::all();
       $trans_docs = Trans_doc::where('doc_type', 'purchase invoice')->simplePaginate(10);

      //  $business_code = array();
      //  $business_code['Management Cost'] = ['Registrations and renewals','Advancement','Licensing and permits','Royalties','Gifts','Awards','Executives wages and benefits','Rentage','Light Bills','Water Bills','Office Equipments','Business Maintaince','Executive management meetings','Professional fee','Entertainment','Documentations','Instrumentations','Professional fee','Welfare','Meals','Travel'];
      //  $business_code['Human Resource Management Cost'] = ['HRM meetings','Recruitment cost','Transfer support cost','Welfare','Meals','Travel','Salary Net pay','Commission','Bonuses','Allowances','Awards','Gifts','Paid time off','Overtime pay','Employee retirement plans','Employee education plans','Employee benefit programs','Membership dues (including union or other professional affiliations)','Business interruption insurance','Business meals','Employee gifts','Education','Seminars','Webinars and conferences','Classes or workshops to increase a skill','Subscriptions to specific industry publications','Books related to your industry','Documentations','Research expenses','Professional fee','Professional services','Rentages','Entertainment','Business insurance','Group health','Vision care','Dental and life insurance','Property insurance to cover the building, furniture and equipment','Liability coverage'];
      //  $business_code['Legal Cost'] = ['Legal meetings','Licensing or other permits','Gifts','Welfare','Documentations','Professional fee','Legal fees','Documentations','Instrumentations','Professional fee','Welfare','Meals','Travel'];
      //  $business_code['Account and Finance Cost'] = ['Account meetings','Finance meetings','Payroll costs','Payroll (employees and freelance help)','Bank fees and interest','Employee salary and benefits','Wages and benefits','Taxes','State income tax','Property tax (Land use dutiy charge)','Payroll tax (Payee)','Sales tax (VAT)','Fuel tax','Excise tax (WIHT)','Self-employment tax','Loan repayment and interest payment','Depreciation cost','Salary Net pay','Allowances','Commissions','Bonuses','Paid time off','Overtime pay','Awards','Gifts',''];
        
      $sql = DB::select("show table status like 'trans_docs'");  
      $next_id =  100 + $sql[0]->Auto_increment; 
      $doc_id = 'DOC-'.$next_id;
      
       return view('admin.purchase_invoice', compact('vendors','trans_docs','doc_id'));
    }


    public function fetch_vendor_data_inv (Request $request) {
      $vendor_id = $request['vendor_id'];
   
      $vendor = Vendor::where('vendor_id', $vendor_id)->first();
      return view('admin.vendor_data_inv', compact('vendor'));
    }


   public function purchase_invoice_submit (Request $request) {
        //   dd($request);
        $custom_error_messages = array (
         'issued_at' => 'document date',
         'due_date' => 'document due date', 
         'business_code' => 'Business code'
         );

         $validator = Validator::make($request->all(),
         [ 
          'issued_at' => ['required', 'string', 'max:55'],
          'due_date' => ['required', 'string', 'max:55'], 
          'business_code' => ['required', 'string', 'max:55']
         ]);
         
      $validator-> setAttributeNames($custom_error_messages);

      if ($validator->fails()) {
         //  return response()->json($validator->messages(),200);
         return back()->with(['errors'=>$validator->messages()]);
      } else {   // validation found zero errors

 
         $sql = DB::select("show table status like 'trans_docs'");  
         $next_id = 100 + $sql[0]->Auto_increment;  $doc_id = 'DOC-'.$next_id;
     
         $prepared_by_id = auth()->user()->user_id; $doc_type = 'purchase invoice';
          
         $Trans_docs = Trans_doc::create([
            'doc_id' => $doc_id,
            'doc_type' => $doc_type, 
            'issued_at' => $request['issued_at'],
            'due_date'  => $request['due_date'],
            'vendor_id' => $request['vendor_id'],
            'shipping_method' =>  $request['shipping_method'], 
            'payment_terms' =>  $request['payment_terms'], 
            'vendor_vat' =>  $request['vendor_vat'],
            'business_period' =>  $request['business_period'],
            'business_center' =>   $request['business_center'],
            'dept_unit_cost' =>  $request['dept_unit_cost'],
            'paying_bank_name' =>  $request['paying_bank_name'],
            'paying_bank_acct' =>  $request['paying_bank_acct'], 
            'business_code' =>  $request['business_code'],
            'currency_code' =>  $request['currency_code'],
            'sub_total' =>  $request['sub_total'],
            'discount' =>  $request['discount'],
            'with_holding_tax' =>  $request['with_holding_tax'],
            'with_held_vat' =>  $request['with_held_vat'],
            'total_in_figure' =>  $request['total_in_figure'],
            'total_in_words' =>  $request['total_in_words'],
            'receiving_bank_name' =>  $request['receiving_bank_name'],
            'receiving_bank_acct' =>  $request['receiving_bank_acct'], 
            'alt_bank_name' => $request['alt_bank_name'],
            'alt_bank_acct' =>  $request['alt_bank_acct'],
            'requested_by_id' =>  $request['requested_by_id'],
            'prepared_by_id' =>  $prepared_by_id,
            'approver1_id' =>  '', 
            'approver2_id' => '',            
            'approver3_id' =>  ''
        ]); 



        for ($i=1; $i <=6 ; $i++) { 
            if ($request['budget_'.$i]!=null) {
               $Trans_docs_details = Trans_docs_detail::create([
                  'doc_id' => $doc_id,
                  'budget_code' => $request['budget_'.$i], 
                  'description' => $request['description_'.$i],
                  'quantity'  => $request['quantity_'.$i],
                  'unit_cost' => $request['unit_cost_'.$i],
      
                  'discount' => $request['discount_'.$i],
                  'vat'  => $request['vat_'.$i],
                  'wht' => $request['wht_'.$i],
                  'amount' => $request['amount_'.$i],
                  'line_total' => $request['line_total_'.$i]
              ]); 
            } 
        }

          return redirect()->route('purchase_invoice.index')->with(['success'=>'Invoice recorded successfully.']);
      }
      }


      public function purchase_invoice_profile (Request $request)  {
          $doc_id = $request['doc_id'];
          $vendors = Vendor::all();
          $trans_doc = Trans_doc::where('doc_id', $doc_id)->first();
          return view('admin.purchase_invoice_profile', compact('trans_doc','vendors'));
      }
        
    















































   // SALE INVOICE
   
    
      public function sale_invoice_index () 
      {  
         $clients = Client::all();
         $trans_docs = Trans_doc::where('doc_type', 'sale invoice')->simplePaginate(10);
  
        //  $business_code = array();
        //  $business_code['Management Cost'] = ['Registrations and renewals','Advancement','Licensing and permits','Royalties','Gifts','Awards','Executives wages and benefits','Rentage','Light Bills','Water Bills','Office Equipments','Business Maintaince','Executive management meetings','Professional fee','Entertainment','Documentations','Instrumentations','Professional fee','Welfare','Meals','Travel'];
        //  $business_code['Human Resource Management Cost'] = ['HRM meetings','Recruitment cost','Transfer support cost','Welfare','Meals','Travel','Salary Net pay','Commission','Bonuses','Allowances','Awards','Gifts','Paid time off','Overtime pay','Employee retirement plans','Employee education plans','Employee benefit programs','Membership dues (including union or other professional affiliations)','Business interruption insurance','Business meals','Employee gifts','Education','Seminars','Webinars and conferences','Classes or workshops to increase a skill','Subscriptions to specific industry publications','Books related to your industry','Documentations','Research expenses','Professional fee','Professional services','Rentages','Entertainment','Business insurance','Group health','Vision care','Dental and life insurance','Property insurance to cover the building, furniture and equipment','Liability coverage'];
        //  $business_code['Legal Cost'] = ['Legal meetings','Licensing or other permits','Gifts','Welfare','Documentations','Professional fee','Legal fees','Documentations','Instrumentations','Professional fee','Welfare','Meals','Travel'];
        //  $business_code['Account and Finance Cost'] = ['Account meetings','Finance meetings','Payroll costs','Payroll (employees and freelance help)','Bank fees and interest','Employee salary and benefits','Wages and benefits','Taxes','State income tax','Property tax (Land use dutiy charge)','Payroll tax (Payee)','Sales tax (VAT)','Fuel tax','Excise tax (WIHT)','Self-employment tax','Loan repayment and interest payment','Depreciation cost','Salary Net pay','Allowances','Commissions','Bonuses','Paid time off','Overtime pay','Awards','Gifts',''];
          
        $sql = DB::select("show table status like 'trans_docs'");  
        $next_id =  100 + $sql[0]->Auto_increment; 
        $doc_id = 'DOC-'.$next_id;
        
         return view('admin.sale_invoice', compact('clients','trans_docs','doc_id'));
      }

 
 

      public function fetch_client_data_inv (Request $request) {
         $client_id = $request['client_id'];
      
         $client = Client::where('client_id', $client_id)->first();
         return view('admin.client_data_inv', compact('client'));
       }

 
       public function sale_invoice_submit (Request $request) {
         //   dd($request);
         $custom_error_messages = array (
          'issued_at' => 'document date',
          'due_date' => 'document due date', 
          'business_code' => 'Business code'
          );
 
          $validator = Validator::make($request->all(),
          [ 
           'issued_at' => ['required', 'string', 'max:55'],
           'due_date' => ['required', 'string', 'max:55'], 
           'business_code' => ['required', 'string', 'max:55']
          ]);
          
       $validator-> setAttributeNames($custom_error_messages);
 
       if ($validator->fails()) {
          //  return response()->json($validator->messages(),200);
          return back()->with(['errors'=>$validator->messages()]);
       } else {   // validation found zero errors
 
  
          $sql = DB::select("show table status like 'trans_docs'");  
          $next_id = 100 + $sql[0]->Auto_increment;  $doc_id = 'DOC-'.$next_id;
      
          $prepared_by_id = auth()->user()->user_id; $doc_type = 'sale invoice';
           
          $Trans_docs = Trans_doc::create([
             'doc_id' => $doc_id,
             'doc_type' => $doc_type, 
             'issued_at' => $request['issued_at'],
             'due_date'  => $request['due_date'],
             'client_id' => $request['client_id'],
             'shipping_method' =>  $request['shipping_method'], 
             'payment_terms' =>  $request['payment_terms'], 
             'vendor_vat' =>  $request['vendor_vat'],
             'business_period' =>  $request['business_period'],
             'business_center' =>   $request['business_center'],
             'dept_unit_cost' =>  $request['dept_unit_cost'],
             'paying_bank_name' =>  $request['paying_bank_name'],
             'paying_bank_acct' =>  $request['paying_bank_acct'], 
             'business_code' =>  $request['business_code'],
             'currency_code' =>  $request['currency_code'],
             'sub_total' =>  $request['sub_total'],
             'discount' =>  $request['discount'],
             'with_holding_tax' =>  $request['with_holding_tax'],
             'with_held_vat' =>  $request['with_held_vat'],
             'total_in_figure' =>  $request['total_in_figure'],
             'total_in_words' =>  $request['total_in_words'],
             'receiving_bank_name' =>  $request['receiving_bank_name'],
             'receiving_bank_acct' =>  $request['receiving_bank_acct'], 
             'alt_bank_name' => $request['alt_bank_name'],
             'alt_bank_acct' =>  $request['alt_bank_acct'],
             'requested_by_id' =>  $request['requested_by_id'],
             'prepared_by_id' =>  $prepared_by_id,
             'approver1_id' =>  '', 
             'approver2_id' => '',            
             'approver3_id' =>  ''
         ]); 
 
 
 
         for ($i=1; $i <=6 ; $i++) { 
             if ($request['budget_'.$i]!=null) {
                $Trans_docs_details = Trans_docs_detail::create([
                   'doc_id' => $doc_id,
                   'budget_code' => $request['budget_'.$i], 
                   'description' => $request['description_'.$i],
                   'quantity'  => $request['quantity_'.$i],
                   'unit_cost' => $request['unit_cost_'.$i],
       
                   'discount' => $request['discount_'.$i],
                   'vat'  => $request['vat_'.$i],
                   'wht' => $request['wht_'.$i],
                   'amount' => $request['amount_'.$i],
                   'line_total' => $request['line_total_'.$i]
               ]); 
             } 
         }
 
           return redirect()->route('sale_invoice.index')->with(['success'=>'Invoice recorded successfully.']);
       }
       }




       public function sale_invoice_profile (Request $request)  {
         $doc_id = $request['doc_id'];
         $clients = Client::all();
         $trans_doc = Trans_doc::where('doc_id', $doc_id)->first();
         return view('admin.sale_invoice_profile', compact('trans_doc','clients'));
     }
       
}
