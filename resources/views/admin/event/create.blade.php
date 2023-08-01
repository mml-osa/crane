@extends('admin.layouts.view.main')
@section('content')

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Event</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Event | <small>add event content</small></h1>
    <!-- END PAGE TITLE-->
    @component('components.messages')@endcomponent
    <!-- END PAGE HEADER-->
    <div class="row">

        <form method="POST" action="{{ route('event.store') }}" role="form" enctype="multipart/form-data">
            @csrf

        <div class="col-md-9 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <i class="icon-layers font-green"></i>
                        <span class="caption-subject bold uppercase"> New Event </span>
                    </div>
                <div class="portlet-body form">

                        <div class="form-body">
                        </div><div class="col-md-12">
                            <div class="form-actions noborder pull-right">
                                <button type="submit" class="btn btn-sm blue">Save</button>
                                {{--                        <a href="{{route('event.index')}}" class="btn btn-sm default">Close</a>--}}
                            </div>
                        </div>

                            <div class="col-md-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" id="title" autofocus spellcheck="true" autocomplete="off" required />
                                    <label for="title">Title</label>
                                    <span class="help-block">Event title...</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="caption" type="text" class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}" value="{{ old('caption') }}" id="caption" spellcheck="true" autocomplete="off" />
                                    <label for="caption">Caption</label>
                                    <span class="help-block">Event caption...</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" value="{{ old('location') }}" id="location" spellcheck="true" autocomplete="off" />
                                    <label for="location">Location</label>
                                    <span class="help-block">Event location...</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="organizer" type="text" class="form-control{{ $errors->has('organizer') ? ' is-invalid' : '' }}" value="{{ old('organizer') }}" id="organizer" spellcheck="true" autocomplete="off" />
                                    <label for="organizer">Organizer</label>
                                    <span class="help-block">Event organizer...</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="start_date" type="date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" value="{{ old('start_date') }}" id="start_date" spellcheck="true" autocomplete="off" />
                                    <label for="start_date">Start Date</label>
                                    <span class="help-block">Event start date...</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="end_date" type="date" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" value="{{ old('end_date') }}" id="end_date" spellcheck="true" autocomplete="off" />
                                    <label for="end_date">End Date</label>
                                    <span class="help-block">Event end date...</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="start_time" type="time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" value="{{ old('start_time') }}" id="start_time" spellcheck="true" autocomplete="off" />
                                    <label for="start_time">Start Time</label>
                                    <span class="help-block">Event start time...</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="end_time" type="time" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" value="{{ old('end_time') }}" id="end_time" spellcheck="true" autocomplete="off" />
                                    <label for="end_time">End Time</label>
                                    <span class="help-block">Event end time...</span>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="rate" type="text" class="form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}" value="{{ old('rate') }}" id="rate" spellcheck="true" autocomplete="off" />
                                    <label for="rate">Rate</label>
                                    <span class="help-block">Event rate...</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" id="phone" spellcheck="true" autocomplete="off" />
                                    <label for="phone">Phone</label>
                                    <span class="help-block">Event phone...</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" id="email" spellcheck="true" autocomplete="off" />
                                    <label for="email">Email</label>
                                    <span class="help-block">Event email...</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                {{--<label for="summernote_1" data-sort-name="" class="control-label">Content</label>--}}
                                <textarea name="content" id="summernote_1" placeholder="Your content text here" required></textarea>
                            </div>
                        </div>

{{--                        <div class="col-md-12">--}}
{{--                            <div class="mt-checkbox-inline">--}}
{{--                                <label class="mt-checkbox">--}}
{{--                                    <input type="checkbox" name="published" id="published" value="1"> Publish Event--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                                <label class="mt-checkbox text-right">--}}
{{--                                    <input type="checkbox" name="current" id="current" value="1"> Set As Current--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="clearfix"></div>--}}
                        <div class="col-md-12">
                            <div class="form-actions noborder pull-right">
                                <button type="submit" class="btn btn-sm blue">Save</button>
{{--                                <a href="{{route('event.index')}}" class="btn btn-sm default">Close</a>--}}
                            </div>
                        </div>
{{--                        <div class="clearfix"></div>--}}

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
                                                            @foreach($mediaAlbums as $mediaAlbum)
                                                                <li><a href="#{{$mediaAlbum->alias}}" tabindex="-1" data-toggle="tab"> {{$mediaAlbum->title}} </a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li><a href="#tab_upload" data-toggle="tab"> Upload Image </a></li>
                                                </ul>
                                                <div class="tab-content">

                                                    @foreach($mediaAlbums as $mediaAlbum)
                                                        <div class="tab-pane fade" id="{{$mediaAlbum->alias}}">
                                                            <div class="form-group">
                                                                <label>Inline Checkboxes</label>
                                                                <div class="mt-checkbox-inline">
                                                                    @foreach($mediaItems as $mediaItem)
                                                                        @if($mediaAlbum->id == $mediaItem->mediaAlbum_id)
                                                                            <label class="mt-checkbox">
                                                                                <input type="hidden" name="type_id" value="1">
                                                                                <input name="items[]" value="{{$mediaItem->id}}" data-img-alt="Page 1" type="checkbox" id="items">
                                                                                <img src="{{asset("storage/app/pages/album/$mediaAlbum->alias/$mediaItem->file")}}" alt="" width="70">
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
                            <p><b>Published: </b><input type="radio" name="published" id="published" value="1"> Yes &emsp;<input type="radio" name="published" id="published" value="0"> No</p>
                            <p><b>Current: </b><input type="radio" name="current" id="current" value="1"> Yes &emsp;<input type="radio" name="current" id="current" value="0"> No</p>
                            <p><b>Visibility: </b><br>
                                @foreach ($visibility as $visible)
                                    <input type="radio" name="visibility_id" id="visibility_id" value="{{$visible->id}}"> {{$visible->title}}<br>
                                @endforeach
                            </p>
                            <p><b>Created At: </b><?php $date = date_format(now(),"M d, Y | H:i "); ?> {{$date}}</p>
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
                        <span class="caption-subject font-dark bold">Event Category</span>
                        <span class="text-right"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" href="#newCategory" @if($session->userRole['alias'] != 'administrator') disabled @endif>Add New</button></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab2_1">
                            @foreach ($eventCategories as $eventCategory)
                                <input type="checkbox" name="cat_id" id="cat_id" value="{{$eventCategory->id}}">
                                <label for="cat_id">{{$eventCategory->title}}</label>
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
                        {{--<i class="icon-picture font-dark"></i>--}}
                        <span class="caption-subject font-dark bold uppercase">SET FEATURED IMAGE</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab2_1">
                            {{--<button type="button" class="btn btn-xs red btn-sm" data-toggle="modal" href="#publish{{$content->id}}" title="Click To Publish">No</button>--}}
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
                                            <span class="caption-subject bold uppercase"> New Event Category</span>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet-body form">
                                        <form method="post" action="{{ route('event.category.store') }}" role="form">
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

@endsection
