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

class NONRTOController extends InitialController{

    public function NONRTOList(Request $req){
    	$NonRtoProduct = DB::select('call N_NON_RTO(?)',array($req->product_id));
    	if(count($NonRtoProduct)>0){
    		$NonRtoSpecialPrice = DB::select('call N_NON_RTO_specialprice(?)',array($req->product_id));
    		for ($i=0; $i < count($NonRtoProduct); $i++) { 
    			$prod_id = $NonRtoProduct[$i]->prod_id;
    			//print_r($NonRtoProduct[$i]->product_logo); 
    			if($NonRtoProduct[$i]->product_logo != null || $NonRtoProduct[$i]->product_logo != ''){
                            $NonRtoProduct[$i]->product_logo = 'http://elite.rupeeboss.com'.$NonRtoProduct[$i]->product_logo;   
                        }  
	    		$speciallist = [];
	    		for ($J=0; $J < count($NonRtoSpecialPrice); $J++) { 
	    			if($prod_id == $NonRtoSpecialPrice[$J]->productid){
	    				 array_push($speciallist,$NonRtoSpecialPrice[$J]);
	    			}
	    		}
	    		$NonRtoProduct[$i]->speciallist = $speciallist;
	    	}
	    	if($NonRtoProduct != null && $NonRtoProduct != ''){
	    		return $this::send_success_response("Records  fetched successfully","success",$NonRtoProduct);
	    	}else{
	    		return $this::send_failure_response("product_id not exists","failure",$NonRtoProduct);
	    	}
    	}	
    	//print_r($req->all()); exit();
    }
}