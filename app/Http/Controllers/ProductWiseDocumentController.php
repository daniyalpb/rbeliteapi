<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Response;
use Validator;
use Redirect;
use Session;
use URL;
use Mail;


class ProductWiseDocumentController extends InitialController{

    public function product_wise_document(Request $req){
    	try{
	    	$document = DB::select('call N_Productwise_Documents(?)',array($req->product_id));
	    	if(count($document)>0){
	    		return $this::send_success_response("Document fetched successfully","success",$document);
		    }else{
		    	return $this::send_failure_response("Get document failed","failure",$document);
		    }
		}catch(Exception $e){
    		return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
    	}
    }
    
}
