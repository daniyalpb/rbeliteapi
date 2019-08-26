@extends('include-new.master')
@section('content') 
 <div id="content" style="overflow:scroll;">
   <div class="container-fluid white-bg">
    <div class="col-md-12"><h3 class="mrg-btm">User Comment</h3></div>      
    <div class="col-md-12">
        <div class="overflow-scroll" >
      <div class="table-responsive" >
        <div id="divrepo">
         <table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" id="payment">
          <thead>
              <tr>                            

                   <th>comment id</th>
                   <th>request id</th>
                   <th>Comments</th>
                    <th>Comments_By</th>
                   <th>Created_date</th>

                 </tr>
                </thead>
                <tbody>

        @foreach($query as $val)   

       <td><?php echo $val->comment_id; ?></td> 
       <td><?php echo $val->request_id; ?></td>
       <td><?php echo $val->comments; ?></td>
        <td><?php echo $val->comments_by; ?></td>
       <td><?php echo $val->created_date; ?></td>

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