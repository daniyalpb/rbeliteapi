<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Responce;
use validator;
use Redirect;
use Session;
use URL;
use mail;

class FeedBackController extends NewInitialController
{
    public function savefeedbackform(Request $req){
    	try{
    		$data = DB::select('call save_feedback_form(?,?,?,?)',array($req->request_id,$req->userid,$req->feedback_comment,$req->rating));
    		if(count($data)>0){
    			return $this::send_success_response("FeedBack saved successfully","Success",$data);
    		}else{
    			return $this::send_failure_response("Failure feedback not saved","Failure",$data);
    		}
    	}catch(Exception $e){
    		return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
    	}
    }
}
