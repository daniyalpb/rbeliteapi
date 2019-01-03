<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class EliteReceiptController extends Controller
{
    function pdf(Request $req){
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->convert_customer_data_to_html($req->id));
            return $pdf->stream();
    }

    function convert_customer_data_to_html($id){
    	$data = DB::select('call getReceiptData(?)',array($id));
        //print_r($data); exit();
        $name = $data[0]->CustomerName;
        $amountinword = $data[0]->wordamount;
        $billno = $data[0]->ReceiptNo;
        $date = $data[0]->payment_date;
        $service = $data[0]->ProductName;
        $amount = $data[0]->Amount;
    	$output =   '<html>
                    <head>
                        <meta charset="utf-8">
                        <title>Elite Receipt</title>
                    </head>
                    <body style="font-family: arial; color:#666;">
                            <table width="820" border="0" style="background:#ffefef;margin:0 auto;border:10px solid #f7e5e5;padding:30px; padding-top:10px; margin-left: -30px; margin-right: 340px;" >
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align:center;  padding-top:10px;color:#666;    font-size: 35px;">ELITE RECEIPT</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Received with thanks from <input type="text" name="textfield" id="txtname"  style=" width: 690px; padding-left: 5px; font-size: 18px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;" value="'.$name.'"></p>

                                <p>the sum of Rupees <input type="text" name="textfield" id="txtamtwords" style=" width: 690px; padding-left: 5px; font-size: 18px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;" value="'.$amountinword.'"></p>
                              
                                <p><input type="text" name="textfield" id="txt" style=" width: 250px; padding-left: 5px; font-size: 18px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;">through online payment as advance for our bill no<input type="text" name="textfield" id="txtbillno" style=" width: 109px; padding-left: 5px; font-size: 18px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;" value="'.$billno.'"></p>
                              
                                <p>Dated<input type="text" name="textfield" id="txtdate" style=" width: 200px; padding-left: 5px; font-size: 18px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;" value="'.$date.'">on A/c of Service <input type="text" name="textfield" id="txtservice" style=" width: 324px; padding-left: 5px; font-size: 18px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;" value="'.$service.'"></p>
                              
                                <p><input type="text" name="textfield" id="txta" style=" width: 495px; padding-left: 5px; font-size: 18px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none; margin-top:15px;"></p>
                            </td>
                            </tr>
                            <tr>
                                <td><br><span style="margin-top:180px; font-size:30px;">Rs<input type="text" border="0" name="textfield" id="txtamtdigits" style="padding: 5px;margin-left: 3px; background: transparent;border: 1px solid #999; font-size:18px; color:#666;" value="'.$amount.'"></span><br>
                                <p style="font-size:11px;position:absolute;font-">This is a computer generated invoice no signature required.</p>
                                </td>
                            
                                <td><div style=" padding: 10px;margin-top:-5px;float: right;"><img src="rb_logo.png" /></div></td>
                            </tr>
                    </tbody>
                </table>
            </body>
        </html>';
    	return $output;
    }
}
