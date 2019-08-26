@extends('include-new.master')
@section('content')

  <div class="container-fluid white-bg col-md-12">
   <div class="col-md-12"><h3 class="mrg-btm"> Add New Employee</h3></div> <br><br>
   <div class="divbro col-md-12">
    <input type="hidden" name="sfbaid" id="sfbaid" value=""/>


<form id="demo_form" name="demo_form" method="post" action="{{url('add-new-emp_elite')}}"> 
 {{csrf_field()}} 


      <!-- <div class="col-lg-4">
      <input type="text" class="text-primary form-control" id="search_userid" name="search_userid"  placeholder="Enter USER ID" required="yes">
      </div> -->
      <!-- <div class="col-lg-2">
      <button type="button" id="sub" name="sub" class="btn btn-primary">
      <span class="glyphicon glyphicon-search"></span> Search</button>
      </div> -->
      </div><br><br>

<div class="form-group col-md-6">
    <div class="col-md-3">
      <label>User ID:</label>
    </div>
    <div class="col-md-7">
      <input type="text" class="text-primary form-control" name="txtuserid" id="txtuserid" placeholder="Enter User_Id">
    </div>
  </div>



   <div class="form-group col-md-6">
    <div class="col-md-3">
      <label>Name:</label>
    </div>
    <div class="col-md-7">
      <input type="text" class="text-primary form-control" name="txtname" id="txtname">
    </div>
  </div>

  <div class="form-group col-md-6">
    <div class="col-md-3">
      <label>Email Id:</label>
    </div>
    <div class="col-md-7">
      <input type="text" class="text-primary form-control" name="txtemail" id="txtemail">
    </div>
  </div>

  <div class="form-group col-md-6">
    <div class="col-md-3">
      <label>Offical Email Id:</label>
    </div>
    <div class="col-md-7">
      <input type="text" class="text-primary form-control" name="txtofcmail" id="txtofcmail">
    </div>
  </div>


  <div class="form-group col-md-6" id="sel">
    <div class="col-md-3">
      <label>Profile:</label>
    </div>
    <div class="col-md-7">
      <select  name="txtprofile" id="txtprofile" class="text-primary form-control">
        <option value="">--Select Employee Profile--</option>
        @foreach($profileadd as $val)
        <option value="{{$val->Profile}}">{{$val->Profile}}</option>
        @endforeach
      </select>
    </div>
  </div>


  <div class="form-group col-md-6">
    <div class="col-md-3">
      <label>Status:</label>
    </div>
    <div class="col-md-7">
      <select class="text-primary form-control" name="txtstatus" id="txtstatus">
      <option value="">Selet User Status</option>
      <option value="1">Active</option>
      <option value="0">in_active</option>
      </select>
    </div>
  </div>

   <div class="col-md-4">
  <input type="Submit" name="statussub" id="statussub" value="submit" class="btn btn-success">
</div>
</div>
</form>



<script type="text/javascript" src="{{public_path('javascripts/jquery.min.js')}}"></script>


<script type="text/javascript">
  $(document).ready(function(){
  });
  $("#txtuserid").on("change",function(){              
    if($("#txtuserid").val()!=''){
      $.ajax({
       url: "{{url('new_emp_add')}}",
        type: 'get',
        data:{'id':$("#txtuserid").val()},
        success: function(data){
          //console.log(data);
             //alert(data.length);
            //alert(data[0].empexist);
          
            //(data.length<=0) 
            if(data.length=='0') 
            {
              alert('User_Id Does Not Exists');   
             $('#txtname').val('');
             $('#txtemail').val('');
             $('#txtuserid').val('');                       
            }else  if(data.length!='0'&& data[0].empexist!='1'){
              $('#txtname').val(data[0].name);
              $('#txtemail').val(data[0].email); 
              $('#txtuserid').val(data[0].user_id);
            }
            else if(data[0].empexist=='1'){
              alert("User_Id Already Exists");
              $('#txtname').val('');
             $('#txtemail').val('');
             $('#txtuserid').val(''); 
            }
          }                                
        });
    }
  });

</script>

<!-- 
  <script type="text/javascript">
        $(document).ready(function(){
         $("#sub").click(function(){
               if( $("#search_userid").val()==''){

                  return  false;
             }

               $.ajax({
                url: "{{url('new_emp_add')}}",
                type: 'get',
                data:{'id':$("#search_userid").val()},

                success: function(data){
               console.log(data);
               //alert(newdate);
                if (data.length<=0) 
                {
                  alert("no data found");
                  // window.location.replace("fbamaster-edit"); 
                 }else{            
             $('#txtname').val(data[0].name);
             $('#txtemail').val(data[0].email);   
  
                    }

                }                                
            });
        });

    $("#search_userid").keydown(function(){ 
                      $('#txtname').val('');
                      $('#txtemail').val(''); 
                      
    });
    });
          
  </script> -->

  @endsection