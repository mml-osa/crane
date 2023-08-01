@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Team</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"><div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Team |
        <small>manage website team</small>
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
                        @if($session->userRole['alias'] != 'moderator')
                            {{--<button type="button" class="btn btn-sm blue" data-toggle="modal" href="#newNavigation"  >Add Post</button>--}}
                            <a type="button" class="btn btn-sm blue" data-toggle="modal" href="{{route('team.create')}}" @if($session->userRole['alias'] != 'administrator') disabled @endif>Add New</a>
                        @endif
                    </div>
                </div>

                <script type="text/javascript">
                    $(function () {
                        $("#level").change(function () {
                            if ($(this).val() == "2") { $("#parent").slideDown(500); }
                            else { $("#parent").slideUp(500); }
                        });
                    });
                </script>

                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table_content" id="sample_2">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> Full Name </th>
                                <th> Position </th>
                                <th> Category </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> Created </th>
                                <th> Updated </th>
                                @if($session->role_id != 3)
                                    <th> Published </th>
                                    <th> Control </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            <?php $counter = 1 ?>
                            @foreach($teams as $team)
                                <tr class="text-center">
                                    <td> {{$counter}} </td>
                                    <td> <a href="{{ route('team.edit',$team->id) }}" title="click to edit content"> <b>{{$team->first_name." ".$team->last_name}}</b> </a> </td>
                                    <td> {{$team->position}} </td>
                                    <td> {{$team->teamCategory['title'] ?? null}} </td>
                                    <td> {{$team->email}} </td>
                                    <td> {{$team->phone}} </td>
                                    <td title="{{$team->userProfile['first_name'] ?? null}} {{$team->userProfile['last_name'] ?? null}}"><a href="{{route('users.profile',$team->userProfile['user_id'])}}">{{$team->userTable['username'] ?? null}}</a> </td>
                                    <?php $date = date_format($team->created_at,"M d, Y - H:i "); ?>
                                    <?php $update = date_format($team->updated_at,"M d, Y - H:i "); ?>
                                    <td title="{{ $team->createdBy['email'] ?? null }}">{{ $team->create_date ?? $date }}</td>
                                    <td title="{{ $team->updatedBy['email'] ?? null}}">{{ $update }}</td>
                                    @if($session->role_id != 3)
                                        <td>
                                            @if($team->published == 0)<a class="text-danger" data-toggle="modal" href="#publish{{$team->id}}" title="Click To Publish" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-close"></i></a>
                                            @else<a class="text-primary" data-toggle="modal" href="#publish{{$team->id}}" title="Click To Unpublish" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-check"></i></a> @endif

                                            {{--PUBLISH SWITCH--}}
                                            <div class="modal fade" id="publish{{$team->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">@if($team->published == 0) Publish @elseif($team->published == 1) Unpublish @endif Team Member </h4>
                                                        </div>
                                                        <div class="modal-body"> Are you sure you want to @if($team->published == 0) publish @elseif($team->published == 1) unpublish @endif this team member? </div>
                                                        <div class="modal-footer">
                                                            <form class="form-horizontal" method="post" action="{{ route('team.publish',$team->id) }}">
                                                                @csrf
                                                                @if($team->published == 0) <input type="hidden" name="switch" value="1">
                                                                @else <input type="hidden" name="switch" value="0"> @endif
                                                                <button type="submit" class="btn btn-sm blue">Yes</button>
                                                                <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">No</button>
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
                                            <a class="text-success" data-toggle="modal" href="{{ route('team.edit',$team->id) }}" @if($session->userRole['alias'] == 'moderator') disabled @endif><i class="fa fa-pencil-square"></i></a> &bullet;
                                            <a class="text-danger" data-toggle="modal" data-target="#delete{{$team->id}}" href="#delete{{$team->id}}" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-trash"></i></a>
                                        </td>
                                    @endif
                                </tr>
                                {{--EDIT USER--}}

                                {{--END EDIT USER--}}
                                <script type="text/javascript">
                                    $(function () {
                                        $("#level_edit").change(function () {
                                            if ($(this).val() == "2") { $("#parent_edit").slideDown(500); }
                                            else { $("#parent_edit").slideUp(500); }
                                        });
                                    });
                                </script>

                                {{--DELETE USER MODAL--}}
                                <div class="modal fade" id="delete{{$team->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Delete Team Member</h4>
                                            </div>
                                            <div class="modal-body text-center" style="color: red"> Are you sure you want to delete this team member? </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('team.destroy',$team->id) }}" method="post" style="display: none;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm red">Delete</button>
                                                    <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">Close</button>
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
