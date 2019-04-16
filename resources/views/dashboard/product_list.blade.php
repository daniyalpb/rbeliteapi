@extends('include-new.master')
@section('content')

<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">Product List</h4>
              
		        <div class="overflow-scroll">
					<div class="table-responsive">
						<table id="table_id" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap">
						     <thead>
						      	<tr>
							       <th><center>Name</center></th>
							       <th>Category</th>
							       <th>Logo</th> 
							       <th>Action</th>
							    </tr>
						    </thead>

						    <tbody>
						       @foreach($product_master as $key=> $val)
						        <tr>
						          <td>{{$val->productname}}</td>
						          <td>{{$val->rtoname}}</td>
						          <td class="logo"><img src="{{ $val->product_logo }}" height="100" width="100"></td>
						          <td><button type="button" class="btn btn-info btn-sm logoedit" id="logoedit" onclick="GetProductEdit({{$val->id}})">Edit</button></td>	
						        </tr>
						        @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          	<style>
			.error_class{color:red;}
			</style>
			    

			<div class="row">
				<div class="col-md-12 grid-margin">
					<div class="card">
			            <div class="card-body">
			 				<form class="form-horizontal" method="post" action="{{url('product-edit')}}" enctype="multipart/form-data"> 
			 				{{ csrf_field() }}
							    <div class="form-group">
							        <label for="inputEmail" class="control-label col-xs-4">Change Product Name :</label>
							        <div class="col-xs-8">
							        	<input type="hidden" name="u_id" id="u_id">
							        	<input type="hidden" name="u_cat_id" id="u_cat_id">
							            <textarea rows="4" type="text" class="form-control" name="uname" id="uname" required="true"></textarea> 
							        </div>
							    </div>

							     <div class="form-group">
							        <label for="inputEmail" class="control-label col-xs-4">Logo :</label>
							        <div class="col-xs-8" id="append_logo">
							           <!-- <img src="{{ $val->product_logo }}" height="100" width="100"> -->
							        </div>
							    </div>

							    <div class="form-group">
							        <label for="inputEmail" class="control-label col-xs-4">Change Logo :</label>
							        <div class="col-xs-8">
							            <input type="file" class="form-control"  name="logo"  onkeypress="return Numeric(event)"> 
							        </div>
							    </div>
											    							    
							    <div class="form-group">
							    	<div class="col-xs-5">
							           
							        </div>

							        <div class="col-xs-2">
							            <input type="submit" class="btn btn-success" value="Update">
							        </div>

							        <div class="col-xs-1">
							           
							        </div>

							        <div class="col-xs-2">
							             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>   
							        </div>
							    </div>
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
       <!--  <div class="modal-footer">
         
        </div> -->
      </div>
    </div>
  </div>
<!-- Modal -->
<script src='{{ url('/javascripts/jquery.min.js') }}'></script>
<script src='{{ url('/javascripts/bootstrap/jquery.dataTables.min.js') }}'></script>
<script src='{{ url('/javascripts/bootstrap/dataTables.bootstrap.min.js') }}'></script>
<script type="text/javascript">
$(document).ready( function () {
    $('#table_id').DataTable({
    	"ordering": false
    });
} );
</script>

<script type="text/javascript">
function GetProductEdit(id){
	$('#u_id').val("");
	$('#u_cat_id').val("");
	$('#uname').val("");
	$("#append_logo").empty();
	$.ajax({
		type:'GET',
		url:'get-product-edit/id',
		dataType: 'JSON',
		data:{id:id},
		success: function(data){
			$('#myModal').modal('show');
			$('#u_id').val(data[0].id);
			$('#u_cat_id').val(data[0].cat_id);
			$('#uname').val(data[0].productname);
			$('#append_logo').prepend('<img id="theImg" src="'+data[0].product_logo+'" height="100" width="100"/>')
		}
	});
}
</script>
@endsection		


