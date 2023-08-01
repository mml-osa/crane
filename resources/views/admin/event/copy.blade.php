@extends('admin.layout.view.app')
@section('content')

    <?php
    use \Illuminate\Support\Facades\Crypt;
    use \App\mc_content;
    ?>

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Event</span>
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
    <h1 class="page-title"> Event |
        <small>copy event content</small>
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
                        <span class="caption-subject bold uppercase"> Event </span>
                    </div>
                </div>
                <div class="portlet-body form">

                    <form method="POST" action="{{ route("admin.events.store") }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{$event->title}}" id="title" autofocus spellcheck="true" autocomplete="off" required />
                                    <label for="title">Title</label>
                                    <span class="help-block">Event title...</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="caption" type="text" class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}" value="{{ $event->caption }}" id="caption" spellcheck="true" autocomplete="off" />
                                    <label for="caption">Caption</label>
                                    <span class="help-block">Event caption...</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" value="{{ $event->location }}" id="location" spellcheck="true" autocomplete="off" />
                                    <label for="location">Location</label>
                                    <span class="help-block">Event location...</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="organizer" type="text" class="form-control{{ $errors->has('organizer') ? ' is-invalid' : '' }}" value="{{ $event->organizer }}" id="organizer" spellcheck="true" autocomplete="off" />
                                    <label for="organizer">Organizer</label>
                                    <span class="help-block">Event organizer...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="start_date" type="date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" value="{{ $event->start_date }}" id="start_date" spellcheck="true" autocomplete="off" />
                                    <label for="start_date">Start Date</label>
                                    <span class="help-block">Event start date...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="end_date" type="date" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" value="{{ $event->end_date }}" id="end_date" spellcheck="true" autocomplete="off" />
                                    <label for="end_date">End Date</label>
                                    <span class="help-block">Event end date...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="start_time" type="time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" value="{{ $event->start_time }}" id="start_time" spellcheck="true" autocomplete="off" />
                                    <label for="start_time">Start Time</label>
                                    <span class="help-block">Event start time...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="end_time" type="time" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" value="{{ $event->end_time }}" id="end_time" spellcheck="true" autocomplete="off" />
                                    <label for="end_time">End Time</label>
                                    <span class="help-block">Event end time...</span>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="rate" type="text" class="form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}" value="{{ $event->rate }}" id="rate" autocomplete="off" />
                                    <label for="rate">Rate</label>
                                    <span class="help-block">Event rate...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="category" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" value="{{ $event->category }}" id="category" spellcheck="true" autocomplete="off" />
                                    <label for="category">Category</label>
                                    <span class="help-block">Event category...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ $event->phone }}" id="phone" autocomplete="off" />
                                    <label for="phone">Phone</label>
                                    <span class="help-block">Event phone...</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $event->email }}" id="email" autocomplete="off" />
                                    <label for="email">Email</label>
                                    <span class="help-block">Event email...</span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                {{--<label for="summernote_1" data-sort-name="" class="control-label">Content</label>--}}
                                <textarea name="content" id="summernote_1" placeholder="Your content text here" required>{{ $event->content}}</textarea>
                            </div>

                            <div class="col-md-12">
                                <div class="mt-checkbox-inline">
                                    <label class="mt-checkbox">
                                        <input type="checkbox" name="published" id="published" value="1"> Publish Event
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox text-right">
                                        <input type="checkbox" name="current" id="current" value="1"> Set As Current
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <div class="form-actions noborder pull-right">
                                <button type="submit" class="btn btn-sm blue">Save</button>
                                <a href="{{route('admin.events')}}" class="btn btn-sm default">Close</a>
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
                                                    {{--<li><a href="#tab_1_2" data-toggle="tab"> Upload Image </a></li>--}}
                                                </ul>
                                                <div class="tab-content">

                                                    @foreach($albums as $album)
                                                        <div class="tab-pane fade" id="{{$album->alias}}">
                                                            <div class="form-group">
                                                                {{--<label>Inline Checkboxes</label>--}}
                                                                <div class="mt-checkbox-inline">
                                                                    @foreach($items as $item)
                                                                        @if($album->id == $item->mediaAlbum_id)
                                                                            <label class="mt-checkbox">
                                                                                <input type="hidden" name="type_id" value="4">
                                                                                <input name="items[]" value="{{$item->id}}" data-img-alt="Page 1" type="checkbox" id="file">
                                                                                <img src="{{asset("storage/app/pages/album/$album->alias/$item->file")}}" alt="" width="70">
                                                                                <span></span>
                                                                            </label>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    {{--<div class="tab-pane fade" id="tab_1_2">--}}
                                                    {{----}}
                                                    {{--</div>--}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info btn-sm">Select</button>
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
                                @if($link->post_id == $event->id && $link->type_id == 4)
                                    @foreach($items as $item)
                                        @if($link->item_id == $item->id)
                                            <?php $album = $item->mediaAlbum['alias']; ?>
                                            <a data-toggle="modal" href="#img_remove{{$link->id}}" title="click to remove image"><img src="{{asset("storage/app/pages/album/$album/$item->file")}}" alt="" width="50"></a>

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
                                                            <form id="delete-item" action="{{ route("admin.posts.featured.remove") }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="link_id" value="{{$link->id}}">
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

@endsection
