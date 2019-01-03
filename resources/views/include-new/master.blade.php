<!DOCTYPE html>
<html lang="en">
@include('include-new.head')

<body>
  <!-- container scroller starts here -->
  <div class="container-scroller">
  	@include('include-new.header')
    <!-- container-fluid page-body-wrapper starts here -->
    <div class="container-fluid page-body-wrapper">

    	@include('include-new.sidebar-menu')

		  <!-- main-panel starts -->
			<div class="main-panel">
        <!-- content-wrapper starts -->
        <div class="content-wrapper">
				    @yield('content')
        </div>
        <!-- content-wrapper ends -->
				@include('include-new.footer')
			</div>
		  <!-- main-panel ends -->
		
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller ends -->

</body>
@include('include-new.js')
</html>