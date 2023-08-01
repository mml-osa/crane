@extends('admin.layouts.view.main')
@section('content')

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Posts</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Posts | <small>manage website posts</small></h1>
    <!-- END PAGE TITLE-->

    <!-- END PAGE HEADER-->

    <!-- MAIN PAGE CONTENT -->
    <div class="row">

        <form method="POST" action="{{ route('posts.store') }}" role="form" enctype="multipart/form-data">
            @csrf
        <div class="col-md-9 ">
        @component('components.messages')@endcomponent
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <i class="icon-layers font-green"></i>
                        <span class="caption-subject bold uppercase"> Posts </span>
                    </div>
                </div>
                <div class="portlet-body form">

                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <button type="submit" class="btn btn-sm blue">Save</button>
{{--                                <a href="{{route('posts.index')}}" class="btn btn-sm default">Close</a>--}}
                            </div>
                        </div>

                        <div class="form-body">

                            <div class="col-md-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" id="title" autofocus autocomplete="title" required />
                                    <label for="title">Title</label>
                                    <span class="help-block">Enter title...</span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <textarea name="caption" id="caption" class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}" value="{{ old('caption') }}" rows="3"></textarea>
                                    <label for="caption">Caption</label>
                                    <span class="help-block">Enter caption... (optional)</span>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <br><br>

                            <div class="col-md-12">
{{--                                @trix(\App\Models\Post::class, 'content')--}}
{{--                                <input type="submit">--}}
{{--                                <label for="summernote_1" data-sort-name="" class="control-label">Content</label>--}}
                                <textarea rows="8" name="content" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}">{{ old('content') }}</textarea>
                            </div>
                        </div>

{{--                        <div class="col-md-12">--}}
{{--                            <div class="mt-checkbox-inline">--}}
{{--                                <label class="mt-checkbox">--}}
{{--                                    <input type="checkbox" name="published" id="published" value="1"> Publish Post--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="clearfix"></div>

                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <button type="submit" class="btn btn-sm blue">Save</button>
{{--                                <a href="{{route('posts.index')}}" class="btn btn-sm default">Close</a>--}}
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
                                                                @if($album->mediaType['alias'] == "image")
                                                                <li><a href="#{{$album->alias}}" tabindex="-1" data-toggle="tab"> {{$album->title}} </a></li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li><a href="#tab_upload" data-toggle="tab"> Upload Image </a></li>
                                                </ul>
                                                <div class="tab-content">

                                                    @foreach($albums as $album)
                                                        @if($album->mediaType['alias'] == "image")
                                                        <div class="tab-pane fade" id="{{$album->alias}}">
                                                            <div class="form-group">
                                                                <div class="mt-checkbox-inline">
                                                                    @foreach($items as $item)
                                                                        @if($item->album_id == $album->id)
                                                                            <label class="mt-checkbox">
                                                                                <input type="hidden" name="type_id" value="{{$album->mediaType['id']}}">
                                                                                <input name="items[]" value="{{$item->id}}" data-img-alt="Page 1" type="checkbox" id="items">
                                                                                @if($item->mediaAlbum['sub'] == 1)
                                                                                    <?php $alias = $item->mediaAlbum->mediaAlbum['alias']?>
                                                                                    <img src="{{asset("storage/app/public/web/album/$alias/$album->alias/$item->file")}}" alt="" width="70">
                                                                                @else <img src="{{asset("storage/app/public/web/album/$album->alias/$item->file")}}" alt="" width="100"> @endif
                                                                                <span></span>
                                                                            </label>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endforeach

                                                    <div class="tab-pane fade" id="tab_upload">
                                                        <label for="album_id">Select Media Album</label>
                                                        <select class="form-control" name="album_id" id="album_id">
                                                            <option value="" selected hidden>Select...</option>
                                                            @foreach($albums as $album)
                                                                <option value="{{ $album->id }}">{{ $album->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                        <label for="input-file-now-custom-1">{{__("Click on image to upload new image...")}}</label>
                                                            <input type='file' name="file" id="imgInp" class="form-control" />
                                                        <br>
                                                            <img id="blah" src="#" alt="your image" width="300" />
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

                </div>
            </div>
        </div>

        <!-- Page Visibility -->
        <div class="col-md-3">
            <!-- BEGIN TAB PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bar-chart font-dark"></i>
                        <span class="caption-subject font-dark bold">Properties</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab2_1">
                            <p><b>Published: </b><input type="radio" name="published" id="published_1" value="1"> <label for="published_1"> Yes</label>  &emsp;<input type="radio" name="published" id="published_0" value="0"> <label for="published_0"> No</label></p>
                            <p><b>Visibility: </b><br>
                                @foreach ($visibility as $visible)
                                    <input type="radio" name="visibility_id" id="visibility_id{{$visible->id}}" value="{{$visible->id}}">
                                    <label for="visibility_id{{$visible->id}}"> {{$visible->title}}</label><br>
                                @endforeach
                            </p>
                            <p><b>Created At: </b><a href="#create_date" data-target="#create_date" data-toggle="modal" title="Click to change post date">{{ now() }}</a></p>
                            <div class="modal fade" id="create_date" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">Custom Date</h4>
                                        </div>
                                        <div class="modal-body">
                                            <label for="meeting-time">Select Date And Time</label>
                                            <input class="form-control fireAt" type="date" id="meeting-time" name="create_date" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn green" data-dismiss="modal">Save</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TAB PORTLET-->
        </div>

        <!-- Page Categories -->
        <div class="col-md-3">
            <!-- BEGIN TAB PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bar-chart font-dark"></i>
                        <span class="caption-subject font-dark bold">Post Category</span>
                        <span class="text-right"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" href="#newCategory" @if($session->userRole['alias'] != 'administrator') disabled @endif>Add New</button></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab2_1">
                            @foreach ($postCategories as $postCategory)
                                <input type="checkbox" name="cat_id" id="cat_id{{$postCategory->id}}" value="{{$postCategory->id}}">
                                <label for="cat_id{{$postCategory->id}}">{{$postCategory->title}}</label><br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TAB PORTLET-->
        </div>

        <div class="col-md-3">
            <!-- BEGIN TAB PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-picture font-dark"></i>
                        <span class="caption-subject font-dark bold">Featured Image</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab2_1">
                            <a href="#featured" data-toggle="modal" title="select image">Click here to select image...</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TAB PORTLET-->
        </div>

        </form>

        <div class="modal fade" id="newCategory" tabindex="-1" role="form" aria-hidden="true">
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
                                            <span class="caption-subject bold uppercase"> New Post Category</span>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet-body form">
                                        <form method="post" action="{{ route('posts.category.store') }}" role="form">
                                            @csrf
                                            <div class="form-body">
                                                <div class="col-md-12">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input id="title" type="text" class="form-control" name="title" spellcheck="true" autofocus autocomplete="off" required />
                                                        <label for="title">Category Title</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input id="description" type="text" class="form-control" name="description" autocomplete="off" />
                                                        <label for="icon">Description</label>
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

    </div>
    <!-- END MAIN PAGE CONTENT -->

@endsection
