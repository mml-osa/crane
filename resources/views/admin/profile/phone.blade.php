@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Phone</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Phone | <small>company phone</small></h1>
    <!-- END PAGE TITLE-->

    <!-- END PAGE HEADER-->

    <!-- MAIN PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12 ">
        @component('components.messages')@endcomponent
        <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <i class="icon-layers font-green"></i>
                        <span class="caption-subject bold uppercase"> Phone </span>
                    </div>
                </div>
                <div class="portlet-body form">

                    <form method="POST" action="{{ route('profile.phone.store') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <button type="submit" class="btn btn-sm blue">Save</button>
                                {{--                                <a href="{{route('profile.about.index')}}" class="btn btn-sm default">Close</a>--}}
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="title" type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" id="title" autofocus autocomplete="title" />
                                    <label for="title">Title</label>
                                    <span class="help-block">Title...</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="phone" type="tel" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" id="phone" autocomplete="phone" />
                                    <label for="phone">Phone</label>
                                    <span class="help-block">Phone Number...</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-2">
                                <div class="mt-checkbox-inline">
                                    <label class="mt-checkbox">
                                        <input type="checkbox" name="published" id="published" value="1"> Mark As Published
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mt-checkbox-inline">
                                    <label class="mt-checkbox">
                                        <input type="checkbox" name="main" id="main" value="1"> Mark As Main
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <br><br>

                        </div>
                    </form>

                        <div class="clearfix"></div>

                        <div class="portlet-body">
                            <div class="table-container">
                                <table class="table table-striped table-bordered table-hover table_content" id="sample_2">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Phone</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        @if($session->userRole['alias'] != 'moderator')
                                            <th>Main</th>
                                            <th>Published</th>
                                            <th>Control</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($phones as $phone)
                                        <tr class="text-center">
                                            <td> <b>{{$phone->title}}</b> </td>
                                            <td> {{$phone->phone}} </td>
                                            <?php $date = date_format($phone->created_at, "M d, Y - H:i "); ?>
                                            <?php $update = date_format($phone->updated_at, "M d, Y - H:i "); ?>
                                            <td>{{ $date }}</td>
                                            <td>{{ $update }}</td>
                                            @if($session->userRole['alias'] != 'moderator')
                                                <td>
                                                    @if($phone->main == 0) <a class="text-danger" data-toggle="modal" href="#main{{$phone->id}}" title="Click To Enable As Main Address" @if($session->userRole['alias'] != 'moderator') disabled @endif ><i class="fa fa-close"></i></a>
                                                    @else <a class="text-primary" data-toggle="modal" href="#main{{$phone->id}}" title="Click To Disable As main Address" @if($session->userRole['alias'] != 'moderator') disabled @endif ><i class="fa fa-check"></i></a> @endif

                                                    {{--MAKE MAIN SWITCH--}}
                                                    <div class="modal fade" id="main{{$phone->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">
                                                                        @if($phone->main == 0) Enable
                                                                        @elseif($phone->main == 1) Disable @endif As Main
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-body"> Are you sure you want to
                                                                    @if($phone->main == 0) <span class="text-primary">enable</span>
                                                                    @elseif($phone->main == 1)<span class="text-danger">disable</span>
                                                                    @endif as main phone number?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form class="form-horizontal" method="post" action="{{ route('profile.phone.main',$phone->id) }}">
                                                                        @csrf
                                                                        @if($phone->main == 0) <input type="hidden" name="switch" value="1">
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
                                                    @if($phone->published == 0) <a class="text-danger" data-toggle="modal" href="#publish{{$phone->id}}" title="Click To Publish" @if($session->userRole['alias'] != 'administrator') disabled @endif ><i class="fa fa-close"></i></a>
                                                    @else <a class="text-primary" data-toggle="modal" href="#publish{{$phone->id}}" title="Click To Unpublish" @if($session->userRole['alias'] != 'administrator') disabled @endif ><i class="fa fa-check"></i></a> @endif

                                                    {{--PUBLISH SWITCH--}}
                                                    <div class="modal fade" id="publish{{$phone->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">
                                                                        @if($phone->published == 0) Publish
                                                                        @elseif($phone->published == 1) Unpublish @endif Phone
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-body"> Are you sure you want to
                                                                    @if($phone->published == 0) <span class="text-primary">publish</span>
                                                                    @elseif($phone->published == 1)<span class="text-danger">unpublish</span>
                                                                    @endif this phone number?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form class="form-horizontal" method="post" action="{{ route('profile.phone.publish',$phone->id) }}">
                                                                        @csrf
                                                                        @if($phone->published == 0) <input type="hidden" name="switch" value="1">
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
                                                    {{--UPDATE PHONE--}}
                                                    <div class="modal fade" id="update{{$phone->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Update Phone</h4>
                                                                </div>
                                                                <form class="form-horizontal" method="post" action="{{ route('profile.phone.update',$phone->id) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="col-md-12">

                                                                            <div class="col-md-$">
                                                                                <div class="col-md-$">
                                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                                        <input name="title" type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') ?? $phone->title }}" id="title" autofocus autocomplete="title" />
                                                                                        <label for="title">Title</label>
                                                                                        <span class="help-block">Title...</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <input name="phone" type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') ?? $phone->phone }}" id="phone" autocomplete="phone" />
{{--                                                                                            <label for="address">Residential Address</label>--}}
                                                                                    <span class="help-block">Phone Number...</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="clearfix"></div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn blue btn-sm pull-right"> Save </button>
                                                                        <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    {{--END ACTIVATE USER ACCOUNT--}}
                                                    {{--                                            --}}{{--                                            <button type="button" class="btn blue btn-xs"></button>--}}
                                                    <a class="text-success" data-toggle="modal" href="#update{{$phone->id}}" @if($session->userRole['alias'] != 'moderator') disabled @endif title="update phone number"><i class="fa fa-pencil-square"></i></a>
                                                    &bullet;
                                                    <a class="text-danger" data-toggle="modal" data-target="#delete{{$phone->id}}" @if($session->userRole['alias'] != 'moderator') disabled @endif title="remove phone number"><i class="fa fa-trash"></i></a>
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
                                        <div class="modal fade" id="delete{{$phone->id}}" tabindex="-1" role="form" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">Remove Phone Number</h4>
                                                    </div>
                                                    <div class="modal-body text-center" style="color: red"> Are you sure you want to remove this phone number?</div>
                                                    <div class="modal-footer">
                                                        <form id="delete-user" action="{{ route('profile.phone.destroy',$phone->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm red">Remove</button>
                                                            <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">Close</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        {{--END DELETE USER MODAL--}}
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                </div>
            </div>
        </div>

{{--        <div class="col-md-3">--}}
{{--            <!-- BEGIN TAB PORTLET-->--}}
{{--            <div class="portlet light bordered">--}}
{{--                <div class="portlet-title tabbable-line">--}}
{{--                    <div class="caption">--}}
{{--                        <i class="icon-picture font-dark"></i>--}}
{{--                        <span class="caption-subject font-dark bold uppercase">SET FEATURED IMAGE</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="portlet-body">--}}
{{--                    <div class="tab-content">--}}
{{--                        <div class="tab-pane active" id="portlet_tab2_1">--}}
{{--                            <a href="#featured" data-toggle="modal" title="select image">Click here to select image...</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- END TAB PORTLET-->--}}
{{--        </div>--}}
    </div>
    <!-- END MAIN PAGE CONTENT -->

@endsection
