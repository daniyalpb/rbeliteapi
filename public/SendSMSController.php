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



$service_url = '43.242.212.34/mspProducerM/sendSMS?user=rbeltt&pwd=rbeltt&sender=RBELIT&mobile=9702943935&msg=TEST MSG Daniyal 123&mt=0';

 $curl = curl_init($service_url);
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($curl, CURLOPT_POST, false);
       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
       $curl_response = curl_exec($curl);
       curl_close($curl);
       $json_objekat=json_decode($curl_response);
       echo "Success: ".$json_objekat;
exit();



 $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    exit();
/*
 $result=$this->call_json_data_api($url,"");
 print_r($result);exit();*/

 
  $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        //curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $http_result = curl_exec($ch);
        $error = curl_error($ch);
        $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
        curl_close($ch);
        $result=array('http_result' =>$http_result ,'error'=>$error );
        print_r(        $result);

exit();


/*
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://43.242.212.34/mspProducerM/sendSMS?user=rbeltt&pwd=rbeltt&sender=RBELIT&mobile=83559920808&msg=TEST MSG Daniyal&mt=0',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
]);
print_r($curl);
// Send the request & save response to $resp
$resp = curl_exec($curl);
print_r($resp );
// Close request to clear up some resources
curl_close($curl);

exit();*/

              $smsdata=DB::select('call getSMSToSend()');

              if(count($smsdata)>0){
                for ($i=0; $i < count($smsdata); $i++) { 
                  $messageid = "uytrdfghbj";                  
                  $query = DB::select('call updateSMSStatus(?,?)',array($smsdata[$i]->smsrqe_id,$messageid));
                }

              }   
              return Response::json("Success");
              //return $this::send_success_response("Send Success" ,"Success","Done");         
        }
}
