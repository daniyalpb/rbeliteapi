<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class DashboardController extends InitialController{
	
  public function dashboard(){
	return view('dashboard.index');
  }

  public function comments_count(){
	           $userid=Session::get('id');
             $data= DB::select('call request_comments_count(?)',array($userid));
             return json_encode($data);
            // return view('dashboard.index',['data'=>$data]); 
        }

             public function view_comment(){
             // print_r($req->all);exit();
             $userid=Session::get('id');
             $query= DB::select('call user_comment_view(?)',array($userid));
             //return json_encode($query);
             return view('dashboard.user_comment_view',['query'=>$query]);
        }


            public function update_is_view(Request $req){                
            $useridisview=Session::get('id');
            $isview =DB::select('call update_comment_is_view(?)',array($useridisview 
    ));
           return json_encode($isview);

  
}
  
}