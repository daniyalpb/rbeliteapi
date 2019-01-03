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

class ClaimGuidenceHospitalizationService2Controller extends NewInitialController
{
    public function ordersaveclaimguidancehospiservice2(Request $req){	
		  try{
        	$query = DB::select('call insert_Claim_Guidance_Hospitalization_Service_2(?,?,?,?,?,?,?,?,?,?,?,?)',
                array($req->prodid,
                      $req->userid,
                      $req->rto_id,
                      $req->transaction_id,
                      $req->cityid,
                      $req->amount,
                      $req->payment_status,
                  	  $req->pincode,
                      $req->patient_name,
                      $req->hospital_name,
                      $req->hospitalization_date,
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
