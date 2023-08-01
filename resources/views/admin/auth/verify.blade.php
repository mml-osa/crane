@extends('admin.layouts.auth.main')
@section('content')

  <!-- BEGIN LOGO -->
  {{--    <div class="logo"><a href="{{ route('dashboard') }}"><img src="{{ asset("storage/app/public/web/logo/".session('logo')->img) ?? "no-image.jpg" }}" alt="" /> </a></div>--}}
  <!-- END LOGO -->
  <!-- BEGIN LOGIN -->
  <!-- BEGIN : LOGIN PAGE 5-1 -->
  <div class="user-login-3">
    <div class="row bs-reset">
      <div class="col-md-6 bs-reset mt-login-5-bsfix">
        <div class="login-bg" style="background-image:url({{ asset("public/admin/assets/images/auth/verify.jpg") }})">
          @if (!empty(session('logo')->img))
            <img class="login-logo login-6" src="{{ asset("storage/app/public/web/logo/".session('logo')->img) }}"
                 alt="Logo" width="80"/>
          @endif
        </div>
      </div>
      <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">

        <div class="login-content">
          <div class="clearfix"></div>

          @if (session('resent'))
            <div class="row">
              <div class="alert alert-success" role="alert">
                <p style="color: #393939">{{ __('A fresh verification link has been sent to your email address.') }}</p>
              </div>
            </div>
          @endif

          <div class="row">
            <h2>User Email Verification</h2>
          </div>

          <div class="row">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email, please click on the \'Resend Request\' button below') }}
          </div>

          <div class="row">
            <br>
            <form method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <button type="submit" class="btn btn-primary">{{ __('Resend Request') }}</button>
            </form>
          </div>

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