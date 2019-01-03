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

class GetProductPriceController extends NewInitialController
{
    	public function getproductprice(Request $req){	
		  try{
        	$query = DB::select('call getProductPriceTAT(?,?,?,?,?,?,?)',
                array($req->vehicleno,
                      $req->cityid,
                      $req->product_id,
                      $req->userid,
                      $req->productcode,
                      $req->make,
                      $req->model));
			if(count($query) > 0)            	
            	return $this::send_success_response('Records fetching successfully' ,"Success",$query);
            else
        		return $this::send_failure_response("failure","failure",$query);
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
	}
}
