<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\CustomValidation;

class MappingController extends Controller{
    
    public function product_city_price_mapping(){

    	$product_data = DB::select('call Get_all_Product()');
    	return view('dashboard.product_city_price_mapping', ['product_data'=>$product_data] );
    }

    public function get_product_mapped_city_price($product_id){
        $days = 'Days';
    	$result = DB::select('call get_product_mapped_city_price(?)' , array($product_id));

    	$table_data = '<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="table_id">
						<thead>
							<tr>
							   <th>Product Name</th>
					           <th>City Name</th>
					           <th>Price</th>
					           <th>TAT</th>
					           <th></th>
							</tr>
						</thead>
						<tbody>';

		foreach($result as $val){

			$json_object = htmlspecialchars(json_encode(array('product_id' => $val -> product_id , 'city_id' => $val -> city_id , 'price' => $val -> price , 'TAT' => $val -> TAT , 'product_name' => $val -> product_name , 'cityname' => $val -> cityname , 'id' => $val -> id)), ENT_QUOTES, 'UTF-8');

			$table_data .= '<tr>
			<td>'.$val -> product_name.'</td>
	       	<td>'.$val -> cityname.'</td>
	        <td>'.$val -> price.'</td>
	        <td>'.$val -> TAT.' - '.$days.'</td>
	        <td><a href="#" class="btn btn-primary" name="modify_'.$val -> id.'" id="modify_'.$val -> id.'" onclick="modify_price_tat('.$json_object.');" data-toggle="modal" data-target="#update_Modal">Modify</a></td>
	       </tr>';
		}

		$table_data .= '</tbody></table><script>$("#table_id").DataTable();</script>';

		$msg = array('messege' => 'success', 'table_data' => $table_data);
		echo json_encode($msg);

    }


    public function update_product_city_price_mapping(Request $request,CustomValidation $validator){

    	$data = array();
    	$error = array();
    	$post_array = $request ->all();

    	$parameters['REQUEST'] = $request->all();
        $parameters['VALIDATIONS'] = array(
            'NUMERIC_VALIDATIONS'=>array('update_price'=>'Please Enter Price','update_tat'=>'Please Enter TAT'));
                             
        extract($validator->validate_numeric($parameters));

    	if(count($error) === 0){
    		DB::select('call update_product_city_price_mapping(?,?,?,?)' ,array($post_array['mapping_id'] , $post_array['update_price'] ,$post_array['update_tat'] , Session::get('user_id')) );

    		$msg = array('status' => 'success', 'messege' => 'Updated Successfully');
			echo json_encode($msg);

    	}else{
            echo json_encode($error);
        }
    }


    public function get_product_unmapped_cities($product_id){

    	$option_data = "<option value=''>Select City</option>";
    	$result = DB::select('call get_product_unmapped_cities(?)' ,array($product_id));
    	
    	foreach($result as $val){
    		$option_data .= "<option value='".$val -> city_id."'>".$val -> cityname."</option>";
    	}

    	echo $option_data;

    }


    public function insert_product_city_price_mapping(Request $request,CustomValidation $validator){

    	$data = array();
    	$error = array();
    	$post_array = $request ->all();

    	$parameters['REQUEST'] = $request->all();
        $parameters['VALIDATIONS'] = array(
            'NUMERIC_VALIDATIONS'=>array('insert_price'=>'Please Enter Price','insert_tat'=>'Please Enter TAT'),
            'REQUIRED_VALIDATIONS'=>array('insert_product'=>'Please Select Product','insert_city_name'=>'Please Select City')
        );
                             
        extract($validator->validate_numeric($parameters));
        extract($validator->validate_required($parameters));

    	if(count($error) === 0){
    		DB::select('call insert_product_city_price_mapping(?,?,?,?,?)' , array($post_array['insert_product'],$post_array['insert_city_name'],$post_array['insert_price'],$post_array['insert_tat'],Session::get('user_id')));

    		$msg = array('status' => 'success', 'messege' => 'Inserted Successfully');
			echo json_encode($msg);

    	}else{
            echo json_encode($error);
        }
    }

}