<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<p class="alert alert-success"><?php echo e(Session::get('message')); ?></p>
</div>
<?php endif; ?>
<style type="text/css">
	#tblcsdata th,td{
    background-color: transparent;
    padding: 10px;
    font-size: 13px;
    border: 1px solid #eee !important; 
    margin-left: 45px;
   
  }
  .txtarea{
  	width: 200px !important; 
  }
</style>
<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">Calling/Disposition Submission</h4>
             <!-- <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#Agent-Modal"><span class="glyphicon glyphicon-plus"></span> &nbsp; Agent</a></p> -->
		        <div class="overflow-scroll">
					<div class="table-responsive">
<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="crm_table_id">
	<thead>
		<tr>
       <th>Request Id</th>
       <th>Customer Name</th>
       <th>Customer Email</th>
       <th>Customer Contact no</th>
		   <th>Agent Name</th>
		   <th>Agent Contact no</th>
		   <th>Agent Email</th>
		   <th>Request Name</th>
		   <th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $crmdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><a onclick="getrequestid(<?php echo e($val->request_id); ?>);" href="#" data-toggle="modal" data-target="#myModal"><?php echo e($val->request_id); ?></a></td>
			<td><?php echo e($val->customer_name); ?></td>
			<td><?php echo e($val->customer_email); ?></td>
			<td><?php echo e($val->customer_no); ?></td>
			<td><?php echo e($val->ag_name); ?></td>
			<td><?php echo e($val->ag_contact_no); ?></td>
			<td><?php echo e($val->ag_email); ?></td>
			<td><textarea readonly class="txtarea"><?php echo e($val->request_name); ?></textarea></td>
			<td><a class="btn btn-default" data-toggle="modal" data-target="#historymodal" onclick="showhistory(<?php echo e($val->request_id); ?>)">History</a>
			<!-- <a class="btn btn-primary">Add new disspostion</a> --></td>
			
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">         
          <h4 class="modal-title">Calling/Disposition Submission</h4>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <form id="frmcrm" method="post" action="<?php echo e(url('insert-crm-followup')); ?>">
         	<?php echo e(csrf_field()); ?>

         	
         	<div class="form-group">
         	 <label>Customer:</label>
             <input type="checkbox" class="txtchk" name="txtcustomer" id="txtcustomer" value="1" checked="checked">
         	 <label>Agent:</label>
              <input type="checkbox" class="txtchk" name="txtagent" id="txtagent" value="1"> 
            </div>        	
            <div class="form-group">
            <label>Disposition:</label>
            <select id="ddldisposition" name="ddldisposition" class="form-control" onchange="getsubdisposition()" required>
            	<option value="">--select--</option>
            	<?php $__currentLoopData = $disposition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            	<option value="<?php echo e($val->id); ?>"><?php echo e($val->disposition_name); ?></option>
            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
           </div>
            <div class="form-group">
             <label>Sub Disposition:</label>
         <select id="ddlsubdisposition" name="ddlsubdisposition" class="form-control" required onchange="closedfollowup()">
          <option value="">--select--</option>            
         </select>
            </div>
            <div class="form-group">
            	<label>Remark:</label>
            	<textarea class="form-control" id="txtremark" name="txtremark" required></textarea>
            </div>         
        </div>
        <div class="modal-footer">
        	<input type="hidden" name="txtrequestid" id="txtrequestid">
        	<input type="submit" name="submit" id="btnsave" class="btn btn-primary">
        	<!--  <button type="button" class="btn btn-primary">save</button> -->
        </form>
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>
<!-- Modal -->
  <div class="modal fade" id="historymodal" role="dialog">
    <div class="modal-dialog modal-lg">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">         
          <h4 class="modal-title">History</h4>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body"> 	
             <div id="divhistory"></div>
        </div>
        <div id="spndiv" style="display: none;" class="center"><span id="spnnodata"></span></div>
        <div class="modal-footer">        	
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>


<script src='<?php echo e(url('/javascripts/jquery.min.js')); ?>'></script>
<script src='<?php echo e(url('/javascripts/bootstrap/jquery.dataTables.min.js')); ?>'></script>
<script src='<?php echo e(url('/javascripts/bootstrap/dataTables.bootstrap.min.js')); ?>'></script>
<script type="text/javascript">
	$(document).ready( function(){
    $('#crm_table_id').DataTable({
    	"ordering": false
    });

    $('input.txtchk').on('change', function() {
    $('input.txtchk').not(this).prop('checked', false);  
});
});
function getsubdisposition(){
	$ID=$("#ddldisposition").val()	
		$.ajax({
             url: 'get-sub-disposition/'+$ID,
             type: "GET",             
             success:function(sub) 
             {      
              $data=JSON.parse(sub);  
              $('#ddlsubdisposition').empty(); 
              $('#ddlsubdisposition').append('<option value="">--Select--</option>');
              $.each($data, function(key,value){                                        
                 $('#ddlsubdisposition').append('<option value="'+ value.id+'">'+ value.disposition_name +'</option>');
                   });        
                                  
              
             }
         });
	}
	function getrequestid(id){
	$('#ddlsubdisposition').empty(); 
	$("#frmcrm").trigger('reset');		
		$("#txtrequestid").val(id);
	}
	function showhistory($ID){  
	$("#divhistory").empty();   
   $.ajax({
             url: 'crm-history/'+$ID,
             type: "GET",             
             success:function(csdata) 
             {                  
               var data = JSON.parse(csdata);               
               if (data.length!=0){
               $("#spndiv").hide();
               var str = "<table Id='tblcsdata' class='table-bordered' style='width:100%'><thead><tr><th>Id</th><th>Disposition</th><th>Sub Disposition</th><th>Remark</th><th>Created By</th><th>Called Person</th><th>Created Date</th></tr></thead><tbody>";
         for (var i = 0; i < data.length; i++) 
           {
           	 str += data[i].id==0?"":"<tr><td>"+data[i].id+"</td>";
           	 str += data[i].disposition_name==''?"":"<td>"+data[i].disposition_name+"</td>";
           	 str += data[i].sub_disposition==''?"":"<td>"+data[i].sub_disposition+"</td>";
           	 str += data[i].remark==''?"":"<td><textarea readonly class='txtarea'>"+data[i].remark+"</textarea></td>";
           	 str += data[i].created_by==''?"":"<td>"+data[i].created_by+"</td>";
           	  str += data[i].called_person==''?"":"<td>"+data[i].called_person+"</td>";
           	  str += data[i].created_date==''?"":"<td>"+data[i].created_date+"</td></tr>";
           } 
          str = str + "</tbody></table>";
           $('#divhistory').html(str);
             }else{
             	$("#spndiv").show();
             	$("#spnnodata").text('No data found');
             }
             }
         });
   }
   function closedfollowup()
   {
    if ($("#ddlsubdisposition").val()==3) {
      //alert('closed');
      $ID=$("#txtrequestid").val();
      $.ajax({
             url: 'closed-followup/'+$ID,
             type: "GET",             
             success:function(data) 
             {                                 
              alert(data);
             }
         });

    }

   }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('include-new.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>