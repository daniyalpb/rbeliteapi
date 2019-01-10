<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">Product List</h4>
              <p><a href="product-add" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;Product</a></p>
		        <div class="overflow-scroll">
					<div class="table-responsive">
<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="example">
     <thead>
      	<tr>
	       <th>Name</th>
	       <th>Category</th>
	       <th>Sub Category</th>
	       <th>Charges</th>
	       <th>Agent Commision</th>
	       <th>Documents Required</th>
	       <th>Company Name</th>
	       <th>Logo</th> 
	    </tr>
    </thead>

    <tbody>
       <?php $__currentLoopData = $product_master; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($val->productname); ?></td>
          <td><?php echo e($val->rtoname); ?></td>
          <td><?php echo e($val->subcategory); ?></td>
          <td><?php echo e($val->charges); ?></td>
          <td><?php echo e($val->agent_commision); ?></td>
          <td><?php echo e($val->required_field); ?></td>
          <td><?php echo e($val->company_name); ?></td>
          <td class="logo"><img src="<?php echo e(url('images/upload')); ?>/<?php echo e($val->product_logo); ?>" height="100" width="100"></td>	
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
<?php $__env->stopSection(); ?>		
<?php echo $__env->make('include-new.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>