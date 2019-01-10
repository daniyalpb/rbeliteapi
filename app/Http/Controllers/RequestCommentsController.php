<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Responce;

class RequestCommentsController extends InitialController
{
    public function saverequestcomments(Request $req){
    	try{
    		$savecomment = DB::select('call save_request_comments(?,?,?)',array($req->request_id,$req->comments,$req->comment_by));
    		if(count($savecomment) > 0){            	
            	return $this::send_success_response('Comments saved successfully' ,"Success",$savecomment);
            }else{
        		return $this::send_failure_response("Failed comment saved.","failure",$savecomment);
            }
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
    }

    public function getrequestcomments(Request $req){
    	try{
    		$getcomment = DB::select('call get_request_comments(?)',array($req->request_id));
    		if(count($getcomment) > 0){            	
            	return $this::send_success_response('Get comments successfully' ,"Success",$getcomment);
            }else{
        		return $this::send_failure_response("Failed get comment.","failure",$getcomment);
            }
        }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
    }

    public function savecommentsrequest1(Request $req){
        try{
            $savecommentAdmin = DB::select('call save_request_comments(?,?,?)',array($req->req_id,$req->req_comm,'Admin'));
            return $savecommentAdmin;
          }
        catch(Exception $e){
            return $this::send_failure_response($e->getMessage(),"failure",$e->getMessage());
        }
    }

    public function viewcommentsrequest(Request $req){
        $vgetcomment = DB::select('call get_request_comments(?)',array($req->vreq_id));
        return $vgetcomment;
    }
}
