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
              <h4 class="card-title">Feedback Report</h4>
		        <div class="overflow-scroll">
					<div class="table-responsive">
						<table id="table_id" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap">
						    <thead>
						        <tr class="tr-bg">
						            <th class="text-wrap1">Order ID</th>
						            {{-- <th class="text-wrap1">Customer ID</th> --}}
						            <th class="text-wrap1">Customer Name</th>
						            <th class="text-wrap1">Product Name</th>
						            <th class="text-wrap1">Rating</th>
						            <th class="text-wrap1">Action</th>
						        </tr>
						    </thead>
						    <tbody>
						    	@foreach($data as $val)
						        <tr>
							        <td class="text-wrap1">{{ $val -> request_id }}</td> 
							        {{-- <td class="text-wrap1">{{ $val -> user_id }}</td> --}} 
							        <td class="text-wrap1">{{ $val -> customer_name }}</td> 
							        <td class="text-wrap1">{{ $val -> product_name }}</td> 
							        <td class="text-wrap1">{{ $val -> Rating }}</td>
							        <td class="text-wrap1"><button type="button" class="btn btn-link custid" data-toggle="modal" value="{{ $val->request_id }}" data-target="#feedbackModal" onclick='load_feedback_comments(this.value)'>View Feedback</button></td>
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
  <div class="modal fade" id="feedbackModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
          <h4 class="modal-title">Feedback</h4>
        </div>

        <div class="modal-body">
        	<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap">
			    <thead>
			        <tr class="tr-bg">
			            <th class="text-wrap1">Order ID</th>
			            <th class="text-wrap1">Customer Name</th>
			            <th class="text-wrap1">Product Name</th>
			            <th class="text-wrap1">feedback_comment</th>
			            <th class="text-wrap1">Create_Date</th>
			        </tr>
			    </thead>
			    <tbody id="modal_td_feedback_comments">
			    	
			    </tbody>
			</table>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

function load_feedback_comments(p_request_id){

	$("#modal_td_feedback_comments").empty();

	$.ajax({
		type : 'POST',
		url : '{{ url('load-feedback-comments') }}',
		data : {'request_id' : p_request_id , '_token' : '{{ csrf_token() }}' },
		success : function(response){
			var data = JSON.parse(response);
			var modal_tabel_data = '';

			$.each(data , function(key,value){

				modal_tabel_data += '<tr> <td class="text-wrap1">'+value.request_id+'</td> <td class="text-wrap1">'+value.customer_name+'</td> <td class="text-wrap1">'+value.product_name+'</td> <td class="text-wrap1">'+value.feedback_comment+'</td> <td class="text-wrap1">'+value.Create_Date+'</td> </tr>'; 
			});

			$("#modal_td_feedback_comments").html(modal_tabel_data);
		}
	});
}
</script>
@endsection		 