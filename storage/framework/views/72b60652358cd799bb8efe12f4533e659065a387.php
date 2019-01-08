<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">Category and Subcategory</h4>
              <p> <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Category</a></p>
		        <div class="overflow-scroll">
					<div class="table-responsive">
<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="example1">
     <thead>
      <tr>
       <th>Category Name</th>
       <th>Subcategory</th>
     </tr>
    </thead>

    <tbody>
   	<?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <tr>
      <td><?php echo e($val->name); ?></td>
      <td><span class="glyphicon glyphicon-hand-right"></span><a href="#" onclick="sub_cat_fn(<?php echo e($val->id); ?>);"><i class="fa fa-eye" aria-hidden="true">Subcategory</i></a></td>
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


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Category ADD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post"  id="category_add_id_from" > <?php echo e(csrf_field()); ?>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-2">category  </label>
		        <div class="col-xs-10">
		            <input type="text" class="form-control" name="name" id="name"  >
		        </div>
		    </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="category_add_id">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="subcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subcategory Show</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form     id="add_sub_catid_from" > <?php echo e(csrf_field()); ?>

              <input type="hidden" name="p_id" id="p_id" >
              <div class="form-group">
				<div class="row">
		          <div class="col-8 col-sm-6">
		           <input type="text" class="form-control" name="name" id="name"  >
		          </div>
		          <div class="col-4 col-sm-6">
		             <button type="button" class="btn btn-primary" id="add_sub_cat">ADD</button>
		          </div>
		        </div>
             </div>
        </form>						       
          <div class="table-responsive" >
			<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="example">
                 <thead><tr> <th>Name</th> </tr></thead>
                 <tbody id="sub_cat_id"> </tbody>
            </table>
		   </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 
      </div>
    </div>
  </div>
</div>

<script type='text/javascript'>
function sub_cat_fn(val){  
 $('#p_id').val(val);
 $('#sub_cat_id').empty();
 $.get("<?php echo e(url('sub-category-id')); ?>", {"sub_category_id":val})
  .done(function(msg){ 
           sub_cat=Array();
            $.each(msg, function(i, item) {
             sub_cat.push('<tr><td>'+item.subcategory+'</td></tr>');
            });
           $('#sub_cat_id').append(sub_cat);
           $('#subcategory').modal('show');
  }).fail(function(xhr, status, error) {
 		console.log(error);
});
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('include-new.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>