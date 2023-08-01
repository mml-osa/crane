@extends('admin.layout.view.app')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Edit Post</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Edit Post |
        <small>edit website post</small>
    </h1>
    <!-- END PAGE TITLE-->

    <!-- END PAGE HEADER-->

    <!-- MAIN PAGE CONTENT -->
    <div class="row">
        <div class="col-md-9 ">
        @component('components.messages')@endcomponent
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <i class="icon-layers font-green"></i>
                        <span class="caption-subject bold uppercase"> Edit Posts </span>
                    </div>
                </div>
                <div class="portlet-body form">

                    <form method="POST" action="{{ route('admin.posts.update',$posts->id) }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label has-info">
                                    <label for="single" class="control-label">Main Category</label>
                                    <select name="cat_id" id="single" class="form-control select2 single" required>
                                        <option hidden selected readonly>Select...</option>

                                        @if($categories != null)
                                            @foreach($categories as $category)
                                                @if($posts->cat_id == $category->id && $category->sub == 0)
                                                    <option value="{{$category->id}}" selected hidden>{{$category->title}}</option>
                                                @elseif($posts->cat_id == $category->id && $category->sub >= 1)
                                                    <option value="{{$category->subCategory['id']}}" selected hidden>{{$category->title}} - {{$category->subCategory['title']}}</option>
                                                @endif
                                            @endforeach

                                            @foreach($categories as $category)
                                                @if($posts->cat_id != $category->id)
                                                    @if($category == null)<option>-- No Categories Created --</option>@endif
                                                    @if($category->sub == 0)<option value="{{$category->id}}">{{$category->title}}</option>
                                                    @else<option value="{{$category->id}}">{{$category->title}}</option>@endif
                                                    @if($category->sub >= 1)
                                                        @foreach($subCategories as $subCategory)
                                                            @if($subCategories != null && $subCategory->cat_id == $category->id)
                                                                <option value="{{$subCategory->id}}">&emsp;&emsp;•&nbsp;{{$subCategory->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label has-info">
                                    <label for="single" class="control-label">Post Category</label>
                                    <select name="post_cat_id" id="single" class="form-control select2 single" required>
                                        <option value="{{$posts->postCategory['id']}}" selected hidden>{{$posts->postCategory['title']}}</option>
                                        @if($postCategories != null)
                                            @foreach($postCategories as $postCategory)
                                                @if($postCategory == null)<option>-- No Post Categories Created --</option>@endif
                                                @if($posts->post_cat_id != $postCategory->id) <option value="{{$postCategory->id}}">{{$postCategory->title}}</option> @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="title" type="text" class="form-control" id="title" value="{{$posts->title}}" autofocus autocomplete="off" required />
                                    <label for="title">Title</label>
                                    <span class="help-block">Enter title...</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="caption" type="text" class="form-control" id="caption" value="{{$posts->caption}}" autocomplete="off" />
                                    <label for="caption">Caption</label>
                                    <span class="help-block">Enter caption... (optional)</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="source" type="text" class="form-control{{ $errors->has('source') ? ' is-invalid' : '' }}" value="{{$posts->source}}" id="source" autocomplete="off" />
                                    <label for="source">Source</label>
                                    <span class="help-block">Enter source... (optional)</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="link" type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" value="{{$posts->link}}" id="link" autocomplete="off" />
                                    <label for="link">Link</label>
                                    <span class="help-block">Enter link... (optional)</span>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <br><br>

                            <div class="col-md-12">
                                {{--<label for="summernote_1" data-sort-name="" class="control-label">Content</label>--}}
                                <textarea rows="8" name="content" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}">{{$posts->content}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mt-checkbox-inline">
                                <label class="mt-checkbox">
                                    <input type="checkbox" name="published" id="published" value="1" @if($posts->published == 1) checked @endif> Publish Post
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <button type="submit" class="btn btn-sm blue">Save</button>
                                <a href="{{route('admin.posts')}}" class="btn btn-sm default">Close</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="modal fade" id="featured" tabindex="-1" role="form" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title bold text-center">SELECT IMAGE </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="portlet light bordered">
                                            <div class="portlet-body">
                                                <ul class="nav nav-tabs">
                                                    <li class="dropdown">
                                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> All Albums<i class="fa fa-angle-down"></i></a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            @foreach($albums as $album)
                                                                <li><a href="#{{$album->alias}}" tabindex="-1" data-toggle="tab"> {{$album->title}} </a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
{{--                                                    <li><a href="#tab_upload" data-toggle="tab"> Upload Image </a></li>--}}
                                                </ul>
                                                <div class="tab-content">

                                                    @foreach($albums as $album)
                                                        <div class="tab-pane fade" id="{{$album->alias}}">
                                                            <div class="form-group">
                                                                <label>Inline Checkboxes</label>
                                                                <div class="mt-checkbox-inline">
                                                                    @foreach($items as $item)
                                                                        @if($album->id == $item->mediaAlbum_id)
                                                                            <label class="mt-checkbox">
                                                                                <input type="hidden" name="type_id" value="1">
                                                                                <input name="items[]" value="{{$item->id}}" data-img-alt="Page 1" type="checkbox" id="items">

                                                                                @if($item->mediaAlbum['sub'] == 1)
                                                                                    <?php $alias = $item->mediaAlbum->mediaAlbum['alias']?>
                                                                                        <img src="{{asset("storage/app/pages/album/$alias/$album->alias/$item->file")}}" alt="" width="70">
                                                                                @else <img src="{{asset("web$album->alias/$item->file")}}" alt="" width="70"> @endif

                                                                                <img src="{{asset("storage/app/pages/album/$album->alias/$item->file")}}" alt="" width="70">
                                                                                <span></span>
                                                                            </label>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <div class="tab-pane fade" id="tab_upload">
                                                        <label for="input-file-now-custom-1">{{__("Click on image to upload new image...")}}</label>
                                                        <input type="file" name="file" id="input-file-now-custom-1" class="dropify" data-default-file="{{asset("storage/app/clients/avatar")}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Select</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <!-- BEGIN TAB PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        {{--<i class="icon-picture font-dark"></i>--}}
                        <span class="caption-subject font-dark bold uppercase">SET FEATURED IMAGE</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab2_1">
                            <br>
                            @foreach($links as $link)
                                @if($link->post_id == $posts->id  && $link->type['alias'] == "image")
                                    @foreach($items as $item)
                                        @if($link->item_id == $item->id)
                                            <?php $album = $item->mediaAlbum['alias']; ?>

                                            @if($item->mediaAlbum['sub'] == 1)
                                                <?php $alias = $item->mediaAlbum->mediaAlbum['alias']?>
                                                <a data-toggle="modal" href="#img_remove{{$link->id}}" title="click to remove image"><img src="{{asset("storage/app/pages/album/$alias/$album/$item->file")}}" alt="" width="50"></a>
                                            @else <a data-toggle="modal" href="#img_remove{{$link->id}}" title="click to remove image"><img src="{{asset("storage/app/pages/album/$album/$item->file")}}" alt="" width="50"></a> @endif

                                            <div class="modal fade" id="img_remove{{$link->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <div class="caption font-red">
                                                                <i class="icon-trash font-red"></i>
                                                                <span class="caption-subject bold uppercase"> Remove Image</span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body text-center text-danger">Are you sure you want to unset this image? </div>
                                                        <div class="modal-footer">
                                                            <form id="delete-item" action="{{ route('admin.posts.featured.remove',$link->id) }}" method="POST">
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
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            <div class="clearfix"></div>
                            <br>
                            {{--<button type="button" class="btn btn-xs red btn-sm" data-toggle="modal" href="#publish{{$content->id}}" title="Click To Publish">No</button>--}}
                            <a href="#featured" data-toggle="modal" title="select image">Click here to select image...</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TAB PORTLET-->
        </div>
    </div>
    <!-- END MAIN PAGE CONTENT -->

@endsection
