<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;


class NewInitialController extends Controller
{
    public function send_success_response($message,$status,$data){	
  		$res = array('message' =>$message ,'status'=>$status,'status_code'=>0,'Data'=>$data );
  		return Response::json($res);
  	}

  	public function send_failure_response($message,$status,$data){
  		$res = array('message' =>$message ,'status'=>$status,'status_code'=>1,'Data'=>[] );
  		return Response::json($res);
  	}

  	public function send_success_json_encode($data){
     	return Response::json($data);
  	}
}
