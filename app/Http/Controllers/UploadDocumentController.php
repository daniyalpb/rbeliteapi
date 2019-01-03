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
}