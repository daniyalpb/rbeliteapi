@extends('include-new.master')

@section('content')
<div class="container-fluid white-bg">
 <div class="col-md-12"><h3 class="mrg-btm">OTP Details</h3></div>
 <div class="col-md-12">
  <form id="Frmcrmrp" method="post">
     {{ csrf_field() }}
   <div class="col-md-3">
      <div class="form-group"> 
         <label>From Date</label>
         <div id="datepicker" class="input-group getDate" data-date-format="yyyy-mm-dd">
               <input class="form-control date-range-filter" type="date" placeholder="From Date" name="txtfromdate" id="txtfromdate" required  value="<?php echo date("Y-m-d")?>">
      <!--     <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> -->
         </div>
      </div>
   </div>





   <div class="col-md-3">
      <div class="form-group">
        <label>To Date</label>
        <div id="datepicker1" class="input-group getDate" data-date-format="yyyy-mm-dd">
             <input class="form-control date-range-filter" type="date" placeholder="To Date"  name="txttodate"  id="txttodate" required value="<?php $datetime = new DateTime('tomorrow');
echo $datetime->format('Y-m-d'); ?>">
<!--  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
 -->        </div>
      </div>
  </div>

  <div class="col-md-1">    
    <a id="btncrmreport" class="btn btn-primary" style="margin-top: 25px; color:white;"  onclick="getcrmrp();">SHOW</a>
  </div> 
  </form>
</div>
  <div class="col-md-12">
      <div class="overflow-scroll">
 <br/>
<br/>
    <div class="table-responsive" id="divcrmtable">       
   </div>
  </div>
</div>
</div>
</div>
</div>






<script type="text/javascript">


 $(document).ready(function() {

   getcrmrp();

 });
function getcrmrp(){
  var startdate=$("#txtfromdate").val();
  var enddate=$("#txttodate").val();
  if ($('#Frmcrmrp').valid()){
$.ajax({ 
     url: 'get-otp-details/'+startdate+'/'+enddate,
     dataType : 'json',
     method:"GET",
     success: function(msg)
     {
      //alert(msg);
 $("#divcrmtable").empty();
        var newdata = JSON.stringify(msg);

        var data=JSON.parse(newdata);
           $("#cek").val(data);
        var fdate=$("#txtfromdate").val();
        var tdate=$("#txttodate").val();


     //   alert(newdata);
        var str = "<table class='datatable-responsive table table-striped table-bordered dt-responsive nowrap' id='crmtable'><thead><tr><th>ID</th> <th>Mobile No</th> <th>OTP</th><th>Created Date</th></tr></thead><tbody>";

         console.log(data);
       for (var i = 0; i < data.length; i++) 
       {
         str = str + "<tr style='height:30px;margin:5px;'><td>"+data[i].id+"</td> <td>"+data[i].mobile+"</td> <td>"+data[i].otp+"</td><td>"+data[i].sent_on+"</td></tr>";
        }     
         str = str + "</tbody></table>";
         //alert(str);
           $('#divcrmtable').html(str);
           $("#crmtable").DataTable();
          
     }  
     

});
}
}
</script>
@endsection