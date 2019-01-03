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


class AttendanceController extends InitialController
{
    public function addAttendance(Request $req)
    {
       if(!empty($req->lat) && !empty($req->long)){
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','token:P0licyB0ss'));
            curl_setopt($ch, CURLOPT_URL, 'http://reverse.geocoder.api.here.com/6.2/reversegeocode.xml?prox='.$req->lat.','.$req->long.'&mode=retrieveAddresses&maxresults=1&gen=9&app_id=uH2VCZCDD9m4odTMDvnE&app_code=C6RPtiAdUJRuqN_q1bhZ6g');       
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FAILONERROR, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            //curl_setopt($ch, CURLOPT_POSTFIELDS,null);
            $http_result = curl_exec($ch);
            $error = curl_error($ch);
            $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
            curl_close($ch);                          
         $xml = simplexml_load_string($http_result);
         
         $address=$xml->Response->View->Result->Location->Address;
             
             // $xml_S=simplexml_load_string($address);
               $arr = array((string)$address->Label);
               $address_label=$arr[0];              
           
           if(!empty($address_label)){
             $distance = $this->distance($req->lat, $req->long, 19.194479, 72.798227, "K");
              $detail = DB::select('call insertatten_data(?,?,?,?,?,?)',array($req->userid,$req->lat,$req->long,$address_label,$req->type,$distance));
              if(count($detail)>0){
                  return $this::send_success_response("Attendance Marked Successfully","success",$detail);
              }else{
                return $this::send_failure_response("Something went wrong","failure",$detail);
              }
           }else{
            return $this::send_failure_response("Something went wrong","failure",$address_label);
           }
       }else{
            $detail = DB::select('call insertatten_data(?,?,?,?,?,?)',array($req->userid,'','','','',''));
              
                  return $this::send_success_response("Attendance Synced","success",$detail);
              
       }

    /*	try
    	{
	    	$detail = DB::select('call insertatten_data(?,?,?,?,?)',array($req->userid,$req->lat,$req->long,$req->address,$req->type));
	    	if(count($detail)>0){
	    		return $this::send_success_response("Attendance Marked Successfully","success",$detail);
		    }else{
		    	return $this::send_failure_response("Something went wrong","failure",$detail);
		    }
		}catch(Exception $e){
    		return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
    	}*/
    }


    public function login(Request $req)
    {
        try{
    		if($req->phoneno != null && $req->phoneno != ''){
    			$data = DB::select('call login_hrms(?)',array($req->phoneno));
	    		if($data[0]->SaveStatus != '1'){
	    			return $this::send_success_response("Login successfully","Success",$data);
	    		}else{
	    			return $this::send_failure_response($data[0]->Message,"Failure",$data);
	    		}
    		}else{
    			return $this::send_failure_response("Please enter phoneno","Failure",[]);
    		}	
    	}catch(Exception $e){
    		return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
    	}   
    }


  function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}
}
