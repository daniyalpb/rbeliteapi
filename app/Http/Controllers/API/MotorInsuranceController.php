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
class MotorInsuranceController extends NewInitialController
{
    public function getmotorinsurance(){
    	$data = DB::select('call Get_Motor_Insurance()');
    	if($data != null && $data != ''){
    		 return $this::send_success_response('Record fetched succesfully',"Success",$data);
    	}else{
    		return $this::send_failure_response("Failed","Failure",[]);
    	}
    }
}
