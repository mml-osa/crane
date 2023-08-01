@extends('admin.layouts.view.main')
@section('content')

<?php
    use App\Models\Media\CcMediaItem;
?>

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
<h1 class="page-title"> Album Items |
    <small> media album items</small>
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
                <div data-filter=".{{$album->alias}}" class="cbp-filter-item btn dark btn-outline uppercase"> {{$album->title}}
                    <div class="cbp-filter-counter"></div>
                </div>
            @endforeach
        </div>
        <div id="js-grid-juicy-projects" class="cbp">
            @foreach($items as $item)
                <?php $album_alias = $item->mediaAlbum['alias']?>
                <div class="cbp-item {{$album_alias}}">
                    <div class="cbp-caption">
                        <div class="cbp-caption-defaultWrap">
                            <img src="{{asset("web$album_alias/$item->file")}}" alt=""> </div>
                        <div class="cbp-caption-activeWrap">
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                    {{--<a href="http://keenthemes.com/preview/metronic/theme/assets/global/plugins/cubeportfolio/ajax/project1.html" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase" rel="nofollow">more info</a>--}}
                                    <a href="{{asset("storage/app/pages/album/$album_alias/$item->file")}}" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="@if($item->title != null) {{$item->title}} @else No Title @endif">view larger</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center">@if($item->title != null) {{$item->title}} @else No Title @endif</div>
                    <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center">@if($item->caption != null) {{$item->caption}} @else No Caption @endif</div>
                    <div class="text-center"><a data-toggle="modal" href="#img_caption{{$item->id}}">Image Caption</a> | <a data-toggle="modal" href="#img_remove{{$item->id}}">Remove</a></div>
                </div>
            @endforeach
        </div>

        @foreach($items as $item)
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
                                            <form method="POST" action="{{ route("media.audio.caption.store") }}" role="form">
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
                                                        <label for="content" data-sort-name="" class="control-label">Content</label>
                                                        <textarea id="content" rows="10" name="content" placeholder="Your content text here" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}">{{ old('content') }}{{$item->content}}</textarea>
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
                            <form id="delete-item" action="{{ route('media.audio.destroy',$item->id) }}" method="POST">
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

{{--                                                                <div class="col-md-12">--}}
{{--                                                                    <div class="form-group form-md-line-input form-md-floating-label has-info">--}}
{{--                                                                        <label for="single" class="control-label">Select Category</label>--}}
{{--                                                                        <select name="cat_id" id="single" class="form-control select2 single" required>--}}
{{--                                                                            <option hidden selected></option>--}}

{{--                                                                            @if($categories != null)--}}
{{--                                                                                @foreach($categories as $category)--}}
{{--                                                                                    @if($category == null)<option>-- No Categories Created --</option>@endif--}}
{{--                                                                                    @if($category->sub == 0)<option value="{{$category->id}}">{{$category->title}}</option>--}}
{{--                                                                                    @else<option value="{{$category->id}}">{{$category->title}}</option>@endif--}}
{{--                                                                                    @if($category->sub >= 1)--}}
{{--                                                                                        @foreach($subCategories as $subCategory)--}}
{{--                                                                                            @if($subCategories != null && $subCategory->cat_id == $category->id)--}}
{{--                                                                                                <option value="{{$subCategory->id}}">&emsp;&emsp;•&nbsp;{{$subCategory->title}}</option>--}}
{{--                                                                                            @endif--}}
{{--                                                                                        @endforeach--}}
{{--                                                                                    @endif--}}
{{--                                                                                @endforeach--}}
{{--                                                                            @endif--}}

{{--                                                                        </select>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}

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
                                                                    <input type="hidden" name="type_id" id="type_id" value="1">
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
                        <br><br>
                        <table class="table">
                            @foreach($albums as $album)
                                @if($album->mediaType_id == 1)
                                    <?php
                                        $item_count = CcMediaItem::where('album_id',$album->id)->count();
                                    ?>
                                    <tr>
                                        <td><i class="fa fa-plus fa-sm"></i> {{$album->title}} @if($item_count != null) [{{$item_count}}] @else [Null] @endif </td>
                                        <td><a class="btn btn-xs btn-info" href="{{ url("admin/media/image/create/$album->id") }}">Add</a></td>
                                    </tr>
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
