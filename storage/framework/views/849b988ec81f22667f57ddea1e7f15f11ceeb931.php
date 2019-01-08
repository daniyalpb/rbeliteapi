<!DOCTYPE html>
<html>
<?php echo $__env->make('include.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>
 
<?php echo $__env->make('include.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="wrapper">
<?php echo $__env->make('include.sidebars', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="content">
<?php echo $__env->yieldContent('content'); ?>
</div>
</div>
 
</body>
 <?php echo $__env->make('include.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->make('include.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->make('include.ajscript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->make('include.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</html>