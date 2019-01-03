
<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">Company-master</h4>
              <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#company_modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Product Company</a></p>
		        <div class="overflow-scroll">
					<div class="table-responsive">
<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="example">
	<thead>
		<tr>
            <th>Category Name</th>
            <th>contact_person</th>
            <th>contact_no</th>
            <th>email</th>
            <th>logo</th>
            <th>date</th>
            <th>ip</th>
            <th>Edit</th>
		</tr>
	</thead>

	<tbody>
       <?php $__currentLoopData = $company_master; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <tr>
          <td class="name"><?php echo e($val->name); ?> </td>
          <td class="contact_person"><?php echo e($val->contact_person); ?> </td>
          <td class="number"><?php echo e($val->contact_no); ?> </td>
          <td class="email"><?php echo e($val->email); ?> </td>
          <td class="logo"><img src="<?php echo e(url('images/upload')); ?>/<?php echo e($val->logo); ?>" height="100" width="100"> </td>
          <td><?php echo e($val->created_at); ?> </td>
          <td><?php echo e($val->ip); ?> </td>
          <td><i style="color: #2980B9" class="fas fa-edit"></i><a href="#" data-toggle="modal" class="edit" data-target="#company_edit"> Edit</a></td>
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
								
<div class="modal fade" id="company_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Company ADD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post"  id="company_master_form" > 
      	<?php echo e(csrf_field()); ?>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-3">Company Name</label>
		        <div class="col-xs-8">
		            <input type="text" class="form-control" name="name" >
		            <span id="name_cat" class="help-inline"></span>
		        </div>
		    </div>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-3">Contact Person</label>
		        <div class="col-xs-8">
		            <input type="text" class="form-control" name="contact_person" id="contact_person"  >
		            <span id="cont_per_cat" class="help-inline"></span>
		        </div>
		    </div>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-3">contact no</label>
		        <div class="col-xs-8">
		            <input type="text" class="form-control" name="contact" id="contact"  >
		            <span id="contact_no_err" class="help-inline"></span>
		        </div>
		    </div>

		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-3">email ID</label>
		        <div class="col-xs-8">
		            <input type="text" class="form-control" name="email" id="email"  >
		            <span id="email_error" class="help-inline"></span>
		        </div>
		    </div>

		    
		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-3">Logo</label>
		        <div class="col-xs-8">
		            <input type="file" class="form-control" name="logo" id="logo"  >
		            <span id="logo_erorr" class="help-inline"></span>
		        </div>
		    </div>

      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="company_master_id">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="company_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post" id="company_edit_form" enctype="multipart/form-data" > 
      <?php echo e(csrf_field()); ?>

      <input type="hidden" name="c_id" class="c_id">
		    <div class="form-group">
		     
		        <label for="company_nm" class="control-label col-xs-3">Company Name</label>
		        <div class="col-xs-8">
		            <input type="text" class="form-control company_nm" name="company_nm">
		        </div>
		    </div>
		    <div class="form-group">
		        <label for="contact_person" class="control-label col-xs-3">Contact Person</label>
		        <div class="col-xs-8">
		            <input type="text" class="form-control contact_person" name="contact_person">
		        </div>
		    </div>
		    <div class="form-group">
		        <label for="contact_no" class="control-label col-xs-3">Contact Number</label>
		        <div class="col-xs-8">
		            <input type="text" class="form-control contact_no" name="contact_no">
		        </div>
		    </div>
		    <div class="form-group">
		        <label for="email_id" class="control-label col-xs-3">Email ID</label>
		        <div class="col-xs-8">
		            <input type="text" class="form-control email_id" name="email_id">
		        </div>
		    </div>
		    <div class="form-group">
		        <label for="company_id" class="control-label col-xs-3">Company ID</label>
		        <div class="col-xs-8">
		            <input type="text" class="form-control company_id" name="company_id">
		        </div>
		    </div>
		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-3">Logo</label>
		        <div class="col-xs-8">
		            <img src="" class=" logo">
		        </div>
		    </div>
		    <div class="form-group">
		        <label for="inputEmail" class="control-label col-xs-3">Upload Logo</label>
		        <div class="col-xs-8">
		            <input type="file" name="new_logo">
		        </div>
		    </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="company_edit">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script src='<?php echo e(url('/javascripts/jquery.min.js')); ?>'></script>
<script type='text/javascript'>

$("#company_master_id").click(function(event){  

    event.preventDefault();
    var image = $('#logo');
    var formData = new FormData();
    formData.append('logo', image[0].files[0]); 
 
    var other_data = $('#company_master_form').serializeArray();
    $.each(other_data,function(key,input){
        formData.append(input.name,input.value);
    });

 $.ajax({
        url: "<?php echo e(url('company-master-save')); ?>",
        data: formData,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(msg){
            if(msg!=0){ 
               console.log(msg);

               if(msg.name){
               		$('#name_cat').text(msg.name );
               }else{
               		$('#name_cat').text('');
               }

               if(msg.name){
               		$('#name_cat').text(msg.name );
               }else{
               		$('#name_cat').text('');
               }

               if(msg.contact_person){
               		$('#cont_per_cat').text(msg.contact_person );
               }else{
               		$('#cont_per_cat').text('');
               }

               if(msg.contact){
               		$('#contact_no_err').text(msg.contact );
               }else{
               		$('#contact_no_err').text('');
               }

	           if(msg.email){
	           		$('#email_error').text(msg.email );
	           }else{
	           		$('#email_error').text(' ');
	           }

               if(msg.company_id){
               		$('#company_id_erorr').text(msg.company_id );
               }else{
               		$('#company_id_erorr').text('') ;
               }

               if(msg.logo ){
               		$('#logo_erorr').text(msg.logo );
               }else{
               		$('#logo_erorr').text('');
               }
                  
               }else{
               window.location.href = "<?php echo e(url('company-master')); ?>"; 
            }      
        }
    });
});


$('#company_edit').click(function(){

    $.ajax({
          url:"<?php echo e(URL::to('company_edit_submit')); ?>" ,  
          data:new FormData($("#company_edit_form")[0]),
          dataType:'json',
          async:false,
          type:'POST',
          processData: false,
          contentType: false,
          success: function(msg){
             console.log(msg.status);
          }
        });
  });

$('.edit').click(function(){
  
    var $row = $(this).closest("tr");
    var id = $row.find(".com_id").text();    // Find the row
    var name = $row.find(".name").text(); 	 // Find the text
    var contact_person = $row.find(".contact_person").text()
    var number = $row.find(".number").text()
    var email = $row.find(".email").text()
    var company_id = $row.find(".company_id").text()
    var logo = $("img", $row).attr("src");
    //console.log(logo);return false;
   

    $('.c_id').val(id);
    $('.company_nm').val(name);
    $('.contact_person').val(contact_person);
    $('.contact_no').val(number);
    $('.email_id').val(email);
    $('.company_id').val(company_id);
    // $(".logo").attr( "src","<?php echo e(url('images/upload')); ?>");

    
});
</script>
<?php $__env->stopSection(); ?>	
<?php echo $__env->make('include-new.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>