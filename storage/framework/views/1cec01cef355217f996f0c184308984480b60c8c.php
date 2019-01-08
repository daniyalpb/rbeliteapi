<?php $__env->startSection('content'); ?>

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
              <h4 class="card-title">Basic Report</h4>
		        <div class="overflow-scroll">
					<div class="table-responsive">
						<table id="table_id" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap">
						    <thead>
						        <tr class="tr-bg">
						        <th class="text-wrap1">Request ID</th>
						            <th class="text-wrap1">Customer Name</th>
						            <th class="text-wrap1">Mobile Number</th>
						           <!--  <th class="text-wrap1">Email Id</th>
						            <th class="text-wrap1">Address</th> -->
						            <th class="text-wrap1">City</th>
						            <!-- <th class="text-wrap1">Pin Code</th> -->
						            <th class="text-wrap1">Amount Paid</th>
						            <th class="text-wrap1">Current Status</th>
						            <th class="text-wrap1">Allocated agent with RTO</th>
						            <th class="text-wrap1">Date of Request</th>
						            <th class="text-wrap1">Request Name</th>
						            <th class="text-wrap1">TAT of Request</th>
						        </tr>
						    </thead>
						    <tbody>
						    	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						        <tr>
						        <!-- <td class="text-wrap1"><button type="button" class="btn btn-link ReqID" data-toggle="modal" value="<?php echo e($val -> orderid); ?>" data-target="#getuserrequestfields"><?php echo e($val -> orderid); ?></button></td> -->
						        <td class="text-wrap1"><a href="<?php echo e(url('view-details/'.$val->orderid)); ?>" target="_blank"><?php echo e($val -> orderid); ?></a></td> 
						            <td class="text-wrap1"><button type="button" class="btn btn-link custid" data-toggle="modal" value="<?php echo e($val->customer_id); ?>" data-target="#myModal"><?php echo e($val -> name); ?></button></td>
						            <td class="text-wrap1"><?php echo e($val -> mobile); ?></td>
						            <!-- <td class="text-wrap1"><?php echo e($val -> email); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> address); ?></td> -->
						            <td class="text-wrap1"><?php echo e($val -> cityname); ?></td>
						            <!-- <td class="text-wrap1"><?php echo e($val -> pincode); ?></td> -->
						            <td class="text-wrap1"><?php echo e($val -> rate); ?></td>
						            <!-- <td class="text-wrap1"><?php echo e($val -> CurrentStatus); ?></td> -->

						            <?php if($val -> CurrentStatus=='Document Pending'): ?>
						            <td class="text-wrap1"><label class="badge badge-info"><?php echo e($val -> CurrentStatus); ?></label></td>						            			<?php elseif($val -> CurrentStatus=='Request Rejected'): ?>
						            <td class="text-wrap1"><label class="badge badge-danger"><?php echo e($val -> CurrentStatus); ?></label></td>
						             <?php elseif($val -> CurrentStatus=='Request Accepted'): ?>
						               <td class="text-wrap1"><label class="badge badge-warning"><?php echo e($val -> CurrentStatus); ?></label></td>						           
						             <?php elseif($val -> CurrentStatus=='Documents Accepted'): ?>
						            <td class="text-wrap1"><label class="badge badge-warning"><?php echo e($val -> CurrentStatus); ?></label></td>
						            <?php elseif($val -> CurrentStatus=='Documents Rejected'): ?>
						            <td class="text-wrap1"><label class="badge badge-warning"><?php echo e($val -> CurrentStatus); ?></label></td>
						            <?php elseif($val -> CurrentStatus=='Verification Pending'): ?>
						            <td class="text-wrap1"><label class="badge badge-info"><?php echo e($val -> CurrentStatus); ?></label></td>
						              <?php elseif($val -> CurrentStatus=='Verification Completed'): ?>
						            <td class="text-wrap1"><label class="badge badge-success"><?php echo e($val -> CurrentStatus); ?></label></td>
						            <?php elseif($val -> CurrentStatus=='Request Complete'): ?>
						            <td class="text-wrap1"><label class="badge badge-success"><?php echo e($val -> CurrentStatus); ?></label></td>
						            <?php else: ?> 
									 <td class="text-wrap1"><?php echo e($val -> CurrentStatus); ?></td>
									 <?php endif; ?>
						            <td class="text-wrap1"><?php echo e($val -> rto); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> created_at); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> productname); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> TAT); ?></td>
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
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title">Customer Details</h4>
        </div>
        <div class="modal-body">
          <h6>Email</h6>
          <label id="emailid"></label>
          <hr>
          <h6>Pincode</h6>
          <label id="Pincodeno"></label>
          <hr>
          <h6>Address</h6>
          <label id="address1"></label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

   <!-- Modal -->
  <div class="modal fade" id="getuserrequestfields" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title">Request Fields</h4>
        </div>
        <div class="modal-body">
        <div class="overflow-scroll">
			<div class="table-responsive">
				<table id="table_id" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap">
				<thead>
					<tr class="tr-bg">
						<th class="text-wrap1">ID</th>
						<th class="text-wrap1">Field</th>
						<th class="text-wrap1">Value</th>
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


<script src='<?php echo e(url('/javascripts/jquery.min.js')); ?>'></script>
<script src='<?php echo e(url('/javascripts/bootstrap/jquery.dataTables.min.js')); ?>'></script>
<script src='<?php echo e(url('/javascripts/bootstrap/dataTables.bootstrap.min.js')); ?>'></script>
<script type="text/javascript">

	$('.ReqID').click(function(){
		$('#reqdata tr').remove();
		$('label[id*="datamsg"]').text('');
		var RequestID = $(this).val();
		$.ajax({
			url : 'get-user-field-value/{RequestID}',
			type : 'get',
			data : { RequestID : RequestID },
			success : function(rqmsg){
				if(rqmsg != null && rqmsg != ''){
					$.each(rqmsg, function(i, data){
				     $("#reqdata").append("<tr><td>" + data.userrequestfieldsid + "</td><td>" + data.keyname + "</td><td>" + data.filedvalue + "</td></tr>");
					})
				}else{
					$("#datamsg").text("No data available");
				}
			}
		})
	});

	$('.custid').click(function(){
		//alert($(this).val());
		var custid = $(this).val();
		$.ajax({
			url : 'get-cust-info/{custid}',
			type : 'get',
			data : { custid : custid },
			success : function(resdata){
				$('#emailid').text(resdata[0].email);
				$('#Pincodeno').text(resdata[0].pincode);
				$('#address1').text(resdata[0].address);
			}
		});
	});
</script>
<script type="text/javascript">
$(document).ready( function () {
    $('#table_id').DataTable({
    	"ordering": false
    });
} );
</script>
<?php $__env->stopSection(); ?>		 
<?php echo $__env->make('include-new.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>