@extends('include-new.master')
@section('content')

<style>
.error_class{
	color:red;
}
</style>

<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">Product City Price Mapping</h4>
              <p><a href="#" data-target='#insert_Modal' data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add New</a></p>
              <p style='padding-top:10px;'>
              	<label>Select Product</label>
              	<select name='product' id='product' class='form-control'>
              		<option value=''>Select Product</option>
              		@foreach($product_data as $val)
              			<option value='{{ $val -> id }}'>{{ $val -> name }}</option>
              		@endforeach
              	</select>
              </p>
		        <div class="overflow-scroll">
					<div class="table-responsive" id='table_response'>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>


 <div class="modal fade" id="update_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Price and TAT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form name='update_price_city_modal' id='update_price_city_modal'>
	{{ csrf_field() }}
	<input type='hidden' name='mapping_id' id='mapping_id' readonly='readonly' placeholder="Mapping Id" class='form-control'>
	<input type='hidden' name='product_id' id='product_id' readonly='readonly' placeholder="Product Id" class='form-control'>
	<input type='hidden' name='city_id' id='city_id' readonly='readonly' placeholder="City Id" class='form-control'>

      	<div class='row'>
      		<div class="col-lg-12">
			    <div class="form-group">
			        <label class="control-label col-xs-4">Product Name = </label>
			        <div class="col-xs-8">
			          <span class="control-label help-inline" id="spn_product_name"></span> 
			        </div>
			    </div>  
			</div>
		</div> 

		<div class='row'>
			<div class="col-lg-12">
			    <div class="form-group">
			        <label class="control-label col-xs-4">City Name = </label>
			        <div class="col-xs-8">
			          <span class="control-label help-inline" id="spn_city_name"></span> 
			        </div>
			    </div>
			</div>
		</div>

		<div class='row'>
			<div class="col-lg-12">
			    <div class="form-group">
			        <label class="control-label col-xs-4">Price = </label>
			        <div class="col-xs-8">
			          <span class="control-label help-inline">
			          	<input type='text' name='update_price' id='update_price' class='form-control' onkeypress='onlyNumber(event);' placeholder='Enter Price'>
			          	<span class='error_class' id="err_update_price"></span>
			          </span> 
			        </div>
			    </div>
			</div>
		</div>

		<div class='row'>
			<div class="col-lg-12">
			    <div class="form-group">
			        <label class="control-label col-xs-4">TAT = </label>
			        <div class="col-xs-8">
			          <span class="control-label help-inline">
			          	<input type='text' name='update_tat' id="update_tat" class='form-control' onkeypress='onlyNumber(event);' placeholder="Enter TAT">
			          	<span class='error_class' id="err_update_tat"></span>
			          </span> 
			        </div>
			    </div>
			</div>
		</div>

</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" name='btn_submit_update' id='btn_submit_update'>Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



 <div class="modal fade" id="insert_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert Price and TAT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form name='insert_price_city_modal' id='insert_price_city_modal'>
{{ csrf_field() }}

      	<div class='row'>
      		<div class="col-lg-12">
			    <div class="form-group">
			        <label class="control-label col-xs-4">Product Name = </label>
			        <div class="col-xs-8">
			          <select name='insert_product' id='insert_product' class='form-control'>
	              		<option value=''>Select Product</option>
	              		@foreach($product_data as $val)
	              			<option value='{{ $val -> id }}'>{{ $val -> name }}</option>
	              		@endforeach
		              </select>
		              <span class='error_class' id="err_insert_product"></span>
			        </div>
			    </div>  
			</div>
		</div> 

		<div class='row'>
			<div class="col-lg-12">
			    <div class="form-group">
			        <label class="control-label col-xs-4">City Name = </label>
			        <div class="col-xs-8">
			          <select name='insert_city_name' id='insert_city_name' class='form-control'>
			          	<option value=''>Select City</option>
			          </select>
			          <span class='error_class' id="err_insert_city_name"></span>
			        </div>
			    </div>
			</div>
		</div>

		<div class='row'>
			<div class="col-lg-12">
			    <div class="form-group">
			        <label class="control-label col-xs-4">Price = </label>
			        <div class="col-xs-8">
			          <span class="control-label help-inline">
			          	<input type='text' name='insert_price' id='insert_price' class='form-control' onkeypress='onlyNumber(event);' placeholder='Enter Price'>
			          	<span class='error_class' id="err_insert_price"></span>
			          </span> 
			        </div>
			    </div>
			</div>
		</div>

		<div class='row'>
			<div class="col-lg-12">
			    <div class="form-group">
			        <label class="control-label col-xs-4">TAT = </label>
			        <div class="col-xs-8">
			          <span class="control-label help-inline">
			          	<input type='text' name='insert_tat' id="insert_tat" class='form-control' onkeypress='onlyNumber(event);' placeholder="Enter TAT">
			          	<span class='error_class' id="err_insert_tat"></span>
			          </span> 
			        </div>
			    </div>
			</div>
		</div>

</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" name='btn_submit_insert' id='btn_submit_insert'>Insert</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src="{{ url('javascripts/jquery.min.js') }}"></script>
<script>
	$("#product").on('change',function(){
		var product_id = $(this).val();

		$.ajax({
			url : 'get-product-mapped-city-price/' + product_id,
			method : 'GET',
			success : function(response){
				var data = JSON.parse(response);
				$('#table_response').html(data.table_data);
			}
		});
	});


	function modify_price_tat(object){
		var data = object;
		console.log(data);
		$("#spn_product_name").text(data.product_name);
		$("#spn_city_name").text(data.cityname);
		$("#update_price").val(data.price);
		$("#update_tat").val(data.TAT);
		$("#mapping_id").val(data.id);
		$("#product_id").val(data.product_id);
		$("#city_id").val(data.city_id);
	}


	function onlyNumber(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    }


    $('#btn_submit_update').on('click' , function(){

    	$('.error_class').empty();
    	var formdata = new FormData($('#update_price_city_modal')[0]);

    	$.ajax({
    		type : 'POST',
    		url : '{{ URL::to('update-product-city-price-mapping') }}',
    		data : formdata,
    		processData : false,
    		contentType : false,
    		success : function(response){
    			var data = JSON.parse(response);

    			if(data.status == 'success'){
    				alert(data.messege);
    				window.location.reload();
    			}else{
    				$.each(data , function(key , value){
    					$("#err_" + key ).text(value);
    				});
    			}
    		}
    	});
    });

    $('#insert_product').on('change' , function(){
    	var insert_product_id = $(this).val();

    	$.ajax({
			url : 'get-product-unmapped-cities/' + insert_product_id,
			method : 'GET',
			success : function(response){
				$('#insert_city_name').html(response);
			}
		});
    });


    $('#btn_submit_insert').on('click' , function(){

    	$('.error_class').empty();
    	var formdata = new FormData($('#insert_price_city_modal')[0]);

    	$.ajax({
    		type : 'POST',
    		url : '{{ URL::to('insert-product-city-price-mapping') }}',
    		data : formdata,
    		processData : false,
    		contentType : false,
    		success : function(response){
    			var data = JSON.parse(response);

    			if(data.status == 'success'){
    				alert(data.messege);
    				window.location.reload();
    			}else{
    				$.each(data , function(key , value){
    					$("#err_" + key ).text(value);
    				});
    			}
    		}
    	});
    });
</script>
@endsection		