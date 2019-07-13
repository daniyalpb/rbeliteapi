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
use App\library\Pagination ;
use App\Http\Requests;


class SendSMSController extends CallApiController
{
        public function sendallsms(){  



              $smsdata=DB::select('call getSMSToSend()');

              if(count($smsdata)>0){
                for ($i=0; $i < count($smsdata); $i++) { 
                  $service_url = 'http://43.242.212.34/mspProducerM/sendSMS?user=rbeltt&pwd=rbeltt&sender=RBELIT&mobile='.$smsdata[$i]->mobile_no.'&msg='.urlencode($smsdata[$i]->sms_body).'&mt=0';
                  //print_r($service_url);exit();
                  $curl = curl_init($service_url);
                  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($curl, CURLOPT_POST, false);
                  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                  $curl_response = curl_exec($curl);
                  curl_close($curl);
                  //print_r($curl_response);exit();
                  $messageid = $curl_response;
                  $query = DB::select('call updateSMSStatus(?,?)',array($smsdata[$i]->smsrqe_id,$messageid));
                }

              }   
              return Response::json("Success");
              //return $this::send_success_response("Send Success" ,"Success","Done");         
        }
}
