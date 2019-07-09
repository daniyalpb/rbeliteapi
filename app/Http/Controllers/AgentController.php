<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Validator;
use Redirect;
use Session;
use URL;
use Mail;
use App\library\Pagination ;

class AgentController extends Controller{
       
        public function agent_list(){
          $rto=DB::select('call sp_rto_master()');
          $agent_m=DB::select('call sp_agent_master()');
          return view('dashboard.agent_list',['rto'=>$rto,'agent_m'=>$agent_m]);    
        }

        public function getrtofieldvalue(Request $req){
          $data = DB::select('call GET_RTO_DATA(?)',array($req->RequestID));
          return $data;
        }

        public function agent_save(Request $req){    
          $error=null;
          try{   
   	         $val =Validator::make($req->all(), 
   	         [
            'ag_name' => 'required',
            'ag_address' => 'required',
            'ag_contact_no' => 'required|regex:/^[0-9]{10}+$/',
            'ag_email' =>  'required|email|unique:agent_master',
            'password'=> 'required|min:6',
            'confirm_password'=> 'required|min:6|same:password',
            'rto_id' =>'required'
            ]);

           if ($val->fails()){
              return response()->json($val->messages(), 200);
           }else{
              $sessionid = Session::get('id');
              $data= DB::select('call Insert_Agent_master(?,?,?,?,?,?)',array($req->ag_name,$req->ag_address,$req->ag_contact_no,$req->ag_email,$req->password,$sessionid));
              $agentid = $data[0]->id;
              if($agentid != null && $agentid != ''){
                  foreach ($req->rto_id as $key => $n){
                  $rto= DB::insert('call insert_tro_agent(?,?)',array($agentid,$n));
                } 
              }          
        	   $error=0; 	
           } 
          }catch (Exception $e){
               $error=1;                 
            }
            return $error;
        }

  public  function mastercard(){
    $pagin=new Pagination();

    $count=DB::table("elite_card_master")->select('inc')->get();
    if(isset($_GET["search"])){
          $page = (int)$_GET["search"];
    }else{
        $page = 1;
    }

    $setLimit = 10;
    $pageLimit = ($page * $setLimit) - $setLimit;
    $pagina=$pagin->displayPaginationBelow($setLimit,$page,count($count));
    $card=DB::select('call sp_elite_card_master(?,?)',array($pageLimit,$setLimit));
    $company_master=DB::table("company_master")->select('id','name')->get();
    return view('dashboard.elite_card',['card'=>$card,'company_master'=>$company_master,'count'=>$count,'pagina'=>$pagina]);
  }

  public function elite_save(Request $req){
    $error=null;
    try{   
     $lst_id=DB::table('elite_card_master')->select('serial_card')->orderBy('serial_card', 'DESC')->first();
     $ins=0;
     $var =(int)$req->numb; 
     if($lst_id){
       $ins=$lst_id->serial_card;
     }else{
        $ins=0;
     }
  for($i=0;$i<$var;$i++){  
     $ins++;
     $number=str_pad($ins,12,"0",STR_PAD_LEFT);
     DB::table('elite_card_master')->insert([ 
      'company_id' => $req->com_id, 
      'Short_Name' =>$req->Short_Name,
      'serial_card'=>$number,
      'created_by'=>Session::get('id'),
      'inc'=>0
      ]);
  }

    DB::select('call sp_inc_elite_card_master()');
    $error=0;
  }catch (Exception $e){
    $error=1;                 
  }
  return $error;
}
         

  public function rto_list(){
    $rto=DB::select('call sp_rto_master()');
    $state_list=DB::select('call get_state_list()');
    return view('dashboard.rto_list',['rto'=>$rto,'state_list'=>$state_list]);
  }

  public function GetCityDependsState(Request $req){
      $city_list = DB::select('call get_city_list_depends_state(?)',array($req->sid));
      return $city_list;
  }

  public function rto_save(Request $req){

    $error=null;
    try{   
        DB::table('rto_master')->insert(
                [ 
                'rto_location' => $req->rto_location, 
                'series_no' =>$req->series_no,
                'state_id' =>$req->state_id,
                'city_id' =>$req->city_id,
                'created_by'=>Session::get('id'),
                'create_date'=>date('Y-m-d H:i:s'),
                'is_active'=>0,
                ]);

            $error=0;
    }catch (Exception $e){
          $error=1;                 
    }     
  }

  public function agentupdate(Request $req){

    $response = array();
    $response['getudata'] = DB::select('call Get_agent_Info_Update(?)',array($req->ageid));
    $response['rdata'] = DB::select('call GET_RTO_DATA(?)',array($req->ageid));
    return $response;
  }

  public function agent_update(Request $req){
    $updateResponce = array();
    $updateResponce['updatedata'] = DB::select('call agent_master_update(?,?,?,?,?)',array($req->a_id,$req->a_name,$req->a_address,$req->a_contact_no,$req->a_email));

    foreach ($req->rto_id1 as $key => $r) {
      $updateResponce['updaterto'] = DB::select('call agent_rto_update(?,?)',array($req->a_id,$r));
    }
    return $updateResponce;
  }

}