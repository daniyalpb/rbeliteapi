<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CustomValidation extends Model{
public $validation_response = array();
    
public function set_new_password_validation($param){

//check if Old Password not Empty
if(isset($param['REQUEST'][$param['VALIDATIONS']['OLD_PASSWORD_FIELD_NAME']]) and !empty($param['REQUEST'][$param['VALIDATIONS']['OLD_PASSWORD_FIELD_NAME']])){

//check if old password is correct
$query = DB::select("call check_old_password(?)",array($param['USERNAME']));

if($param['REQUEST'][$param['VALIDATIONS']['OLD_PASSWORD_FIELD_NAME']] == $query[0]->pwd){
	$this -> validation_response['data'][$param['VALIDATIONS']['OLD_PASSWORD_FIELD_NAME']] = $param['REQUEST'][$param['VALIDATIONS']['OLD_PASSWORD_FIELD_NAME']];
}else{
	$this -> validation_response['error'][$param['VALIDATIONS']['OLD_PASSWORD_FIELD_NAME']] = "Old Password is Incorrect";
}
}else{
	$this -> validation_response['error'][$param['VALIDATIONS']['OLD_PASSWORD_FIELD_NAME']] = "Please Enter Old Password";
}

$this->password_validation($param);

return $this -> validation_response;
}


public function password_validation($param){

//check if New Password is not empty
if(isset($param['REQUEST'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']]) and !empty($param['REQUEST'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']])){

//check if new password and confirm password are same
if($param['REQUEST'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']] == $param['REQUEST'][$param['VALIDATIONS']['CONFIRM_PASSWORD_FIELD_NAME']]){

	$this -> validation_response['data'][$param['VALIDATIONS']['CONFIRM_PASSWORD_FIELD_NAME']] = $param['REQUEST'][$param['VALIDATIONS']['CONFIRM_PASSWORD_FIELD_NAME']];

}else{
	$this -> validation_response['error'][$param['VALIDATIONS']['CONFIRM_PASSWORD_FIELD_NAME']] = "Password do not match";
}


//Check Alphanumeric
if(preg_match("/(?=.*[a-zA-Z])(?=.*\d)/",$param['REQUEST'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']])){
	$this -> validation_response['data'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']] = $param['REQUEST'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']];
}
else{
	$this -> validation_response['error'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']] = "Password must be Alphanumeric [i.e. Password must contain atleast 1 Character and 1 Number.]";
}


//Check Special Character
if(preg_match("/(?=.*[@#$%^&*])/",$param['REQUEST'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']])){
	$this -> validation_response['data'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']] = $param['REQUEST'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']];
}
else{
	$this -> validation_response['error'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']] = "Password must contain atleast 1 Special Character.[Only '@','#','$','%','^','&','*' are Allowed]";
}


//check password length
if((strlen($param['REQUEST'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']]) >= 6 ) and (strlen($param['REQUEST'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']]) <= 15 )){
	$this -> validation_response['data'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']] = $param['REQUEST'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']];
}
else{
	$this -> validation_response['error'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']] = "Password Must be minimum 6 and maximum 15 characters";
}


}else{
	$this -> validation_response['error'][$param['VALIDATIONS']['NEW_PASSWORD_FIELD_NAME']] = "Please Enter New Password";
}

return $this -> validation_response;
}


public function validate_required($param){

	foreach($param['VALIDATIONS']['REQUIRED_VALIDATIONS'] as $fieldname => $error_msg){
		if(isset($param['REQUEST'][$fieldname]) and !empty($param['REQUEST'][$fieldname])){
			$this -> validation_response['data'][$fieldname] = trim($param['REQUEST'][$fieldname]);
		}
		else{
			$this -> validation_response['error'][$fieldname] = $error_msg;
		}
	}
	return $this -> validation_response;
}


public function validate_email($param){
	
$pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

foreach($param['VALIDATIONS']['EMAIL_VALIDATIONS'] as $fieldname => $error_msg){
	if(preg_match($pattern,trim($param['REQUEST'][$fieldname]))){
		$this -> validation_response['data'][$fieldname] = trim($param['REQUEST'][$fieldname]);
	}
	else{
		$this -> validation_response['error'][$fieldname] = $error_msg;
	}
}
return $this -> validation_response;
}

public function validate_numeric($param){

	foreach($param['VALIDATIONS']['NUMERIC_VALIDATIONS'] as $fieldname => $error_msg){
		if(is_numeric($param['REQUEST'][$fieldname])){
			$this -> validation_response['data'][$fieldname] = trim($param['REQUEST'][$fieldname]);
		}
		else{
			$this -> validation_response['error'][$fieldname] = $error_msg;
		}
	}
	return $this -> validation_response;
}


public function validate_char($param){

	foreach($param['VALIDATIONS']['CHAR_VALIDATIONS'] as $fieldname => $error_msg){
		if(isset($param['REQUEST'][$fieldname]) and !empty($param['REQUEST'][$fieldname])){
			if(preg_match('/^[A-Za-z\s]+$/',$param['REQUEST'][$fieldname])){
				$this -> validation_response['data'][$fieldname] = trim($param['REQUEST'][$fieldname]);
			}
			else{
				$this -> validation_response['error'][$fieldname] = $error_msg.' (Only alphabets, symbols and numbers not allowed.)';
			}
		}else{
			$this -> validation_response['error'][$fieldname] = $error_msg;
		}
	}
	return $this -> validation_response;
}


public function validate_mobilenumber($param){

	foreach($param['VALIDATIONS']['MOBILE_VALIDATIONS'] as $fieldname => $error_msg){
		if(is_numeric($param['REQUEST'][$fieldname])){
			if(strlen($param['REQUEST'][$fieldname]) == 10){
				$this -> validation_response['data'][$fieldname] = trim($param['REQUEST'][$fieldname]);
			}else{
				$this -> validation_response['error'][$fieldname] = "Enter 10 Digit Mobile Number";
			}
		}
		else{
			$this -> validation_response['error'][$fieldname] = $error_msg;
		}
	}
	return $this -> validation_response;
}


public function validate_documents($param){

	$allowed_fileTypes =  array('image/png','image/jpg','image/jpeg');
	$file_maxsize_bytes = 5242880;            //i.e. 5MB (MB to bytes convesion).
	$file_maxsize_MB = "5MB";

	$all_files_count = count($param['VALIDATIONS']['FILE_VALIDATIONS']);
	$empty_count = 0;

	foreach($param['VALIDATIONS']['FILE_VALIDATIONS'] as $fieldname => $file_parameters){

		if($file_parameters['name'] == ""){
			$empty_count++;
		}

		if(isset($file_parameters['type']) and !empty($file_parameters['type'])){
			if( !in_array($file_parameters['type'],$allowed_fileTypes) ) {
			    $this -> validation_response['error'][$fieldname] = "Invalid File Type.(Only 'png','jpg','jpeg' File types are allowed)";
			}
		}

		if($file_parameters['size'] > $file_maxsize_bytes){
			
			$this -> validation_response['error'][$fieldname] = "File Size Exceeded.(File Size must be less than $file_maxsize_MB)";
			
		}
	}

	if($all_files_count == $empty_count){
		$this -> validation_response['error']['messege'] = "error";
		$this -> validation_response['error']['alert_msg'] = "Please Upload Atleast 1 Document.";
	}

return $this -> validation_response;
}


public function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}

}