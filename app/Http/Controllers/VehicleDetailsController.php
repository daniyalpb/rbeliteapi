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

class VehicleDetailsController extends InitialController
{
    public function vehicle_details(Request $req){
    	$data = $req->ProductId;
    	$curl = curl_init();
		  curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.magicfinmart.com/api/vehicle-details",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\"ProductId\":\"$data\"}",
		  CURLOPT_HTTPHEADER => array(
		    "Content-Type: application/json",
		    "Postman-Token: ee774d33-2083-4d8e-a135-b9531545f1d2",
		    "cache-control: no-cache",
		    "token: 1234567890"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  $myJSONerr = json_decode($err);
		  return $this::send_success_json_encode($myJSONerr);
		} else {
			$myJSON = json_decode($response);
		   return $this::send_success_json_encode($myJSON);
		}
    }

    public function getvehicledata(Request $req){
    	$response = file_get_contents('http://202.131.96.100:7541/LeadGenration.svc/VehicleMaster?VehicleTypeID=2');
        $ObjResponse = json_decode($response);
        if($ObjResponse != '' && $ObjResponse != null){
	    	return $this::send_success_response("Vehicle fetched successfully","success",$ObjResponse);
		}else{
		    return $this::send_failure_response("Get Vehicle failed","failure",$ObjResponse);
		}
    }
}
