@extends('include-new.master')
@section('content')

@if(Session::has('msg'))
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<p class="alert alert-success">{{ Session::get('msg') }}</p>
</div>
@endif
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
            <div class="card-body">
              <h4 class="card-title">Employee Details</h4>
      
              <a href="{{url('add-employee')}}" class="btn btn-success adempbtn" id="adempbtn" name="adempbtn">Add New Employee</a>

             <!-- <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#Agent-Modal"><span class="glyphicon glyphicon-plus"></span> &nbsp; Agent</a></p> -->
            <div class="overflow-scroll">
          <div class="table-responsive">
<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="emp_details_tbl">
  <thead>
    <tr>
       <th>User ID</th>
       <th>Employee Name</th>
       <th>Official Email</th>
       <th>Profile</th>
       <th>Status</th>
       <th>Update</th>

		</tr>
	</thead>
	<tbody>
		@foreach($empdata as $val)
        <tr>
         <td>{{$val->user_id}}</td>
          <td>{{$val->EmployeeName}}</td>
          <td>{{$val->official_emailid}}</td>
          <td>{{$val->Profile}}</td>
          <td>{{$val->Status}}</td>
          <td><a href="update_employee/{{$val->user_id}}" id="btnupdte" class="btn btn-success btnupdte"  value="{{$val->user_id}}" name="btnupdte" class="btn btn-default">Update</a></td>
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

<script type="text/javascript">
	$(document).ready( function(){
    $('#emp_details_tbl').DataTable({
      "ordering": false
    });

});
</script>
  @endsection