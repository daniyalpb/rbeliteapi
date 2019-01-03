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

class ComplimentaryCreditReportController extends NewInitialController
{
    public function savecomplimentarycreditreportservice9(Request $req){	
		  try{
        	$query = DB::select('call Insert_complimentory_credit_report_Service_9(?,?,?,?,?,?,?,?,?,?,?)',
                array($req->prodid,
                      $req->userid,
                      $req->rto_id,
                      $req->transaction_id,
                      $req->cityid,
                      $req->amount,
                      $req->payment_status,
                  	  $req->pincode,
                  	  $req->com_name,
                      $req->pan_no,
                      $req->DOB
                  ));
			
			 if(count($query) > 0){
        
              if($query[0]->SuccessStatus=='1')
            	   return $this::send_success_response('Saved successfully' ,"Success",$query);
              else
                return $this::send_failure_response($query[0]->displaymessage,"failure",$query);
            }
            else{
        		return $this::send_failure_response("failure","failure",$query);
          }
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
	}
}
