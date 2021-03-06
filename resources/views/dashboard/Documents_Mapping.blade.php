@extends('include-new.master')
@section('content')
<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
				<h3 class="card-title">Product Document Mapping</h3>
				@if(session()->has('message'))
				    <div class="alert alert-success">
				        {{ session()->get('message') }}
				    </div>
				@endif
				<!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#product">Document Mapping</button> -->
				<form action="{{url('save-documents-mapping')}}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
				
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-2">
							<label>Product Name</label>
						</div>
						<div class="col-md-6">
							<select type="text" name="proid" id="proid" class="form-control proid" required="true">
								<option selected disabled="" value="0">---Select-----</option>
								@foreach($product as $val)
									<option value="{{ $val->id }}">{{ $val->name }}</option>
								@endforeach
							</select>
						</div>
					</div><br>

					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-2">
							<label>Document Name</label>
						</div>
						<div class="col-md-6">
							<select type="text" name="docid" id="docid" class="form-control docid" disabled="true">
								<option selected disabled="" value="0">---Select-----</option>
								
							</select>
						</div>
					</div><br>

					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-2">
							<label>Document Mandatory</label>
						</div>
						<div class="col-md-6">
							<label class="radio-inline">
						      <input type="radio" name="manradio" id="manradio" value="1" checked>Yes
						    </label>
						    <label class="radio-inline">
						      <input type="radio" name="manradio" id="manradio" value="0">No
						    </label>
						</div>
					</div><br>

					<div class="row">
						<div class="col-md-7">
						</div>
						<div class="col-md-5">
							<button type="submit" class="btn btn-success" disabled="true">Submit</button>
						<button type="reset" class="btn btn-danger">Cancel</button><br>
						</div>
					</div>
				</form><br>
				<div class="row">
					<div class="col-md-8">
					</div>
					<div class="col-md-3">
						<input id="myInput" type="text" placeholder="Search...." class="form-control">
					</div>
					<div class="col-md-1">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<br>
					<div style="overflow-x:auto; overflow-y: auto; height: 400px;">
					<table class="table table-bordered scroll-horizontal" id="docnameview">
					    <thead>
					      <tr>
					        <th>Document Name</th>
					        <th>Document Path</th>
					        <th>Remove</th>
					      </tr>
					    </thead>
					    <tbody>
					      
					    </tbody>
					</table>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript">
  	$("document").ready(function(){
	    setTimeout(function(){
	        $("div.alert").remove();
	    }, 2000 ); // 5 secs

	});

	$('.proid').change(function(){
		var proid = $(this).val();
		$.ajax({
			url : 'get-doc-productwise/{proid}',
			type : 'get',
			data : { proid:proid },
			success : function(resdatanew){
				$('#docid').prop('disabled', false);
				$("#docid").empty();
				$.each(resdatanew, function(indexnew) {
					$('#docid').append('<option value="'+resdatanew[indexnew].doc_id+'">'+resdatanew[indexnew].document_name+'</option>');
			    });
			    $(':input[type="submit"]').prop('disabled', false);
			    getmappingdoc();
			}
		})
	});

	// $('.proid').change(function(){
	// 	var proid = $(this).val();
	// 	$.ajax({
	// 		url : 'get-mapping-doc-productwise/{proid}',
	// 		type : 'get',
	// 		data : { proid:proid },
	// 		success : function(resdata){
	// 			$("#docnameview tbody tr").remove();
	// 			$.each(resdata, function(index) {
	// 				$('#docnameview tbody').append('<tr><td>'+resdata[index].document_name+'</td><td><a href="'+resdata[index].documenturl+'" target="_blank">'+resdata[index].documenturl+'</td></a><td><button type="button" class="btn btn-link del" data-val="'+resdata[index].doc_id+'" value="'+resdata[index].product_id+'">Remove</button></td></tr>');
	// 		    });
	// 		}
	// 	})
	// });

	$('.docid').change(function(){
		$(':input[type="submit"]').prop('disabled', false);
	});

	$(document).on('click', '.del', function(){ 
		var beforedel = confirm('Are you sure you want to remove this item?');
		if(beforedel){
	     	var productid = $(this).val();
	     	var docid = $(this).attr('data-val');
	     	$.ajax({
	     		url : 'del-pro-doc-mapping/{productid}/{docid}',
	     		type : 'get',
	     		data : { productid:productid, docid:docid },
	     		success : function(msg){
	     			alert('Document remove successfully.');
	     			getmappingdoc();
	     		}
	     	})
	    }
	});

	function getmappingdoc(){
	var proid = $('.proid').val();
	$.ajax({
		url : 'get-mapping-doc-productwise/{proid}',
		type : 'get',
		data : { proid:proid },
		success : function(resdata){
			$("#docnameview tbody tr").remove();
			$.each(resdata, function(index) {
				$('#docnameview tbody').append('<tr><td>'+resdata[index].document_name+'</td><td><a href="'+resdata[index].documenturl+'" target="_blank">'+resdata[index].documenturl+'</td></a><td><button type="button" class="btn btn-link del" data-val="'+resdata[index].doc_id+'" value="'+resdata[index].product_id+'">Remove</button></td></tr>');
			});
		}
	})
};

	$(document).ready(function(){
  		$("#myInput").on("keyup", function() {
    		var value = $(this).val().toLowerCase();
    		$("#docnameview tbody tr").filter(function() {
      			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    		});
  		});
	});
  </script>

@endsection
