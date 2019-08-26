@extends('include-new.master')
@section('content')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<p class="alert alert-success">{{ Session::get('message') }}</p>
</div>
@endif
<style type="text/css">
  #tblcsdata th,td{
    background-color: transparent;
    padding: 10px;
    font-size: 13px;
    border: 1px solid #eee !important; 
    margin-left: 45px;
   
  }
  .txtarea{
    width: 200px !important; 
  }
</style>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
            <div class="card-body">
              <h4 class="card-title">Calling/Disposition Submission</h4>
             <!-- <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#Agent-Modal"><span class="glyphicon glyphicon-plus"></span> &nbsp; Agent</a></p> -->
            <div class="overflow-scroll">
          <div class="table-responsive">
<table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="crm_table_id">
  <thead>
          <td><button class="btn btn-info cust_chat" value="{{$val->request_id}}" id="cust_chat_{{$val->request_id}}" name="cust_chat" onclick="customerchatmodel()">Customer Chat</button></td>


          <td><button class="btn btn-info agent_chat" value="" id="agent_chat" name="agent_chat" onclick="AgentChat()">Agent Chat</button></td>
        </tr>
    @else
        <tr>
          <td><a onclick="getrequestid({{$val->request_id}});" href="#" data-toggle="modal" data-target="#myModal">{{$val->request_id}}</a></td>
          <td>{{$val->customer_name}}</td>
          <td>{{$val->customer_email}}</td>
          <td>{{$val->customer_no}}</td>
          <td>{{$val->ag_name}}</td>
          <td>{{$val->ag_contact_no}}</td>
          <td>{{$val->ag_email}}</td>
          <td><textarea readonly class="txtarea">{{$val->request_name}}</textarea></td>
           
          <td><button class="btn btn-info cust_chat" value="{{$val->request_id}}" id="cust_chat_{{$val->request_id}}" name="cust_chat" onclick="customerchatmodel()">Customer Chat</button></td>

          <td><button class="btn btn-info agent_chat" value="" id="agent_chat" name="agent_chat" onclick="AgentChat()">Agent Chat</button></td>
        </tr>
    @endif
    @endforeach
  </tbody>

</table>
</div>
</div>
</div>
</div>
</div>
</div>



<!-- ---------------------Comment---------------------------------- -->
 <!-- Modal -->
  <div class="modal fade" id="reqcommentsagent" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Comment Messages</h3>
          <button type="button" class="close" data-dismiss="modal" onClick="window.location.reload()">&times;</button>
        </div>
        <div class="modal-body" style="height: 250px; overflow-y: auto;">
          <div id="Adminview">
            
          </div>
          <form>
        </div>
        <div class="modal-footer">
              <label style="margin: 7px;"><h4>Comment:</h4></label>
              <input type="hidden" name="rcommidagnt" id="rcommidagnt" class="form-control" value="">
              <input type="text" name="rcommentagent" id="rcommentagent" class="form-control" placeholder="Type a message..." required="">
              <button type="button" id="commentsaveagant" name="commentsaveagant" class="btn btn-success">Save</button>
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Close</button> -->
        </div>
        </form>
      </div>
    </div>
  </div>

<script src='{{ url('/javascripts/jquery.min.js') }}'></script>
<script src='{{ url('/javascripts/bootstrap/jquery.dataTables.min.js') }}'></script>
<script src='{{ url('/javascripts/bootstrap/dataTables.bootstrap.min.js') }}'></script>
<script type="text/javascript">
  $(document).ready( function(){
    $('#crm_table_id').DataTable({
      "ordering": false
    });

    $('input.txtchk').on('change', function() {
    $('input.txtchk').not(this).prop('checked', false);  
});
});
      
</script>

<script type="text/javascript">
  $('.reqcommagent').click(function(){
    $('#Adminviewagent').empty();
    var vreq_id = $(this).val();
    $('#reqcommentsagent').modal('show');
    $('#rcommidagnt').val(vreq_id);
    var vreq_id = $(this).val();
       
  });

  // $('#commentsaveagant').click(function(){
  //  var req_id = $('#rcommidagnt').val();
  //  var req_comm = $('#rcommentagent').val();
  //  if(req_comm == '' || req_comm == null){
  //     alert("Please enter comment.");
  //  }else{
  //    $.ajax({
  //       url:'save-comments-request/{req_id}/{req_comm}',
  //       type:'get',
  //       data: { req_id:req_id,req_comm:req_comm},
  //       success:function(msg){
  //         location.reload();
  //         //chatdisplay();
  //         //$('#rcomment').val('');
  //       }
  //    })
  //   }
  // });
</script>

<script type="text/javascript">
  function agentchatdisplay(){
       $('#Adminviewagent').empty();
       var vreq_id = $('#reqcommagent').val();
       $.ajax({
        url:'view-comments-request/{vreq_id}',
        type:'get',
        data: { vreq_id:vreq_id},
        success:function(msg){
          $.each(msg,function(value){
            if(msg[value].comments_by == 'Admin'){
              $('#Adminviewagent').append('<div class="container"><img src="images/icons/Admin.jpg" alt="Avatar" style="width:100%;"><p>'+msg[value].comments+'</p><span class="time-right">'+msg[value].created_date+'</span></div>');
            }else{
              $('#Adminviewagent').append('<div class="container darker"><img src="images/icons/Agent.jpg" alt="Avatar" class="right" style="width:100%;"><p>'+msg[value].comments+'</p><span class="time-left">'+msg[value].created_date+'</span></div>');
            }
             if(msg[value].status=='3'){
              $('#commentsaveagant').attr("disabled", true);
            }else{
              $('#commentsaveagant').removeAttr("disabled");
            }
          })
        }
     })
  }
</script>


  <script type="text/javascript">
    function AgentChat(){
       $.ajax({
        url:'agent-chat-count',
        type:'get',
        data:{},
        success:function(chatcount){
           setTimeout(function(){
            $.each( chatcount, function( key, value ) {
               $("#agent_chat"+value.req_id).html('Agent Msg ('+value.count+')');
            })
             AgentChat(); 
           }, 3000); 
        }
       })
     }

      $(document).ready(function(){
        AgentChat();
      });

      $('.agent_chat').click(function(){
        var id = $(this).val();
        $('#AgentChat').modal('show'); 
        $('#reqidadminagnt').val(id); 
        $.ajax({
          url:'agent-chat-msg/{id}',
          type:'get',
          data:{id:id},
          success:handleData 
        })
      });

      function agentchatdetails(id){
        $.ajax({
          url:'agent-chat-msg/{id}',
          type:'get',
          data:{id:id},
          success:handleData 
        })
     }
      
     function handleData(msg) {
        $('#Ajentview').empty();
        $.each(msg,function(value){
        if(msg[value].type == 'A'){
          $('#Ajentview').append('<div class="container"><img src="images/icons/Admin.jpg" alt="Avatar" style="width:100%;"><p>'+msg[value].message+'</p><span class="time-right">'+msg[value].created_date_time+'</span></div>');
          }else{
            $('#Ajentview').append('<div class="container darker"><img src="images/icons/Agent.jpg" alt="Avatar" class="right" style="width:100%;"><p>'+msg[value].message+'</p><span class="time-left">'+msg[value].created_date_time+'</span></div>');
          }
        })
        setTimeout(function(){
          agentchatdetails(msg[0].req_id); 
      }, 3000); 
     }
  </script>

  

  <script type="text/javascript">
    $('#commentsaveagant').on('submit', function(e) {
       e.preventDefault(); 
       $.ajax({
           type: "get",
           url: '{{URL::to('comment-add-agent')}}',
           data:  $('#commentsaveagant').serialize(),
           success: function( msg ) {
                $('#admincommentagnt').val('');
               agentchatdetails(msg[0].id); 
           }
       });
   });
  </script>


  <!-- ---------------------Agent Chat Vikas---------------------------------- -->
 <!-- Modal -->
  <div class="modal fade" id="AgentChat" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Customer Messages</h3>
          <button type="button" class="close" data-dismiss="modal" onClick="window.location.reload();">&times;</button>
        </div>
        <div class="modal-body" style="height: 250px; overflow-y: auto;">
          <div id="Ajentview">
            
          </div>
          <form id="commentsaveagant" method="post">
        </div>
        <div class="modal-footer">
              <label style="margin: 7px;"><h4>Comment:</h4></label>
              <input type="hidden" name="reqidadminagnt" id="reqidadminagnt" class="form-control" value="">
              <input type="text" name="admincommentagnt" id="admincommentagnt" class="form-control" placeholder="Type a message..." required="">
              <button type="submit" id="admincommentsaveagant" name="admincommentsaveagant" class="btn btn-success">Send</button>
        </div>
        </form>
      </div>
    </div>
  </div>

           <script type="text/javascript">
            
      $('.agent_chat').click(function(){
        var id = $(this).val();
        $('#AgentChat').modal('show'); 
        $('#reqidadminagnt').val(id); 
        $.ajax({
          url:'agent-chat-msg/{id}',
          type:'get',
          data:{id:id},
          success:handleData 
        })
      });
           </script>
@endsection

