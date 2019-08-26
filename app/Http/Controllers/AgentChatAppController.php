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

class AgentChatAppController extends Controller
{
    public function agentchatcount(Request $req){
    	$count = DB::select('call Agent_Chat_Count()');
    	// print_r($count);exit();
    	return $count;
    }

    public function agentchatmsg(Request $req){
    	$msg = DB::select('call GetAgentChatMsg(?)',array($req->id));
    	return $msg;
    }

    public function addCommentagent(Request $req){
    	  $getid=Session::get('id');
    	  $save = DB::select('call Save_Agent_Chat_Msg(?,?,?)',array($req->reqidadminagnt,$getid,$req->admincommentagnt));
         $this->sendnotification($req->reqidadminagnt,$req->admincommentagnt,$save[0]->token_id,$save[0]->chat_date_time,$save[0]->display_request_id,$save[0]->chat_id);
    	  return $save; 
    }



    public function sendnotification($reqid,$msg,$token_id,$chat_date,$display_request_id,$chat_id){
        $to=$token_id;
        $notifyFlag='MSG';
        $imgurl='';
        $body=$msg;
        $title='Elite';
        $web_url='';
        $web_title='';
        $message_id='';
        $App_Name='';
        $notifyid='';
        $order_id='';
        $request_id=$reqid;
        $message=$msg;
        $chat_date=$chat_date;
        $type='A';
        $display_request_id=$display_request_id;
        $chat_id=$chat_id;
               	$header=array("Content-Type:application/json",
            "Authorization:key=AAAA8LQEaJk:APA91bFCHbV-Agn5pAFEIZlo1I5a1kJT045bSmgzxSPtTt6InH7upheQY_qcepYoMG5XiRgLGWnWPBSkVK0DpTrLo0OgXtylhCUAxSgD_SCof9_xd_E2UhjGrWRNJbFjFjvzWZQnTDPi",
            "Sender:1033812338841",
            "Cache-Control:no-cache");


          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>"{\"to\":\"$to\",\"data\":{\"notifyFlag\":\"$notifyFlag\",\"img_url\":\"$imgurl\",\"body\":\"$body\",\"title\":\"$title\",\"web_url\":\"$web_url\",\"web_title\":\"$web_title\",\"message_id\":\"$message_id\",\"App_Name\":\"$App_Name\",\"chat\":{\"req_id\":\"$request_id\",\"message\":\"$message\",\"created_date_time\":\"$chat_date\",\"type\":\"$type\",\"display_req_id\":\"$display_request_id\",\"chat_id\":\"$chat_id\"}}}",
          CURLOPT_HTTPHEADER => $header,
          ));
          $response = curl_exec($curl);
          $err = curl_error($curl);
          curl_close($curl);

    }
}