<script type="text/javascript">
    function Numeric(event) {     // for numeric value function
      if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode != 8) {
          event.keyCode = 0;
          return false;
      }
    }
$(document).ready(function(){
    $(".fltr-tog").click(function(){
        $(".filter-bdy").toggle();
    });
}); 
function myFunction(x) {
   x.classList.toggle("change");
}
 
$(document).ready(function(){
    $(".search-btn").click(function(){
        $(".search-dv").toggle("slow");
    });
});
 
  $(function () {
  $("#datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker("getDate");
});
 
  $(function () {
  $("#datepicker1").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker("getDate");
});
 
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });




          $(document).ready(function() {         //  table
          $('#example').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
          } );
          } );
          $('.popover-Payment').popover({
            trigger: 'focus'
          });

           $('.popover-Password').popover({
            trigger: 'focus'
          });

             
             $(document).ready(function(){          // show table 
                  $.fn.dataTable.ext.search.push(
                  function (settings, data, dataIndex) {
                      var min = $('#min').datepicker("getDate");
                      var max = $('#max').datepicker("getDate");
                      var startDate = new Date(data[1]);
                      if (min == null && max == null) { return true; }
                      if (min == null && startDate <= max) { return true;}
                      if(max == null && startDate >= min) {return true;}
                      if (startDate <= max && startDate >= min) { return true; }
                      return false;
                  }
                  );

                
                      $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                      $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                      var table = $('#example').DataTable();

                      // Event listener to the two range filtering inputs to redraw on input
                      $('#min, #max').change(function () {
                          table.draw();
                      });
                  });   









$("#Sub_Category_ID_hide").css("display", "none");
$(document).ready(function(){                        //     Product LIst 
    $("#category_id").change(function(){ 
           if($(this).val()!=null){
        $.get("<?php echo e(url('product/category-id')); ?>", {"category_id":$(this).val()})
                   .done(function(msg){ 

                           $('#Sub_Category_ID').empty();
                          obj=Array();
                         $.each(msg, function(i, item) {
                                obj.push('<option value='+item.id+'>'+item.subcategory+'</option>');
                           });
                            $("#Sub_Category_ID_hide").css("display", "block");
                           $('#Sub_Category_ID').append('<select class="form-control" name="Sub_Category_ID"> '+obj+'</select>');
                  }).fail(function(xhr, status, error) {
                 console.log(error);
            });
        
        }
    });


$("#category_add_id").click(function(event){  event.preventDefault();
 $.post("<?php echo e(url('category-save')); ?>", $('#category_add_id_from').serialize())
             .done(function(msg){ 
                 if(msg==0){
                 window.location.href = "<?php echo e(url('category-list')); ?>"; 
                 }else{
                  console.log("error");
                 }
                     })
             .fail(function(xhr, status, error) {
                 console.log(error);
            });



});

    



});


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


$("#add_sub_cat").click(function(event){  event.preventDefault();
            $.post("<?php echo e(url('sub-category-save')); ?>", $('#add_sub_catid_from').serialize())
             .done(function(msg){ 
                 if(msg==0){
                 window.location.href = "<?php echo e(url('category-list')); ?>"; 
                 }else{
                  console.log("error");
                 }
                     })
             .fail(function(xhr, status, error) {
                 console.log(error);
            });


});






//                  company_master

$("#company_master_id").click(function(event){  event.preventDefault();


   var image = $('#logo');
   var  formData = new FormData();
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
                  if(msg!=0){ console.log(msg);
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


 
                //var seri=$('#company_master_form').serialize();

            //  $.post("<?php echo e(url('company-master-save')); ?>",formData)
            //  .done(function(msg){ 

            //     if(msg!=0){ console.log(msg);
            //       $('#name_cat').text(msg.name );
            //       $('#cont_per_cat').text(msg.contact_person );
            //       $('#contact_no_err').text(msg.contact );
            //       $('#email_error').text(msg.email );
            //       $('#company_id_erorr').text(msg.company_id );
                   

                  
            //     }else{
            //       alert("success...");
            //     }
                  
            // }).fail(function(xhr, status, error) {
            //      console.log(error);
            // });


});




</script>

<!-- Documents Related -->

<script type="text/javascript">
  $('#documents').click(function(){
  
   if (! $('#documents_form').valid()) 
    {
      alert('not valid');
    } 
    else {
          
         $.ajax({  
         type: "POST",  
         url: "<?php echo e(URL::to('documents-submit')); ?>",
         data : $('#documents_form').serialize(),
         success: function(msg){
            console.log(msg.message);
            if (msg.status== 0) 
            { 
              alert('Documents Added Successfully');
            }
            else
            {
               alert('We regret documents could not be Added');
            }
                     
                      
      }   
     });
        
    }
  });
</script>

<script type="text/javascript">
  $('.do_edit').click(function(){

    var $row = $(this).closest("tr");    // Find the row
    var doc_id = $row.find(".doc_id").text(); // Find the text
    var doc_field = $row.find(".doc_field").text()
    
    $('.docs_nm').empty().append(doc_field);
    $('.docs_id').val(doc_id);
  });
</script>

<script type="text/javascript">
  $('#documents_edit').click(function(){
   // alert('okae');
  
          
         $.ajax({  
         type: "POST",  
         url: "<?php echo e(URL::to('documents-edit-submit')); ?>",
         data : $('#documents_edit_form').serialize(),
         success: function(msg){
          console.log(msg.message);
            if (msg.status== 0) 
            { 
              alert('Documents have been updated successfully');
            }
            else
            {
               alert('We regret documents could not be updated');
            }

            
                     
                      
      }   
     });
        
    
  });
</script>

<!-- Company Related -->

<script type="text/javascript">
  $('.edit').click(function(){
  
    var $row = $(this).closest("tr");
    var id = $row.find(".com_id").text();    // Find the row
    var name = $row.find(".name").text(); // Find the text
    var contact_person = $row.find(".contact_person").text()
    var number = $row.find(".number").text()
    var email = $row.find(".email").text()
    var company_id = $row.find(".company_id").text()
    var logo = $("img", $row).attr("src");
    // console.log(logo);return false;
   

    $('.c_id').val(id);
    $('.company_nm').val(name);
    $('.contact_person').val(contact_person);
    $('.contact_no').val(number);
    $('.email_id').val(email);
    $('.company_id').val(company_id);
    // $(".logo").attr( "src","<?php echo e(url('images/upload')); ?>");

    
  });
</script>

<script type="text/javascript">
  $('#company_edit').click(function(){
    alert('okae');
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
</script>
<script type="text/javascript">
  function getreportdata(id)  
  {
    alert(id);
   $.ajax({  
         type: "GET",  
         url:'Payment-Report-get/'+id,
         success: function(data){        
              $("#divrepo").show();  
        }  
      });

  } 

var table = $("#payment").DataTable();
$(".input-sm").on( 'keyup', function(){
// alert(table);
    table.search( this.value ).draw();
});
</script>
 