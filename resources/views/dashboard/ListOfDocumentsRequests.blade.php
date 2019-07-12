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
              <h4 class="card-title">List Of Requests For Documents Approval</h4>
		        <div class="overflow-scroll">
					<div class="table-responsive">
						<table id="table_id" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap">
						    <thead>
						        <tr class="tr-bg">
						            <th>Request ID</th>
						            <th>Customer Name</th>
						            <th>Mobile No.</th>
						            <th>City</th>
						            <th>Product Name</th>
						            <th>Final Status</th>
						            <th>View Documents</th>
						        </tr>
						    </thead>
						    <tbody>
						    	@foreach($data as $val)
						        <tr>
						            <td>{{ $val -> orderid }}</td>
						            <td>{{ $val -> name }}</td>
						            <td>{{ $val -> mobile }}</td>
						            <td>{{ $val -> cityname }}</td>
						            <td>{{ $val -> productname }}</td>
						            <td>{{ $val -> finalstatus }}</td>
						            <td> 
						            	<span id="spn_doc_{{ $val -> orderid }}_{{ $val -> customer_id }}" style="cursor: pointer;" data-toggle="modal" data-target="#documents-Modal" data-orderid="{{ $val -> orderid }}" data-customerid="{{ $val -> customer_id }}" onclick="show_doc_modal(this.id)">
						            		<font color="#00a3cc"><u>View Documents</u></font>
						            	</span> 
						            </td>
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

<div class="modal fade" id="documents-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Documents</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      		<div id="doc_response">

      		</div>

      		<div id="image_preview">

      		</div>

      </div>
      <div class="modal-footer">
      	<input type="hidden" name="hidden_orderid" id="hidden_orderid" readonly="readonly">
      	<input type="hidden" name="hidden_customerid" id="hidden_customerid" readonly="readonly">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    	
    });
} );
</script>
<script type="text/javascript">
	function show_doc_modal(this_id){
		var orderid = $("#" + this_id).attr('data-orderid');
		var customerid = $("#" + this_id).attr('data-customerid');
		$("#doc_response").empty();
		$("#image_preview").empty();

		$("#hidden_orderid").val(orderid);
		$("#hidden_customerid").val(customerid);

		$.ajax({
			method : 'GET',
			url : '{{ url('/show-uploaded-docs') }}',
			data : {'orderid' : orderid , 'customerid' : customerid},
			success : function(response){
				var data = JSON.parse(response);
				$("#doc_response").html(data.table_data);
				$(".reject_reason_content").hide();
			}
		});

	}

	function view_document(this_id){
		
		var data_href = $("#" + this_id).attr('data-href');
		var img_src = "<img src='" + data_href + "' width='400px' height='500'>";
		$("#image_preview").html(img_src);
	}

	function update_docstatus(this_id){

		var option_value = $("#" + this_id).val();
		var doc_id = $("#" + this_id).attr("data-doc_requid");
		var hidden_orderid = $("#hidden_orderid").val();
		var reject_reason = $("#reject_reason_" + doc_id).val()

		var d_data = { 'option_value' : option_value , 'doc_id' : doc_id , 'hidden_orderid' : hidden_orderid , 'reject_reason' : reject_reason };

		if(option_value == ""){
			return false;
		}else{

			if((option_value == "3") && ($("#reject_reason_" + doc_id).val() == "")){
				$("#reject_reason_" + doc_id).show();
				$("#btn_reason_submit_" + doc_id).show();
				$("#reject_reason_" + doc_id).focus();
				return false;
			}
			$.ajax({
				method : 'GET',
				url : '{{ url('/update-docstatus') }}',
				data : d_data,
				success : function(response){
					var data = JSON.parse(response);
					$("#action_dropdown_status_" + data.doc_id).text(data.status);
					$("#show_hide_action_dropdown_" + data.doc_id).hide();
					$("#reject_reason_" + doc_id).hide();
					$("#btn_reason_submit_" + doc_id).hide();
				}
			});
		}	
	}
</script>
@endsection		 