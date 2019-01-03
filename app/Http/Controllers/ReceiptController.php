<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReceiptController extends Controller{
    
    public function elite_receipt($id){
    	$result = DB::select("call getReceiptData(?)",array($id));

    	return view('WebView.Elite-Receipt',[ 'data' => $result ]);
    }
}
