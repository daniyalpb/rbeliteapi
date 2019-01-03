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

class DocumentMasterController extends Controller
{
    public function documentmaster(){
    	$data = DB::select('call Get_Documents_Master()');
    	return view('dashboard.documents_master',['data'=>$data]);
    }

    public function documentmastersave(Request $req){
      if($req->uploaddoc == null || $req->uploaddoc == ''){
	      $data = DB::insert('call Add_document_master(?,?)',array($req->docname,$req->uploaddoc));
          if($data == 1){
             return redirect()->back()->with('message', 'Document uploaded successfully.');
          }else{
             return redirect()->back()->with('message', 'failure.');
          }
      }else{
        $file = $req->file('uploaddoc');
        $docnamenew = $file->getClientOriginalName();
        $destinationPath = 'uploads/DocumentsMaster';
        $file->move($destinationPath,$file->getClientOriginalName());
          $data = DB::insert('call Add_document_master(?,?)',array($req->docname,$destinationPath.'/'.$docnamenew ));
          if($data == 1){
             return redirect()->back()->with('message', 'Document uploaded successfully.');
          }else{
             return redirect()->back()->with('message', 'failure.');
          }
      }
    }

    public function getdocmaster(Request $req){
    	$data = DB::select('call Update_Get_Documents_Master(?)',array($req->doc_id));
    	return $data;
    }

    public function documentmasterupdate(Request $req){
      if($req->uploaddocupdate == null || $req->uploaddocupdate == ''){
           $data = DB::update('call update_document_master(?,?,?)',array($req->docid,$req->docnameupdate,$req->docview ));
           if($data == 1){
              return redirect()->back()->with('message', 'Updated successfully.');
           }else{
              return redirect()->back()->with('message', 'failure.');
           }
      }else{
           $file = $req->file('uploaddocupdate');
           $docnamenew = $file->getClientOriginalName();
           $destinationPath = 'uploads/DocumentsMaster';
           $file->move($destinationPath,$file->getClientOriginalName());
           $data = DB::update('call update_document_master(?,?,?)',array($req->docid,$req->docnameupdate,$destinationPath.'/'.$docnamenew ));
           if($data == 1){
              return redirect()->back()->with('message', 'Document Updated successfully.');
           }else{
              return redirect()->back()->with('message', 'failure.');
           }
      }
    }

    public function deldocmaster(Request $req){
      $deldata = DB::select('call delete_document_master(?)',array($req->id));
      return $deldata;
    }
}
