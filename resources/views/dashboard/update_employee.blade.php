@extends('include-new.master')
@section('content')
@if(Session::has('msg'))
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<p class="alert alert-success">{{ Session::get('msg') }}</p>
</div>
@endif
   <div class="container-fluid white-bg col-md-12">
   <div class="col-md-12"><h3 class="mrg-btm">Update Employee Details</h3></div> <br><br>
   <div class="divbro col-md-12">

<form id="emp_form" name="emp_form" method="post" action="{{url('update_emp_details')}}"> 
 {{csrf_field()}} 
 </div><br><br>

<div class="form-group col-md-6">
    <div class="col-md-3">
      <label>User ID:</label>
    </div>
    <div class="col-md-7">
      <input type="text" class="text-primary form-control" name="txtuserid" value="{{$data[0]->user_id}}" id="txtuserid" placeholder="Enter User_Id" readonly="yes">
    </div>
  </div>



   <div class="form-group col-md-6">
    <div class="col-md-3">
      <label>Name:</label>
    </div>
    <div class="col-md-7">
      <input type="text" class="text-primary form-control" name="txtname" id="txtname" value="{{$data[0]->EmployeeName}}" required="yes" >
    </div>
  </div>




  <div class="form-group col-md-6">
    <div class="col-md-3">
      <label>Email Id:</label>
    </div>
    <div class="col-md-7">
      <input type="text" class="text-primary form-control" name="txtemail" id="txtemail" id="txtuserid" value="{{$data[0]->email}}" required="yes" readonly="yes">
    </div>
  </div>

  <div class="form-group col-md-6">
    <div class="col-md-3">
      <label>Offical Email Id:</label>
    </div>
    <div class="col-md-7">
      <input type="text" class="text-primary form-control" name="txtofcmail" id="txtofcmail" value="{{$data[0]->official_emailid}}" id="txtuserid" onblur="validateEmail(this);">
    </div>
  </div>


  <div class="form-group col-md-6" id="sel">
    <div class="col-md-3">
      <label>Profile:</label>
    </div>
    <div class="col-md-7">
      <select  name="txtprofile" id="txtprofile" class="text-primary form-control" required="yes">
        @foreach($profileadd as $val)
        @if($val->Profile==$data[0]->Profile){
        <option selected="selected" value="{{$val->Profile}}">{{$val->Profile}}</option>
}
@else
<option value="{{$val->id}}">{{$val->Profile}}</option>
  @endif
   @endforeach
      </select>
    </div>
  </div>

  <div class="form-group col-md-6">
          <div class="col-md-3">
           <label>Status :</label>
         </div>
         <div class="col-md-7">
          <select  name="txtstatus" id="txtstatus" class="text-primary form-control" required="yes">
            @foreach($data as $val)
            @if($val->Status==$data[0]->Status){
            <option selected="selected" value="{{$val->Status}}">{{$val->Status}}</option>
          }
          <option value="1">Active</option>
          <option value="0">in_active</option> 
          @endif
          @endforeach
        </select>
 </div>
</div>

   <div class="col-md-4">
  <input type="Submit" name="statussub" id="statussub" value="submit" class="btn btn-success">
</div>
</div>
</form>

<script type="text/javascript">
  function validateEmail(emailField){
      //$("#txtemail").val("");

        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        
        if (reg.test(emailField.value) == false) 
        {
            alert('Invalid Email Address');
            return false;
        }

        return true;
}
</script>
  @endsection
