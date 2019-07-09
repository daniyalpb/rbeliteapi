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

class CrmController extends Controller{
 public function getcrm(){
   
   	$crmdata= DB::select("call crm_data()");
   	$disposition= DB::select("call crm_disposition()"); 	
 	return view('dashboard.Crm',['crmdata'=>$crmdata,'disposition'=>$disposition]);
 }
 public function getsubdisposition($id){
 	$subdisposition= DB::select("call crm_sub_dispodition($id)");
 	return json_encode($subdisposition);
 }
 public function inertcrmfollowup(Request $req){
 	//print_r($req->all());exit();
 	$user_id=Session::get('id');
 	//print_r($user_id);exit();
 	 $id= DB::select('call insert_crm_followup(?,?,?,?,?,?,?)',array(
 	 	$req->ddldisposition,
 	 	$req->ddlsubdisposition, 
 	 	$req->txtagent, 
 	 	$req->txtcustomer, 
 	 	$req->txtremark, 
 	 	$user_id,
 	    $req->txtrequestid));
 	 Session::flash('message', 'Record has been saved successfully');           
      return Redirect('crm');
 }
 public function getcrmhistory($id){
      	$crmhistorydata= DB::select("call get_crm_history($id)");
      	return json_encode($crmhistorydata) ;
 }
 public function closedfollowup($reqid){
 	$user_id=Session::get('id');
 	$data=DB::select("call closed_followup($reqid,$user_id)");
 	return json_encode($data);
 }

 public function getdoccallingdisposition(Request $req){
 	$getdata = DB::select("call GetDocCommentCallingDisposition(?)",array($req->id));
 	return $getdata;
 }
}