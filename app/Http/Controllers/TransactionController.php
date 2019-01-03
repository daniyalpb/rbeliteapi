<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;

class TransactionController extends InitialController{
    //
    public $client_id='3bltoyw0MheRMwXY7CoubY4ZKaLdbYIwo3CV0Eyn';
    public $client_secret='97bbMq9fepAqgrQzd2SIboiQMWKb7dtBg8MLfj5ysBbjULVsyQDiIViZ8GUiN0NNfbHU7RLh4ZNVfKJkoJK4I4LQUFZX2nR41jbE5qH6MRn5uM2RYIgEiTdYw5aOdAvO';
    public $url = "https://api.instamojo.com/oauth2/token/";
    public $env = "production";


    public function getToken() {
        if (substr( $this->client_id, 0, 5 ) === "test_") {
            $this->url = "https://test.instamojo.com/oauth2/token/";
            $this->env = "test";
        }
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, rawurldecode(http_build_query(array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'client_credentials'
        ))));
        $json = json_decode(curl_exec($curl));

        if(curl_error($curl))
        {
            echo 'error:' . curl_error($curl);
        }
       
        if (isset($json->error)) {
            return "Error: " . $json->error;
            throw new Exception("Error: " . $json->error);
        }
        $this->token = $json;

        return $this->env. $json->access_token;
    }
    
    public function give_token(Request $req){       
        $token= $this::getToken();
        return ($token);
    }

    public function show_orders(Request $req){
        try {
            $user_id=$req['user_id'];
            $data=DB::select('call view_sales_orders(?)',[$user_id]);

            if(sizeof($data)>0){
                return $this::send_success_response('Data loaded successfully' ,"Success",$data);
            }else{
                
                return $this::send_failure_response("No order to show","failure",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        }
      
    }


    public function update_orders(Request $req){
        
        try {
            $dump=json_encode($req->all());
            $order_id=$req['order_id'];
            $pg_date=$req['payment_datetime'];
            $remark=$req['remark'];
            $txnid=$req['transaction_id'];
            $pg_status=$req['status'];
            $rto=$req["rto_id"];
            
            $data=DB::select("CALL update_transaction_details(?,?,?,?,?,?,?)",[$order_id,$pg_date,$remark,$txnid,$pg_status,$rto,$dump]);
            if(sizeof($data)>0){
            return $this::send_success_response('Data Updated Successfully' ,"Success",$data);
            }
            else{
                return $this::send_failure_response("No data found","failure",[]);
            }

        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]);
        }
    }

   public function getincome(Request $req){
        try {
            $user_id=$req['agent_id'];
            $sata=DB::select('call usp_getagentincome(?)',[$user_id]);
            
            foreach ($sata as $key => $value) {
                $data[$value->Status]=$value->count;
            }
            
            if(sizeof($data)>0){
                return $this::send_success_response('Data loaded successfully' ,"Success",[$data]);
            }else{
                return $this::send_failure_response("No order to show","failure",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        }
        
    }

    public function getagentorderdetails(Request $req){
        try {
            $user_id=$req['agent_id'];
            $status_id = $req['status_id'];
            $data=DB::select('call usp_getagentorders(?,?)',array($user_id,$status_id));

            if(sizeof($data)>0){
                return $this::send_success_response('Data loaded successfully' ,"Success",$data);
            }else{
                return $this::send_failure_response("No order to show","failure",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        }
    }

    public function updateorderstatus(Request $req)    {
        try {
            $order_id=$req['order_id'];
            $status_id = $req['order_status'];
            $order_remark = $req['order_remark'];
            $agent_id = $req['agent_id'];

            $data=DB::select('call usp_update_order_status(?,?,?,?)',array($order_id,$agent_id,$status_id,$order_remark));

            if(sizeof($data)>0){
                return $this::send_success_response('Order status updated successfully' ,"Success",[]);
            }else{
               // print_r($data);
                return $this::send_failure_response("No order to show","failure",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        }        
    }

    public function getpendingwallet(Request $req){
        try {
            $agent_id = $req['agent_id'];

            $data=DB::select('call usp_getwallet_pending_details(?)',array($agent_id));

            if(sizeof($data)>0){
                return $this::send_success_response('Data loaded successfully' ,"Success",$data);
            }else{
              //  print_r($data);
                return $this::send_failure_response("No order to show","failure",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        }                
    }

    public function agentamtrequest(Request $req){
        try {
            $agent_id = $req['agent_id'];
            $req_amt = $req['req_amt'];

            $data=DB::select('call usp_agent_req_amt(?,?)',array($agent_id,$req_amt));

            if(sizeof($data)>0){
                return $this::send_success_response('Data loaded' ,"Success",$data);
            }else{
                
                return $this::send_failure_response("No order to show","failure",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        }        
    }

    public function agentaccept_status_update(Request $req){
        try{
            $order_id=$req['order_id'];
            $status_id = $req['agent_accept_status'];            
            $agent_id = $req['agent_id'];

            $data=DB::select('call usp_update_agent_status(?,?,?)',array($order_id,$agent_id,$status_id));
       
            if(sizeof($data)>0){
                return $this::send_success_response('Order status updated successfully' ,"Success",$data);
            }else{
               // print_r($data);
                return $this::send_failure_response("No order to show","failure",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        }
    }

    public function updateorderdocs(Request $req){
        try{           
            $data=DB::select('call usp_update_orderid(?,?)',array($req->order_id,$req->ids));
            if(sizeof($data)>0){
                return $this::send_success_response('Order status updated successfully' ,"Success",$data);
            }else{ 
                return $this::send_failure_response("No order to show","failure",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        }
    }

}