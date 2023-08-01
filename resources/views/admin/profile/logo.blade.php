@extends('admin.layouts.view.main')
@section('content')

<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{route('dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li><span>Website Logo</span></li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Logo | <small>website logo</small></h1>
<!-- END PAGE TITLE-->
@component('components.messages')@endcomponent
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET LOGO-->
        <div class="portlet light form-fit bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Logo </span>
                </div>
                <div class="portlet-body form">
                    <form role="form" action="{{ route('profile.logo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <br><hr>
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="form-group last">
                                    <div class="col-md-3">
                                        <label class="control-label">Upload Website Logo</label>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" id="title" autocomplete="off" />
                                                <label for="title">Logo Title... <i>[default is "Logo"]</i></label>
                                                <span class="help-block">Enter logo title... [optional]</span>
                                            </div>

                                        <img src="" alt="">
                                    </div>

                                    <div class="col-md-9">
                                        <p> Click on "Select Image" to pick a new image to use as website Logo. Accepted formats are JPG, JPEG, PNG, BMP, GIF, and should not be more than 500kb </p>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
{{--                                                <img src="{{asset("storage/app/logo/$settings->logo")}}" alt="" />--}}
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" id="img" name="img">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                <button type="submit" class="btn blue pull-right"> Save </button>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            <span class="label label-danger">NOTE!</span>
                                            <span> Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
                <hr>

                <div style="margin-bottom: 100px"></div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table_content" id="sample_2">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Logo</th>
                                <th>Created</th>
                                <th>Updated</th>
                                @if($session->userRole['alias'] != 'moderator')
                                    <th>Published</th>
                                    <th>Favicon</th>
                                    <th>Control</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($logos as $logo)
                                <tr class="text-center">
                                    <td> <b>{{$logo->title}}</b> </td>
                                    <td>
                                        @if($logo->img != null) <img src="{{asset("storage/app/public/web/logo/$logo->img")}}" class="img-circle" alt="" width="25">
                                        @else <img alt="" class="img-circle" src="{{asset("public/user/assets/images/default/no-img.png")}}" width="25"/>@endif
                                    </td>
                                    <?php $date = date_format($logo->created_at, "M d, Y - H:i "); ?>
                                    <?php $update = date_format($logo->updated_at, "M d, Y - H:i "); ?>
                                    <td>{{ $date }}</td>
                                    <td>{{ $update }}</td>
                                    @if($session->userRole['alias'] != 'moderator')
                                        <td>
                                            @if($logo->published == 0) <a class="text-danger" data-toggle="modal" href="#publish{{$logo->id}}" title="Click To Publish" @if($session->userRole['alias'] != 'administrator') disabled @endif ><i class="fa fa-close"></i></a>
                                            @else <a class="text-primary" data-toggle="modal" href="#publish{{$logo->id}}" title="Click To Unpublish" @if($session->userRole['alias'] != 'administrator') disabled @endif ><i class="fa fa-check"></i></a> @endif

                                            {{--PUBLISH SWITCH--}}
                                            <div class="modal fade" id="publish{{$logo->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">
                                                                @if($logo->published == 0) Publish
                                                                @elseif($logo->published == 1) Unpublish @endif Logo
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body"> Are you sure you want to
                                                            @if($logo->published == 0) <span class="text-primary">publish</span>
                                                            @elseif($logo->published == 1)<span class="text-danger">unpublish</span>
                                                            @endif this logo?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form class="form-horizontal" method="post" action="{{ route('profile.logo.publish',$logo->id) }}">
                                                                @csrf
                                                                @if($logo->published == 0) <input type="hidden" name="switch" value="1">
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
                                            @if($logo->favicon == 0) <a class="text-danger" data-toggle="modal" href="#favicon{{$logo->id}}" title="Click To Enable Logo As Favicon" @if($session->userRole['alias'] != 'moderator') disabled @endif ><i class="fa fa-close"></i></a>
                                            @else <a class="text-primary" data-toggle="modal" href="#favicon{{$logo->id}}" title="Click To Disable Logo As Favicon" @if($session->userRole['alias'] != 'moderator') disabled @endif ><i class="fa fa-check"></i></a> @endif

                                            {{--PUBLISH SWITCH--}}
                                            <div class="modal fade" id="favicon{{$logo->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">
                                                                @if($logo->favicon == 0) Enable
                                                                @elseif($logo->favicon == 1) Disable @endif As Favicon
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body"> Are you sure you want to
                                                            @if($logo->favicon == 0) <span class="text-primary">enable</span>
                                                            @elseif($logo->favicon == 1)<span class="text-danger">disable</span>
                                                            @endif logo as favicon?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form class="form-horizontal" method="post" action="{{ route('profile.logo.favicon',$logo->id) }}">
                                                                @csrf
                                                                @if($logo->favicon == 0) <input type="hidden" name="switch" value="1">
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
                                            <div class="modal fade" id="update{{$logo->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Update Logo</h4>
                                                        </div>
                                                        <form class="form-horizontal" method="post" action="{{ route('profile.logo.update',$logo->id) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="col-md-12">

                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') ?? $logo->title }}" id="title" autocomplete="title" />
                                                                        <label for="title">Logo Title... <i>[default is "Logo"]</i></label>
                                                                        <span class="help-block">Enter logo title... [optional]</span>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                                {{--                                                <img src="{{asset("storage/app/logo/$settings->logo")}}" alt="" />--}}
                                                                            </div>
                                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                                            <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Select image </span>
                                                                                <span class="fileinput-exists"> Change </span>
                                                                                <input type="file" id="img" name="img">
                                                                            </span>
                                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

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
                                            <a class="text-success" data-toggle="modal" href="#update{{$logo->id}}" @if($session->userRole['alias'] != 'moderator') disabled @endif title="update logo"><i class="fa fa-pencil-square"></i></a>
                                            &bullet;
                                            <a class="text-danger" data-toggle="modal" data-target="#delete{{$logo->id}}" @if($session->userRole['alias'] != 'moderator') disabled @endif title="remove logo"><i class="fa fa-trash"></i></a>
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
                                <div class="modal fade" id="delete{{$logo->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Remove Logo</h4>
                                            </div>
                                            <div class="modal-body text-center" style="color: red"> Are you sure you want to remove this logo?</div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('profile.logo.destroy',$logo->id) }}" method="POST" style="display: none;">
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

{{--                <div class="modal fade" id="clear_logo" tabindex="-1" role="form" aria-hidden="true">--}}
{{--                    <div class="modal-dialog">--}}
{{--                        <div class="modal-content">--}}
{{--                            --}}
{{--                            <div class="modal-header">--}}
{{--                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>--}}
{{--                                <h4 class="modal-title">Clear Logo </h4>--}}
{{--                            </div>--}}
{{--                            --}}
{{--                            <div class="modal-body text-center text-danger"> Are you sure you want to clear this logo? </div>--}}
{{--                            --}}
{{--                            <div class="modal-footer">--}}
{{--                                <form class="form-horizontal" method="post" action="{{ route('profile.logo.clear') }}">--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit" class="btn btn-sm red">Yes</button>--}}
{{--                                    <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">No</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        --}}
{{--                        </div>--}}
{{--                        <!-- /.modal-content -->--}}
{{--                    </div>--}}
{{--                    <!-- /.modal-dialog -->[--}}
{{--                </div>--}}

            </div>

        </div>
        <!-- END SAMPLE FORM PORTLET LOGO-->
    </div>
</div>

@endsection
