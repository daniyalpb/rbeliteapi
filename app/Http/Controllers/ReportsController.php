<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportsController extends Controller{
    
    public function basic_report(){
    	$result_report = DB::select('call basic_report()');

    	return view('Reports.Basic_Report', ['data' => $result_report] );
    }

    public function getcustinfo(Request $req){
    	$custinfo = DB::select('call Get_Basic_Report_Customer_info(?)',array($req->custid));
    	return $custinfo;
    }

    public function getuserfieldvalue(Request $req){
    	$data = DB::select('call Get_User_Request_Fields(?)',array($req->RequestID));
    	return $data;
    }

     public function viewdetails($orderid){
        $data = DB::select('call Get_All_Sales_Master_Extra_Data(?)',array($orderid));
        return view('Reports.View_Details',['data'=>$data]);
    }
}