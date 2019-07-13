@extends('include-new.master')
<style>
 
</style>
@section('content')

<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">Agent List</h4>
             <p><a href="#" class="btn btn-primary" id="addagent" data-toggle="modal" data-target="#Agent-Modal"><span class="glyphicon glyphicon-plus"></span> &nbsp; Agent</a></p>
		        <div class="overflow-scroll">
					<div class="table-responsive">
<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="table_id">
	<thead>
		<tr>
           <th>Name</th>
           <th>Address</th>
           <th>contact No</th>
           <th>Email ID</th>
           <th>View RTO</th>
		       <th>Date</th>
           <th>Update</th>

		</tr>
	</thead>
	<tbody>
	@foreach($agent_m as $val)
		<tr>
            <td>{{$val->ag_name}}</td>
            <td>{{$val->ag_address}}</td>
            <td>{{$val->ag_contact_no}}</td>
            <td>{{$val->ag_email}}</td> 
            <td class="text-wrap1"><button type="button" class="btn btn-link ReqID" data-toggle="modal" value="{{ $val ->agent_id }}" data-target="#getrto">RTO</button></td>
            <td>{{$val->created_at}}</td>
            <td> <button type="button" class="btn btn-info btn-sm AgentID" value="{{ $val ->agent_id }}" data-toggle="modal" data-target="#updateagent">Update</button></td>
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
  <div class="modal fade" id="getrto" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title">RTO Location</h4>
        </div>
        <div class="modal-body">
        <div class="overflow-scroll">
      <div class="table-responsive">
        <table id="table_id" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap">
        <thead>
          <tr class="tr-bg">
            <th class="text-wrap1"><center>RTO</center></th>
          </tr>
        </thead>
        <tbody id="reqdata">
          
        </tbody>
        </table>
        <label id="datamsg" style="font-size: 14px;"></label>
      </div>
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="Agent-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agent ADD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post"  id="agent_add_from" >
      {{ csrf_field() }}
		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-2">Agent Name  </label>
		        <div class="col-xs-10">
		            <input type="text" class="form-control" name="ag_name" id="ag_name"  >
		             <span id="ag_nameerr" class="help-inline"></span>
		        </div>
		    </div>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-2"> Address  </label>
		        <div class="col-xs-10">
		            <input type="text" class="form-control" name="ag_address" id="ag_address"  >
		             <span id="valid_ag_address" class="help-inline"></span>
		        </div>
		    </div>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-2"> Contact No  </label>
		        <div class="col-xs-10">
		            <input type="text" class="form-control" name="ag_contact_no" id="ag_contact_no" onkeypress="return Numeric(event)"  >
		             <span id="valid_ag_contact_no" class="help-inline"></span>
		        </div>
		    </div>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-2">Email ID </label>
		        <div class="col-xs-10">
		            <input type="text" class="form-control" name="ag_email" id="ag_email"  >
		             <span id="valid_ag_email" class="help-inline"></span>
		        </div>
		    </div> 

		     <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-2">Password </label>
		        <div class="col-xs-10">
		            <input type="password" class="form-control" name="password" id="password"  >
		             <span id="valid_agent_password" class="help-inline"></span>
		        </div>
		    </div>

		     <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-2">confirm password</label>
		        <div class="col-xs-10">
		            <input type="password" class="form-control" name="confirm_password" id="confirm_password"  >
		             <span id="valid_agent_cagent_password" class="help-inline"></span>
		        </div>
		    </div>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-2">RTO </label>
		        <div class="col-xs-10">
		        <!-- <select class="form-control" name="rto_id" id="rto_id">
		           <option value="0" > SELECT --</option>
		            @foreach($rto as $val)
						   <option value="{{$val->id}}">{{$val->series_no}}</option>           
					@endforeach
				</select> -->


        <div class="button-group">
           <button type="button" class="btn btn-default btn-sm dropdown-toggle form-control" data-toggle="dropdown">SELECT --</button>
          <ul class="dropdown-menu" style="min-width: 24rem;   height: 250px; overflow: auto;">
             @foreach($rto as $val)
            <li style="font-size: 17px;"><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="rto_id[]" id="rto_id" value="{{$val->id}}" style="margin: 4px 7px 0;" />{{$val->series_no}}</a></li>
            @endforeach
          </ul>
        </div>
            <span id="valid_ag_rto_id" class="help-inline"></span>
		        </div>
		    </div>    
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="agent_add_id">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="updateagent" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title">Agent Update</h4>
        </div>
        <div class="modal-body">
            
            <form class="form-horizontal" method="post"  id="agent_update_from" >
            {{ csrf_field() }}

            <div class="form-group">
              <label for="inputEmail" class="control-label col-xs-2">Name</label>
              <div class="col-xs-10">
                  <input type="hidden" class="form-control" name="a_id" id="a_id"  >
                  <input type="text" class="form-control" value="" name="a_name" id="a_name" required="true">
                   <span id="a_nameerr" class="help-inline"></span>
              </div>
          </div>
             
          <div class="form-group">
              <label for="inputEmail" class="control-label col-xs-2">Address</label>
              <div class="col-xs-10">
                  <input type="text" class="form-control" name="a_address" id="a_address" required="true" >
                   <span id="valid_a_address" class="help-inline"></span>
              </div>
          </div>
          
          <div class="form-group">
              <label for="inputEmail" class="control-label col-xs-2">Contact</label>
              <div class="col-xs-10">
                  <input type="text" class="form-control" name="a_contact_no" id="a_contact_no" onkeypress="return Numeric(event)" required="true" >
                   <span id="valid_a_contact_no" class="help-inline"></span>
              </div>
          </div>
         
          <div class="form-group">
              <label for="inputEmail" class="control-label col-xs-2">EmailID</label>
              <div class="col-xs-10">
                  <input type="text" class="form-control" name="a_email" id="a_email" required="true" >
                   <span id="valid_a_email" class="help-inline"></span>
              </div>
          </div> 

            <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-2">RTO </label>
            <div class="col-xs-10">

           <div class="button-group">
           <button type="button" class="btn btn-default btn-sm dropdown-toggle form-control" data-toggle="dropdown">SELECT --</button>
          <ul class="dropdown-menu" style="min-width: 24rem;   height: 250px; overflow: auto;">
             @foreach($rto as $val)
            <li style="font-size: 17px;"><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="rto_id1[]" id="rto_id_{{$val->id}}" value="{{$val->id}}" style="margin: 4px 7px 0;" />{{$val->series_no}}</a></li>
            @endforeach
          </ul>
        </div>
            <span id="valid_a_rto_id" class="help-inline"></span>

          
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="agent_update_id">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script src='{{ url('/javascripts/jquery.min.js') }}'></script>
<script src='{{ url('/javascripts/bootstrap/jquery.dataTables.min.js') }}'></script>
<script src='{{ url('/javascripts/bootstrap/dataTables.bootstrap.min.js') }}'></script>
<script type="text/javascript">
  $('.ReqID').click(function(){
    $('#reqdata tr').remove();
    $('label[id*="datamsg"]').text('');
    var RequestID = $(this).val();
    $.ajax({
      url : 'get-rto-field-value/{RequestID}',
      type : 'get',
      data : { RequestID : RequestID },
      success : function(rqmsg){
        if(rqmsg != null && rqmsg != ''){
          $.each(rqmsg, function(i, data){
             $("#reqdata").append("<tr><td>" + data.rto + "</td></tr>");
          })
        }else{
          $("#datamsg").text("No RTO Available");
        }
      }
    })
  });
</script>
<script type="text/javascript">
$(document).ready( function () {
    $('#table_id').DataTable({
    	
    });
} );

$("#agent_add_id").click(function(event){  
event.preventDefault();
//alert();
 
$.post("{{url('agent-save')}}", $('#agent_add_from').serialize())
  .done(function(msg){ 
    if(msg == '0'){
      alert("Add agent successfully.");
      location.reload();
    }
  if(msg.ag_name){
    $('#ag_nameerr').text(msg.ag_name);
  }else{
    $('#ag_nameerr').text('');
  }

  if(msg.ag_address){
    $('#valid_ag_address').text(msg.ag_address);
  }else{
    $('#valid_ag_address').text('');
  }

  if(msg.ag_contact_no){
    $('#valid_ag_contact_no').text(msg.ag_contact_no);
  }else{
    $('#valid_ag_contact_no').text('');
  }

  if(msg.ag_email){
    $('#valid_ag_email').text(msg.ag_email);
  }else{
    $('#valid_ag_email').text('');
  }

  if(msg.password){
    $('#valid_agent_password').text(msg.password);
  }else{
    $('#valid_agent_password').text('');
  }

  if(msg.confirm_password){
    $('#valid_agent_cagent_password').text(msg.confirm_password);
  }else{
    $('#valid_agent_cagent_password').text('');
  }
  
  if(msg.rto_id){
    $('#valid_ag_rto_id').text(msg.rto_id);
  }else{
    $('#valid_ag_rto_id').text('');
  }

  if(msg==0){
  	window.location.href = "{{url('agent-list')}}";
  }    
 }).fail(function(xhr, status, error) {
console.log(error);
}); 
});

</script>


<script>
  var options = [];
$( '.dropdown-menu a' ).on( 'click', function( event ) {

   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
       $inp = $target.find( 'input' ),
       idx;

   if ( ( idx = options.indexOf( val ) ) > -1 ) {
      options.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {
      options.push( val );
      setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }

   $( event.target ).blur();
      
   //console.log( options );
   return false;
});
</script>

<script type="text/javascript">
  $('.AgentID').click(function(){
     $("input[type='checkbox']").attr("checked",false);
      var ageid = $(this).val();
      $.ajax({
        url : 'agent-update/{ageid}',
        type : 'get',
        data : { ageid:ageid },
        success : function(updatemsg){
          console.log(updatemsg);
          $('#a_id').val(updatemsg.getudata[0].agent_id);
          $('#a_name').val(updatemsg.getudata[0].ag_name);
          $('#a_address').val(updatemsg.getudata[0].ag_address);
          $('#a_contact_no').val(updatemsg.getudata[0].ag_contact_no);
          $('#a_email').val(updatemsg.getudata[0].ag_email);

          $.each(updatemsg.rdata , function(key ,value){
           document.getElementById('rto_id_' + value.id).setAttribute('checked','checked');
          });
        }
      });
  });
</script>

<script type="text/javascript">
  $('#agent_update_id').click(function(){
      var u_name = $('#a_name').val();
      var u_address = $('#a_address').val();
      var u_contact_no = $('#a_contact_no').val();
      var u_email = $('#a_email').val();
      $(".error").remove();
      if (u_name == "") {
        $('#a_nameerr').after('<span class="error">This field is required</span>');
      }
      else if (u_address == "") {
        $('#valid_a_address').after('<span class="error">This field is required</span>');
      }
      else if (u_contact_no.length < 10) {
        $('#valid_a_contact_no').after('<span class="error">Mobile no must be at least 10 digit</span>');
      }
      else if (u_email == "") {
        $('#valid_a_email').after('<span class="error">This field is required</span>');
      }else{
          $.ajax({
            type:"POST",
            url:'agent-update',
            data:$('#agent_update_from').serialize(),
            dataType: 'json',
            success: function(data){
                alert(data.updaterto[0].rinsertmessage);
                location.reload();
            },
            error: function(data){

            }
          })
        }
    });
</script>

@endsection		