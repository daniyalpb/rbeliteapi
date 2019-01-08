<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('include-new.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body>
  <!-- container scroller starts here -->
  <div class="container-scroller">
  	<?php echo $__env->make('include-new.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- container-fluid page-body-wrapper starts here -->
    <div class="container-fluid page-body-wrapper">

    	<?php echo $__env->make('include-new.sidebar-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		  <!-- main-panel starts -->
			<div class="main-panel">
        <!-- content-wrapper starts -->
        <div class="content-wrapper">
				    <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- content-wrapper ends -->
				<?php echo $__env->make('include-new.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		  <!-- main-panel ends -->
		
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller ends -->

</body>
<?php echo $__env->make('include-new.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</html>