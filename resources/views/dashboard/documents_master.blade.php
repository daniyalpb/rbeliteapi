@extends('include-new.master')
@section('content')

<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
				<h3 class="card-title">Document Master</h3>
				@if(session()->has('message'))
				    <div class="alert alert-success">
				        {{ session()->get('message') }}
				    </div>
				@endif
				<div class="row">
					<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Add New Documents</button>
				</div><br>
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
					<div style="overflow-x:auto; overflow-y: auto;
height: 400px;">
					<table class="table table-bordered scroll-horizontal" id="docnameview">
					    <thead>
					      <tr>
					        <th>ID</th>
					        <th>Document Name</th>
					        <th>Document Path</th>
					        <th>Edit</th>
					        <th>Delete</th>
					      </tr>
					    </thead>
					    <tbody>
					      @foreach($data as $val)
					      <tr>
					        <td>{{ $val->doc_id }}</td>
					        <td>{{ $val->document_name }}</td>
					        <td><a href="{{ $val->documenturl }}" target="_blank">{{ $val->documenturl }}</a></td>
					        <td><button type="button" class="btn btn-info doc_id" id="doc_id" value="{{ $val->doc_id }}">Edit</button></td>
					        <td><button type="button" class="btn btn-danger del_doc_id" value="{{ $val->doc_id }}">Delete</button></td>
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
</div>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="{{url('document-master-save')}}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
				
					<div class="row">
						<div class="col-md-3">
							<label>Document Name</label>
						</div>
						<div class="col-md-9">
							<input type="text" name="docname" id="docname" class="form-control" required="true">
						</div>
					</div><br>

					<div class="row">
						<div class="col-md-3">
							<label>Upload Document</label>
						</div>
						<div class="col-md-9">
							<input type="file" name="uploaddoc" id="uploaddoc" class="form-control">
						</div>
					</div><br>

					<div class="row">
						<div class="col-md-6">
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-success">Submit</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button><br>
						</div>
					</div>
				</form>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="docupdate" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="{{url('document-master-update')}}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
				
					<div class="row">
						<div class="col-md-3">
							<label>Document Name</label>
						</div>
						<div class="col-md-9">
							<input type="hidden" name="docid" id="docid" value="">
							<input type="text" name="docnameupdate" id="docnameupdate" class="form-control" required="true">
						</div>
					</div><br>

					<div class="row">
						<div class="col-md-3">
							<label>Document View</label>
						</div>
						<div class="col-md-9">
							<!-- <label id="viewDoc"></label> -->
							<input type="hidden" name="docview" id="docview" value="">
							<lable id="docmsg"></lable>
							<a href="" id="viewDoc" target="_blank">View Document</a>
						</div>
					</div><br>

					<div class="row">
						<div class="col-md-3">
							<label>Change Document</label>
						</div>
						<div class="col-md-9">
							<input type="file" name="uploaddocupdate" id="uploaddocupdate" class="form-control">
						</div>
					</div><br>

					<div class="row">
						<div class="col-md-6">
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-success">Submit</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.reload(true);">Close</button><br>
						</div>
					</div>
				</form>
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
  </script>
  <script type="text/javascript">
  	$('.doc_id').click(function(){
  		var doc_id = $(this).val();
  		$.ajax({
  			url : 'get-doc-master/{doc_id}',
  			type : 'get',
  			data : { doc_id : doc_id },
  			success : function(data){
  				$("#docupdate").modal('show');
  				$('#docid').val(data[0].doc_id);
  				$('#docnameupdate').val(data[0].document_name);
  				$('#docview').val(data[0].documenturl);
  				if(data[0].documenturl == null || data[0].documenturl == ''){
  					// $('#viewDoc').attr("href","#");
  					$("#viewDoc").hide();
  					$('#docmsg').text('Document not available');
  				}else{
  					$("#docmsg").hide();
  					$('#viewDoc').attr("href", data[0].documenturl);
  				}
  				
  			}
  		})
  	});

  	$('.del_doc_id').click(function(){
  		var beforedel = confirm('Are you sure you want to delete this item?');
  		if(beforedel){
	  		var id = $(this).val();
	  		$.ajax({
	  			url : 'del-doc-master/{id}',
	  			type : 'get',
	  			data : { id : id },
	  			success : function(resdata){
	  				if(resdata[0].idstatus == 1){
	  					alert(resdata[0].Meesage);
	  					location.reload();
	  				}else{
	  					alert(resdata[0].Meesage);
	  					location.reload();
	  				}
	  			}
	  		})
  		}
  	});

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