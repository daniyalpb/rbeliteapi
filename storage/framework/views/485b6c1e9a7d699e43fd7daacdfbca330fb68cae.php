
<?php $__env->startSection('content'); ?>
 <div id="content" style="overflow:scroll;">
	 <div class="container-fluid white-bg">
		<div class="col-md-12"><h3 class="mrg-btm">Report</h3></div>
      <div>
      	<div>
      		<a class="btn btn-primary" target="_blank" href="paymentdone">Payment Done</a>
      		<a class="btn btn-primary" target="_blank" href="PaymentPending">Payment Pending</a>
      		<a class="btn btn-primary" target="_blank" href="UnassignedLead">Unassigned Lead </a>
      		<a class="btn btn-primary" target="_blank" href="assignedLead">Assigned Lead</a>	
      	</div>
      </div>
      <br>
		<!-- <div class="col-md-12">
		    <div class="overflow-scroll" >
			<div class="table-responsive" >
				<div id="divrepo" style="display: none;">
				<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="example">
					<thead>
					    <tr>					                  
					      <th>ID</th>
                          <th>Name</th>
                          <th>Product</th>
                          <th>status</th>
                          <th>quantity</th>
                          <th>Custmer Name</th>
                          <th>Rate</th>
                          <th>Agent Name</th>
                          <th>Payment Status</th>
                          <th>Transaction Id</th>
                          <th>Bank Name</th>
                          <th>Payment Remark</th>
                          <th>Payment Date</th>
                          <th>RTO Location</th>
                          <th>Created At</th>
                          <th>Updated At</th>
					    </tr>
					</thead>
					<tbody>
				    <?php if(isset($sales)): ?>
					<?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>					
					<tr>
					 <td><?php echo e($val->id); ?></td>
					 <td><?php echo e($val->name); ?></td>
					 <td><?php echo e($val->product); ?></td>
					 <td><?php echo e($val->status); ?></td>
					 <td><?php echo e($val->quantity); ?></td>
					 <td><?php echo e($val->customer); ?></td>
					 <td><?php echo e($val->rate); ?></td>
					 <td><?php echo e($val->agent); ?></td>
					 <td><?php echo e($val->payment_status); ?></td>
					 <td><?php echo e($val->transaction_id); ?></td>
					 <td><?php echo e($val->bank_name); ?></td>					 
					 <td><?php echo e($val->payment_remark); ?></td>
					 <td><?php echo e($val->payment_date); ?></td>
					 <td><?php echo e($val->rto_location); ?></td>			                 
					 <td><?php echo e($val->created_at); ?></td>
					 <td><?php echo e($val->updated_at); ?></td>
					</tr> 
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					</tbody>
				</table>
				</div>
			</div>
			</div>						
		</div> -->
	 </div>
</div>
<?php $__env->stopSection(); ?>		 
<?php echo $__env->make('include.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>