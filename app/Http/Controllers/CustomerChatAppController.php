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

class CustomerChatAppController extends Controller
{
    public function custchatcount(Request $req){
    	$count = DB::select('call Cust_Chat_Count()');
    	return $count;
    }

    public function custchatmsg(Request $req){
    	$msg = DB::select('call GetCustomerChatMsg(?)',array($req->id));
    	return $msg;
    }

    public function addComment(Request $req){
    	  $Aid=Session::get('id');
    	  $save = DB::select('call Save_Cust_Chat_Msg(?,?,?)',array($req->reqidadmin,$Aid,$req->admincomment));
          $this->sendnotification($req->reqidadmin,$req->admincomment,$save[0]->token_id,$save[0]->chat_date_time,$save[0]->display_request_id,$save[0]->chat_id);
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
            "Authorization:key=AAAAwYIqbxU:APA91bHq2oAgRM-cIGCgoJ-VG14U9SuEt4mFcGXqOySBj8uUe6l2AtwWXdh5J9yICgWx_lDqicgbti-Ouu_C87-vDUX-LdTe4Bq-ae2jRjqr6N1uZpvHjP37rfskRPzvYe8zdOyRgaqC",
            "Sender:831112507157",
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
