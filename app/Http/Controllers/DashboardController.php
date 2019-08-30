<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class DashboardController extends InitialController{
	
      public function dashboard(){
    	 return view('dashboard.index');
      }

      public function notifications_count(){
       $userid=Session::get('id');
       $type = 'show_count';
       $data= DB::select('call admin_notifications_count(?,?)',array($userid,$type));
       return json_encode($data); 
      }

      public function update_is_viewed_notifications(){
        $userid=Session::get('id');
        DB::select('call update_is_viewed_notifications(?)',array($userid));

        $type = 'show_notifications';
        $data= DB::select('call admin_notifications_count(?,?)',array($userid,$type));
        return json_encode($data);
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
        $isview =DB::select('call update_comment_is_view(?)',array($useridisview));
        return json_encode($isview);
      }
  
}