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
use App\library\Pagination ;

class Add_employee_Controller extends Controller{
	public function add_elite_employee(){
    $profileadd=DB::select("call get_elite_profile()"); 
    return view('dashboard.Add_employee',['profileadd'=>$profileadd]);

	}


		public function get_emp_data(Request $req){ 
         $data = DB::select("call get_elite_emp_data(?)",array($req->id));
         print_r($data);exit();
          return response()->json($data);
   }  


public function new_emp_add_elite(Request $req){
	             // print_r($req->all);exit();

    $user_id=Session::get('user_id');
    DB::select('call usp_insert_elite_emp(?,?,?,?,?,?)',array(
      $req->txtuserid,  
      $req->txtname,  
      $req->txtofcmail,    
      $req->txtprofile, 
      $req->txtstatus,
      $user_id,

));
    // Session::flash('message', 'Record Insert Successfully');
    return redirect('all_emp_data');
  } 


    public function all_emp_data(){
    $empdata=DB::select("call all_elite_emp_data()");
    return view('dashboard.elite_emp_details',['empdata'=>$empdata]);
  }

    public function get_update_employee_details($user_id){
    	$data=DB::select("call employee_details_by_user_id('$user_id')");
  	    $profileadd=DB::select("call get_elite_profile()"); 
  	   return view('dashboard.update_employee',['data'=>$data,'profileadd'=>$profileadd]);
   }

   public function update_emp_details(Request $req){
//print_r($req->all());exit();
   DB::select('call usp_update_emp_details(?,?,?,?,?,?)',array(
   	  $req->txtuserid,  
      $req->txtname,  
      $req->txtofcmail,    
      $req->txtprofile, 
      $req->txtstatus,
      $user_id,

  ));
    return redirect('all_emp_data');
 }
  
}