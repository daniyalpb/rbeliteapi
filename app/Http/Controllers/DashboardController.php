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

      public function update_is_read_notifications(Request $request){

        $userid = Session::get('id');
        DB::select('call update_is_read_notifications(?,?)' , array($request->get('admin_notificationId') , $userid) );
      }
}