@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Pages</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Pages | <small>manage website pages</small></h1>
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

                        @if($session->role_id != 3)
                            <a type="button" class="btn btn-sm blue" data-toggle="modal" href="{{route('pages.create')}}" @if($session->userRole['alias'] != 'administrator') disabled @endif>Add New</a>
                        @endif

                        <div class="modal fade" id="newPage" tabindex="-1" role="form" aria-hidden="true">
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
                                                            <span class="caption-subject bold uppercase"> New Page</span>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <div class="portlet-body form">
                                                        <form method="POST" action="{{ route('pages.store') }}" role="form">
                                                            @csrf
                                                            <div class="form-body">
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="name" type="text" class="form-control" name="name" autofocus required />
                                                                        <label for="name">Page Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="title" type="text" class="form-control" name="title" required />
                                                                        <label for="title">Page Title</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="caption" type="text" class="form-control" name="caption" />
                                                                        <label for="caption">Page Caption</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                                                                        <label for="description">Description</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <select class="form-control" name="visibility_id" id="visibility_id">
                                                                            <option value="" selected hidden>Select...</option>
                                                                            @foreach ($visibility as $visible)
                                                                                <option value="{{$visible->id}}">{{$visible->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="mt-checkbox-inline">
                                                                        <label class="mt-checkbox">
                                                                            <input type="checkbox" name="published" id="published" value="1"> Publish
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-actions noborder">
                                                                    <button type="submit" class="btn btn-sm blue">Submit</button>
                                                                    <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">Close</button>
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Title</th>
{{--                                <th>Caption</th>--}}
{{--                                <th>Route</th>--}}
                                <th>Visibility</th>
                                <th>Created</th>
                                <th>Updated</th>
                                @if($session->role_id != 3)
                                    <th>Published</th>
                                    <th>Control</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            <?php $counter = 1 ?>
                            @foreach($pages as $page)
                                <tr class="text-center">
                                    <td> {{$counter}} </td>
                                    <td> <a href="{{ route('pages.edit',$page->id) }}" title="click to edit content"> <b>{{$page->name}}</b> </a> </td>
                                    <td> {{$page->title}} </td>
{{--                                    <td> {{$page->caption}} </td>--}}
{{--                                    <td> web.{{$page->navigation['alias'] ?? null}} </td>--}}
                                    <td> {{$page->visibility['title']}} <i class="fa @if($page->visibility['alias'] == 'public')fa-globe @elseif($page->visibility['alias'] == 'password-protected')fa-lock @elseif($page->visibility['alias'] == 'private')fa-key @endif"></i> </td>
                                    <?php $date = date_format($page->created_at,"M d, Y"); ?>
                                    <?php $update = date_format($page->updated_at,"M d, Y"); ?>
                                    <td title="{{ $page->user['email'] ?? null }}">{{ $date }}</td>
                                    <td title="{{ $page->user['email'] ?? null }}">{{ $update }}</td>
                                    @if($session->userRole['alias'] != 'moderator')
                                        <td>
                                            @if($page->published == 0)<a class="text-danger" data-toggle="modal" href="#publish{{$page->id}}" title="Click To Publish"><i class="fa fa-eye-slash"></i></a>
                                            @else<a class="text-primary" data-toggle="modal" href="#publish{{$page->id}}" title="Click To Unpublish"><i class="fa fa-eye"></i></a> @endif

                                            {{--PUBLISH SWITCH--}}
                                            <div class="modal fade" id="publish{{$page->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">@if($page->published == 0) Publish @elseif($page->published == 1) Unpublish @endif Page </h4>
                                                        </div>
                                                        <div class="modal-body"> Are you sure you want to @if($page->published == 0) publish @elseif($page->published == 1) unpublish @endif this page? </div>
                                                        <div class="modal-footer">
                                                            <form class="form-horizontal" method="post" action="{{ route('pages.publish',$page->id) }}">
                                                                @csrf
                                                                @if($page->published == 0) <input type="hidden" name="switch" value="1">
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
                                            <a class="text-success" data-toggle="modal" data-target="#update{{$page->id}}" @if($session->userRole['alias'] == 'moderator') disabled @endif title="edit page"><i class="fa fa-pencil-square-o"></i></a> &bullet;
                                            <a class="text-danger" data-toggle="modal" data-target="#delete{{$page->id}}" @if($session->userRole['alias'] != 'administrator') disabled @endif title="delete page"><i class="fa fa-trash"></i></a>
                                        </td>
                                    @endif
                                </tr>

                                {{--EDIT CATEGORY--}}
                                <div class="modal fade" id="update{{$page->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <!-- BEGIN SAMPLE FORM PORTLET-->
                                                        <div class="portlet light bordered">
                                                            <div class="portlet-title">
                                                                <div class="caption font-blue-soft">
                                                                    <i class="icon-pencil font-blue"></i>
                                                                    <span class="caption-subject bold uppercase"> Update Page - [ {{$page->name}} ]</span>
                                                                </div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="portlet-body form">
                                                                <form role="form" action="{{ route('pages.update',$page->id) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    <div class="form-body">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <input id="name" type="text" class="form-control" name="name" value="{{$page->name}}" autofocus required />
                                                                                <label for="name">Page Name</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <input id="title" type="text" class="form-control" name="title" value="{{$page->title}}" required />
                                                                                <label for="title">Page Title</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <input id="caption" type="text" class="form-control" name="caption" value="{{$page->caption}}" />
                                                                                <label for="caption">Page Caption</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <textarea name="description" id="description" class="form-control" rows="3">{{$page->description}}</textarea>
                                                                                <label for="description">Description</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <select class="form-control" name="visibility_id" id="visibility_id">
                                                                                    @foreach ($visibility as $visible)
                                                                                        @if ($visible->id == $page->visibility_id)
                                                                                            <option value="{{$visible->id}}" selected hidden>{{$visible->title}}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    @foreach ($visibility as $visible)
                                                                                        @if ($visible->id != $page->visibility_id)
                                                                                            <option value="{{$visible->id}}">{{$visible->title}}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select>
                                                                                <label for="description">Visibility</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-actions noborder">
                                                                                <button type="submit" class="btn btn-sm blue">Submit</button>
                                                                                <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
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
                                <div class="modal fade" id="delete{{$page->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Delete Page</h4>
                                            </div>
                                            <div class="modal-body text-center" style="color: red"> Are you sure you want to delete this page? </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('pages.destroy',$page->id) }}" method="POST" style="display: none;">
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
