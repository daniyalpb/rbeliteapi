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


class RTOListController extends InitialController
{
    public function RTOList(Request $req){
    	$RtoCityProduct = DB::select('call N_RTO_City_Wise(?,?,?)',array($req->product_id,$req->userid,$req->productcode));
    	//print_r($RtoCityProduct);exit();
    	if(count($RtoCityProduct)>0){
    		//$RtoList = DB::select('call N_RTO_List_City_Wise(?,?)',array($req->product_id,$req->productcode));
    		for ($i=0; $i < count($RtoCityProduct); $i++) { 
    			// $cityid = $RtoCityProduct[$i]->city_id;
    			if($RtoCityProduct[$i]->product_logo != null || $RtoCityProduct[$i]->product_logo != ''){
                            $RtoCityProduct[$i]->product_logo = 'http://elite.rupeeboss.com'.$RtoCityProduct[$i]->product_logo;   
                        }  
	    		// $rtolist = [];
	    		// for ($J=0; $J < count($RtoList); $J++) { 
	    			
	    		// 	if($cityid == $RtoList[$J]->city_id){

	    		// 		 array_push($rtolist,$RtoList[$J]);
	    		// 	}
	    		// }
	    		// $RtoCityProduct[$i]->rtolist = $rtolist;
	    	}
	    
	    	if($RtoCityProduct != null && $RtoCityProduct != ''){
	    		return $this::send_success_response("Records  fetched successfully","success",$RtoCityProduct);
	    	}else{
	    		return $this::send_failure_response("Get RTO failed","failure",$RtoCityProduct);
	    	}
    	}
    	else{
    		return $this::send_failure_response("Get RTO failed","failure",'');
    	}	
    }

     public function RTOList_Change_Vehicle(Request $req){     	
    	$RtoCityProduct = DB::select('call N_RTO_City_Wise_changevehicle(?,?,?,?,?)',array($req->product_id,$req->userid,$req->productcode,$req->make,$req->model));
    	//print_r($RtoCityProduct);exit();
    	if(count($RtoCityProduct)>0){
    		$RtoList = DB::select('call N_RTO_List_City_Wise(?,?)',array($req->product_id,$req->productcode));
    		for ($i=0; $i < count($RtoCityProduct); $i++) { 
    			// $cityid = $RtoCityProduct[$i]->city_id;
    			if($RtoCityProduct[$i]->product_logo != null || $RtoCityProduct[$i]->product_logo != ''){
                            $RtoCityProduct[$i]->product_logo = 'http://elite.rupeeboss.com'.$RtoCityProduct[$i]->product_logo;   
                        }  
	    		// $rtolist = [];
	    		// for ($J=0; $J < count($RtoList); $J++) { 
	    			
	    		// 	if($cityid == $RtoList[$J]->city_id){

	    		// 		 array_push($rtolist,$RtoList[$J]);
	    		// 	}
	    		// }
	    		//$RtoCityProduct[$i]->rtolist = $rtolist;
	    	}
	    
	    	if($RtoCityProduct != null && $RtoCityProduct != ''){
	    		return $this::send_success_response("Records  fetched successfully","success",$RtoCityProduct);
	    	}else{
	    		return $this::send_failure_response("Get RTO failed","failure",$RtoCityProduct);
	    	}
    	}	
    }
}
