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

class TransferOFNCBBenefitsController extends NewInitialController
{
    public function savetransferncbbenefitsservice5(Request $req){	
		  try{
        	$query = DB::select('call save_transfer_of_ncb_benefits_Service_5(?,?,?,?,?,?,?,?,?,?,?)',
                array($req->prodid,
                      $req->userid,
                      $req->rto_id,
                      $req->transaction_id,
                      $req->vehicleno,
                      $req->cityid,
                      $req->amount,
                      $req->payment_status,
                  	  $req->pincode,
                      $req->make,
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
