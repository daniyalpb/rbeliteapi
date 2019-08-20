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

class ProductTypeController extends InitialController{

	public function getdata(Request $req){
		try{		
			$query = DB::select('call usp_user_insert(?,?,?,?)',array($req->elite_card_no,$req->policy_no,$req->mobile_no,$req->email_address));
			
			if(count($query) > 0)     
				return $this::send_success_response($query[0]->Result ,"Success",$query[0]->Result);
			else
            	return $this::send_failure_response("Invalid argument ","failure",$query); 
		}
		catch(Exception $e){
			//return $this::send_failure_response($e->getMessage(),"failure","failure tested");
		}
	}

	public function loadproduct(Request $req){
		try{
        	//$query = DB::select('call usp_load_products()');
            //return $this::send_success_response('Data loaded' ,"Success",$query);
			$count = 0;
			//$category = DB::select('call usp_loadCategory()');
			//$count = count($category);
			//$subcategory = DB::select('call usp_loadsubcategory()');
			//$countsub = count($subcategory);

        	$query = DB::select('call usp_load_products()');
        	$countprod = count($query);

            //commented
        	//$arr = array('categorylist' => $category, 'subcategorylist'=> $subcategory,'productlist'=>$query);

            //$arr = array('productlist'=>$query);

			//if($count > 0 && $countsub > 0 && $countprod > 0)        	
            if($countprod > 0)           
            	return $this::send_success_response('Data loaded successfully' ,"Success",$query);
            else
            	return $this::send_failure_response("Invalid argument ","failure",$query); 
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
	}

	public function insertorder(Request $req){	


            $extrarequest= $req->extrarequest;
            $newreq ="";
            if($extrarequest){
                 $keys =array_keys($extrarequest);
                $values =array_values($extrarequest);

                
                for ($i=0; $i < sizeof($keys); $i++) { 
                    $key = $keys[$i];
                    $value = $values[$i];                
                    $newreq.=$key.'~'.$value.'|';
                }
            }
           
		// print_r($req->all());exit();
		try{
        	$query = DB::select('call usp_order_details_insert(?,?,?,?,?,?,?,?,?,?,?)',
                array($req->prodid,
                      $req->userid,
                      $req->rto_id,
                      $req->transaction_id,
                      $req->subscription,
                      $req->vehicleno,
                      $req->pucexpirydate,
                      $req->cityid,
                      $req->amount,
                      $req->payment_status,
                      $newreq));
			
			if(count($query) > 0)            	
            	return $this::send_success_response('Order Placed successfully' ,"Success",$query);
            else
        		return $this::send_failure_response("Invalid state ","failure",$query);
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
	}


	public function getorderdetails(Request $req){
		try{
        	$query = DB::select('call usp_load_task_list(?)',array($req->userid));
            if(count($query) > 0)
            	return $this::send_success_response('Records fetched successfully' ,"Success",$query);
            else
                return $this::send_success_response('Records fetched successfully' ,"Success",$query);
        		//return $this::send_failure_response("Invalid state ","failure",$query);
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
	}

	public function insertproducttype(Request $req){
		print_r($req);
	}

	public function updateorderstatus(Request $req){
		try{
        	$query = DB::select('call usp_order_status_update(?,?,?)',array($req->order_statusid,$req->order_id,$req->user_id));
            if(count($query) > 0)
            	return $this::send_success_response('Records updated successfully' ,"Success",$query);
        	else
        		return $this::send_failure_response("Invalid state ","failure",$query);
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }		
	}

	public function loadpincode(Request $req){
		try{
        	$query = DB::select('call usp_loadpincodedtls(?)',array($req->pincode));

        	if(count($query) > 0)
            	return $this::send_success_response('Records fetched successfully' ,"Success",$query);
            else
        		return $this::send_failure_response("Invalid state ","failure",$query);
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }		
	}

	public function loadstates(Request $req){
		try{
        	$query = DB::select('call usp_loadstates()');

        	if(count($query) > 0)
            	return $this::send_success_response('Records fetched successfully' ,"Success",$query);
            else
        		return $this::send_failure_response("Invalid state ","failure",$query);
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }	
	}


	public function loadcities(Request $req){
		try{
        	$query = DB::select('call usp_load_cities(?)',array($req->state_id));

        	if(count($query) > 0)
            	return $this::send_success_response('Records fetched successfully' ,"Success",$query);
        	else
        		return $this::send_failure_response("Invalid state","failure",$query);
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }	
	}

    public function loadallcities(){
        try{
            $query = DB::select('call usp_load_all_cities()');
            $arr = array("AllCities"=>$query);
            if(count($query) > 0)
                return $this::send_success_response('Records fetched successfully' ,"Success",$arr);
            else
                return $this::send_failure_response("Invalid state","failure",$query);
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }   
    }
}
?>
