<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('table', function () {
    return view('dashboard.fba-list');
});


Route::post('admin-login','LoginController@login');
Route::get('register-user','LoginController@register_user');
Route::get('log-out','LoginController@logout');



Route::group(['middleware' => ['App\Http\Middleware\CheckUserSession']], function () {

Route::get('dashboard','DashboardController@dashboard');
Route::get('product-list','ProductController@product_list');
Route::get('product-add','ProductController@product_add');
Route::get('product/category-id','ProductController@category_id');
Route::POST('product-save','ProductController@product_save');
Route::get('get-product-edit/{id}','ProductController@getproductedit');
Route::POST('product-edit','ProductController@product_Edit');

Route::get('category-list','ProductController@category_list');
Route::POST('category-save','ProductController@categorysave');
Route::get('sub-category-id','ProductController@sub_category_id');
Route::POST('sub-category-save','ProductController@sub_category_save');
Route::get('company-master','CompanyMasterController@companymaste');
Route::POST('company-master-save','CompanyMasterController@companymaste_save');
Route::post('company-edit-submit','CompanyMasterController@company_edit_submit');


Route::get('documents','CompanyMasterController@documents_required');
Route::post('documents-submit','CompanyMasterController@documents_submit');
Route::post('documents-edit-submit','CompanyMasterController@documents_edit_submit');






Route::get('agent-list','AgentController@agent_list');
Route::POST('agent-save','AgentController@agent_save');
Route::get('elite-card-master','AgentController@mastercard');
Route::POST('elite-save','AgentController@elite_save');

Route::get('rto-list','AgentController@rto_list');
Route::POST('rto-save','AgentController@rto_save');
Route::get('Payment-Report','Payment_reportController@getview');
Route::get('Payment-Report-get/{id}','Payment_reportController@reportshow');
Route::get('paymentdone','Payment_reportController@getpaymentdone');
Route::get('PaymentPending','Payment_reportController@getpaymentpending');
Route::get('UnassignedLead','Payment_reportController@getUnassignedLead');
Route::get('assignedLead','Payment_reportController@getassignedLead');



Route::get('/Document-Requests','DocumentController@list_of_requests');
Route::get('/show-uploaded-docs','DocumentController@show_uploaded_docs');
Route::get('/update-docstatus','DocumentController@update_docstatus');



//shubham start//
Route::get('crm','CrmController@getcrm');
Route::get('get-sub-disposition/{id}','CrmController@getsubdisposition');
Route::post('insert-crm-followup','CrmController@inertcrmfollowup');
Route::get('crm-history/{id}','CrmController@getcrmhistory');
Route::get('closed-followup/{reqid}','CrmController@closedfollowup');
//shubham End//



//Paritosh start
Route::get('product-city-price-mapping','MappingController@product_city_price_mapping');
Route::get('get-product-mapped-city-price/{product_id}','MappingController@get_product_mapped_city_price');
Route::post('update-product-city-price-mapping','MappingController@update_product_city_price_mapping');
Route::post('insert-product-city-price-mapping','MappingController@insert_product_city_price_mapping');
Route::get('get-product-unmapped-cities/{product_id}','MappingController@get_product_unmapped_cities');
//Paritosh end

});

Route::get('/Basic-Report','ReportsController@basic_report');
Route::get('/view-details/{orderid}','ReportsController@viewdetails');


Route::get('access_token.php','TransactionController@give_token');
Route::get('/new_template','DocumentController@new_template');


//--------------------------NITIN-------------------------------------
Route::get('order-list','OrdersListController@orderlist');
Route::get('get-rto/{cityid}','OrdersListController@getrto');
Route::get('get-agent/{rtoid}','OrdersListController@getagent');
Route::GET('agentidupdate','OrdersListController@agentidupdatedata');

Route::get('get-cust-info/{custid}','ReportsController@getcustinfo');
Route::get('get-user-field-value/{RequestID}','ReportsController@getuserfieldvalue');

Route::get('get-rto-field-value/{RequestID}','AgentController@getrtofieldvalue');
Route::get('agent-update/{ageid}','AgentController@agentupdate');
Route::post('agent-update','AgentController@agent_update');

Route::get('document-master','DocumentMasterController@documentmaster');
Route::post('document-master-save','DocumentMasterController@documentmastersave');
Route::post('document-master-update','DocumentMasterController@documentmasterupdate');

Route::get('get-doc-master/{doc_id}','DocumentMasterController@getdocmaster');
Route::get('del-doc-master/{id}','DocumentMasterController@deldocmaster');

Route::get('documents-mapping','DocumentsMappingController@documentsmapping');
Route::post('save-documents-mapping','DocumentsMappingController@savedocumentsmapping');
Route::get('get-mapping-doc-productwise/{proid}','DocumentsMappingController@getmappingdocproductwise');

Route::get('get-doc-productwise/{proid}','DocumentsMappingController@getdocproductwise');

Route::get('del-pro-doc-mapping/{productid}/{docid}','DocumentsMappingController@delprodocmapping');

Route::get('elite-receipt/{id}','EliteReceiptController@pdf');

Route::get('save-comments-request/{req_id}/{req_comm}','RequestCommentsController@savecommentsrequest1');

Route::get('view-comments-request/{vreq_id}','RequestCommentsController@viewcommentsrequest');