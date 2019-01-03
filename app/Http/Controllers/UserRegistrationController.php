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
use App\Http\Controllers\otpController;


class UserRegistrationController extends InitialController
{
    public function userotpverify(Request $req)
    {
        $user_register_result = array();
        try{
            $query = DB::select('call usp_verify_otp(?,?,?)',array($req->otp,$req->mobile,$req->emailid));
            if($query[0]->SavedStatus == '0'){
                $userregister = $this -> UserRegistration($req);
                $user_register_result[] =  $userregister -> original;
                return $this::send_success_json_encode($userregister -> original);
            }else{
                return $this::send_failure_response($query[0]->Result,"failure","failure tested");
            }
            
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure","failure tested");
        }
    }

    public function UserRegistration(Request $req)
    {
        try{        


            $query = DB::select('call N_User_Registration(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',array(
            	$req->name,
            	$req->emailid,
            	$req->mobile,
            	$req->city,
            	$req->state,
            	$req->area,
            	$req->pincode,
            	$req->vehicle_no,
            	$req->policy_no,
            	$req->password,
                $req->ProductCode,
                $req->RiskEndDate,
                $req->RiskStartDate,
                $req->InsuredName,
                $req->Make,
                $req->Model,
                $req->PolicyStatus,
                $req->ResponseStatus));
            if($query[0]->SavedStatus == '0')    
                return $this::send_success_response($query[0]->Message,"Success",$query);
            else
                return $this::send_failure_response($query[0]->Message,"Failure",[]);
            //print_r($query[0]->Message); 
        }
        catch(Exception $e)
        {
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
    }

    public function checkuserregistration(Request $req){

        $json_response_otp = array();
       // $json_response_otp_new = null;
        try{
            $checkdata = DB::select('call Check_User_Registration(?,?)',array($req->email,
                $req->mobNo));
            if($checkdata[0]->SavedStatus == '2'){
                $json_response_otp_new = array('SavedStatus' =>$checkdata[0]->SavedStatus ,'OTP'=>'');
                return $this::send_success_response($checkdata[0]->Message,"Success",$json_response_otp_new);

            }else if($checkdata[0]->SavedStatus == '1'){
                $otpControllerObj = new otpController;                
                $result_otp = $otpControllerObj -> otpinsert($req); 
                //print_r($result_otp -> original['Data']);exit();
               // print_r( $result_otp -> original); exit();
                $result_otp -> original['Message'] = $result_otp -> original['message'];
                $result_otp -> original['SavedStatus'] = $checkdata[0]->SavedStatus;
                $json_response_otp[] = $result_otp -> original;
                // print_r($json_response_otp);
                // exit();
                //$json_response_otp_new->SavedStatus = "test";//$checkdata[0]->SavedStatus;
                $json_response_otp_new = array('SavedStatus' =>$checkdata[0]->SavedStatus ,'OTP'=>$result_otp -> original['Data'] );
                //$json_response_otp_new->original['OTP']=$result_otp -> original['Data'];

                return $this::send_success_response('OTP Generated succesfully',"Success",$json_response_otp_new);
            }else{
                 return $this::send_failure_response($checkdata[0]->Message,"Failure",[]);
            }
        }catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
    }
}
