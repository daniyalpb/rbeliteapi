<?php $__env->startSection('content'); ?>


<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">RTO List</h4>
              <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#rto-Modal"><span class="glyphicon glyphicon-plus"></span>RTO</a></p>
              <br>
		        <div class="overflow-scroll">
					<div class="table-responsive">
<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="table_id">
	<thead>
		<tr>
           <th>RTO location</th>
           <th>Series no</th>
           <th>State</th>
           <th>City</th>
		</tr>
	</thead>
	<tbody>			               
       <?php $__currentLoopData = $rto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	       <tr>
	       	<td><?php echo e($val->rto_location); ?></td>
	        <td><?php echo e($val->series_no); ?></td>
          <td><?php echo e($val->state_name); ?></td>
          <td><?php echo e($val->cityname); ?></td>
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
								

<div class="modal fade" id="rto-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">RTO ADD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post" id="rto_add_from" > <?php echo e(csrf_field()); ?>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-2">RTO location</label>
		        <div class="col-xs-10">
		          <textarea class="form-control" name="rto_location" id="rto_location"></textarea>
		          <span id="rto_vali_loca" class="help-inline"></span> 
		        </div>
		    </div>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-2">Series no</label>
		        <div class="col-xs-10">
		          <input type="text" class="form-control" name="series_no" id="series_no"  >
		          <span id="rto_vali_series" class="help-inline"></span>
		        </div>
		    </div>

        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-2">State</label>
            <div class="col-xs-10">
              <select type="text" id="state_id" name="state_id" class="form-control">
                  <option selected disabled="true">-- Select State --</option>
                  <?php $__currentLoopData = $state_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($v->state_id); ?>"><?php echo e($v->state_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <span id="rto_vali_state" class="help-inline"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-2">City</label>
            <div class="col-xs-10">
              <select type="text" id="city_id" name="city_id" class="form-control">
                  <option selected disabled="true">-- Select City --</option>
              </select>
              <span id="rto_vali_state" class="help-inline"></span>
            </div>
        </div>

             <div class="form-group">
		        <label for="" class="control-label col-xs-2"></label>
		        <label id="rto_valid_id"></label>    
		    </div>    
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="rto_add_id">Submit</button>
      </div>
    </div>
  </div>
</div>

<script src='<?php echo e(url('/javascripts/jquery.min.js')); ?>'></script>
<script src='<?php echo e(url('/javascripts/bootstrap/jquery.dataTables.min.js')); ?>'></script>
<script src='<?php echo e(url('/javascripts/bootstrap/dataTables.bootstrap.min.js')); ?>'></script>
<script type="text/javascript">
$(document).ready( function () {
    $('#table_id').DataTable({
    	"ordering": false
    });
} );


$("#rto_add_id").click(function(event){  
	event.preventDefault();
 
    if($('#rto_location').val()!=0 && $('#series_no').val()!=0 ){
 			$.post("<?php echo e(url('rto-save')); ?>", $('#rto_add_from').serialize())
             .done(function(msg){ 
                     if(msg==0){
                        window.location.href = "<?php echo e(url('rto-list')); ?>";
                     }else{
                      console.log("error");
                     }  
                }).fail(function(xhr, status, error) {
                 console.log(error);
            	});
    }else{
        $('#rto_valid_id').text("Please fill out this form carefully...");
    }
});

$("#state_id").change(function(){
  var sid = $(this).val();
  $("#city_id option").remove();
  $.ajax({
      type:"get",
      url:"get-city-depends-state/{sid}",
      data:{sid:sid},
      success:function(data){
        $.each(data,function(index,value){
          $('#city_id').append('<option value="'+value.city_id+'" selected="selected">'+value.cityname+'</option>');

        })
      }
  })
});
</script>
<?php $__env->stopSection(); ?>		
<?php echo $__env->make('include-new.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>