@extends('include-new.master')
@section('content')

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
						   	@foreach($data as $val)
						        <tr>
						            <td class="text-wrap1">{{ $val -> id }}</td>
						            <td class="text-wrap1">{{ $val -> orderid }}</td>
						            <td class="text-wrap1">{{ $val -> cityname }}</td>
						            <td class="text-wrap1">{{ $val -> currentpincode }}</td>
						            <td class="text-wrap1">{{ $val -> current_address }}</td>						            			
						            <td class="text-wrap1">{{ $val -> vehicleno }}</td>
						            <td class="text-wrap1">{{ $val -> chaising_number }}</td>						                 
						            <td class="text-wrap1">{{ $val -> DL_Type }}</td>   
						            <td class="text-wrap1">{{ $val -> DL_No }}</td>
						            <td class="text-wrap1">{{ $val -> DL_Correct_name }}</td>
						            <td class="text-wrap1">{{ $val -> DL_DOB }}</td>
						            <td class="text-wrap1">{{ $val -> DL_Address }}</td>
									<td class="text-wrap1">{{ $val -> assistant_date }}</td>
						            <td class="text-wrap1">{{ $val -> assistant_time }}</td>
						            <td class="text-wrap1">{{ $val -> assistant_place }}</td>
						            <td class="text-wrap1">{{ $val -> insure_company_name }}</td>
						            <td class="text-wrap1">{{ $val -> patient_name }}</td>
						            <td class="text-wrap1">{{ $val -> hospital_name }}</td>
						            <td class="text-wrap1">{{ $val -> hospitalization_date }}</td>
						            <td class="text-wrap1">{{ $val -> name_of_praposal }}</td>						            			
						            <td class="text-wrap1">{{ $val -> sume_assured }}</td>
						            <td class="text-wrap1">{{ $val -> DOB }}</td>						                 
						            <td class="text-wrap1">{{ $val -> covered_for }}</td>   
						            <td class="text-wrap1">{{ $val -> No_family_member }}</td>
						            <td class="text-wrap1">{{ $val -> make }}</td>
						            <td class="text-wrap1">{{ $val -> model }}</td>
						            <td class="text-wrap1">{{ $val -> nominee_name }}</td>
									<td class="text-wrap1">{{ $val -> relation_with_nominee }}</td>
						            <td class="text-wrap1">{{ $val -> com_name }}</td>
						            <td class="text-wrap1">{{ $val -> pan_no }}</td>
						            <td class="text-wrap1">{{ $val -> annual_income }}</td>
						            <td class="text-wrap1">{{ $val -> salaried }}</td>
						            <td class="text-wrap1">{{ $val -> any_EMI }}</td>
						            <td class="text-wrap1">{{ $val -> EMI_Amount }}</td>
									<td class="text-wrap1">{{ $val -> vehicle_finance_form }}</td>
						            <td class="text-wrap1">{{ $val -> new_owner }}</td>
						            <td class="text-wrap1">{{ $val -> pucexpirydate }}</td>
						            <td class="text-wrap1">{{ $val -> createdate }}</td>
						        </tr>
						    @endforeach
						    </tbody>
						</table>
					</div>
				</div>
            </div>
        </div>
	</div>
</div>

<script src='{{ url('/javascripts/jquery.min.js') }}'></script>
<script src='{{ url('/javascripts/bootstrap/jquery.dataTables.min.js') }}'></script>
<script src='{{ url('/javascripts/bootstrap/dataTables.bootstrap.min.js') }}'></script>
@endsection		 