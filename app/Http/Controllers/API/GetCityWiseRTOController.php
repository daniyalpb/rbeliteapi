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

class GetCityWiseRTOController extends NewInitialController
{
    public function getcityrto(){
    	$city = DB::select('call N_GET_CITY()');
    	if(count($city)>0){
            $city[0]->city_id = '2653';
            $city[0]->cityname = 'Any Other City';
    		$rto = DB::select('call N_GET_RTO()');
    		for ($i=0; $i < count($city); $i++) { 
    			$cityid = $city[$i]->city_id;
    			$rtodata = [];
    			for ($j=0; $j <count($rto) ; $j++) { 
    				if($cityid == $rto[$j]->cityid){
    					array_push($rtodata,$rto[$j]);
    				}	
    			}
    			$city[$i]->RTOList = $rtodata;
    		}
    		if($city != null && $city != ''){
    		 	return $this::send_success_response('Record fetched succesfully',"Success",$city);
    		}else{
    			return $this::send_failure_response("Failed","Failure",[]);
    		}
    	}else{
    		return $this::send_failure_response("Failed","Failure",[]);
    	}
    }
}
