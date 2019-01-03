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

class OrdersListController extends Controller
{
    public function orderlist(Request $req){
    	$order=DB::select('call List_Of_Orders()');
        $getcity = DB::select('call Get_City()');
    	return view('dashboard.list_of_orders',['order'=>$order,'getcity'=>$getcity]);
    }

    public function getrto(Request $req){
        $getrtodependcity = DB::select('call Get_RTO_Depend_City(?)',array($req->cityid));
        return $getrtodependcity;
    }

    public function getagent(Request $req){
        $getagentdependrto = DB::select('call Get_Agent_Depends_RTO(?)', array($req->rtoid));
        return $getagentdependrto;
    }

    public function agentidupdatedata(Request $req){
    	 $updatedata = DB::select('call N_Order_Agent_Update(?,?,?,?)',array($req->smid,$req->city1,$req->rto1,$req->agent1));
    	return $updatedata;
    }
}
