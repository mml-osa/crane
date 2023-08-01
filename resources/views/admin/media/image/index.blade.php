@extends('admin.layouts.view.main')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{route('dashboard')}}">Home</a>
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
<h1 class="page-title"> Image Items |
    <small> image media album items</small>
</h1>
<!-- END PAGE TITLE-->
@component('components.messages')@endcomponent
<!-- END PAGE HEADER-->

<!-- MAIN PAGE CONTENT -->
<div class="row">
    <div class="col-md-12">
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="portfolio-content portfolio-1">
    <div class="col-md-9">
        <div id="js-filters-juicy-projects" class="cbp-l-filters-button">

            <div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase"> All
                <div class="cbp-filter-counter"></div>
            </div>

            @foreach($albums as $album)
                @if($album->mediaType['alias'] == 'image')
                    <div data-filter=".{{$album->alias}}" class="cbp-filter-item btn dark btn-outline uppercase"> {{$album->title}}
                        <div class="cbp-filter-counter"></div>
                    </div>
                @endif
            @endforeach

        </div>
        <div id="js-grid-juicy-projects" class="cbp">
            @foreach($items as $item)

            @if($item->mediaAlbum->mediaType['alias'] == 'image')
                <?php $album_alias = $item->mediaAlbum['alias']?>
                <div class="cbp-item {{$album_alias}}">
                    <div class="cbp-caption">
                        <div class="cbp-caption-defaultWrap">
                            @if($item->file != null)
                                @if($item->mediaAlbum['sub_id'] != null)
                                    <?php $album = $item->mediaAlbum->mainAlbum['alias']?>
                                    <img src="{{asset("storage/app/public/web/album/$album/$album_alias/$item->file")}}" alt="">
                                @else<img src="{{asset("storage/app/public/web/album/$album_alias/$item->file")}}" alt="">
                                @endif
                            @elseif($item->url != null)<img src="{{$item->url}}" alt="image">
                            @endif
                        </div>
                        <div class="cbp-caption-activeWrap">
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                    {{--<a href="http://keenthemes.com/preview/metronic/theme/assets/global/plugins/cubeportfolio/ajax/project1.html" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase" rel="nofollow">more info</a>--}}
                                    @if($item->file != null)
                                        @if($item->mediaAlbum['sub_id'] != null)
                                            <?php $album = $item->mediaAlbum->mainAlbum['alias']?>
                                            <a href="{{asset("storage/app/public/web/album/$album/$album_alias/$item->file")}}" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="@if($item->title != null) {{$item->title}} @else No Title @endif">view larger</a>
                                        @else <a href="{{asset("storage/app/public/web/album/$album_alias/$item->file")}}" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="@if($item->title != null) {{$item->title}} @else No Title @endif">view larger</a>
                                        @endif
                                    @elseif($item->url != null)<a href="{{$item->url}}" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="@if($item->title != null) {{$item->title}} @else No Title @endif">view larger</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center" title="{{$item->title}}">@if($item->title != null) {{$item->title}} @else No Title @endif</div>
                    <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center" title="{{$item->caption}}">@if($item->caption != null) {{$item->caption}} @else No Caption @endif</div>
                    <div class="text-center">
                        <a data-toggle="modal" href="#img_caption{{$item->id}}" title="image title and caption"><span class="text-primary"><i class="fa fa-file-text"></i></span></a> &bullet;
                        <a data-toggle="modal" href="#img_change{{$item->id}}" title="change image"><span class="text-success"><i class="fa fa-refresh"></i></span></a> &bullet;
                        <a data-toggle="modal" href="#img_publish{{$item->id}}" title="@if($item->published == 1)unpublish @else publish image @endif">@if($item->published == 1) <span class="text-danger"><i class="fa fa-close"></i></span> @else <i class="fa fa-check"></i> @endif</a> &bullet;
                        <a data-toggle="modal" href="#img_remove{{$item->id}}" title="remove image"><span class="text-danger"><i class="fa fa-trash"></i></span></a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        @foreach($items as $item)
        @if($item->mediaAlbum->mediaType['alias'] == 'image')
            <?php $album_alias = $item->mediaAlbum['alias']?>
            <div class="modal fade" id="img_caption{{$item->id}}" tabindex="-1" role="form" aria-hidden="true">
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
                                                <span class="caption-subject bold uppercase">Image Caption</span>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="portlet-body form">
                                            <form method="POST" action="{{ route("media.image.caption.store") }}" role="form">
                                                @csrf
                                                <div class="form-body">

                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <input id="title" name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}{{$item->title}}" autofocus autocomplete="off" />
                                                            <label for="title">Title</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <input id="caption" name="caption" type="text" class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}" value="{{ old('caption') }}{{$item->caption}}" autocomplete="off">
                                                            <label for="caption">Caption</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="url" data-sort-name="" class="control-label">Content</label>
                                                        <textarea id="url" rows="5" name="url" placeholder="Your content text here" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}">{{ old('url') }}{{$item->url}}</textarea>
                                                    </div>

                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-actions noborder text-right">
                                                        <input type="hidden" name="item_id" value="{{$item->id}}">
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
            <div class="modal fade" id="img_change{{$item->id}}" tabindex="-1" role="form" aria-hidden="true">
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
                                                <span class="caption-subject bold uppercase">Image Change</span>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="portlet-body form">
                                            <form method="POST" action="{{ route("media.image.edit",$item->id) }}" role="form" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <select name="album_id" id="album_id" class="form-control">
                                                                @if($albums != null)
                                                                    @foreach($albums as $album)
                                                                        @if($item->mediaAlbum['id'] == $album->id) <option value="{{$item->mediaAlbum['id']}}" selected hidden>{{$item->mediaAlbum['title']}}</option>
                                                                        @else <option value="" hidden selected>Select...</option> @endif
                                                                    @endforeach
                                                                    @foreach($albums as $album)
                                                                        @if($album->sub_cat_id == 0)<option value="{{$album->id}}">{{$album->title}}</option>
                                                                        @else<option value="{{$album->id}}">{{$album->title}}</option>@endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <p> Click on "Change Image" to pick a new image to replace. Accepted formats are JPG, JPEG, PNG, BMP, GIF, and should not be more than 1mb </p>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            @if($item->mediaAlbum['sub_id'] != null)
                                                                <?php $album = $item->mediaAlbum->mainAlbum['alias']?>
                                                                <img src="{{asset("storage/app/web/album/$album/$album_alias/$item->file")}}" alt="">
                                                            @else <img src="{{asset("storage/app/web/album/$album_alias/$item->file")}}" alt="">
                                                            @endif
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" id="file" name="file" value="{{$item->file}}">
                                                            </span>
                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
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
            <div class="modal fade" id="img_publish{{$item->id}}" tabindex="-1" role="form" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">@if($item->published == 0) Publish @else Unpublish @endif This Image </h4>
                        </div>
                        <div class="modal-body text-center"> Are you sure you want to @if($item->published == 0) publish @else unpublish @endif this image? </div>
                        <div class="modal-footer">
                            <form class="form-horizontal" method="post" action="{{ route('media.image.publish',$item->id) }}">
                                @csrf
                                @if($item->published == 0) <input type="hidden" name="switch" value="1">
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
            <div class="modal fade" id="img_remove{{$item->id}}" tabindex="-1" role="form" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <div class="caption font-red">
                                <i class="icon-trash font-red"></i>
                                <span class="caption-subject bold uppercase"> Remove Item</span>
                            </div>
                        </div>
                        <div class="modal-body text-center text-danger">Are you sure you want to delete this item? </div>
                        <div class="modal-footer">
                            <form id="delete-item" action="{{ route('media.image.destroy',$item->id) }}" method="POST">
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

        {{--<div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">
            <a href="http://keenthemes.com/preview/metronic/theme/assets/global/plugins/cubeportfolio/ajax/loadMore.html" class="cbp-l-loadMore-link btn grey-mint btn-outline" rel="nofollow">
                <span class="cbp-l-loadMore-defaultText">LOAD MORE</span>
                <span class="cbp-l-loadMore-loadingText">LOADING...</span>
                <span class="cbp-l-loadMore-noMoreLoading">NO MORE WORKS</span>
            </a>
        </div>--}}
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
                                                                                    @if($album->sub_id == null)
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
                                @if($album->mediaType['alias'] == 'image')
                                    <?php $item_count = \App\Models\Media\CcMediaItem::where('album_id',$album->id)->count(); ?>
                                    <tr>
                                        <td class="pull-left">{{$album->title}} @if($item_count != null) [{{$item_count}} Items] @else [Null] @endif </td>
                                        <td><a class="text-success" href="{{ route('media.image.create',['type' => 'image','id' => $album->id]) }}" title="add items"><i class="fa fa-plus"></i></a></td>
                                        <td><a class="text-danger" data-toggle="modal" data-target="#img_remove_all{{$album->id}}" title="clear all items"><i class="fa fa-trash"></i></a></td>
                                    </tr>

                                    <div class="modal fade" id="img_remove_all{{$album->id}}" tabindex="-1" role="form" aria-hidden="true">
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
                                                    <form id="delete-item" action="{{ route('media.image.remove',$album->id) }}" method="POST">
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
</div>
</div>

@endsection
