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
              <h4 class="card-title">View Details</h4>
		        <div class="overflow-scroll">
					<div class="table-responsive">
						<table id="table_id" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap">
						    <thead>
						        <tr class="tr-bg">
						            <th class="text-wrap1">ID</th>
						            <th class="text-wrap1">Order Id</th>
						            <th class="text-wrap1">City Name</th>
						            <th class="text-wrap1">Pincode</th>
						            <th class="text-wrap1">Current Address</th>
						            <th class="text-wrap1">Vehicle No.</th>
						            <th class="text-wrap1">Chaising No.</th>
						            <th class="text-wrap1">DL Type</th>
						            <th class="text-wrap1">DL No.</th>
						            <th class="text-wrap1">DL Name</th>
						            <th class="text-wrap1">DL DOB</th>
						            <th class="text-wrap1">DL Address</th>
						            <th class="text-wrap1">Assistent date</th>
						            <th class="text-wrap1">Assistent time</th>
						            <th class="text-wrap1">Assistent place</th>
						            <th class="text-wrap1">Insure company name</th>
						            <th class="text-wrap1">Patient Name</th>
						            <th class="text-wrap1">Hospital Name</th>
						            <th class="text-wrap1">Hospitalization Date</th>
						            <th class="text-wrap1">Name of praposal</th>
						            <th class="text-wrap1">Sume assured</th>
						            <th class="text-wrap1">DOB</th>
						            <th class="text-wrap1">Coverd For</th>
						            <th class="text-wrap1">Family No.</th>
						            <th class="text-wrap1">Make</th>
						            <th class="text-wrap1">Modal</th>
						            <th class="text-wrap1">Nominee name</th>
						            <th class="text-wrap1">Relation Nominee</th>
						            <th class="text-wrap1">Com Name</th>
						            <th class="text-wrap1">Pan No</th>
						            <th class="text-wrap1">Annual Income</th>
						            <th class="text-wrap1">Salaried</th>
						            <th class="text-wrap1">Any EMI</th>
						            <th class="text-wrap1">EMI amount</th>
						            <th class="text-wrap1">Vehicle finance form</th>
						            <th class="text-wrap1">New owner</th>
						            <th class="text-wrap1">PUC expiry date</th>
						            <th class="text-wrap1">Created date</th>
						        </tr>
						    </thead>
						    <tbody>
						   	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						        <tr>
						            <td class="text-wrap1"><?php echo e($val -> id); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> orderid); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> cityname); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> currentpincode); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> current_address); ?></td>						            			
						            <td class="text-wrap1"><?php echo e($val -> vehicleno); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> chaising_number); ?></td>						                 
						            <td class="text-wrap1"><?php echo e($val -> DL_Type); ?></td>   
						            <td class="text-wrap1"><?php echo e($val -> DL_No); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> DL_Correct_name); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> DL_DOB); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> DL_Address); ?></td>
									<td class="text-wrap1"><?php echo e($val -> assistant_date); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> assistant_time); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> assistant_place); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> insure_company_name); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> patient_name); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> hospital_name); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> hospitalization_date); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> name_of_praposal); ?></td>						            			
						            <td class="text-wrap1"><?php echo e($val -> sume_assured); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> DOB); ?></td>						                 
						            <td class="text-wrap1"><?php echo e($val -> covered_for); ?></td>   
						            <td class="text-wrap1"><?php echo e($val -> No_family_member); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> make); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> model); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> nominee_name); ?></td>
									<td class="text-wrap1"><?php echo e($val -> relation_with_nominee); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> com_name); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> pan_no); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> annual_income); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> salaried); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> any_EMI); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> EMI_Amount); ?></td>
									<td class="text-wrap1"><?php echo e($val -> vehicle_finance_form); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> new_owner); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> pucexpirydate); ?></td>
						            <td class="text-wrap1"><?php echo e($val -> createdate); ?></td>
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

<script src='<?php echo e(url('/javascripts/jquery.min.js')); ?>'></script>
<script src='<?php echo e(url('/javascripts/bootstrap/jquery.dataTables.min.js')); ?>'></script>
<script src='<?php echo e(url('/javascripts/bootstrap/dataTables.bootstrap.min.js')); ?>'></script>
<?php $__env->stopSection(); ?>		 
<?php echo $__env->make('include-new.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>