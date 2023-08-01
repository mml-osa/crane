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
        <small>manage website posts</small>
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
                            <a type="button" class="btn btn-sm blue" data-toggle="modal" href="{{route('posts.create')}}" @if($session->userRole['alias'] != 'administrator') disabled @endif>Add New</a>
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
                                <th> Views </th>
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
                            @foreach($posts as $post)
                                <tr class="text-center">
                                    <td> {{$counter}} </td>
                                    <td> <a href="{{ route('posts.edit',$post->id) }}" title="click to edit content"> <b>{{$post->title}}</b> </a> </td>
{{--                                    <td title="{{$post->caption}}"> @if($post->caption != null) Yes @else No @endif </td>--}}
                                    <td> {{$post->postCategory['title'] ?? null}} </td>
                                    <td> {{$post->views}} </td>
                                    <td title="{{$post->userProfile['first_name'] ?? null}} {{$post->userProfile['last_name'] ?? null}}"><a href="{{route('users.profile',$post->userProfile['user_id'])}}">{{$post->userTable['username'] ?? null}}</a> </td>
                                    <?php $date = date_format($post->created_at,"M d, Y"); ?>
                                    <?php $update = date_format($post->updated_at,"M d, Y"); ?>
                                    <td title="{{ $post->createdBy['email'] ?? null }}">{{ $date }}</td>
                                    <td title="{{ $post->updatedBy['email'] ?? null}}">{{ $update }}</td>
                                    @if($session->role_id != 3)
                                        <td>
                                            @if($post->published == 0)<a class="text-danger" data-toggle="modal" href="#publish{{$post->id}}" title="Click To Publish" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-eye-slash"></i></a>
                                            @else<a class="text-primary" data-toggle="modal" href="#publish{{$post->id}}" title="Click To Unpublish" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-eye"></i></a> @endif

                                            {{--PUBLISH SWITCH--}}
                                            <div class="modal fade" id="publish{{$post->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">@if($post->published == 0) Publish @elseif($post->published == 1) Unpublish @endif Post </h4>
                                                        </div>
                                                        <div class="modal-body"> Are you sure you want to @if($post->published == 0) publish @elseif($post->published == 1) unpublish @endif this post? </div>
                                                        <div class="modal-footer">
                                                            <form class="form-horizontal" method="post" action="{{ route('posts.publish',$post->id) }}">
                                                                @csrf
                                                                @if($post->published == 0) <input type="hidden" name="switch" value="1">
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
                                            <a class="text-success" data-toggle="modal" href="{{ route('posts.edit',$post->id) }}" @if($session->userRole['alias'] == 'moderator') disabled @endif><i class="fa fa-pencil-square"></i></a> &bullet;
                                            <a class="text-danger" data-toggle="modal" data-target="#delete{{$post->id}}" href="#delete{{$post->id}}" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-trash"></i></a>
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
                                <div class="modal fade" id="delete{{$post->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Delete Post</h4>
                                            </div>
                                            <div class="modal-body text-center" style="color: red"> Are you sure you want to delete this post? </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('posts.destroy',$post->id) }}" method="POST" style="display: none;">
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
