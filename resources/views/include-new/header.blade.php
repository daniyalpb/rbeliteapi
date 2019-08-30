<style>
.Read{background-color:#ffffff;}
.Unread{background-color:#a3a3c2;}
</style>

<!-- header navbar starts -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
          <img src="{{ url('images/elite-sm.png') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="{{ url('images/logo-mini.svg') }}" alt="logo" />
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
              <span id="notifications_count" class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              {{-- <a class="dropdown-item">
                <a href="view-coment" id="viewcomment" name="viewcomment" class="badge badge-pill badge-warning float-right">View all</a>
              </a> --}}
              <div class="dropdown-divider"></div>

              <div id='notification_details'>
                

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




              <img class="img-xs rounded-circle" src="{{ url('images/faces/face1.jpg') }}" alt="Profile image">
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


<script type="text/javascript" src="{{ url('javascripts/jquery.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
  get_notifications_count();
}); 


$("#notificationDropdown").on('click' , function(){
  get_notifications_details();
});


function get_notifications_count(){
  $("#notifications_count").empty();
  $.ajax({     
    url: "{{URL::to('get-notifications-count')}}",
    method:"get",
    success: function(response){
    var data = JSON.parse(response);
      $("#notifications_count").text(data[0].notifications_count);
    }
  });
} 


function get_notifications_details(){

  $("#notification_details").html();

  $.ajax({     
    url: "{{URL::to('update-is-viewed-notifications')}}",
    method:"get",
    success: function(response){
      var data = JSON.parse(response);
      $("#notifications_count").text(0);

      var notifications_details = '';

      $.each( data , function(key , value){
        notifications_details += '<a class="dropdown-item preview-item '+ value.is_read +'" id="a_each_notification_'+ value.admin_notif_id +'" data-order_id="'+value.orderid+'" data-is_read="'+ value.is_read +'" data-admin_notificationId="'+value.admin_notif_id+'" onclick="mark_notification_read(this.id)"> <div class="preview-thumbnail" style="cursor:pointer;color:black !important;"> Order Id : ' + value.orderid + ' created. </div> <div class="preview-item-content"> <h6 class="preview-subject font-weight-medium text-dark" ></h6> <p class="font-weight-light small-text"></p> </div> </a> <div class="dropdown-divider"> </div>'; });

      $("#notification_details").html(notifications_details);
      }
  });
}


function mark_notification_read(this_id){

  event.preventDefault();
  var order_id = $("#" + this_id).attr('data-order_id');
  var is_read = $("#" + this_id).attr('data-is_read');
  var admin_notificationId = $("#" + this_id).attr('data-admin_notificationId');

  $.ajax({     
    url: "{{URL::to('update-is-read-notifications')}}",
    method:"POST",
    data : { '_token' : '{{ csrf_token() }}' , 'admin_notificationId': admin_notificationId },
    success: function(response){
      $("#a_each_notification_" + admin_notificationId).removeClass('Unread');
      $("#a_each_notification_" + admin_notificationId).addClass('Read');
    }
  });

}

setInterval(function(){ 
  get_notifications_count();
}, 15000);
</script>

