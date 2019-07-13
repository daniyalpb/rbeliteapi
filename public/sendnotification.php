<?php
       //echo "advjhkbjl;jfhdjkldfhgjkljfhjkgfjf";
       $service_url = 'elite.rupeeboss.com/api/send-db-notification';
       $curl = curl_init($service_url);
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($curl, CURLOPT_POST, false);
       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
       $curl_response = curl_exec($curl);
       curl_close($curl);
       $json_objekat=json_decode($curl_response);
       echo "Success: ".$json_objekat;
       
?>