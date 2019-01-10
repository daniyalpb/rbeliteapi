<?php $__env->startSection('content'); ?>

<style>
.error_class{color:red;}
</style>
    

<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">Product Add</h4>								 
								  
 	<form class="form-horizontal" method="post" action="<?php echo e(url('product-save')); ?>" enctype="multipart/form-data"> 
 	<?php echo e(csrf_field()); ?>

    <div class="form-group">
        <label for="inputEmail" class="control-label col-xs-2">Product Name</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" name="name" id="name"  >
             <?php if($errors->has('name')): ?><label class="control-label error_class" for="inputError"> <?php echo e($errors->first('name')); ?></label>  <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="inputPassword" class="control-label col-xs-2">Category   </label>
        <div class="col-xs-10">
           <select class="form-control" name="category_id" id="category_id">
            <option value="0" > SELECT</option>
            <?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
			 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
    <?php if($errors->has('category_id')): ?><label class="control-label error_class" for="inputError"> <?php echo e($errors->first('category_id')); ?></label>  <?php endif; ?>
        </div>
    </div>


    <div class="form-group">
        <label for="inputPassword" class="control-label col-xs-2" id="Sub_Category_ID_hide">Sub Category</label>
        <div class="col-xs-10" id="Sub_Category_ID">
           
            
        </div>
    </div>
                                        

	<div class="form-group">
	    <label for="inputEmail" class="control-label col-xs-2">Charge</label>
	    <div class="col-xs-10">
	        <input type="text" class="form-control" name="charge" id="charge" onkeypress="return Numeric(event)" >
	   <?php if($errors->has('charge')): ?><label class="control-label error_class" for="inputError"> <?php echo e($errors->first('charge')); ?></label><?php endif; ?>
	    </div>
	</div>


    <div class="form-group">
        <label for="inputEmail" class="control-label col-xs-2">Agent Commision</label>
        <div class="col-xs-10">
        <input type="text" class="form-control" name="agent_commision" onkeypress="return Numeric(event)">
    	<?php if($errors->has('agent_commision')): ?><label class="control-label error_class" for="inputError"> <?php echo e($errors->first('agent_commision')); ?></label><?php endif; ?>
        </div>
    </div>


    <div class="form-group">
        <label for="inputEmail" class="control-label col-xs-2">Logo</label>
        <div class="col-xs-10">
            <input type="file" class="form-control"  name="logo"  onkeypress="return Numeric(event)">
    <?php if($errors->has('logo')): ?><label class="control-label error_class" for="inputError"> <?php echo e($errors->first('logo')); ?></label>  <?php endif; ?>
        </div>
    </div>
								    
	<div class="form-group">
	    <label for="inputPassword" class="control-label col-xs-2">Company</label>
	    <div class="col-xs-10">
	       <select class="form-control" name="company" id="company"  >
	        <option value="0" > --SELECT---</option>
	        <?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
			 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
	          <?php if($errors->has('company')): ?><label class="control-label error_class" for="inputError"> <?php echo e($errors->first('company')); ?></label>  <?php endif; ?>
	    </div>
	</div>
 

	<div class="form-group">
	    <label for="inputPassword" class="control-label col-xs-2">Documents Required</label>
	    <div class="col-xs-10">
	       <select class="form-control" name="required_field[]"  id="multiple-checkboxes" multiple="multiple" >
	        <?php $__currentLoopData = $docu_required; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  <option value="<?php echo e($val->id); ?>"><?php echo e($val->required_field); ?></option>
			 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
	          <?php if($errors->has('required_field')): ?><label class="control-label error_class" for="inputError"> <?php echo e($errors->first('required_field')); ?></label>  <?php endif; ?>
	    </div>
	</div>
								    
    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            <input type="submit" class="btn btn-primary" value="SUBMIT">   </div>
    </div>
	</form>

			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>		
<?php echo $__env->make('include-new.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>