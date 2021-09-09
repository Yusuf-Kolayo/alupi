<?php
 
namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Client;
use App\Models\User; 
use App\Models\Product_purchase_session;
use App\Models\Transaction; 
use App\Models\Product;  


class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
       //    
    }


        
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client_id)
    {
        //   
    }



    public function edit_trans_ajax_fetch (Request $request)
    {   
        $trans_id = $request['trans_id'];  
        $transaction = Transaction::where('trans_id', $trans_id)->firstOrFail();  // dd($transaction); 
        
        return view('agent.edit_trans_ajax_fetch', compact('transaction')); 
    }


    public function delete_trans_ajax_fetch (Request $request)
    {   
        $trans_id = $request['trans_id'];  
        $transaction = Transaction::where('trans_id', $trans_id)->firstOrFail();  // dd($transaction); 
        
        return view('agent.delete_trans_ajax_fetch', compact('transaction')); 
    }
 
  


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }





    
    public function pps_details_ajax_fetch(Request $request)
    {   
        $pps_id = $request['pps_id'];  //  dd($pps_id);
        $product_purchase_session = Product_purchase_session::where('pps_id', $pps_id)->firstOrFail(); // dd($client);   

        return view('agent.pps_details_ajax_fetch', compact('product_purchase_session'));   
    } 


    public function pps_delete_ajax_fetch(Request $request)
    {   
        $pps_id = $request['pps_id'];  //  dd($pps_id);
        $product_purchase_session = Product_purchase_session::where('pps_id', $pps_id)->firstOrFail(); // dd($client);   

        return view('agent.pps_delete_ajax_fetch', compact('product_purchase_session'));   
    } 


    public function trans_details_ajax_fetch(Request $request)
    {   
        $pps_id = $request['pps_id'];   // dd($trans_id);
        $product_purchase_session = Product_purchase_session::where('pps_id', $pps_id)->firstOrFail(); // dd($client);    
    
        return view('agent.trans_details_ajax_fetch', compact('product_purchase_session'));   
    } 


    public function new_purchase_session(Request $request)
    {   
        $client_id = $request['client_id'];  $product_id = $request['product_id']; 
       
        $sql = DB::select("show table status like 'product_purchase_sessions'");
        $next_id = 100 + $sql[0]->Auto_increment;   
        $pps_id = 'PPS-'.$next_id;   $status = 'pending';
        $agent_id = auth()->user()->user_id; // dd($agent_id);

        $user = Product_purchase_session::create ([
            'pps_id' => $pps_id,
            'product_id' => $product_id,
            'client_id' => $client_id,
            'agent_id' => $agent_id,
            'status' =>  $status 
        ]);
        
        // $this->show($client_id, 'New product session opened for this client');
        return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'New product purchase session opened for this client');
    }



    public function approve_session(Request $request)
    {   
        $pps_id = $request['pps_id'];   $client_id = $request['client_id'];   
        $new_status = 'ongoing'; //  dd($pps_id);
        DB::table('product_purchase_sessions')->where('pps_id', $pps_id)
        ->update(['status' => $new_status]); 

        return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'Product purchase session ['.$pps_id.'] approved for this client');
    }



    public function pause_session(Request $request)
    {   
        $pps_id = $request['pps_id'];   $client_id = $request['client_id'];   
        $new_status = 'paused'; //  dd($pps_id);
        DB::table('product_purchase_sessions')->where('pps_id', $pps_id)
        ->update(['status' => $new_status]); 

        return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'Product purchase session ['.$pps_id.'] paused for this client');
    }



    public function delete_product_session(Request $request)
    {   
        $pps_id = $request['pps_id'];     // dd($pps_id);
        $product_purchase_session = Product_purchase_session::where('pps_id', $pps_id)->firstOrFail();
        $client_id = $product_purchase_session->client_id;
        DB::table('product_purchase_sessions')->where('pps_id', $pps_id)
        ->delete(); 

        return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'Product purchase session ['.$pps_id.'] and related transactions deleted successfully for this client');
    }



    public function create_deposit(Request $request)
    {   // dd($request);
        $pps_id = $request['pps_id'];   $amount = $request['amount'];   $type = $request['type'];      
        $product_purchase_session = Product_purchase_session::where('pps_id', $pps_id)->firstOrFail();
        $client_id = $product_purchase_session->client_id;    
        $product_id = $product_purchase_session->product_id; 
        $agent_id = auth()->user()->user_id; // dd($agent_id);

        $prev_balance = Transaction::where('pps_id', $pps_id)->sum('amount');
        $new_balance = $prev_balance + $amount;

        $sql = DB::select("show table status like 'transactions'");
        $next_id = 100 + $sql[0]->Auto_increment;   $trans_id = 'TRN-'.$next_id; 
        
        $data = request()->validate([
            'amount' => ['required', 'string', 'max:55'],
            'type' => ['required', 'string', 'max:55']
        ]);  

        $user = Transaction::create ([
            'trans_id' => $trans_id, 
            'client_id' =>  $client_id,
            'product_id' => $product_id,
            'pps_id' =>  $pps_id, 
            'agent_id' =>  $agent_id,
            'amount' => $amount,
            'new_bal' => $new_balance,
            'type' => $type
        ]);
        
        return redirect()->route('client.show', ['client'=>$client_id])->with('success', number_format($amount).' deposited successfully for this client');
    }







 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $trans_id)
    {
        // dd ($trans_id);
        $data = request()->validate([ 
            'amount' => ['required', 'string', 'max:55'],
            'type' => ['required', 'string', 'max:55']
        ]); 
 
            $transaction = Transaction::where('trans_id', $trans_id)->firstOrFail();         
            $pps_id = $transaction->pps_id;     $client_id = $transaction->client_id;
            $prev_balance = Transaction::where('pps_id', $pps_id)
            ->where('trans_id','<>',$trans_id)->sum('amount');      // dd($prev_balance);
            $new_bal = $prev_balance + $data['amount'];                                   

            if ($transaction) {
 
                DB::table('transactions')->where('trans_id', $trans_id)
                ->update([
                    'amount' => $data['amount'], 
                    'new_bal' => $new_bal,
                    'type' => $data['type']
                ]);  
                return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'Transaction: ['.$trans_id.'] updated successfully.');
            }   else {   return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'An error occurred, pls try again ...'); }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($trans_id)
    {
       $transaction = Transaction::where('trans_id', $trans_id)->firstOrFail();
       $client_id = $transaction->client_id;

       if ($transaction) {
           $deleted_rows = Transaction::where('trans_id', $trans_id)->delete();
           return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'Transaction: ['.$trans_id.'] deleted successfully.');
        } else {
            return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'An error occurred, pls try again ...');
        }
    }
}