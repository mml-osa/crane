@extends('admin.layouts.view.main')
@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Edit Service</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Edit Service | <small>edit website service</small></h1>
    <!-- END PAGE TITLE-->

    <!-- MAIN PAGE CONTENT -->
    <div class="row">

        <form method="POST" action="{{ route('services.update',$services->id) }}" role="form" enctype="multipart/form-data">
            @csrf
            <!-- PAGE FORMS -->
            <div class="col-md-9 ">
            @component('components.messages')@endcomponent
            <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green">
                            <i class="icon-layers font-green"></i>
                            <span class="caption-subject bold uppercase"> Services </span>
                        </div>
                    </div>
                    <div class="portlet-body form">

                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <a href="{{route('services.create')}}" class="btn btn-sm btn-primary">New Service</a>
                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                                <button type="button" data-toggle="modal" data-target="#destroy{{$services->id}}" href="#destroy{{$services->id}}" class="btn btn-sm btn-danger" @if($session->userRole['alias'] != 'administrator') disabled @endif>Remove</button>
{{--                                <a href="{{route('event.index')}}" class="btn btn-sm default">Close</a>--}}
                            </div>
                        </div>

                        <div class="form-body">

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $services->name ?? old('name') }}" id="name" autofocus autocomplete="name" required />
                                    <label for="name">Name</label>
                                    <span class="help-block">Enter name...</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $services->title ?? old('title') }}" id="title" autocomplete="title" required />
                                    <label for="title">Title</label>
                                    <span class="help-block">Enter title...</span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <textarea name="caption" id="caption" class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}" rows="3">{{ $services->caption ?? old('caption') }}</textarea>
                                    <label for="caption">Caption</label>
                                    <span class="help-block">Enter caption... (optional)</span>
                                </div>
                            </div>

{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group form-md-line-input form-md-floating-label">--}}
{{--                                    <input name="link" type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" value="{{ $services->link ?? old('link') }}" id="link" autocomplete="link" />--}}
{{--                                    <label for="link">Link</label>--}}
{{--                                    <span class="help-block">Enter link... (optional)</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group form-md-line-input form-md-floating-label">--}}
{{--                                    <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3" autocomplete="description">{{ $services->description ?? old('description') }}</textarea>--}}
{{--                                    <label for="description">Description</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="clearfix"></div>
                            <br><br>

                            <div class="col-md-12">
                                {{--                                @trix(\App\Models\Event::class, 'content')--}}
                                {{--                                <input type="submit">--}}
                                {{--                                <label for="summernote_1" data-sort-name="" class="control-label">Content</label>--}}
                                <textarea rows="8" name="content" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}">{{ $services->content ?? old('content') }}</textarea>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <a href="{{route('services.create')}}" class="btn btn-sm btn-primary">New Service</a>
                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                                <button type="button" href="" class="btn btn-sm btn-danger" @if($session->userRole['alias'] != 'administrator') disabled @endif>Remove</button>
{{--                                <a href="{{route('event.index')}}" class="btn btn-sm default">Close</a>--}}
                            </div>
                        </div>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>

            <!-- SERVICE VISIBILITY BOX -->
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
                                <p><b>Published: </b><input type="radio" name="published" id="yes" value="1" @if($services->published == 1) checked @endif> <label for="yes">Yes</label> &emsp;<input type="radio" name="published" id="no" value="0" @if($services->published == 0) checked @endif> <label for="no">No</label></p>
                                <p><b>Visibility: </b><br>
                                    @foreach ($visibility as $visible)
                                        <input type="radio" name="visibility_id" id="{{$visible->alias}}" value="{{$visible->id}}" @if($services->visibility_id == $visible->id) checked @endif> <label for="{{$visible->alias}}">{{$visible->title}}</label><br>
                                    @endforeach
                                </p>
                                <p><b>Created At: </b><a href="#create_date" data-target="#create_date" data-toggle="modal" title="Click to change service date">@if($services->create_date != null) {{ ($services->create_date) }} @else {{ now() }} @endif</a></p>
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

            <!-- SERVICE CATEGORY BOX -->
            <div class="col-md-3">
                <!-- BEGIN TAB PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark"></i>
                            <span class="caption-subject font-dark bold">Service Category</span>
                            <span class="text-right"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" href="#newCategory" @if($session->userRole['alias'] != 'administrator') disabled @endif>Add New</button></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="portlet_tab2_1">
                                @foreach ($serviceCategories as $serviceCategory)
                                    <input type="checkbox" name="cat_id" id="cat_id{{$serviceCategory->id}}" value="{{$serviceCategory->id}}" @if($services->cat_id == $serviceCategory->id) checked @endif>
                                    <label for="cat_id{{$serviceCategory->id}}">{{$serviceCategory->title}}</label><br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END TAB PORTLET-->
            </div>

            <!-- FEATURED PAGE IMAGE MODAL -->
            <div class="modal fade" id="featuredBanner" role="form" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title bold text-center">SELECT FEATURED BANNER </h4>
                        </div>
                        <div class="modal-body">
                            <div class="portlet light bordered">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="dropdown">
                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> All Albums<i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                @foreach($albums as $featured)
                                                    @if($featured->mediaType['alias'] == "image")
                                                        <li><a href="#{{$featured->alias}}" tabindex="-1" data-toggle="tab"> {{$featured->title}} </a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                        {{--                                                    <li><a href="#tab_upload" data-toggle="tab"> Upload Image </a></li>--}}
                                    </ul>
                                    <div class="tab-content">

                                        @foreach($albums as $featured)
                                            @if($featured->mediaType['alias'] == "image")
                                                <div class="tab-pane fade" id="{{$featured->alias}}">
                                                    <div class="form-group">
                                                        <div class="mt-checkbox-inline">
                                                            @foreach($items as $item)
                                                                @if($item->album_id == $featured->id)
                                                                    <label class="mt-checkbox">
                                                                        <input type="hidden" name="featured" value="2">
                                                                        <input type="hidden" name="type_id" value="{{$featured->mediaType['id']}}">
                                                                        <input name="items[]" value="{{$item->id}}" data-img-alt="Page 1" type="checkbox" id="items">
                                                                        @if($item->mediaAlbum['sub'] == 1)
                                                                            <?php $alias = $item->mediaAlbum->mediaAlbum['alias']?>
                                                                            <img src="{{asset("storage/app/public/web/album/$alias/$featured->alias/$item->file")}}" alt="" width="70">
                                                                        @else <img src="{{asset("storage/app/public/web/album/$featured->alias/$item->file")}}" alt="" width="100"> @endif
                                                                        <span></span>
                                                                    </label>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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
            <!-- END FEATURED PAGE IMAGE MODAL -->
        </form>

        <!-- REMOVE FEATURED IMAGE MODAL-->
        @foreach($serviceMedia as $media)
            <div class="modal fade" id="img_remove{{$media->id}}{{$media->featured}}" tabindex="-1" role="form" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <div class="caption font-red">
                                <i class="icon-trash font-red"></i>
                                <span class="caption-subject bold uppercase"> Remove Featured Image</span>
                            </div>
                        </div>
                        <div class="modal-body text-center text-danger">Are you sure you want to remove this featured image? </div>
                        <div class="modal-footer">
                            <form id="delete-item" action="{{ route('services.featured.remove',['id'=>$media->id,'featured'=>$media->featured]) }}" method="POST">
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
        @endforeach
        <!-- END REMOVE FEATURED IMAGE MODAL-->

        <!-- ========================================================================================= -->

        <!-- FEATURED SERVICE IMAGE BOX -->
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
                            <br>
                            <!-- FEATURED PAGE IMAGE DISPLAY-->
                            @foreach($serviceMedia as $media)
                                @if($media->service_id == $services->id && $media->featured == 1)
                                    <?php $album = $media->mediaItem->mediaAlbum['alias']; ?>
                                    <?php $file = $media->mediaItem['file']; ?>

                                    @if($media->mediaItem->mediaAlbum['sub'] == 1)
                                        <?php $alias = $media->mediaItem->mediaAlbum->mediaAlbum['alias']; ?>
                                        <a data-toggle="modal" href="#img_remove{{$media->id}}" title="click to remove image"><img src="{{asset("storage/app/public/web/album/$alias/$album/$file")}}" alt="" width="100%"></a>
                                    @else <a data-toggle="modal" href="#img_remove{{$media->id}}" title="click to remove image"><img src="{{asset("storage/app/public/web/album/$album/$file")}}" alt="" width="100%"></a> @endif
                                    <div class="clearfix"></div>
                                    <br>
                                    <a class="btn btn-danger btn-xs" data-target="#img_remove{{$media->id}}{{$media->featured}}" data-toggle="modal" title="select image">Remove Featured Image</a>
                            @endif
                        @endforeach
                        <!-- END FEATURED PAGE IMAGE DISPLAY-->

                            <div class="clearfix"></div>
                            <br>

                            <a href="#featuredImage" data-toggle="modal" title="select image">Click here to select image...</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TAB PORTLET-->
        </div>

        <!-- FEATURED SERVICE BANNER BOX -->
        <div class="col-md-3">
            <!-- BEGIN TAB PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-picture font-dark"></i>
                        <span class="caption-subject font-dark bold">Featured Banner</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab2_1">
                            <br>
                            <!-- FEATURED PAGE IMAGE DISPLAY-->
                            @foreach($serviceMedia as $media)
                                @if($media->service_id == $services->id && $media->featured == 2)
                                    <?php $album = $media->mediaItem->mediaAlbum['alias']; ?>
                                    <?php $file = $media->mediaItem['file']; ?>

                                    @if($media->mediaItem->mediaAlbum['sub'] == 1)
                                        <?php $alias = $media->mediaItem->mediaAlbum->mediaAlbum['alias']; ?>
                                        <img src="{{asset("storage/app/public/web/album/$alias/$album/$file")}}" alt="" width="100%">
                                    @else <img src="{{asset("storage/app/public/web/album/$album/$file")}}" alt="" width="100%"> @endif

                                    <div class="clearfix"></div>
                                    <br>
                                    <a class="btn btn-danger btn-xs" data-target="#img_remove{{$media->id}}{{$media->featured}}" data-toggle="modal" title="select image">Remove Featured Banner</a>
                                @endif
                            @endforeach
                            <!-- END FEATURED PAGE IMAGE DISPLAY-->

                            <div class="clearfix"></div>
                            <br>

                            <a href="#featuredBanner" data-toggle="modal" title="select image">Click here to select image...</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TAB PORTLET-->
        </div>

        <!-- NEW SERVICE CATEGORY -->
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
                                            <span class="caption-subject bold uppercase"> New Service Category</span>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet-body form">
                                        <form method="post" action="{{ route('services.category.store') }}" role="form">
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

        <!-- REMOVE SERVICE MODAL -->
        <div class="modal fade" id="destroy{{$services->id}}" tabindex="-1" role="form" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Remove Service</h4>
                    </div>
                    <div class="modal-body text-center" style="color: red"> Are you sure you want to remove this service? </div>
                    <div class="modal-footer">
                        <form id="delete-user" action="{{ route('services.destroy',$services->id) }}" method="post">
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

    </div>
    <!-- END MAIN PAGE CONTENT -->

@endsection
