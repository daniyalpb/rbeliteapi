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

class ComplimentaryLoanAuditController extends NewInitialController
{
    public function savecomplimentaryloanauditservice10(Request $req){	
		  try{
        	$query = DB::select('call Insert_complimentory_Loan_Audit_Service_10(?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                array($req->prodid,
                      $req->userid,
                      $req->rto_id,
                      $req->transaction_id,
                      $req->cityid,
                      $req->amount,
                      $req->payment_status,
                  	  $req->pincode,
                  	  $req->com_name,
                      $req->DOB,
                      $req->annual_income,
                      $req->salaried,
                      $req->any_EMI,
                      $req->EMI_Amount
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
