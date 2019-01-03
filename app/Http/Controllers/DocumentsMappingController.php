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
class DocumentsMappingController extends Controller
{
    public function documentsmapping(){
    	$product = DB::select('call Get_all_Product()');
    	$docname = DB::select('call Get_all_DocName()');
    	return view('dashboard.Documents_Mapping',['product'=>$product,'docname'=>$docname]);
    }

    public function savedocumentsmapping(Request $req){
    	$savedata = DB::select('call save_productwise_documents_mapping(?,?)',array( $req->proid,$req->docid));
    	if(count($savedata)>0){
    		return redirect()->back()->with('message', 'Document mapping successfully.');
    	}else{
    		return redirect()->back()->with('message', 'Failed document mapping.');
    	}
    }

    public function getmappingdocproductwise(Request $req){
    	$getdocname = DB::select('call Get_ProductWise_Documents(?)',array($req->proid));
    	return $getdocname;
    }

    public function delprodocmapping(Request $req){
    	$deldoc = DB::select('call del_productwise_documents1(?,?)',array($req->productid,$req->docid));
    	return $deldoc;
    }
}
