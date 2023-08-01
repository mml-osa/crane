@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Profile</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>User Profile</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">User Profile | <small>manage user profile</small></h1>
    <!-- END PAGE TITLE-->
    @component('components.messages')@endcomponent
    <!-- END PAGE HEADER-->

    <!-- MAIN PAGE CONTENT -->
    <div class="profile">
        <div class="tabbable-line tabbable-full-width">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1_1" data-toggle="tab"> Overview </a></li>
                @if ($session->id == $user->id || $session->id != $user->id && $session->userRole['alias'] == 'administrator')
                    <li><a href="#tab_1_3" data-toggle="tab"> Account </a></li>
                @endif
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="list-unstyled profile-nav">
                                <li>
                                    @if(!empty($profile->avatar))<img src="{{asset("storage/app/public/user/avatar/$profile->avatar")}}" class="img-responsive pic-bordered" alt="" width="250">
                                    @else<img class="img-responsive pic-bordered" src="{{asset("public/user/assets/images/default/user-img.png")}}" alt="" width="250" />@endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-8 profile-info">
                                    <h1 class="font-green sbold uppercase">{{$profile->first_name ?? null}} {{$profile->last_name ?? null}}</h1>
                                    <ul class="list-inline">
                                        <li><i class="fa fa-user"></i> {{$user->username ?? null}} </li>
                                        <li><i class="fa fa-envelope"></i> {{$user->email ?? null}} </li>
                                        <li><i class="fa fa-lock"></i> {{$user->userRole['title'] ?? null}} </li>
                                        <li><i class="fa fa-calendar"></i> {{$user->created_at ?? null}} </li>
                                    </ul>
                                    <p class="border"> {{$profile->bio ?? null}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--tab_1_2-->
                <div class="tab-pane" id="tab_1_3">
                    <div class="row profile-account">
                        <div class="col-md-3">
                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                <li class="active"><a data-toggle="tab" href="#tab_1-1"><i class="fa fa-cog"></i> Personal info </a><span class="after"> </span></li>
                                <li><a data-toggle="tab" href="#tab_2-2"><i class="fa fa-picture-o"></i> Change Avatar </a></li>
                                <li><a data-toggle="tab" href="#tab_3-3"><i class="fa fa-lock"></i> Change Password </a></li>
                                <li><a data-toggle="tab" href="#tab_4-4"><i class="fa fa-eye"></i> User Role </a></li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content">
                                <div id="tab_1-1" class="tab-pane active">
                                    <form action="{{route('users.update',$user->id)}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="username" class="control-label">Username</label>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                                   name="username" id="username" value="@if(old('username') != null){{old('username')}}@else{{$user->username}}@endif"
                                                   required autocomplete="username" disabled />
                                            @error('username')<span class="error-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="control-label">First Name</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                                   name="first_name" id="first_name" value="@if(old('first_name') != null){{old('first_name')}}@else{{$profile->first_name ?? null}}@endif"
                                                   required autocomplete="first_name" />
                                            @error('first_name')<span class="error-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name" class="control-label">Last Name</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                                   name="last_name" id="last_name" value="@if(old('last_name') != null){{old('last_name')}}@else{{$profile->last_name ?? null}}@endif"
                                                   required autocomplete="last_name" />
                                            @error('last_name')<span class="error-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   name="email" id="email" value="@if(old('email') != null){{old('email')}}@else{{$user->email ?? null}}@endif"
                                                   required autocomplete="email" />
                                            @error('email')<span class="error-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
{{--                                        <div class="form-group">--}}
{{--                                            <label for="phone" class="control-label">Phone</label>--}}
{{--                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"--}}
{{--                                                   name="phone" id="phone" value="@if(old('phone') != null){{old('phone')}}@else{{$profile->phone}}@endif"--}}
{{--                                                   autocomplete="phone" />--}}
{{--                                            @error('phone')<span class="error-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <label for="bio" class="control-label">Profile</label>
                                            <textarea class="form-control @error('bio') is-invalid @enderror"
                                                      name="bio" id="bio" rows="3" >@if(old('bio') != null){{old('bio')}}@else{{$profile->bio ?? null}}@endif</textarea>
                                            @error('bio')<span class="error-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="margiv-top-10">
                                            <button type="submit" class="btn btn-success"> Save Changes </button>
                                            {{--                                            <a href="javascript:;" class="btn default"> Cancel </a>--}}
                                        </div>
                                    </form>
                                </div>
                                <div id="tab_2-2" class="tab-pane">
                                    <p> Click on Select Image to pick a new image to use as your avatar or profile picture. Accepted formats are JPG, JPEG, PNG, BMP, GIF, and should not be more than 2MB </p>
                                    <form method="POST" action="{{ route('users.avatar.change',$user->id) }}" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    @if($session->avatar == null || $session->avatar == "no-image")
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                    @else
                                                        <img src="{{asset("storage/app/public/user/avatar/$session->avatar")}}" alt="" />
                                                    @endif
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                        <span class="btn default btn-file">
                                                            <span class="fileinput-new"> Select image </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="avatar"> </span>
                                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">NOTE!</span>
                                                <span> Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn green"> Update </button>
                                            {{--<a href="javascript:;" class="btn default"> Cancel </a>--}}
                                        </div>
                                    </form>
                                </div>
                                <div id="tab_3-3" class="tab-pane">
                                    <form method="POST" action="{{ route('users.password.change',$user->id) }}" role="form">
                                        @csrf
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Current Password</label>
                                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="**********" required />

                                                @error('current_password')
                                                <span class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="**********" required />

                                                @error('password')
                                                <span class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Re-type New Password</label>
                                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="**********" required />

                                                @error('password_confirmation')
                                                <span class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="margin-top-10">
                                                <button type="submit" class="btn green"> Change Password </button>
                                                {{--<a href="javascript:;" class="btn default"> Cancel </a>--}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="tab_4-4" class="tab-pane">
                                    <form action="{{route('users.account.role',$user->id)}}" method="post" role="form">
                                        @csrf
                                        <div class="col-md-12">
                                            <table class="table table-light table-hover">
                                                <tr>
                                                    <td> User Account Role </td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="role_id" value="1" @if($user->userRole['alias'] == 'administrator') checked @endif @if($session->userRole['alias'] != 'administrator') disabled @endif /> Admin
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="role_id" value="2" @if($user->userRole['alias'] == 'editor') checked @endif @if($session->userRole['alias'] != 'administrator') disabled @endif /> Editor
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="role_id" value="3" @if($user->userRole['alias'] == 'moderator') checked @endif @if($session->userRole['alias'] != 'administrator') disabled @endif /> Moderator
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--end profile-settings-->
                                            <div class="margin-top-10">
                                                <button type="submit" class="btn green"> Save Changes </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end col-md-9-->
                    </div>
                </div>
                <!--end tab-pane-->

            </div>
        </div>
    </div>
    <!-- END MAIN PAGE CONTENT -->

@endsection
