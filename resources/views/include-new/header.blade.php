<!-- header navbar starts -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
          <img src="images/elite-sm.png" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="images/logo-mini.svg" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
     {{-- <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <li class="nav-item">
            <a href="#" class="nav-link">Schedule
              <span class="badge badge-primary ml-1">New</span>
            </a>
          </li>
          <li class="nav-item active">
            <a href="#" class="nav-link">
              <i class="mdi mdi-elevation-rise"></i>Reports</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="mdi mdi-bookmark-plus-outline"></i>Score</a>
          </li>
        </ul>--}}
        <ul class="navbar-nav navbar-nav-right">
          {{-- <li class="nav-item dropdown">
             <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
              <span class="count">7</span>
            </a> 
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>--}}
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              
<!--             <span id="divcnt" class="count" onclick="newupdateamt()"></span>
 -->              
             <span id="divcnt" class="count"></span>
             <span id="notify"></span>

            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">

                <p class="mb-0 font-weight-normal float-left">You have <span id="divcntnew" class="countday"></span> new notifications
                </p>
                <a href="view-coment" id="viewcomment" name="viewcomment" class="badge badge-pill badge-warning float-right">View all</a>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>


                <div class="preview-item-content">
                  <a onclick="empty_count();" data-toggle="modal" data-target="#Quotedescription"> <h6 class="preview-subject font-weight-medium text-dark" >View User Comment</h6></a>
                  <p class="font-weight-light small-text">
                    Just now 
                    </a>
                  </p> 
                </div>
              
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, {{ Session::get('name') }} !</span>




              <img class="img-xs rounded-circle" src="images/faces/face1.jpg" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item">
                Change Password
              </a>
              <a class="dropdown-item" href='{{ url('log-out') }}'>
                Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
<!-- header navbar ends -->


<!-- QUOTES STATUS VIEW MODEL STATRT -->

<div class="modal" id="Quotedescription">
  <div class="modal-dialog modal-lg modal_extra_width">
    <div class="modal-content">      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">User Comments</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>        
      <!-- Modal body -->
      <div class="modal-body">

       <div class="table"></div>
       <div id="loadproduct"> </div>
       <!--            <span id="txtdiscription"></span>  -->
       <textarea id="txtdiscription" readonly class="form-control" style="height: 218px;"></textarea>              
     </div>      
     <!-- Modal footer -->
     <div class="modal-footer">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
     </div>
   </div>


 </div>
</div>

<!-- QUOTES STATUS VIEW MODEL END -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    $.ajax({     
    // url: "{{URL::to('get-count-comment')}}",
      url: 'get-count-comment',
      method:"get",
      success: function(msg)  
         {
      var data = (JSON.parse(msg));

      $("#divcnt").text(data[0].comments);
      $("#divcntnew").text(data[0].comments);

      $("#txtdiscription").text(data[0].mssg);


      }
     });
   }); 

    </script>

<script type="text/javascript">
$(document).ready(function() {
    // function view_comment_new(request_id){ 

    $.ajax({     
    url: "{{URL::to('view-coment')}}",
      // url: 'getcomment/'+request_id,
      method:"get",
      success: function(msg)  
         {
      var data = (JSON.parse(msg));

      }
     });
   }); 
    </script>
<script type="text/javascript">
function empty_count(){
  alert("test");
  $.ajax({ 
       url: "{{URL::to('is-view-comment')}}",
       method:"get",
       success: function(msg){
        var data = (JSON.parse(msg));
        if (data.length!='1') {
          $("#Quotedescription").modal('show');
        }else{
          alert('There is nothing to Comment');
          $("#Quotedescription").modal('hide');
        }
        
        
      console.log(msg);
   // window.location.reload(true);

   }
 
   });
}

</script>