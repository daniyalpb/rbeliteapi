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


class VehicleController extends InitialController
{
    public function changeVehicle(Request $req)
    {
    	try
    	{
	    	$vehicle = DB::select('call changeVehicle(?)',array($req->vehicleno));
	    	if(count($vehicle)>0){
	    		return $this::send_success_response("RTO Found","success",$vehicle);
		    }else{
		    	return $this::send_failure_response("No RTO Found","failure",$vehicle);
		    }
		}catch(Exception $e){
    		return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
    	}
    }
}
