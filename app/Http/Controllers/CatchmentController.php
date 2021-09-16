<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Catchment;
use App\Models\Group;

class CatchmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    
     public function __construct() {
        $this->middleware('auth');
        parent::__construct();
    }



    public function index()
    { 
        $catchments = Catchment::all();           $state_datas = array();
        $states = json_decode(file_get_contents( asset('states.json') ));
        foreach ($states as $key => $state) {   
            $state_datas[] = [$key, $state->state->name];
        }   // dd($state_names);

        return view('admin.catchments', ['catchments'=>$catchments, 'state_datas'=>$state_datas]); 
    } 


    public function ajax_fetch_lga(Request $request)
    {   $st = explode('x-x', $request->state)[1];
        $states = json_decode(file_get_contents( asset('states.json') ));
        foreach ($states as $key => $state) {  
            if ($st == $state->state->name) {
              $st_index = $key;   break;  // dd("$key - $st");
            }
        }    
        $lgas = $states[$st_index]->state->locals;  // dd($lgas);
        return view('admin.lga_ajax_fetch')->with('lgas', $lgas); 
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
        $data = request()->validate([
            'state' => ['required', 'string'],
            'lga' => ['required', 'string'],
            'locations' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:500'],
        ]); 

        $sql = DB::select("show table status like 'catchments'");
        $next_id = 100 + $sql[0]->Auto_increment; $out=0; $in=0;
        $catchment_id = $next_id.'-'.substr($data['lga'], 0,3).'-';
        $location_ard = explode(',', $data['locations']);// dd($location_ard);
        foreach ($location_ard as $key => $location) { $out++;
            if (trim($location)!='') { $in++;
                $catchment_id .=$this->first_l(trim($location));
            }
        }  $catchment_id = strtoupper($catchment_id);
           
        $state_index = explode('x-x', $data['state'])[0];
        $state_name  = explode('x-x', $data['state'])[1];

        $catchment = Catchment::create([  
            'catchment_id' => $catchment_id,
            'locations' => $data['locations'],
            'lga' => $data['lga'], 
            'state_name' => $state_name, 
            'state_index' => $state_index, 
            'description' => $data['description']
        ]); 

        return redirect()->route('catchment.index')->with('success', 'New Catchment ('.$catchment_id.') Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    private function first_l($string)
    {
       $first_l = substr($string, 0,1);
       return $first_l;
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


    public function trash($id)
    {
        $catchment = Catchment::findOrFail($id);
        return view('admin.catchment_trash')->with('catchment',$catchment);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'catchment_id' => ['required', 'string', 'max:22', 'unique:catchments,catchment_id,'.$id.'id'],
            'group_id' => ['required', 'integer', 'max:100'],
            'locations' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:100']
        ]); 

         Catchment::where('id', $id)
         ->update([  
            'catchment_id' => $data['catchment_id'],
            'group_id' => $data['group_id'],
            'locations' => $data['locations'],
            'description' => $data['description']
        ]); 

        return redirect()->route('catchment.index', ['catchment'=>$id])->with('success', 'Catchment updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catchment = Catchment::find($id); 
        $catchment->delete();
        return redirect()->route('catchment.index')->with('success', 'Catchment moved to trash successfully'); 
    }
}
