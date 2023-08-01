@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Social</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Social | <small>company social media</small></h1>
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
                        <span class="caption-subject bold uppercase"> Social </span>
                    </div>
                </div>
                <div class="portlet-body form">

                    <form method="POST" action="{{ route('profile.social.store') }}" role="form" enctype="multipart/form-data">
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
                                    <label for="title">Platform</label>
                                    <span class="help-block">Social Media Platform...</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="link" type="text" class="form-control {{ $errors->has('link') ? ' is-invalid' : '' }}" value="{{ old('link') }}" id="link" autocomplete="link" />
                                    <label for="link">Link</label>
                                    <span class="help-block">Social Media Link...</span>
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
                                        <th>Link</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        @if($session->userRole['alias'] != 'moderator')
                                            <th>Published</th>
                                            <th>Control</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($socials as $social)
                                        <tr class="text-center">
                                            <td> <b>{{$social->title}}</b> </td>
                                            <td> {{$social->link}} </td>
                                            <?php $date = date_format($social->created_at, "M d, Y - H:i "); ?>
                                            <?php $update = date_format($social->updated_at, "M d, Y - H:i "); ?>
                                            <td>{{ $date }}</td>
                                            <td>{{ $update }}</td>
                                            @if($session->userRole['alias'] != 'moderator')

                                                <td>
                                                    @if($social->published == 0) <a class="text-danger" data-toggle="modal" href="#publish{{$social->id}}" title="Click To Publish" @if($session->userRole['alias'] != 'administrator') disabled @endif ><i class="fa fa-close"></i></a>
                                                    @else <a class="text-primary" data-toggle="modal" href="#publish{{$social->id}}" title="Click To Unpublish" @if($session->userRole['alias'] != 'administrator') disabled @endif ><i class="fa fa-check"></i></a> @endif

                                                    {{--PUBLISH SWITCH--}}
                                                    <div class="modal fade" id="publish{{$social->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">
                                                                        @if($social->published == 0) Publish
                                                                        @elseif($social->published == 1) Unpublish @endif Social Link
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-body"> Are you sure you want to
                                                                    @if($social->published == 0) <span class="text-primary">publish</span>
                                                                    @elseif($social->published == 1)<span class="text-danger">unpublish</span>
                                                                    @endif this social link number?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form class="form-horizontal" method="post" action="{{ route('profile.social.publish',$social->id) }}">
                                                                        @csrf
                                                                        @if($social->published == 0) <input type="hidden" name="switch" value="1">
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
                                                    {{--PUBLISH SWITCH--}}
                                                    <div class="modal fade" id="update{{$social->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Update Social Link</h4>
                                                                </div>
                                                                <form class="form-horizontal" method="post" action="{{ route('profile.social.update',$social->id) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="col-md-12">

                                                                            <div class="col-md-6">
                                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                                    <input name="title" type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') ?? $social->title }}" id="title" autofocus autocomplete="title" />
                                                                                    <label for="title">Title</label>
                                                                                    <span class="help-block">Social Media Platform...</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group form-md-line-input">
                                                                                <input name="link" type="text" class="form-control {{ $errors->has('link') ? ' is-invalid' : '' }}" value="{{ old('link') ?? $social->link }}" id="link" autocomplete="link" />
{{--                                                                                            <label for="address">Residential Address</label>--}}
                                                                                <span class="help-block">Social Media Link...</span>
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
                                                    <a class="text-success" data-toggle="modal" href="#update{{$social->id}}" @if($session->userRole['alias'] != 'moderator') disabled @endif title="update social link"><i class="fa fa-pencil-square"></i></a>
                                                    &bullet;
                                                    <a class="text-danger" data-toggle="modal" data-target="#delete{{$social->id}}" @if($session->userRole['alias'] != 'moderator') disabled @endif title="remove social link"><i class="fa fa-trash"></i></a>
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
                                        <div class="modal fade" id="delete{{$social->id}}" tabindex="-1" role="form" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">Remove Social Link</h4>
                                                    </div>
                                                    <div class="modal-body text-center" style="color: red"> Are you sure you want to remove this social media link?</div>
                                                    <div class="modal-footer">
                                                        <form id="delete-user" action="{{ route('profile.social.destroy',$social->id) }}" method="POST" style="display: none;">
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
