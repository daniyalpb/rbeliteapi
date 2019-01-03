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

class ConstantController extends InitialController
{
        
    public function getUserConstant(Request $req)
    {
        try{
            $query = DB::select('call getUserConstant(?)',array($req->userid));            
            if(count($query) > 0)
                return $this::send_success_response("Records fetched successfully","success",$query);
             else
                return $this::send_failure_response("get user failed ","failure",$query);            
        }
        catch(Exception $e)
        {
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
    }

}

?>
