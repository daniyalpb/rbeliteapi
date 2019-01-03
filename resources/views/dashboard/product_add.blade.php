@extends('include-new.master')
@section('content')

<style>
.error_class{color:red;}
</style>
    

<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="card">
            <div class="card-body">
              <h4 class="card-title">Product Add</h4>								 
								  
 	<form class="form-horizontal" method="post" action="{{url('product-save')}}" enctype="multipart/form-data"> 
 	{{ csrf_field() }}
    <div class="form-group">
        <label for="inputEmail" class="control-label col-xs-2">Product Name</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" name="name" id="name"  >
             @if ($errors->has('name'))<label class="control-label error_class" for="inputError"> {{ $errors->first('name') }}</label>  @endif
        </div>
    </div>

    <div class="form-group">
        <label for="inputPassword" class="control-label col-xs-2">Category   </label>
        <div class="col-xs-10">
           <select class="form-control" name="category_id" id="category_id">
            <option value="0" > SELECT</option>
            @foreach($query as $key=> $val)
			  <option value="{{$val->id}}">{{$val->name}}</option>
			 @endforeach
			</select>
    @if ($errors->has('category_id'))<label class="control-label error_class" for="inputError"> {{ $errors->first('category_id') }}</label>  @endif
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
	   @if ($errors->has('charge'))<label class="control-label error_class" for="inputError"> {{ $errors->first('charge') }}</label>@endif
	    </div>
	</div>


    <div class="form-group">
        <label for="inputEmail" class="control-label col-xs-2">Agent Commision</label>
        <div class="col-xs-10">
        <input type="text" class="form-control" name="agent_commision" onkeypress="return Numeric(event)">
    	@if($errors->has('agent_commision'))<label class="control-label error_class" for="inputError"> {{ $errors->first('agent_commision') }}</label>@endif
        </div>
    </div>


    <div class="form-group">
        <label for="inputEmail" class="control-label col-xs-2">Logo</label>
        <div class="col-xs-10">
            <input type="file" class="form-control"  name="logo"  onkeypress="return Numeric(event)">
    @if ($errors->has('logo'))<label class="control-label error_class" for="inputError"> {{ $errors->first('logo') }}</label>  @endif
        </div>
    </div>
								    
	<div class="form-group">
	    <label for="inputPassword" class="control-label col-xs-2">Company</label>
	    <div class="col-xs-10">
	       <select class="form-control" name="company" id="company"  >
	        <option value="0" > --SELECT---</option>
	        @foreach($company as $key=> $val)
			  <option value="{{$val->id}}">{{$val->name}}</option>
			 @endforeach
			</select>
	          @if ($errors->has('company'))<label class="control-label error_class" for="inputError"> {{ $errors->first('company') }}</label>  @endif
	    </div>
	</div>
 

	<div class="form-group">
	    <label for="inputPassword" class="control-label col-xs-2">Documents Required</label>
	    <div class="col-xs-10">
	       <select class="form-control" name="required_field[]"  id="multiple-checkboxes" multiple="multiple" >
	        @foreach($docu_required as $key=> $val)
			  <option value="{{$val->id}}">{{$val->required_field}}</option>
			 @endforeach
			</select>
	          @if ($errors->has('required_field'))<label class="control-label error_class" for="inputError"> {{ $errors->first('required_field') }}</label>  @endif
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

@endsection		