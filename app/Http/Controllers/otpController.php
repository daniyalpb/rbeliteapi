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

class otpController extends CallApiController
{

 public static $service_url_static = "http://services.rupeeboss.com/";
  public function otpinsert(Request $req)
  {
    //try{
//////////////////////////////////////////////////////

//public function vehicle_inspection_otp(Request $req){
      $status=0;
      //$msg="success";
      try {
        //$otp=123456;
       $otp = mt_rand(100000, 999999);
      
            Session::put('temp_contact', $req['mobNo']);
            // print_r(Session::get('temp_contact'));exit();
            $post_data='{"mobNo":"'.$req->mobNo.'","msgData":"your otp is '.$otp.' - RupeeBoss.com - Elite",
                        "source":"WEB"}';
                        // print_r( $post_data);exit();
            // $url = "http://beta.services.rupeeboss.com/LoginDtls.svc/xmlservice/sendSMS";
            $url = $this::$service_url_static."LoginDtls.svc/xmlservice/sendSMS";
            $result=$this->call_json_data_api($url,$post_data);
            $http_result=$result['http_result'];
            $error=$result['error'];
            $obj = json_decode($http_result);
            //print_r($obj->status);


      
      if($obj->status == "success"){

        //echo $obj->status;

      $query = DB::select('call usp_insert_otp(?,?,?,?)',array($otp,$req->email,$req->mobNo,$req->ip));
      //print_r($query);
      return $this::send_success_response('OTP Generated succesfully',"Success",(string)$otp);
    }
    else{
      return $this::send_failure_response("Error occured while sending OTP","failure","failure tested");
    }

      
    }
    catch(Exception $e)
    {
      return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
    }
  }

  public function otpverify(Request $req)
  {
    try{

      $query = DB::select('call usp_verify_otp(?,?,?)',array($req->otp,$req->mobile,$req->email));

      return $this::send_success_response($query[0]->Result,"Success","Test Succeed");
    }
    catch(Exception $e)
    {
      return $this::send_failure_response($e->getMessage(),"failure","failure tested");
    }
  }

  public function forgot_password(Request $req){
        
        // print_r($req->all());exit();
        $status_code=0;
        $status="success";
       
        try {
            $mobile = $req['mobile'];
            $type = $req['type'];
            $password = mt_rand(100000, 999999);
        Session::put('temp_contact', $req['mobile']);
        $post_data='{"mobNo":"'.$req['mobile'].'","msgData":"your password is '.$password.' - RupeeBoss.com",
                        "source":"WEB"}';
                        // print_r($post_data);exit();
            // $url = "http://beta.services.rupeeboss.com/LoginDtls.svc/xmlservice/sendSMS";
            $url = $this::$service_url_static."LoginDtls.svc/xmlservice/sendSMS";
            $result=$this->call_json_data_api($url,$post_data);
            $http_result=$result['http_result'];
            $error=$result['error'];
            $obj = json_decode($http_result);
            $q=DB::table('user_master')->select('mobile')->where('mobile','=',$req['mobile'])->first();
            $que=DB::table('agent_master')->select('ag_contact_no')->where('ag_contact_no','=',$req['mobile'])->first();
             
             
            if ($type==1 && isset($q->mobile)) {
             $query=DB::table('user_master')->where('mobile', $req['mobile'])
            ->update(['password' => $password]);
            
              return response()->json(array('status_code' =>0,'status'=>"success",'message'=>"Password has been sent to your registered number"));
            
            } elseif ($type==2 && $que->ag_contact_no) {
              $query=DB::table('agent_master') ->where('ag_contact_no', $req['mobile'])
            ->update(['agent_password' => $password]);
            
              return response()->json(array('status_code' =>0,'status'=>"success",'message'=>"Password has been sent to your registered number"));
            
            }else{

               return response()->json(array('status_code' =>1,'status'=>"failure",'message'=>"Number doesnt match."));
            } 
            
            
        } catch (Exception $e) {
            return response()->json(array('status' =>1,'status'=>"failure",'message'=>$e->getMessage()));
        }
        
    }

    public function change_password(Request $req){
       $status_code=0;
       $status="success";
      try {
     $mobile = $req['mobile'];
     $type = $req['type'];
     $current_password = $req['current_password'];
     $new_password = $req['new_password'];
     $confirm_password = $req['confirm_password'];
    
     $q=DB::table('user_master')->select('mobile')->where('mobile','=',$req['mobile'])->first();
     $que=DB::table('agent_master')->select('ag_contact_no')->where('ag_contact_no','=',$req['mobile'])->first();


     if ($new_password == $confirm_password ) {

      if ($type==1 && isset($q->mobile)) {
       $query=DB::table('user_master') ->where('mobile', $req['mobile'])
            ->update(['password' => $confirm_password]);
            if ($query) {
              return response()->json(array('status_code' =>0,'status'=>"success",'message'=>"Password has been updated"));
            }

      }elseif ($type==2 && isset($que->ag_contact_no)) {
        $query=DB::table('agent_master') ->where('ag_contact_no', $req['mobile'])
            ->update(['agent_password' => $confirm_password]);
            if ($query) {
              return response()->json(array('status_code' =>0,'status'=>"success",'message'=>"Password has been updated"));
            }
      }else{
        return response()->json(array('status_code' =>1,'status'=>"failure",'message'=>"Number doesnt match."));
      }
        
     }elseif ($new_password != $confirm_password) {
       return response()->json(array('message'=>"Both password should be same"));
     }
      } catch (Exception $e) {
        return response()->json(array('status_code' =>1,'status'=>"failure",'message'=>$e->getMessage()));
      }
  }

  public function rto(Request $req){
      try {
        $rto = DB::select('call all_rto_price_list()');
     // print_r($rto);exit();
     return $this::send_success_response('RTO updated',"success",$rto);
      } catch (Exception $e) {
        return $this::send_failure_response($e->getMessage(),"failure",null);
      }
     

    }

  public function rtobyproduct(Request $req){
      try {
        $rtolist = DB::select('call all_rto_price_list_by_product(?,?,?)',array($req->productid,$req->userid,$req->productcode));

        $cities = DB::select('call cities_available_by_product(?)',array($req->productid));

        $arr = array('cities' => $cities, 'rtolist'=> $rtolist);     // print_r($rto);exit();
     return $this::send_success_response('data fetched successfully',"success",$arr);
      } catch (Exception $e) {
        return $this::send_failure_response($e->getMessage(),"failure",null);
      }
    }

    public function rtobyproductchangevehicle(Request $req){
      try {
        $rtolist = DB::select('call all_rto_price_list_by_product_changevehicle(?,?,?,?,?)',array($req->productid,$req->userid,$req->productcode,$req->make,$req->model));

        $cities = DB::select('call cities_available_by_product(?)',array($req->productid));

        $arr = array('cities' => $cities, 'rtolist'=> $rtolist);     // print_r($rto);exit();
     return $this::send_success_response('data fetched successfully',"success",$arr);
      } catch (Exception $e) {
        return $this::send_failure_response($e->getMessage(),"failure",null);
      }
     

    }

}

?>