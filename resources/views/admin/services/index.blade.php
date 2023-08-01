@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Posts</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"><div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Posts |
        <small>manage website services</small>
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
                            <a type="button" class="btn btn-sm blue" data-toggle="modal" href="{{route('services.create')}}" @if($session->userRole['alias'] != 'administrator') disabled @endif>Add New</a>
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
                                <th> Title </th>
{{--                                <th> Caption </th>--}}
                                <th> Category </th>
{{--                                <th> Views </th>--}}
                                <th> Post By </th>
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
                            @foreach($services as $service)
                                <tr class="text-center">
                                    <td> {{$counter}} </td>
                                    <td> <a href="{{ route('services.edit',$service->id) }}" title="click to edit content"> <b>{{$service->name}}</b> </a> </td>
{{--                                    <td title="{{$service->caption}}"> @if($service->caption != null) Yes @else No @endif </td>--}}
<!--                                    --><?php //dd($service->serviceCategory); ?>
                                    <td> {{$service->serviceCategory['title'] ?? null}} </td>
{{--                                    <td> {{$service->views}} </td>--}}
                                    <td title="{{$service->userProfile['first_name']}} {{$service->userProfile['last_name']}}"><a href="{{route('users.profile',$service->userProfile['user_id'])}}">{{$service->userTable['username']}}</a> </td>
                                    <?php $date = date_format($service->created_at,"M d, Y"); ?>
                                    <?php $update = date_format($service->updated_at,"M d, Y"); ?>
                                    <td title="{{ $service->userTable['email'] }}">{{ $date }}</td>
                                    <td title="{{ $service->userTable['email'] }}">{{ $update }}</td>
                                    @if($session->role_id != 3)
                                        <td>
                                            @if($service->published == 0)<a class="text-danger" data-toggle="modal" href="#publish{{$service->id}}" title="Click To Publish" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-eye-slash"></i></a>
                                            @else<a class="text-primary" data-toggle="modal" href="#publish{{$service->id}}" title="Click To Unpublish" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-eye"></i></a> @endif

                                            {{--PUBLISH SWITCH--}}
                                            <div class="modal fade" id="publish{{$service->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">@if($service->published == 0) Publish @elseif($service->published == 1) Unpublish @endif Post </h4>
                                                        </div>
                                                        <div class="modal-body"> Are you sure you want to @if($service->published == 0) publish @elseif($service->published == 1) unpublish @endif this service? </div>
                                                        <div class="modal-footer">
                                                            <form class="form-horizontal" method="post" action="{{ route('services.publish',$service->id) }}">
                                                                @csrf
                                                                @if($service->published == 0) <input type="hidden" name="switch" value="1">
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
                                            <a class="text-success" data-toggle="modal" href="{{ route('services.edit',$service->id) }}" @if($session->userRole['alias'] == 'moderator') disabled @endif><i class="fa fa-pencil-square"></i></a> &bullet;
                                            <a class="text-danger" data-toggle="modal" data-target="#delete{{$service->id}}" href="#delete{{$service->id}}" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-trash"></i></a>
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
                                <div class="modal fade" id="delete{{$service->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Delete Service</h4>
                                            </div>
                                            <div class="modal-body text-center" style="color: red"> Are you sure you want to delete this service? </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('services.destroy',$service->id) }}" method="post" style="display: none;">
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
