@extends('admin.layouts.auth.main')
@section('content')

  <!-- BEGIN LOGO -->
  {{--    <div class="logo"><a href="{{ route('dashboard') }}"><img src="{{ asset("storage/app/public/web/logo/".session('logo')->img) ?? "no-image.jpg" }}" alt="" /> </a></div>--}}
  <!-- END LOGO -->
  <!-- BEGIN LOGIN -->
  <!-- BEGIN : LOGIN PAGE 5-1 -->
  <div class="user-login-2">
    <div class="row bs-reset">
      <div class="col-md-6 bs-reset mt-login-5-bsfix">
        <div class="login-bg" style="background-image:url({{ asset("public/admin/assets/images/auth/bg.jpg") }})">
          @if (!empty(session('logo')->img))
            <img class="login-logo login-6" src="{{ asset("storage/app/public/web/logo/".session('logo')->img) }}"
                 alt="Logo" width="150"/>
          @endif
        </div>
      </div>
      <div class="col-md-6 login-container bs-reset mt-login-5-bsfix" style="margin-top: 10em">
        {{--                <img class="login-logo login-6 pull-right" src="{{ asset("public\admin\assets\images\logo\maven_hub_logo.png") }}" alt="Logo" width="100" />--}}
        <div class="login-content">
          {{--                    <img class="login-6" src="{{ asset("public\admin\assets\images\logo\maven_hub_logo.png") }}" alt="Logo" width="150" />--}}
          {{--                    <hr>--}}
          <h1>User Login</h1>
          <p> Enter your username and password credentials to login to the content manager to manage your website. </p>
          @if (session('success'))
            <div id="alert-box" class="alert alert-success alert-rounded" role="alert">
              <b>Success!</b> {{ session('success') }}</div>
          @endif
          <form method="POST" action="{{ route('login') }}" role="form">
            @csrf
            <div class="alert alert-danger display-hide">
              <button class="close" data-close="alert"></button>
              {{--                            <span> Enter any username and password. </span>--}}
            </div>
            <div class="row">
              <div class="col-xs-6">
                <label for="username" class="control-label visible-ie8 visible-ie9">Username</label>
                <input id="username" type="text"
                       class="form-control form-control-solid placeholder-no-fix form-group @error('username') is-invalid @enderror"
                       name="username" value="{{ old('username') }}" placeholder="Username" required
                       autocomplete="username" autofocus>
                <input id="active" type="hidden" class="form-control @error('active') is-invalid @enderror"
                       name="active">
                @error('email')<span class="error-feedback text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                @error('active')<span class="error-feedback text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-xs-6">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <input id="password" type="password"
                       class="form-control form-control-solid placeholder-no-fix form-group @error('password') is-invalid @enderror"
                       name="password" placeholder="Password" required autocomplete="off">
                @error('password')<span class="error-feedback text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="rem-password">
                  <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                    <span></span>
                  </label>
                </div>
              </div>
              <div class="col-sm-8 text-right">
                <div class="forgot-password">
                  <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                </div>
              </div>
            </div>
            <button class="btn blue" type="submit">Sign In</button>
          </form>
        </div>
        <div class="login-footer">
          <div class="row bs-reset">
            <div class="col-xs-12 bs-reset">
              <div class="login-copyright text-right">
                <p>{{ date('Y') }} &copy; Crane CMS</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END : LOGIN PAGE 5-1 -->

@endsection
