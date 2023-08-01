@extends('admin.layouts.view.main')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>All Users</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm">
                    <div id="clockbox"></div>
                </button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Account Users |
        <small>manage account users</small>
    </h1>
    <!-- END PAGE TITLE-->
    @component('components.messages')@endcomponent
    <!-- END PAGE HEADER-->

    <!-- MAIN PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">

                        @if($session->userRole['alias']== 'administrator')
                            <button type="button" class="btn btn-sm blue" data-toggle="modal" data-target="#newUserAccount" @if($session->userRole['alias'] != 'administrator') disabled @endif >
                                Add New
                            </button>
                        @endif
                        
                        <div class="modal fade" id="newUserAccount" tabindex="-1" role="form" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title">
                                                        <div class="caption font-blue">
                                                            <i class="icon-layers font-blue"></i>
                                                            <i class="icon-pencil font-blue"></i>
                                                            <span class="caption-subject bold uppercase"> New User Account</span>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <div class="portlet-body form">
                                                        <form method="post" action="{{ route('users.store') }}" role="form">
                                                            @csrf
                                                            <div class="form-body">
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="username" type="text" class="form-control" name="username" autofocus/>
                                                                        <label for="username">Username</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="first_name" type="text" class="form-control" name="first_name" autofocus/>
                                                                        <label for="first_name">First name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="last_name" type="text" class="form-control" name="last_name" autofocus/>
                                                                        <label for="last_name">Last Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="email" type="text" class="form-control" name="email" required/>
                                                                        <label for="email">Email</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="password" type="text" class="form-control" name="password" value="{{$randstring}}" readonly/>
                                                                        <label for="password">Password</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <select class="form-control" name="role_id" id="role_id">
                                                                            <option value="" selected hidden>Select
                                                                            </option>
                                                                            @foreach($roles as $role)
                                                                                <option value="{{$role->id}}">{{$role->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <label for="role_id">User Role</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-actions noborder">
                                                                    <button type="submit" class="btn btn-sm blue">
                                                                        Submit
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                </div>

                <script type="text/javascript">
                    $(function () {
                        $("#level").change(function () {
                            if ($(this).val() == "2") {
                                $("#parent").slideDown(500);
                            } else {
                                $("#parent").slideUp(500);
                            }
                        });
                    });
                </script>

                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table_content" id="sample_2">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Avatar</th>
                                <th>Created</th>
                                <th>Updated</th>
                                @if($session->role_id != 3)
                                    <th>Active</th>
                                    <th>Control</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            <?php $counter = 1 ?>
                            @foreach($users as $user)
                                <tr class="text-center">
                                    <td> {{$counter}} </td>
                                    <td><a href="{{route('users.profile',$user->id)}}" title="view profile"><b>{{$user->username}}</b></a></td>
                                    <td> {{$user->email}} </td>
                                    <td> {{$user->userRole['title']}}</td>
                                    <td>
                                        <?php $img = $user->userProfile['avatar']?>
                                        @if($user->userProfile['avatar'] != null)
                                            <img src="{{asset("storage/app/public/user/avatar/$img")}}" class="img-circle" alt="" width="25">
                                        @else
                                            <img alt="" class="img-circle" src="{{asset("public/user/assets/images/default/user-img.png")}}" width="25"/>@endif
                                    </td>
                                    <?php $date = date_format($user->created_at, "M d, Y - H:i "); ?>
                                    <?php $update = date_format($user->updated_at, "M d, Y - H:i "); ?>
                                    <td>{{ $date }}</td>
                                    <td>{{ $update }}</td>
                                    @if($session->role_id != 3)
                                        <td>
                                            @if($user->active == 0)
                                                <a class="text-danger" data-toggle="modal" href="#active{{$user->id}}" title="Click To Activate" @if($session->userRole['alias'] != 'administrator') disabled @endif ><i class="fa fa-close"></i></a>
                                            @else
                                                <a class="text-primary" data-toggle="modal" href="#active{{$user->id}}" title="Click To Deactivate" @if($session->userRole['alias'] != 'administrator') disabled @endif ><i class="fa fa-check"></i></a> @endif

                                            {{--PUBLISH SWITCH--}}
                                            <div class="modal fade" id="active{{$user->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">@if($user->active == 0)
                                                                    Activate @elseif($user->active == 1)
                                                                    Deactivate @endif User Account </h4>
                                                        </div>
                                                        <div class="modal-body"> Are you sure you want
                                                            to @if($user->active == 0) <span class="text-primary">activate</span> @elseif($user->active == 1)
                                                                <span class="text-danger">deactivate</span> @endif this
                                                            user?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form class="form-horizontal" method="post" action="{{ route('users.active',$user->id) }}">
                                                                @csrf
                                                                @if($user->active == 0)
                                                                    <input type="hidden" name="switch" value="1">
                                                                @else
                                                                    <input type="hidden" name="switch" value="0"> @endif
                                                                <button type="submit" class="btn btn-sm blue">Yes
                                                                </button>
                                                                <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">
                                                                    No
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            {{--END ACTIVATE USER ACCOUNT--}}
                                        </td>
                                        <td>
                                            {{--                                            <button type="button" class="btn blue btn-xs"></button>--}}
                                            <a class="text-success" href="{{route('users.profile',$user->id)}}" @if($session->userRole['alias'] != 'administrator') disabled @endif title="view user account"><i class="fa fa-search    "></i></a>
                                            &bullet;
                                            <a class="text-danger" data-toggle="modal" data-target="#delete{{$user->id}}" @if($session->userRole['alias'] != 'administrator') disabled @endif title="remove user account"><i class="fa fa-trash"></i></a>
                                        </td>
                                    @endif
                                </tr>

                                <script type="text/javascript">
                                    $(function () {
                                        $("#level_edit").change(function () {
                                            if ($(this).val() == "2") {
                                                $("#parent_edit").slideDown(500);
                                            } else {
                                                $("#parent_edit").slideUp(500);
                                            }
                                        });
                                    });
                                </script>

                                {{--DELETE USER MODAL--}}
                                <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Remove User Account</h4>
                                            </div>
                                            <div class="modal-body text-center" style="color: red"> Are you sure you
                                                want to remove this user account?
                                            </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('users.destroy',$user->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm red">Remove</button>
                                                    <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{--END DELETE USER MODAL--}}
                                <?php $counter++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- End: life time stats -->
        </div>
    </div>
    <!-- END MAIN PAGE CONTENT -->
@endsection
