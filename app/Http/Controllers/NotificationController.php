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
class NotificationController extends InitialController
{
    public function getnotification(Request $req){
    	try{
	    	$data = DB::select('call getNotification(?,?,?)',array($req->isagentapp,$req->userid,$req->count));
	    	if(count($data)>0){
	    		return $this::send_success_response("Notification fetched successfully","success",$data);
		    }else{
		    	return $this::send_failure_response("Get notification failed","failure",$data);
		    }
		}catch(Exception $e){
    		return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
    	}
    }
}
