@extends('admin.layouts.auth.main')
@section('content')

  <!-- BEGIN LOGO -->
  {{--    <div class="logo"><a href="{{ route('dashboard') }}"><img src="{{ asset("storage/app/public/web/logo/".session('logo')->img) ?? "no-image.jpg" }}" alt="" /> </a></div>--}}
  <!-- END LOGO -->
  <!-- BEGIN LOGIN -->
  <!-- BEGIN : LOGIN PAGE 5-1 -->
  <div class="user-login-5">
    <div class="row bs-reset">
      <div class="col-md-6 bs-reset mt-login-5-bsfix">
        <div class="login-bg" style="background-image:url({{ asset("public/admin/assets/images/auth/bg.jpg") }})">
          @if (!empty(session('logo')->img))
            <img class="login-logo login-6" src="{{ asset("storage/app/public/web/logo/".session('logo')->img) }}"
                 alt="Logo" width="80"/>
          @else
            <img class="login-logo login-6" src="{{ asset("public\admin\assets\images\logo\maven_hub_logo.png") }}"
                 alt="Logo" width="150"/>
          @endif
        </div>
      </div>
      <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
        {{--                <img class="login-logo login-6 pull-right" src="{{ asset("public\admin\assets\images\logo\maven_hub_logo.png") }}" alt="Logo" width="100" />--}}
        <div class="login-content">
          {{--                    <img class="login-6" src="{{ asset("public\admin\assets\images\logo\maven_hub_logo.png") }}" alt="Logo" width="150" />--}}
          {{--                    <hr>--}}
          <h1>Account Setup</h1>
          <p> Please fill this form to complete setting up your website admin panel. </p>

          @if (Session('success'))
            <div id="alert-box" class="alert alert-success alert-rounded" role="alert">
              <b>Success!</b> {{ session('success') }}</div>
          @endif

          <form method="POST" action="{{ route('register') }}" role="form">
            @csrf

{{--            <div class="alert alert-danger display-hide">--}}
{{--              <button class="close" data-close="alert"></button>--}}
{{--              --}}{{--                            <span> Enter any username and password. </span>--}}
{{--            </div>--}}
            <div class="row">
              <p class="form-group col-xs-12"> Organization Details: </p>
              <div class="clearfix"></div>

              <div class="form-group col-xs-12">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Organization Name') }}</label>
                <input class="form-control @error('organization_name') is-invalid @enderror placeholder-no-fix" type="text"
                       placeholder="{{ __('Organization Name') }}" name="organization_name"
                       value="{{ old('organization_name') }}" required
                       autocomplete="organization_name" autofocus/>
                @error('organization_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="form-group col-xs-4">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Location') }}</label>
                <input class="form-control @error('address') is-invalid @enderror placeholder-no-fix" type="text"
                       placeholder="{{ __('Location') }}" name="address" value="{{ old('address') }}" required
                       autocomplete="address"/>
                @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>

              <div class="form-group col-xs-4">
                <label class="control-label visible-ie8 visible-ie9">{{ __('City') }}</label>
                <input class="form-control @error('city') is-invalid @enderror placeholder-no-fix" type="text"
                       placeholder="{{ __('City') }}" name="city" value="{{ old('city') }}" required
                       autocomplete="city"/>
                @error('city')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>

              <div class="form-group col-xs-4">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Country') }}</label>
                <select name="country" id="country" class="form-control select2 single">
                  <option hidden selected value="">Select Country...</option>
                  @foreach($countries->sortBy('country_name') as $country)
                    @if($country == null)
                      <option>-- No Countries Available --</option>
                    @endif
                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                  @endforeach
                </select>
                @error('city')<span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>

              <div class="form-group col-xs-12">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Postal Address') }}</label>
                <input class="form-control @error('postal') is-invalid @enderror placeholder-no-fix"
                       type="text"
                       placeholder="{{ __('Postal Address') }}" name="postal"
                       value="{{ old('postal') }}"
                       autocomplete="postal" autofocus/>
                @error('postal')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>

              <div class="form-group col-xs-6">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Organization Email') }}</label>
                <input class="form-control @error('org_email') is-invalid @enderror placeholder-no-fix" type="text"
                       placeholder="{{ __('Organization Email') }}" name="org_email" value="{{ old('org_email') }}" required
                       autocomplete="org_email"/>
                @error('org_email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>

              <div class="form-group col-xs-6">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Phone') }}</label>
                <input class="form-control @error('phone') is-invalid @enderror placeholder-no-fix" type="number"
                       placeholder="{{ __('Phone') }}" name="phone" value="{{ old('phone') }}" required
                       autocomplete="phone"/>
                @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>

              <p class="form-group col-xs-12"> Personal Details: </p>
              <div class="clearfix"></div>

              <div class="form-group col-xs-6">
                <label class="control-label visible-ie8 visible-ie9">{{ __('First Name') }}</label>
                <input class="form-control @error('first_name') is-invalid @enderror placeholder-no-fix" type="text"
                       placeholder="{{ __('First Name') }}" name="first_name" value="{{ old('first_name') }}" required
                       autocomplete="first_name" autofocus/>
                @error('first_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="form-group col-xs-6">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Last Name') }}</label>
                <input class="form-control @error('last_name') is-invalid @enderror placeholder-no-fix" type="text"
                       placeholder="{{ __('Last Name') }}" name="last_name" value="{{ old('last_name') }}" required
                       autocomplete="last_name"/>
                @error('last_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="form-group col-xs-12">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Email Address') }}</label>
                <input class="form-control @error('email') is-invalid @enderror placeholder-no-fix" type="email"
                       placeholder="{{ __('Email Address') }}" name="email" value="{{ old('email') }}" required
                       autocomplete="email"/>
                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="clearfix"></div>

              <p class="form-group col-xs-12"> Account Details: </p>
              <div class="clearfix"></div>

              <div class="form-group col-xs-12">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Username') }}</label>
                <input class="form-control @error('username') is-invalid @enderror placeholder-no-fix" type="text"
                       placeholder="{{ __('Username') }}" name="username" value="{{ old('username') }}" required
                       autocomplete="username"/>
                @error('username')<span class="invalid-feedback"
                                        role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>
              {{--              <div class="form-group col-xs-6">--}}
              {{--                <label class="control-label visible-ie8 visible-ie9">{{ __('User Role') }}</label>--}}
              {{--                <select class="form-control form-group" name="role_id" id="role_id">--}}
              {{--                  <option value="" selected hidden>Select User Role...</option>--}}
              {{--                  @if($roles != null)--}}
              {{--                    @foreach($roles as $role)--}}
              {{--                      <option value="{{$role->id}}">{{$role->title}}</option>--}}
              {{--                    @endforeach--}}
              {{--                  @endif--}}
              {{--                </select>--}}
              {{--                @error('username')<span class="invalid-feedback"--}}
              {{--                                        role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
              {{--              </div>--}}
              <div class="form-group col-xs-6">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Password') }}</label>
                <input class="form-control @error('password') is-invalid @enderror placeholder-no-fix" type="password"
                       id="password" placeholder="{{ __('Password') }}" name="password" required
                       autocomplete="new-password"/>
                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="form-group col-xs-6">
                <label class="control-label visible-ie8 visible-ie9">{{ __('Re-type Your Password') }}</label>
                <input class="form-control placeholder-no-fix" id="password-confirm" name="password_confirmation"
                       type="password" placeholder="Re-type Your Password" required autocomplete="new-password"/>
              </div>

              <input type="hidden" name="role_id" id="role_id" value="{{$roles->id}}" />

              <div class="clearfix"></div>
              <div class="form-group col-xs-12">
                <div class="col-md-6 form-group margin-top-20 margin-bottom-20">
                  <label class="mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="tnc" {{ 1 ?? old('tnc') }} required /> I agree to the
                    <a href="javascript:;">Terms of Service </a> &
                    <a href="javascript:;">Privacy Policy </a>
                    <span></span>
                  </label>
                  <div id="register_tnc_error"></div>
                </div>
                <div class="col-md-6 margin-top-20 margin-bottom-20">
                  <button class="btn btn-primary blue" type="submit">Register</button>
                </div>
              </div>

            </div>
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
