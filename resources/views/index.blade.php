@extends('include-new.index-master')
@section('content')

<style>
.error_class{color:red;}
</style>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
             <form action="{{url('admin-login')}}" method="post" >
              {{ csrf_field() }}

                <div class="form-group">
                  <label class="control-label">Username</label>
                  <input type="text" name="email" class="form-control" placeholder="Username" />
                  @if($errors->has('email'))<label class="control-label error_class" for="inputError">{{ $errors->first('email') }}</label>@endif
                </div>
                
                <div class="form-group">
                  <label class="control-label">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password"  />
                  @if($errors->has('password'))<label class="control-label error_class" for="inputError">{{ $errors->first('password') }}</label>@endif
                </div>

                <div class="form-group has-error">
                  @if(Session::has('msg'))<label class="control-label error_class" for="inputError">{{ Session::get('msg') }}</label>@endif
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-primary submit-btn btn-block" value='Login' />
                </div>
                <!-- <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                </div>
                <div class="form-group" style="display: block;">
                  <button class="btn btn-block g-login">
                    <img class="mr-3" src="../../images/file-icons/icon-google.svg" alt="">Log in with Google</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="register.html" class="text-black text-small">Create new account</a>
                </div> -->
              </form>
            </div>
            {{-- <ul class="auth-footer">
              <li>
                <a href="#">Conditions</a>
              </li>
              <li>
                <a href="#">Help</a>
              </li>
              <li>
                <a href="#">Terms</a>
              </li>
            </ul> --}}
            <p class="footer-text text-center">copyright © 2018 Landmark Elite. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
@endsection