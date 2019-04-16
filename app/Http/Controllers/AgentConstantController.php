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

class AgentConstantController extends InitialController{

    

    public function getAgentConstant(Request $req){
         $query = DB::select('call getAgentConstant(?)',array($req->agent_id,));
            if(count($query) > 0)    
                return $this::send_success_response("Record Fetched" ,"Success",$query);
            else
                return $this::send_failure_response("Recored failed ","failure",$query);
        
    }

   
}

?>