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
use Mail;

class LifeInsurancePolicyNomineeChangeAssistanceController extends NewInitialController
{
    public function savelifeinsurancepolicynomineeservice7(Request $req){	
		  try{
        	$query = DB::select('call Insert_life_insurance_policy_nominee_Service_7(?,?,?,?,?,?,?,?,?,?,?)',
                array($req->prodid,
                      $req->userid,
                      $req->rto_id,
                      $req->transaction_id,
                      $req->cityid,
                      $req->amount,
                      $req->payment_status,
                  	  $req->pincode,
                      $req->nominee_name,
                      $req->relation_with_nominee,
                      $req->insure_company_name
                  ));
			
			if(count($query) > 0)            	
            	return $this::send_success_response('Saved successfully' ,"Success",$query);
            else
        		return $this::send_failure_response("failure","failure",$query);
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
	}
}
