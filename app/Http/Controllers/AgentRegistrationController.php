<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Responce;
use validator;
use Redirect;
use Session;
use URL;
use Mail;
use App\Http\Controllers\otpController;

class AgentRegistrationController extends InitialController
{
    public function checkagentregistration(Request $req){

        $json_response_otp = array();
        try{
            $checkdata = DB::select('call Check_Agent_Registration(?,?)',array($req->email,
                $req->mobNo));
            if($checkdata[0]->SavedStatus == '2'){
                $json_response_otp_new = array('SavedStatus' =>$checkdata[0]->SavedStatus ,'OTP'=>'');
                return $this::send_success_response($checkdata[0]->Message,"Success",$json_response_otp_new);

            }else if($checkdata[0]->SavedStatus == '1'){
                $otpControllerObj = new otpController;                
                $result_otp = $otpControllerObj -> otpinsert($req); 
               // print_r( $result_otp -> original); exit();
                $result_otp -> original['Message'] = $result_otp -> original['message'];
                $result_otp -> original['SavedStatus'] = $checkdata[0]->SavedStatus;
                $json_response_otp[] = $result_otp -> original;
                $json_response_otp_new = array('SavedStatus' =>$checkdata[0]->SavedStatus ,'OTP'=>$result_otp -> original['Data'] );
                return $this::send_success_response('OTP Generated succesfully',"Success",$json_response_otp_new);
            }else{
                 return $this::send_failure_response($checkdata[0]->Message,"Failure",[]);
            }
        }catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
    }

    public function agentotpverify(Request $req)
    {
        try{
            $query = DB::select('call usp_verify_otp(?,?,?)',array($req->otp,$req->mobile,$req->emailid));
            if($query[0]->SavedStatus == '0'){
            	 $data = DB::select('call Agent_Registration(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',array(
            	 	$req->agent_name,
            	 	$req->mobile,
            	 	$req->emailid,
            	 	$req->pass,
            	 	$req->pincode,
            	 	$req->address,
            	 	$req->area,
            	 	$req->city,
            	 	$req->state,
            	 	$req->bank_account_no,
            	 	$req->IFSC_code,
            	 	$req->MICR_code,
            	 	$req->bank_name,
            	 	$req->bank_branch_name,
            	 	$req->bank_city
            	 ));
            	 if($data[0]->SavedStatus == '0') {
            	 	return $this::send_success_response($query[0]->Result,"Success",$data);
            	 }else{
            	 	return $this::send_failure_response($data[0]->Message,"Failure",[]);
            	 }   
            }else{
                return $this::send_failure_response($query[0]->Result,"failure","failure tested");
            }  
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure","failure tested");
        }
    }
}
