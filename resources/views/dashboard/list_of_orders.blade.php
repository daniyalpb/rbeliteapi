
@extends('include-new.master')
@section('content')

<style>
.text-wrap{
    white-space:normal;
    width:200px;
}
.text-wrap1{
    white-space:normal;
    width:100px;
}
</style>


<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">Lead Allocation Utility</h4>
		        <div class="overflow-scroll">
					<div class="table-responsive">
						<table id="table_id" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap">
						    <thead>
						        <tr class="tr-bg">
						        <th class="text-wrap1">Request ID</th>
						            <th class="text-wrap1">Customer Name</th>
						            <th class="text-wrap1">Mobile No.</th>
						            <th class="text-wrap1">City Name</th>
						            <th class="text-wrap1">Product Name</th>
						            <th class="text-wrap1">TAT</th>
						            <th class="text-wrap1">RTO City</th>
						            <th class="text-wrap1">Agent ID</th>
						            <th class="text-wrap1">Agent Name</th>
						            <th class="text-wrap1">Assign</th>
						        </tr>
						    </thead>
						    <tbody>
						    	@foreach($order as $val)
						        <tr>
						        <td class="text-wrap1">{{ $val -> salesid }}</td>
						            <td class="text-wrap1">{{ $val -> name }}</td>
						            <td class="text-wrap1">{{ $val -> mobile }}</td>
						            <td class="text-wrap1">{{ $val -> cityname }}</td>
						            <td class="text-wrap1">{{ $val -> productname }}</td>
						            <td class="text-wrap1">{{ $val -> TAT }}</td>
						            <td class="text-wrap1">{{$val -> rto_location}}</td>
						            <td class="text-wrap1">{{ $val -> agent_id }}</td>
						            <td class="text-wrap1">{{ $val -> ag_name }}</td>
						            <td class="text-wrap1"><button type="button" value="{{$val->salesid}}" id="model" class="btn btn-info" value="" data-toggle="modal" data-target="#myModal">Assign</button></td>
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
		 
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title">Assign Agent</h4>
        </div>
        <div class="modal-body">
        	<form action="" method="POST" id="assignagent">
	          	<div class="form-group">
	          		<input type="hidden" name="smid" id="smid" value="">
	          		<label for="sel1">Select City</label>
			      	<select class="form-control" id="city1" name="city1"> <br>
			      		<option>Select City</option>
			      		@foreach($getcity as $val)
			      			<option value="{{ $val -> city_id }}">{{ $val -> cityname }}</option>
			      		@endforeach
			      </select>
			    </div>

			    <div class="form-group">
			      	<label for="sel1">Select RTO</label>
			      	<select class="form-control" id="rto1" name="rto1" disabled="true">
			      		<option>Select RTO</option>
			      </select>
			    </div>

			    <div class="form-group">
			    	<label for="sel1">Select Agent</label>
			    	<select class="form-control" id="agent1" name="agent1" disabled="true">
			    		<option>Select Agent</option>
			    	</select>
			    </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default btn-success" id="submitdata" data-dismiss="modal">Assign</button>
	          <button type="button" class="btn btn-default" data-dismiss="modal" id="model-close">Close</button>
	        </div>
	    </form>
      </div>
    </div>
  </div>
<script type="text/javascript">
	$('#model').click(function(){
		$('#smid').val($(this).val());
	});

	$('#city1').change(function(){
		$('#rto1').removeAttr('disabled');
		$('#rto1').empty();
		var cityid = $(this).val();
		$.ajax({
			url : 'get-rto/{cityid}',
			type : 'GET',
			data : { cityid:cityid },
			success : function(response){
				$('#rto1').append('<option value="0">Select RTO</option>');
				$.each(response,function(key, value){
					$('#rto1').append('<option value=' + value.id + '>' + value.rto +'</option>');
				});
			}
		});
	});

	$('#rto1').change(function(){
		$('#agent1').removeAttr('disabled');
		$('#agent1').empty();
		var rtoid = $(this).val();
		$.ajax({
			url : 'get-agent/{rtoid}',
			type : 'GET',
			data : { rtoid : rtoid },
			success : function(msg){
				$.each(msg,function(key, value){
					$('#agent1').append('<option value=' + value.agent_id + '>' + value.ag_name + '</option>');
				});
			}
		});
	});

	$('#submitdata').click(function(){
		$.ajax({
			url : 'agentidupdate',
			type : 'GET',
			data : $('#assignagent').serialize(),
			success : function(submsg){
				alert(submsg[0].message);
				location.reload();
			}
		});
	});

	$('#model-close').click(function(){
		location.reload();
	});

</script>
 
@endsection