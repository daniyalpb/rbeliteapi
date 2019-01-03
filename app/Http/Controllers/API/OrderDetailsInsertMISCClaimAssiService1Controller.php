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

class OrderDetailsInsertMISCClaimAssiService1Controller extends NewInitialController
{
    public function ordersavemiscclaimassiservice1(Request $req){	
		  try{
        	$query = DB::select('call usp_order_details_insert_MISC_claim_assi_Service_1(?,?,?,?,?,?,?,?,?,?,?,?,?)',
                array($req->prodid,
                      $req->userid,
                      $req->rto_id,
                      $req->transaction_id,
                      $req->vehicleno,
                      $req->cityid,
                      $req->amount,
                      $req->payment_status,
                  	  $req->pincode,
                      $req->assistant_date,
                      $req->assistant_time,
                      $req->assistant_place,
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
