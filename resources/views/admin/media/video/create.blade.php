@extends('admin.layouts.view.main')
@section('content')

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Video Media Content</span>
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
    <h1 class="page-title"> Upload Content |
        <small>upload video media album content</small>
    </h1>
    <!-- END PAGE TITLE-->
    @component('components.messages')@endcomponent
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-9 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <i class="icon-layers font-green"></i>
                        <span class="caption-subject bold uppercase"> Video Media Content Link </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <form method="post" action="{{route('media.video.store',['type' => 'image','id' => $album->id])}}" enctype="multipart/form-data">
                                    @csrf
                                    <label for="url">Enter Video Link Here...</label>
                                    <input type="text" name="url" id="url" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" value="{{ old('url') }}" autofocus autocomplete="url" required />
                                    <br>
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <i class="icon-layers font-green"></i>
                        <span class="caption-subject bold uppercase"> Video Media Content File </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('media.video.store',['type' => 'image','id' => $album->id])}}" class="dropzone dropzone-file-area" id="my-dropzone" style="width: 500px; margin-top: 50px;" enctype="multipart/form-data">
                                @csrf
                                <h3 class="bold">Drop files here or click to upload</h3>
                                {{--<p> This is just a demo dropzone. Selected files are not actually uploaded. </p>--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <!-- BEGIN TAB PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab2_1">
                            <span><b>All Albums</b></span>
                            <button type="button" class="btn btn-xs btn-info pull-right" data-toggle="modal" href="#newAlbum">New Album</button>
                            <div class="modal fade" id="newAlbum" tabindex="-1" role="form" aria-hidden="true">
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
                                                                <span class="caption-subject bold uppercase"> Create New Album</span>
                                                            </div>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="portlet-body form">
                                                            <form method="POST" action="{{ route('media.album.store') }}" role="form">
                                                                @csrf
                                                                <div class="form-body">

                                                                    <div class="col-md-6">
                                                                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                                                                            <label for="single" class="control-label">Select Album</label>
                                                                            <select name="sub_id" id="single" class="form-control select2 single">
                                                                                <option value="" selected>None</option>
                                                                                @if($albums != null)
                                                                                    @foreach($albums as $album)
                                                                                        @if($album == null) <option>-- No Albums Created --</option>@endif
                                                                                        @if($album->sub == 0)
                                                                                            <option value="{{ $album->id }}">{{ $album->title }}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div id="parent" class="col-md-6">
                                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                                            <label for="type_id">Media Type</label>
                                                                            <select id="type_id" name="type_id" class="form-control">
                                                                                <option selected readonly hidden>Select...</option>
                                                                                @foreach($type as $mediaType)
                                                                                    <option value="{{$mediaType->id}}">{{$mediaType->title}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                                            <input id="title" type="text" class="form-control" name="title" required autofocus autocomplete="off" />
                                                                            <label for="title">Album Title</label>
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
                                                                    <div class="form-actions noborder text-right">
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
                            <br><br>
                            <table class="table">
                                @foreach($albums as $album)
                                    @if($album->mediaType['alias'] == 'video')
                                        <?php $item_count = \App\Models\Media\CcMediaItem::where('album_id',$album->id)->count(); ?>
                                        <tr>
                                            <td class="pull-left">{{$album->title}} @if($item_count != null) [{{$item_count}} Items] @else [Null] @endif </td>
                                            <td><a class="text-success" href="{{ route('media.video.create',['type' => 'video','id' => $album->id]) }}" title="add items"><i class="fa fa-plus"></i></a></td>
                                            <td><a class="text-danger" data-toggle="modal" data-target="#vid_remove_all{{$album->id}}" title="clear all items"><i class="fa fa-trash"></i></a></td>
                                        </tr>

                                        <div class="modal fade" id="vid_remove_all{{$album->id}}" tabindex="-1" role="form" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <div class="caption font-red">
                                                            <i class="icon-trash font-red"></i>
                                                            <span class="caption-subject bold uppercase"> Remove All Images</span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body text-center text-danger">Are you sure you want to remove all images for this album? </div>
                                                    <div class="modal-footer">
                                                        <form id="delete-item" action="{{ route('media.video.remove',$album->id) }}" method="POST">
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
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TAB PORTLET-->
        </div>

    </div>

@endsection
