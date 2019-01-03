<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Elite Receipt</title>
</head>

<body style="font-family: arial; color:#666;">
	<table width="820" border="0" style="background:#ffefef;margin:0 auto;border:10px solid #f7e5e5;padding:30px; padding-top:10px;" >
  <tbody>
    <tr>
      <td colspan="2" style="text-align:center;  padding-top:10px;color:#666;    font-size: 35px;">ELITE RECEIPT</td>
    </tr>
    <tr>
      <td colspan="2">
		  
		  <p>Received with thanks from  <input readonly type="text" name="textfield" id="textfield" style=" width: 522px; padding-left: 5px; font-size: 16px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;" value="{{ trim($data[0] -> CustomerName) }}"> </p>

		  <p>the sum of Rupees  <input readonly type="text" name="textfield" id="textfield" style=" width: 580px; padding-left: 5px; font-size: 16px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;"  value="{{ trim($data[0] -> wordamount) }}"></p>
		  
		  <p><input readonly type="text" name="textfield" id="textfield" style=" width: 200px; padding-left: 5px; font-size: 16px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;">
		  	through online payment as advance for our bill no<input readonly type="text" name="textfield" id="textfield" style=" width: 160px; padding-left: 5px; font-size: 16px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;"  value="{{ trim($data[0] -> ReceiptNo) }}"></p>
		  
		  <p>Dated<input readonly type="text" name="textfield" id="textfield" style=" width: 200px; padding-left: 5px; font-size: 16px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;"  value="{{ $data[0] -> payment_date }}">
		  	on A/c of Service <input readonly type="text" name="textfield" id="textfield" style=" width: 350px; padding-left: 5px; font-size: 16px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;" value="{{ trim($data[0] -> ProductName) }}"></p>
		  
		  <p><input readonly type="text" name="textfield" id="textfield" style=" width: 380px; padding-left: 5px; font-size: 16px;color: #666; border: 0px; border-bottom: 1px solid #999;background: transparent;outline: none;"></p>
		
		</td>
    </tr>
    <tr>
      <td><span style="margin-top:80px; font-size:30px;">₹ <input readonly type="text" border="0" name="textfield" id="textfield" style="padding: 10px;margin-left: 10px; background: transparent;border: 1px solid #999;outline: none; font-size:16px; color:#666;" value="{{ trim($data[0] -> Amount) }}"></span>
	  <p style="font-size:11px;position:absolute;font-">This is a computer generated invoice no signature required</p>
	  </td>
		
      <td><div style="padding: 10px;margin-top:-20px;float: right;"><img src="{{ url('/images/rb_logo.png') }}" /></div></td>
    </tr>
  </tbody>
</table>

</body>
</html>
