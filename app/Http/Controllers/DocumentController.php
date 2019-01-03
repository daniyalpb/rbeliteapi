<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Response;
use Validator;
use Redirect;
use URL;
use Mail;
use Excel;

class DocumentController extends CallApiController{

	public function new_template(){
		return view('dashboard.star_new_template');
	}
    
    public function list_of_requests(){

    	$result = DB::select('call ListOfDocRequests()');
    	return view('dashboard.ListOfDocumentsRequests', [ 'data' => $result]);
    }

    public function show_uploaded_docs(Request $request){
    	
    	$request_array = $request -> all();
    	$result = DB::select('call ShowUploadedDocs(?)',array($request_array['orderid']));

    	$table = "<table class='datatable-responsive table table-striped table-bordered dt-responsive nowrap'><thead>
				        <tr>
				            <th class='text-wrap1'>Document Name</th>
				            <th class='text-wrap1'>Is Uploaded ?</th>
				            <th class='text-wrap'>Change Status</th>
				        </tr>
				    </thead>
				    <tbody>";

		if(count($result) > 0){
			foreach($result as $val){

				if(empty($val -> path)){
					$is_uploaded = "Not Uploaded";
					$doc_name = $val -> document_name;
					$action_dropdown = "";
				}else{

					if($val -> docstatus == "2"){
						$docstatus = "Document Accepted";
						$show_span_docstatus = "Y";
						$action_dropdown = "
					<span id='span_docstatus_".$val -> id."' data-spanval='".$show_span_docstatus."'>".$docstatus."</span>";
					}

					elseif($val -> docstatus == "3"){
						$docstatus = "Document Rejected";
						$show_span_docstatus = "Y";
						$action_dropdown = "
					<span id='span_docstatus_".$val -> id."' data-spanval='".$show_span_docstatus."'>".$docstatus."</span>";
					}

					else{
						$show_span_docstatus = "N";
						$action_dropdown = "
					<span id='action_dropdown_status_".$val -> id."'></span>
					<span id='show_hide_action_dropdown_".$val -> id."'>
					<select class='form-control' data-doc_requid='".$val -> id."' name='action_".$val -> id."' id='action_".$val -> id."' onchange='update_docstatus(this.id)' >
					<option value=''>select</option>
					<option value='2'>Document Accepted</option>
					<option value='3'>Document Rejected</option>
					</select><br>
					<input type='text' name='reject_reason_".$val -> id."' id='reject_reason_".$val -> id."' class='form-control reject_reason_content' Placeholder='Enter Reason'><br>
					<input type='button' data-actiondropdownid='action_".$val -> id."' name='btn_reason_submit_".$val -> id."' id='btn_reason_submit_".$val -> id."' value='Submit' class='btn btn-primary reject_reason_content' onclick='update_docstatus(this.getAttribute(\"data-actiondropdownid\"))'>
					</span>";
					}

					$is_uploaded = "Uploaded";

					$doc_name = "<span style='cursor:pointer' id='up_doc_".$val -> id."' onclick='view_document(this.id)' data-href='".$val -> path."'><font color='#00a3cc'><u>".$val -> document_name."</u></font></span>";
				}
				$table .= "<tr>
				            <td class='text-wrap1'>".$doc_name."</td>
				            <td class='text-wrap1'>".$is_uploaded."</td>
				            <td class='text-wrap'>".$action_dropdown."</td> 
					       </tr>";
			} 
		}else{
			$table .= "<tr>
			           <td colspan='3'>No Documents Found</td>
					   </tr>";
		}

		$table .= "</tbody></table>";

		$msg = array('table_data' => $table);
		echo json_encode($msg);
    }


    public function update_docstatus(Request $request){

    	$user = Session::get('id');
    	$request_array = $request->all();

    	if($request_array['option_value'] == '2'){
    		DB::select("call updatedocumentstatus(?,?,?,?,?)",array($request_array['hidden_orderid'] , $request_array['doc_id'] , $request_array['option_value'] , null , $user));

    		$msg = array( 'status' => 'Document Accepted', 'doc_id' => $request_array['doc_id'] );
    	}

    	if($request_array['option_value'] == '3'){

    		DB::select("call updatedocumentstatus(?,?,?,?,?)",array($request_array['hidden_orderid'] , $request_array['doc_id'] , $request_array['option_value'] , $request_array['reject_reason'] , $user));

    		$msg = array( 'status' => 'Document Rejected', 'doc_id' => $request_array['doc_id'] );

    		try
    		{
    			$devicetoken = DB::select('call get_device_token(?)',array($request_array['hidden_orderid']));
    			//print_r($devicetoken[0]->device_token); exit();
    			$data='{"to":"'.$devicetoken[0]->device_token.'","notifyflag":"DR","imgurl":"http://i.stack.imgur.com/CE5lz.png","body":"Document rejected with flooding reason : '.$request_array['reject_reason'].'","title":"Document Rejected","notifyid":"0","isagentapp":"0","createdby":"'.$user.'","userid":"'.$user.'"}';
				$type= "Content-Type:application/json";
				//print_r($data); 
     			$result=$this->call_other_data_api('http://elite.rupeeboss.com/api/send-notification',$data,$type);
       			$http_result=$result['http_result'];
       			$error=$result['error'];
              	$st=str_replace('"{', "{", $http_result);
              	$s=str_replace('}"', "}", $st);
              	$m=str_replace('\\', "", $s);
              	$update_user='';        
              	$custrespon = response()->json(array('status' =>0,'message'=>"success"));
       		}
           	catch (Exception $e)
           	{
				//return $e->getMessage();    
    		}        
           		//return ($custrespon);
    	}

    	echo json_encode($msg);
    	exit;

    }
}