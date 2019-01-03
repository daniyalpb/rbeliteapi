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

class OrderDetailsInsertDLService2Controller extends NewInitialController
{
    public function insertorderdetailsDLService2(Request $req){	
		  try{
        	$query = DB::select('call usp_order_details_insert_DL_Service_2(?,?,?,?,?,?,?,?,?,?,?,?,?)',
                array($req->prodid,
                      $req->userid,
                      $req->rto_id,
                      $req->transaction_id,
                      $req->cityid,
                      $req->amount,
                      $req->payment_status,
                  	  $req->pincode,
                  	  $req->dl_type,
                      $req->dl_no,
                      $req->dl_correct_name,
                      $req->dl_dob,
                      $req->dl_address));
			
			if(count($query) > 0)            	
            	return $this::send_success_response('Order Placed successfully' ,"Success",$query);
            else
        		return $this::send_failure_response("Invalid state ","failure",$query);
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
	}
}
