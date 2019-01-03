<?php 

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','token:P0licyB0ss'));
        curl_setopt($ch, CURLOPT_URL, 'http://horizon.policyboss.com:5000/quote/rilservice?vehicle_number='.$_GET["policyno"]);
       // curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,null);
        $http_result = curl_exec($ch);
        $error = curl_error($ch);
        $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
        curl_close($ch);
         
        $dom = new DOMDocument();
$dom->loadXml($http_result);
$xpath = new DOMXpath($dom);
//print_r($xpath);exit();
// register OWN namespace aliases for the xpath
$xpath->registerNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
$xpath->registerNamespace('cd', 'http://RGICL_Policy_Service.ServiceContracts/22/2014');
$result="";
foreach ($xpath->evaluate('//cd:GetPolicyDetailforRSAResult', NULL, FALSE) as $order) {
  $result=$xpath->evaluate('string(cd:PolicyNumber)', $order, FALSE);
}
return json_encode($result);
    
?>