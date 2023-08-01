@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Team Categories</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right"><div id="clockbox"></div></div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Team Categories |
        <small>manage website team categories</small>
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
                        @if($session->role_id != 3)
                            <button type="button" class="btn btn-sm blue" data-toggle="modal" href="#newTeamCategory" @if($session->userRole['alias'] != 'administrator') disabled @endif >Add New</button>
                        @endif

                        <div class="modal fade" id="newTeamCategory" tabindex="-1" role="form" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title">
                                                        <div class="caption font-blue">
                                                            {{--<i class="icon-layers font-blue"></i>--}}
                                                            <i class="icon-note font-blue"></i>
                                                            <span class="caption-subject bold uppercase"> New Team Category</span>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <div class="portlet-body form">
                                                        <form method="post" action="{{ route('team.category.store') }}" role="form">
                                                            @csrf
                                                            <div class="form-body">

                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="title" type="text" class="form-control" name="title" spellcheck="true" autofocus required />
                                                                        <label for="title">Category Title</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="caption" type="text" class="form-control" name="caption"  />
                                                                        <label for="description">Caption</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="description" type="text" class="form-control" name="description" />
                                                                        <label for="icon">Description</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <input id="published" type="checkbox" name="published" value="1" />
                                                                    <label for="published">Published</label>
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
                            <tr class="text-center">
                                <th> # </th>
                                <th> Title </th>
                                <th> Caption </th>
                                <th> Description </th>
                                <th> Published </th>
                                <th> Created </th>
                                <th> Updated </th>
                                @if($session->role_id != 3)
                                    <th> Control </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            <?php $counter = 1 ?>
                            @foreach($teamCategories as $teamCategory)
                                <tr  class="text-center">
                                    <td> {{$counter}} </td>
                                    <td>{{$teamCategory->title}}</td>
                                    <td> @if($teamCategory->caption != null) Yes @else No @endif </td>
                                    <td> {{$teamCategory->description}} </td>
                                    <td>
                                        @if($teamCategory->published == 0)<a class="text-danger" data-toggle="modal" href="#publish{{$teamCategory->id}}" title="Click To Publish" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-eye-slash"></i></a>
                                        @else<a class="text-primary" data-toggle="modal" href="#publish{{$teamCategory->id}}" title="Click To Unpublish" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-eye"></i></a> @endif

                                        {{--PUBLISH SWITCH--}}
                                        <div class="modal fade" id="publish{{$teamCategory->id}}" tabindex="-1" role="form" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">@if($teamCategory->published == 0) Publish @elseif($teamCategory->published == 1) Unpublish @endif Category </h4>
                                                    </div>
                                                    <div class="modal-body"> Are you sure you want to @if($teamCategory->published == 0) publish @elseif($teamCategory->published == 1) unpublish @endif this category? </div>
                                                    <div class="modal-footer">
                                                        <form class="form-horizontal" method="post" action="{{ route('team.category.publish',$teamCategory->id) }}">
                                                            @csrf
                                                            @if($teamCategory->published == 0) <input type="hidden" name="switch" value="1">
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
                                    <?php $date = date_format($teamCategory->created_at,"M d, Y - H:i"); ?>
                                    <?php $update = date_format($teamCategory->updated_at,"M d, Y - H:i"); ?>
                                    <td title="{{ $teamCategory->createdBy['username'] }}">{{ $date }}</td>
                                    <td title="{{ $teamCategory->updatedBy['username'] }}">{{ $update }}</td>
                                    @if($session->role_id != 3)
                                        <td>
                                            <a class="text-success" data-toggle="modal" href="#update{{$teamCategory->id}}" @if($session->role_id == 3) disabled @endif title="update category"><i class="fa fa-pencil-square-o"></i></a> &bullet;
                                            <a class="text-danger" data-toggle="modal" href="#delete{{$teamCategory->id}}" @if($session->userRole['alias'] != 'administrator') disabled @endif title="delete category"><i class="fa fa-trash"></i></a>
                                        </td>
                                    @endif
                                </tr>

                                {{--EDIT USER--}}
                                <div class="modal fade" id="update{{$teamCategory->id}}" tabindex="-1" role="form" aria-hidden="true">
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
                                                                    <span class="caption-subject bold uppercase"> Update Team Category - [ {{$teamCategory->title}} ]</span>
                                                                </div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            </div>

                                                            <div class="portlet-body form">
                                                                <form role="form" action="{{ route('team.category.update',$teamCategory->id) }}" method="post" style="display: none;">
                                                                    @csrf
                                                                    <div class="form-body">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <input name="title" type="text" class="form-control" id="title" value="{{$teamCategory->title}}" autofocus required />
                                                                                <label for="title">Category Title</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <input id="caption" type="text" class="form-control" name="caption" value="{{$teamCategory->caption}}" />
                                                                                <label for="description">Caption</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <input id="description" type="text" class="form-control" name="description" value="{{$teamCategory->description}}" />
                                                                                <label for="description">Description</label>
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
                                <div class="modal fade" id="delete{{$teamCategory->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Delete Category</h4>
                                            </div>
                                            <div class="modal-body text-center" style="color: red"> Are you sure you want to delete this category? </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('team.category.destroy',$teamCategory->id) }}" method="post" style="display: none;">
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
