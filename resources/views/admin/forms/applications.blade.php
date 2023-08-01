@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Applications</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Pages | <small>manage website applications</small></h1>
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
{{--                            <button type="button" class="btn btn-sm blue" data-toggle="modal" href="#newPage">Add New</button>--}}
                        @endif

{{--                        <div class="modal fade" id="newPage" tabindex="-1" role="form" aria-hidden="true">--}}
{{--                            <div class="modal-dialog">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-12 ">--}}
{{--                                                <!-- BEGIN SAMPLE FORM PORTLET-->--}}
{{--                                                <div class="portlet light bordered">--}}
{{--                                                    <div class="portlet-title">--}}
{{--                                                        <div class="caption font-blue">--}}
{{--                                                            <i class="icon-layers font-blue"></i>--}}
{{--                                                            <span class="caption-subject bold uppercase"> New Page</span>--}}
{{--                                                        </div>--}}
{{--                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="portlet-body form">--}}
{{--                                                        <form method="POST" action="{{ route('page.store') }}" role="form">--}}
{{--                                                            @csrf--}}
{{--                                                            <div class="form-body">--}}
{{--                                                                <div class="col-md-12">--}}
{{--                                                                    <div class="form-group form-md-line-input form-md-floating-label">--}}
{{--                                                                        <input id="name" type="text" class="form-control" name="name" autofocus required />--}}
{{--                                                                        <label for="name">Page Name</label>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="col-md-12">--}}
{{--                                                                    <div class="form-group form-md-line-input form-md-floating-label">--}}
{{--                                                                        <input id="title" type="text" class="form-control" name="title" required />--}}
{{--                                                                        <label for="title">Page Title</label>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="col-md-12">--}}
{{--                                                                    <div class="form-group form-md-line-input form-md-floating-label">--}}
{{--                                                                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>--}}
{{--                                                                        <label for="description">Description</label>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="col-md-12">--}}
{{--                                                                    <div class="form-group form-md-line-input form-md-floating-label">--}}
{{--                                                                        <select class="form-control" name="visibility_id" id="visibility_id">--}}
{{--                                                                            <option value="" selected hidden>Select...</option>--}}
{{--                                                                            @foreach ($visibility as $visible)--}}
{{--                                                                                <option value="{{$visible->id}}">{{$visible->title}}</option>--}}
{{--                                                                            @endforeach--}}
{{--                                                                        </select>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="col-md-12">--}}
{{--                                                                    <div class="mt-checkbox-inline">--}}
{{--                                                                        <label class="mt-checkbox">--}}
{{--                                                                            <input type="checkbox" name="published" id="published" value="1"> Publish--}}
{{--                                                                            <span></span>--}}
{{--                                                                        </label>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-12">--}}
{{--                                                                <div class="form-actions noborder">--}}
{{--                                                                    <button type="submit" class="btn btn-sm blue">Submit</button>--}}
{{--                                                                    <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">Close</button>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="clearfix"></div>--}}
{{--                                                        </form>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.modal-content -->--}}
{{--                            </div>--}}
{{--                            <!-- /.modal-dialog -->--}}
{{--                        </div>--}}
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
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Course</th>
                                <th>Created</th>
                                <th>Updated</th>
                                @if($session->role_id != 3)
                                    <th>Control</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            <?php $counter = 1 ?>
                            @foreach($applications as $application)
                                <tr class="text-center">
                                    <td> {{$counter}} </td>
                                    <td> {{$application->name}} </td>
                                    <td> {{$application->email}} </td>
                                    <td> {{$application->phone}} </td>
                                    <td> {{$application->address}} </td>
                                    <td> {{$application->course}} </td>
                                    <?php $date = date_format($application->created_at,"M d, Y - H:i"); ?>
                                    <?php $update = date_format($application->updated_at,"M d, Y - H:i"); ?>
                                    <td>{{ $date }}</td>
                                    <td>{{ $update }}</td>
                                    @if($session->userRole['alias'] != 'moderator')
                                        <td>
                                            <a class="text-success" data-toggle="modal" data-target="#viewNote{{$application->id}}" @if($session->userRole['alias'] == 'moderator') disabled @endif title="edit page"><i class="fa fa-pencil-square"></i></a> &bullet;
                                            <a class="text-danger" data-toggle="modal" data-target="#delete{{$application->id}}" @if($session->userRole['alias'] != 'administrator') disabled @endif title="delete page"><i class="fa fa-trash"></i></a>
                                        </td>
                                    @endif
                                </tr>

                                {{--EDIT CATEGORY--}}
                                <div class="modal fade" id="viewNote{{$application->id}}" tabindex="-1" role="form" aria-hidden="true">
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
                                                                    <span class="caption-subject bold uppercase"> Update Page - [ {{$application->name}} ]</span>
                                                                </div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="portlet-body form">
                                                                <form role="form" action="#" method="POST" style="display: none;">
                                                                    @csrf
                                                                    <div class="form-body">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <textarea name="description" id="description" class="form-control" rows="3">{{$application->notes}}</textarea>
                                                                                <label for="description">Description</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-actions noborder">
{{--                                                                                <button type="button" class="btn btn-sm blue">Print</button>--}}
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
                                <div class="modal fade" id="delete{{$application->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Delete Page</h4>
                                            </div>
                                            <div class="modal-body text-center" style="color: red"> Are you sure you want to delete this application? </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('forms.applications.destroy',$application->id) }}" method="POST" style="display: none;">
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
