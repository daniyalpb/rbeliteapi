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

class RTOController extends InitialController{
    
    public function GetRTOData(Request $req){
    	try{
            $Final = [];
            $RTO = [];
            $NONRTO = [];
    		$RTO = DB::select('call N_get_rto_and_nonrto_data(1)');
    		if(count($RTO)>0){
                $mainobject = [];
                $RTOsubcate = DB::select('call N_get_rto_and_nonrto_subdata(1)');
                for ($i=0; $i < count($RTO); $i++) { 
                    $id = $RTO[$i]->id;  
                        if($RTO[$i]->product_logo != null && $RTO[$i]->product_logo != ''){
                            $RTO[$i]->product_logo = 'http://elite.rupeeboss.com'.$RTO[$i]->product_logo;   
                        }              
                    $RTOsubcatearray = [];
                    for ($j=$i; $j < count($RTOsubcate) ; $j++) { 
                        if($id==$RTOsubcate[$j]->parent_id){
                                if($RTOsubcate[$j]->product_logo != null && $RTOsubcate[$j]->product_logo != ''){
                                    $RTOsubcate[$j]->product_logo = 'http://elite.rupeeboss.com'.$RTOsubcate[$j]->product_logo;
                                }
                                array_push($RTOsubcatearray,$RTOsubcate[$j]);                    
                        }
                    }
                    $RTO[$i]->subcategory = $RTOsubcatearray;
                    
                }
            };

            $NONRTO = DB::select('call N_get_rto_and_nonrto_data(2)');
            if(count($NONRTO)>0){
                $mainobject = [];
                $NONRTOsubcate = DB::select('call N_get_rto_and_nonrto_subdata(2)');
                for ($i=0; $i < count($NONRTO); $i++) { 
                    $id = $NONRTO[$i]->id;  
                        if($NONRTO[$i]->product_logo != null && $NONRTO[$i]->product_logo != ''){
                            $NONRTO[$i]->product_logo = 'http://elite.rupeeboss.com'.$NONRTO[$i]->product_logo;   
                        }              
                    $NONRTOsubcatearray = [];
                    for ($j=$i; $j < count($NONRTOsubcate) ; $j++) { 
                        if($id==$NONRTOsubcate[$j]->parent_id){
                                if($NONRTOsubcate[$j]->product_logo != null && $NONRTOsubcate[$j]->product_logo != ''){
                                    $NONRTOsubcate[$j]->product_logo = 'http://elite.rupeeboss.com'.$NONRTOsubcate[$j]->product_logo;
                                }
                                array_push($subcatearray,$NONRTOsubcate[$j]);                    
                        }
                    }
                    $NONRTO[$i]->subcategory = $NONRTOsubcatearray;
                    
                };
            };

            $Final = ['RTO'=>$RTO,'NONRTO'=>$NONRTO]; 

            if($Final != null && $Final != ''){
    			return $this::send_success_response("Records  fetched successfully","success",$Final);
    		}else{
    			return $this::send_failure_response("Get RTO failed","failure",$Final);
    		}
    	}catch(Exception $e){
    		return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
    	}
    }
}