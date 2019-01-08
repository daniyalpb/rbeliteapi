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
    		$data = DB::select('call save_feedback_form(?,?,?)',array($req->request_id,$req->userid,$req->feedback_comment));
    		if(count($data)>0){
    			return $this::send_success_response("FeedBack saved successfully","Success",$data);
    		}else{
    			return $this::send_failure_response("Failure feedback not save","Failure",$data);
    		}
    	}catch(Exception $e){
    		return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
    	}
    }

    public function getcompleteorders(Request $req){
        try{
            $getdata = DB::select('call Get_Complete_orders(?)',array($req->user_id));
            if(count($getdata)>0){
                return $this::send_success_response("Orders get successfully","Success",$getdata);
            }else{
                return $this::send_failure_response("Failed get orders","Failure",$getdata);
            }
        }catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
    }

    public function displayfeedbackform(Request $req){
        try{
            $getfeedback = DB::select('call DisplayFeedbackForm(?)',array($req->user_id));
            if(count($getfeedback)>0){
                return $this::send_success_response("FeedBack get successfully","Success",$getfeedback);
            }else{
                return $this::send_failure_response("Failed get feedback","Failure",$getfeedback);
            }
        }catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
    }

    public function saverate(Request $req){
        try{
            $saverating = DB::select('call save_rating(?,?,?,?)',array($req->request_id,$req->userid,$req->feedback,$req->rating));
            if(count($saverating)>0){
                return $this::send_success_response("Rating saved successfully","Success",$saverating);
            }else{
                return $this::send_failure_response("Failed save rating","Failure",$saverating);
            }
        }catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
    }
}
