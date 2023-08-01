@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{route('admin.dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">General</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Media Items</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Document Items |
    <small> document media album items</small>
</h1>
<!-- END PAGE TITLE-->
@component('admin.layouts.components.messages')@endcomponent
<!-- END PAGE HEADER-->

<!-- MAIN PAGE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    @if($session->role_id != 3)
                        {{--<button type="button" class="btn btn-sm blue" data-toggle="modal" href="#newNavigation"  >Add Post</button>--}}
                        <a type="button" class="btn btn-sm blue" data-toggle="modal" href="{{route('posts.create')}}" @if($session->userRole['alias'] != 'admin') disabled @endif>Add New</a>
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
                            <th> Caption </th>
                            <th> URL/FIle </th>
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
                        @foreach($items as $item)
                            @if($item->mediaAlbum->mediaType['alias'] == 'document')
                                <?php $album_alias = $item->mediaAlbum['alias']?>
                            <tr class="text-center">
                                <td> {{$counter}} </td>
                                <td> <b>{{$post->title}}</b> </td>
                                <td title="{{$post->caption}}"> @if($post->caption != null) Yes @else No @endif </td>
                                <td>
                                    @if($item->mediaAlbum['sub'] == 1)
                                        <?php $album = $item->mediaAlbum->mediaAlbum['alias']?>
                                            <a href=""></a>
                                    @else <img src="{{asset("storage/app/web/album/$album_alias/$item->file")}}" alt=""> @endif
                                </td>
                                <td> {{$post->views}} </td>
                                <td> {{$post->likes}} </td>
                                <td title="posted by {{$post->profile['first_name']}} {{$post->profile['last_name']}}"><a href="{{route('users.profile',\Illuminate\Support\Facades\Crypt::encrypt($post->userTable['id']))}}">{{$post->userTable['username']}}</a> </td>
                                <?php $date = date_format($post->created_at,"M d, Y - H:i "); ?>
                                <?php $update = date_format($post->updated_at,"M d, Y - H:i "); ?>
                                <td title="{{ $post->createdBy['email'] }}">{{ $date }}</td>
                                <td title="{{ $post->updatedBy['email'] }}">{{ $update }}</td>
                                @if($session->role_id != 3)
                                    <td>
                                        @if($post->published == 0)<a class="text-danger" data-toggle="modal" href="#publish{{$post->id}}" title="Click To Publish" @if($session->userRole['alias'] != 'admin') disabled @endif><i class="fa fa-close"></i></a>
                                        @else<a class="text-primary" data-toggle="modal" href="#publish{{$post->id}}" title="Click To Unpublish" @if($session->userRole['alias'] != 'admin') disabled @endif><i class="fa fa-check"></i></a> @endif

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
                                        <a class="text-success" data-toggle="modal" href="{{ route('posts.edit',\Illuminate\Support\Facades\Crypt::encrypt($post->id)) }}" @if($session->role_id == 3) disabled @endif><i class="fa fa-pencil-square"></i></a> &bullet;
                                        <a class="text-danger" data-toggle="modal" data-target="#delete{{$post->id}}" href="#delete{{$post->id}}" @if($session->userRole['alias'] != 'admin') disabled @endif><i class="fa fa-trash"></i></a>
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
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- End: life time stats -->
    </div>
</div>

@endsection
