@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Comments</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Comments |
        <small>manage website comments</small>
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
                            {{--<button type="button" class="btn btn-sm blue" data-toggle="modal" href="#newNavigation"  >Add Post</button>--}}
                            <a type="button" class="btn btn-sm blue" data-toggle="modal" href="{{route('comment.create')}}" @if($session->userRole['alias'] != 'administrator') disabled @endif>Add New</a>
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
                                <th> Post </th>
{{--                                <th> Category </th>--}}
                                <th> Type </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Created </th>
                                <th> Updated </th>
                                @if($session->userRole['alias']!= 'moderator')
                                    <th> Published </th>
                                    <th> Control </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            <?php $counter = 1 ?>
                            @foreach($comments as $comment)
                                <tr class="text-center">
                                    <td> {{$counter}} </td>
{{--                                    <td> <a href="@if($session->userRole['alias'] != 'admin') #. @else {{ route('admin.comment.edit',\Illuminate\Support\Facades\Crypt::encrypt($comment->id)) }} @endif"> <b>{{$comment->title}}</b> </a> </td>--}}
                                    <td> <b>{{$comment->commentPost['title']}}</b> </td>
{{--                                    <td> {{$comment->commentPost->mainCategory['title']}} </td>--}}
                                    <td> @if($comment->reply == 0) Comment @else Reply @endif </td>
                                    <td> {{$comment->name}} </td>
                                    <td> {{$comment->email}} </td>
{{--                                    <td> {{$comment->comment}} </td>--}}
                                    <?php $date = date_format($comment->created_at,"M d, Y - H:i"); ?>
                                    <?php $update = date_format($comment->updated_at,"M d, Y - H:i"); ?>
                                    <td> {{$date}} </td>
                                    <td> {{$update}} </td>
                                    @if($session->userRole['alias']!= 'moderator')
                                        <td>
                                            @if($comment->published == 0)<a class="text-danger" data-toggle="modal" href="#publish{{$comment->id}}" title="Click To Publish" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-close"></i></a>
                                            @else<a class="text-primary" data-toggle="modal" href="#publish{{$comment->id}}" title="Click To Unpublish"  @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-check"></i></a> @endif

                                            {{--PUBLISH SWITCH--}}
                                            <div class="modal fade" id="publish{{$comment->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">@if($comment->published == 0) Publish @elseif($comment->published == 1) Unpublish @endif Comment </h4>
                                                        </div>
                                                        <div class="modal-body"> Are you sure you want to @if($comment->published == 0) publish @elseif($comment->published == 1) unpublish @endif this comment? </div>
                                                        <div class="modal-footer">
                                                            <form class="form-horizontal" method="post" action="{{ route('comment.publish',$comment->id) }}">
                                                                @csrf
                                                                @if($comment->published == 0) <input type="hidden" name="switch" value="1">
                                                                @else <input type="hidden" name="switch" value="0"> @endif
                                                                <input type="hidden" name="reply" id="reply" value="1">
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

                                                {{--PUBLISH SWITCH--}}
                                            <div class="modal fade" id="viewComment{{$comment->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Comment </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <textarea name="comment" id="comment" class="form-control" rows="3" readonly>{{$comment->comment}}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            {{--END ACTIVATE USER ACCOUNT--}}
                                        </td>
                                        <td>
                                            <a class="text-primary" data-toggle="modal" data-target="#viewComment{{$comment->id}}" @if($session->userRole['alias']== 'moderator') disabled @endif title="view comment"><i class="fa fa-search"></i></a> &bullet;
                                            <a class="text-danger" data-toggle="modal" data-target="#delete{{$comment->id}}" @if($session->userRole['alias'] != 'administrator') disabled @endif title="delete comment"><i class="fa fa-trash"></i></a>
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
                                <div class="modal fade" id="delete{{$comment->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Delete Comment</h4>
                                            </div>
                                            <div class="modal-body text-center" style="color: red"> Are you sure you want to delete this comment? </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('comment.destroy',$comment->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="reply" id="reply" value="1">
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
