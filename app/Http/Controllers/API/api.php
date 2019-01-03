<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('test','UserController@data');
Route::post('errordata','UserController@errordata');
Route::post('getdata','ProductTypeController@getdata');
Route::post('insert','ProductTypeController@insertproducttype');
Route::post('add-user','UserController@insertdata');
Route::post('otp-insert','otpController@otpinsert');
Route::post('otp-verify','otpController@otpverify');
Route::post('getuser-details','UserController@getuser');
Route::post('update-user','UserController@updateuser');
Route::post('login','UserController@login');
Route::get('loadproduct','ProductTypeController@loadproduct');


Route::post('insertorder','ProductTypeController@insertorder');
Route::post('get-tasklist','ProductTypeController@getorderdetails');


//Route::post('update-order','ProductTypeController@updateorderstatus');elite.rupeeboss.com/api/update-order

Route::post('add-by-pincode','ProductTypeController@loadpincode');
Route::post('load-states','ProductTypeController@loadstates');
Route::post('load-cities','ProductTypeController@loadcities');
Route::post('getincome','TransactionController@getincome');
Route::post('agent-order-detail','TransactionController@getagentorderdetails');
Route::post('update-order-status','TransactionController@updateorderstatus');
Route::post('getpending-wallet','TransactionController@getpendingwallet');
Route::post('agent-amt-request','TransactionController@agentamtrequest');


Route::post('forgot-password','otpController@forgot_password');
Route::post('change-password','otpController@change_password');

Route::post('agentaccept-status-update','TransactionController@agentaccept_status_update');

Route::post('get-orders','TransactionController@show_orders');
Route::post('update-order-docs','TransactionController@updateorderdocs');

Route::get('load-all-cities','ProductTypeController@loadallcities');
Route::post('update-order','TransactionController@update_orders');

Route::post('doc-upload','UploadDocumentController@upload');
Route::get('rto-location','otpController@rto');
Route::post('rto-byproducts','otpController@rtobyproduct');
Route::get('get-version','UserController@get_version');

//-----------------------31-7-2018----------------------------------

Route::post('get-service-list','RTOController@GetRTOData');
Route::post('get-rto-list','RTOListController@RTOList');
Route::post('get-non-rto-list','NONRTOController@NONRTOList');
Route::post('get-product-wise-document','ProductWiseDocumentController@product_wise_document');

//---------------------------Daniyal-----------------------------
Route::post('get-order-document','UploadDocumentController@getOrderDocument');
Route::post('rto-byproducts-chahngevehicle','otpController@rtobyproductchangevehicle');
Route::post('get-rto-list-chahngevehicle','RTOListController@RTOList_Change_Vehicle');
Route::post('get-user-constant','ConstantController@getUserConstant');
Route::post('change-vehicle','VehicleController@changeVehicle');

//---------------------------30-10-2018-------------------------------

Route::post('reliance-login','RelianceLoginController@Reliancelogin');
Route::post('user-registration','UserRegistrationController@UserRegistration');
Route::post('check-user-registration','UserRegistrationController@checkuserregistration');
Route::post('user-otp-verify','UserRegistrationController@userotpverify');
Route::post('vehicle-details','VehicleDetailsController@vehicle_details');

Route::post('check-agent-registration','AgentRegistrationController@checkagentregistration');
Route::post('agent-otp-verify','AgentRegistrationController@agentotpverify');

//shubham start//
Route::post('send-notification','SendnotificationController@sendnotification');

Route::get('send-db-notification','SendnotificationController@senddbnotification');

//shubham End//

//Nitin start
Route::post('get-notification','NotificationController@getnotification');
Route::POST('get-vehicle-data','VehicleDetailsController@getvehicledata');
Route::post('get-ifsc-code','GetIFSCController@getifsccode');
Route::post('get-health-insurance','API\HealthInsuranceController@gethealthinsurance');
Route::post('get-motor-insurance','API\MotorInsuranceController@getmotorinsurance');
Route::get('get-city-rto','API\GetCityWiseRTOController@getcityrto');
Route::post('order-save-rcservice1','API\OrderDetailsInsertRCService1Controller@insertorderdetailsRCService1');

Route::post('get-product-price','API\GetProductPriceController@getproductprice');
//Nitin End

