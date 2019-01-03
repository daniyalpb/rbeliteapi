@extends('include-new.master')
@section('content')

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
       @foreach($product_master as $key=> $val)
        <tr>
          <td>{{$val->productname}}</td>
          <td>{{$val->rtoname}}</td>
          <td>{{$val->subcategory}}</td>
          <td>{{$val->charges}}</td>
          <td>{{$val->agent_commision}}</td>
          <td>{{$val->required_field}}</td>
          <td>{{$val->company_name}}</td>
          <td class="logo"><img src="{{url('images/upload')}}/{{$val->product_logo}}" height="100" width="100"></td>	
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
@endsection		