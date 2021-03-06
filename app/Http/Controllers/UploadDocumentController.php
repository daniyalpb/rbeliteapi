<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Response;


class UploadDocumentController extends CallApiController{


	public function upload(Request $req){

		$data=0;
		try {
			$file=$req->file('docfile');
			$location='/uploads/'.$req->userid.'/';
	        $destinationPath = $_SERVER['DOCUMENT_ROOT'] .$location;
	        $filename=$req->doctype.".".$file->getClientOriginalExtension();
	        $file->move($destinationPath,$filename);
	        $path=$location.$filename;		        
	        $data=DB::select("call upload_doc(?,?,?,?)",[URL('/').$path,$req->userid,$req->doctype,$req->order_id]);
		} catch (Exception $e) {
			// print_r($e->getMessage());
		}
	
        if($data[0]->status==1){
            return $this::send_success_response("Upload Successfully","Success",$data);
        }else{ 
            return $this::send_failure_response("Failed to upload","failure",[]); 
        }
        
	}

	public function getOrderDocument(Request $req){
        try {
            $order_id=$req['order_id'];           
            $data=DB::select('call getOrderDocument(?)',[$order_id]);

            if(sizeof($data)>0){
                return $this::send_success_response('Data loaded successfully' ,"Success",$data);
            }else{
                return $this::send_success_response("No order to show","Success",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        } 
    }

    public function upload_doc_comment(Request $req){

        $data=0;
        try {
            $file=$req->file('docfile');
            //print_r($file->getClientOriginalExtension());exit();
            $location='/uploads/'.$req->userid.'/';
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] .$location;
            $filename=time().".".$file->getClientOriginalExtension();
            $file->move($destinationPath,$filename);
            $path=$location.$filename;              
            $data=DB::select("call upload_doc_comment(?,?,?)",[URL('/').$path,$req->orderid,$file->getClientOriginalExtension()]);
        } catch (Exception $e) {
            // print_r($e->getMessage());
        }
    
        if($data[0]->status==1){
            return $this::send_success_response("Upload Successfully","Success",$data);
        }else{ 
            return $this::send_failure_response("Failed to upload","failure",[]); 
        }
        
    }

    public function view_doc_comment(Request $req){
        try {
            $orderid = $req->orderid;
           
            $data=DB::select('call view_doc_comment(?)',[$orderid]);

            if(sizeof($data)>0){
                return $this::send_success_response('Record Fetched' ,"Success",$data);
            }else{
                return $this::send_success_response("No record to show","Success",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        } 
    }

    public function save_doc_comment(Request $req){
        try {
            $userid = $req->userid;
           
            $data=DB::select('call save_doc_comment(?,?)',[$req->id,$req->comment]);

            if(sizeof($data)>0){
                return $this::send_success_response('Saved Successfully' ,"Success",$data);
            }else{
                return $this::send_success_response("Failed to Save","Success",[]); 
            }
        } catch (Exception $e) {
            return $this::send_failure_response($e->getMessage(),"failure",[]); 
        } 
    }

}