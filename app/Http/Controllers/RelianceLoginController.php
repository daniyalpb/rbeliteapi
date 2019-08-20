<?php

 namespace App\Http\Controllers;
//namespace App\Http\Controllers\III_Ranks;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Response;
use Validator;
use Redirect;
use Session;
use URL;
use Mail;

class RelianceLoginController extends InitialController
{
    public function Reliancelogin(Request $req){
    	try{

$data = '[{
                 "PolicyNumber": "110521823110005216",
                 "ProductCode" : "2311",
                 "RiskEndDate" : "21 Jan 2019",
                 "RiskStartDate" : "22 Jan 2018",
                 "InsuredName" : "RUDRAGOUDA S PATIL",
                 "VehicleNumber" : "KA04ML6747",
                 "Make" : "SKODA",
                 "Model" : "RAPID",
                 "PolicyStatus" : "Active",
                 "ResponseStatus" : "Policy is eligible for ELITE services" 
                }]';


$json_data = json_decode($data, true);
                return $this::send_success_response("Success","success",$json_data);
exit();


    		if($req->PolicyNumber != null && $req->PolicyNumber != ''){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','token:P0licyB0ss'));
            curl_setopt($ch, CURLOPT_URL, 'http://horizon.policyboss.com:5000/quote/rilservice?vehicle_number='.$req->PolicyNumber);
           // curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FAILONERROR, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            //curl_setopt($ch, CURLOPT_POSTFIELDS,null);
            $http_result = curl_exec($ch);
            $error = curl_error($ch);
            $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
            curl_close($ch);
             
             $dom = new \DOMDocument();
            $dom->loadXml($http_result);
            $xpath = new \DOMXpath($dom);
            //print_r($xpath);exit();
            // register OWN namespace aliases for the xpath
            $xpath->registerNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
            $xpath->registerNamespace('cd', 'http://RGICL_Policy_Service.ServiceContracts/22/2014');

                    $PolicyNumber="";
                    $ProductCode="";
                    $RiskEndDate="";
                    $RiskStartDate="";
                    $InsuredName="";
                    $VehicleNumber="";
                    $Make="";
                    $Model="";
                    $PolicyStatus="";
                    $ResponseStatus="";
            foreach ($xpath->evaluate('//cd:GetPolicyDetailforRSAResult', NULL, FALSE) as $order) {
                    $ResponseStatus=$xpath->evaluate('string(cd:ResponseStatus)', $order, FALSE);
                    if($ResponseStatus=='Policy is eligible for ELITE services'){
                        $PolicyNumber=$xpath->evaluate('string(cd:PolicyNumber)', $order, FALSE);
                        $ProductCode=$xpath->evaluate('string(cd:ProductCode)', $order, FALSE);
                        $RiskEndDate=$xpath->evaluate('string(cd:RiskEndDate)', $order, FALSE);
                        $RiskStartDate=$xpath->evaluate('string(cd:RiskStartDate)', $order, FALSE);
                        $InsuredName=$xpath->evaluate('string(cd:InsuredName)', $order, FALSE);
                        $VehicleNumber=$xpath->evaluate('string(cd:VehicleNumber)', $order, FALSE);
                        $Make=$xpath->evaluate('string(cd:Make)', $order, FALSE);
                        $Model=$xpath->evaluate('string(cd:Model)', $order, FALSE);
                        $PolicyStatus=$xpath->evaluate('string(cd:PolicyStatus)', $order, FALSE);
                }
                else{
                    return $this::send_failure_response("Policy number or vehicle number does not exists.","failure",null);
                }
            }




    			// $data = '{
    			// 	"PolicyNumber": "110521823110005216",
    			// 	"ProductCode" : "2311",
    			// 	"RiskEndDate" : "21 Jan 2019",
    			// 	"RiskStartDate" : "22 Jan 2018",
    			// 	"InsuredName" : "RUDRAGOUDA S PATIL",
    			// 	"VehicleNumber" : "KA04ML6747",
    			// 	"Make" : "SKODA",
    			// 	"Model" : "RAPID",
    			// 	"PolicyStatus" : "Active",
    			// 	"ResponseStatus" : "Policy is eligible for ELITE services" 
    			// }';


                // $data = '{
                //     "PolicyNumber": "'.$PolicyNumber.'",
                //     "ProductCode" : "'.$ProductCode.'",
                //     "RiskEndDate" : "'.$RiskEndDate.'",
                //     "RiskStartDate" : "'.$RiskStartDate.'",
                //     "InsuredName" : "'.$InsuredName.'",
                //     "VehicleNumber" : "'.$VehicleNumber.'",
                //     "Make" : "'.$Make.'",
                //     "Model" : "'.$Model.'",
                //     "PolicyStatus" : "'.$PolicyStatus.'",
                //     "ResponseStatus" : "'.$ResponseStatus.'" 
                // }';

               

    			$json_data = json_decode($data, true);
    			return $this::send_success_response("Success","success",$json_data);
    		}else{
    			return $this::send_failure_response("policy number or vehicle number does not exists.","failure",null);
    		}
    	}catch(Exception $e){
    		return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
    	}
    }
}
