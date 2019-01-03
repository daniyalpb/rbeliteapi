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

class TransferOfOwnershipController extends NewInitialController
{
    public function savetransferownershipservice4(Request $req){	
		  try{
        	$query = DB::select('call save_transfer_ownership_Service_4(?,?,?,?,?,?,?,?,?,?)',
                array($req->prodid,
                      $req->userid,
                      $req->rto_id,
                      $req->transaction_id,
                      $req->vehicleno,
                      $req->cityid,
                      $req->amount,
                      $req->payment_status,
                  	  $req->pincode,
                      $req->new_owner
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
