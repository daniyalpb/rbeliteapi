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

class SendnotificationController extends InitialController
{
	public function sendnotification(Request $req)
	{
		//print_r($req->all());exit();
		$to=$req->to;
		$notifyFlag=$req->notifyflag;
		$imgurl=$req->imgurl;
		$body=$req->body;
		$title=$req->title;
		$notifyid=$req->notifyid;
		$order_id=$req->order_id;
        if ($req->isagentapp==1){
        	$header=array("Content-Type:application/json",
            "Authorization:key=AAAA8LQEaJk:APA91bFCHbV-Agn5pAFEIZlo1I5a1kJT045bSmgzxSPtTt6InH7upheQY_qcepYoMG5XiRgLGWnWPBSkVK0DpTrLo0OgXtylhCUAxSgD_SCof9_xd_E2UhjGrWRNJbFjFjvzWZQnTDPi",
            "Sender:1033812338841",
            "Cache-Control:no-cache");

        }else{
        	$header=array("Content-Type:application/json",
            "Authorization:key=AAAAwYIqbxU:APA91bHq2oAgRM-cIGCgoJ-VG14U9SuEt4mFcGXqOySBj8uUe6l2AtwWXdh5J9yICgWx_lDqicgbti-Ouu_C87-vDUX-LdTe4Bq-ae2jRjqr6N1uZpvHjP37rfskRPzvYe8zdOyRgaqC",
            "Sender:831112507157",
            "Cache-Control:no-cache");
        }
         //print_r($header);exit();
		  $curl = curl_init();
		  curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\"to\":\"$to\",\"data\":{\"notifyFlag\":\"$notifyFlag\",\"img_url\":\"$imgurl\",\"body\":\"$body\",\"title\":\"$title\"}}",
		  CURLOPT_HTTPHEADER => $header,
		  ));
		  $response = curl_exec($curl);
		  $err = curl_error($curl);
		  curl_close($curl);
		 if ($err){
		  $myJSONerr = json_decode($err);
		  return $this::send_success_json_encode($myJSONerr);
		}else {
			$myJSON = json_decode($response);			
			if ($myJSON->success==1&&$notifyid==0){
				DB::select('call insert_notifinaction_request(?,?,?,?,?,?,?,?)',array(
					$req->title,
                    $req->body,
                    $req->imgurl,
                    $req->userid,
                    $req->isagentapp,
                    $req->notifyflag,
                    $myJSON->results[0]->message_id,
			        $req->order_id));
			}else if($myJSON->success!=1&&$notifyid==0){
				DB::select('call insert_notifinaction_notsendrequest(?,?,?,?,?,?,?)',array(
					$req->title,
                    $req->body,
                    $req->imgurl,
                    $req->userid,
                    $req->isagentapp,
                    $req->notifyflag,
                    $req->order_id));
			}else if ($myJSON->success==1&&$notifyid!=0){
				DB::select('call update_notification_send(?,?)',array(
					$notifyid,
				    $myJSON->results[0]->message_id));
			}
		   return $this::send_success_json_encode($myJSON);
		}

	}
	public function senddbnotification(){
		$query = DB::select('call get_agent_notificationdata()');
		//print_r($query);exit();
		foreach ($query as $key => $val) {
		if ($val->isagentapp==1){
        	$header=array("Content-Type:application/json",
            "Authorization:key=AAAA8LQEaJk:APA91bFCHbV-Agn5pAFEIZlo1I5a1kJT045bSmgzxSPtTt6InH7upheQY_qcepYoMG5XiRgLGWnWPBSkVK0DpTrLo0OgXtylhCUAxSgD_SCof9_xd_E2UhjGrWRNJbFjFjvzWZQnTDPi",
            "Sender:1033812338841",
            "Cache-Control:no-cache");

        }else{
        	$header=array("Content-Type:application/json",
            "Authorization:key=AAAAwYIqbxU:APA91bHq2oAgRM-cIGCgoJ-VG14U9SuEt4mFcGXqOySBj8uUe6l2AtwWXdh5J9yICgWx_lDqicgbti-Ouu_C87-vDUX-LdTe4Bq-ae2jRjqr6N1uZpvHjP37rfskRPzvYe8zdOyRgaqC",
            "Sender:831112507157",
            "Cache-Control:no-cache");
        }		
		  $curl = curl_init();
		  curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\"to\":\"$val->device_token\",\"data\":{\"notifyFlag\":\"$val->notifyflag\",\"img_url\":\"$val->imgurl\",\"body\":\"$val->body\",\"title\":\"$val->title\"}}",
		  CURLOPT_HTTPHEADER => $header,
		  ));
		  $response = curl_exec($curl);
		  $err = curl_error($curl);
		  curl_close($curl);
		 if ($err){
		  $myJSONerr = json_decode($err);
		  return $this::send_success_json_encode($myJSONerr);
		}else {
			$myJSON = json_decode($response);			
			 if ($myJSON->success==1){
				DB::select('call update_notification_send(?,?)',array(
					$val->notifyid,
				    $myJSON->results[0]->message_id));
			}
		   
		}

		}
		return $this::send_success_json_encode("notification send successfully");
	}
}

