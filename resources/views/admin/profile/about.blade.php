@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>About</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">About | <small>about company</small></h1>
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
                        <span class="caption-subject bold uppercase"> About </span>
                    </div>
                </div>
                <div class="portlet-body form">

                    @if($about != null)
                    <form method="POST" action="{{ route('profile.about.update',$about->id) }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <button type="submit" class="btn btn-sm blue">Update</button>
{{--                                <a href="{{route('profile.about.index')}}" class="btn btn-sm default">Close</a>--}}
                            </div>
                        </div>

                        <div class="form-body">

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') ?? $about->title }}" id="title" autofocus autocomplete="title" required />
                                    <label for="title">Company Name</label>
                                    <span class="help-block">Name of Company...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="tag" type="text" class="form-control{{ $errors->has('tag') ? ' is-invalid' : '' }}" value="{{ old('tag') ?? $about->tag }}" id="tag" autocomplete="tag" />
                                    <label for="tag">Tag Line</label>
                                    <span class="help-block">Company Tag Line...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="author" type="text" class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}" value="{{ old('author') ?? $about->author }}" id="author" autocomplete="author" />
                                    <label for="tag">Site Author</label>
                                    <span class="help-block">Company Tag Line...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="revised" type="text" class="form-control{{ $errors->has('revised') ? ' is-invalid' : '' }}" value="{{ old('revised') ?? $about->revised }}" id="revised" autocomplete="revised" />
                                    <label for="tag">Revised</label>
                                    <span class="help-block">Last Site Revised Date...</span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="caption" type="text" class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}" value="{{ old('caption') ?? $about->caption }}" id="caption" autocomplete="caption" />
                                    <label for="caption">Caption</label>
                                    <span class="help-block">Enter caption... (optional)</span>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <br><br>

                            <div class="col-md-12 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">About</label>
                                <textarea rows="8" name="about" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('about') ? ' is-invalid' : '' }}">{{ old('about') ??  $about->about }}</textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Vision</label>
                                <textarea rows="8" name="vision" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('vision') ? ' is-invalid' : '' }}">{{ old('vision') ?? $about->vision }}</textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Mission</label>
                                <textarea rows="8" name="mission" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('mission') ? ' is-invalid' : '' }}">{{ old('mission') ?? $about->mission }}</textarea>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Objective</label>
                                <textarea rows="8" name="objective" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('objective') ? ' is-invalid' : '' }}">{{ old('objective') ?? $about->objective }}</textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Values</label>
                                <textarea rows="8" name="values" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('values') ? ' is-invalid' : '' }}">{{ old('values') ?? $about->values }}</textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Goals</label>
                                <textarea rows="8" name="goals" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('goals') ? ' is-invalid' : '' }}">{{ old('goals') ?? $about->goals }}</textarea>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Keywords</label>
                                <textarea rows="4" name="keywords" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('keywords') ? ' is-invalid' : '' }}">{{ old('keywords') ?? $about->keywords }}</textarea>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <button type="submit" class="btn btn-sm blue">Update</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>

                    @else
                    <form method="POST" action="{{ route('profile.about.store') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <button type="submit" class="btn btn-sm blue">Update</button>
                                {{--                                <a href="{{route('profile.about.index')}}" class="btn btn-sm default">Close</a>--}}
                            </div>
                        </div>

                        <div class="form-body">

                            <div class="col-md-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" id="name" autofocus autocomplete="name" required />
                                    <label for="name">Company Name</label>
                                    <span class="help-block">Name of Company...</span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="caption" type="text" class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}" value="{{ old('caption') }}" id="caption" autocomplete="caption" />
                                    <label for="caption">Caption</label>
                                    <span class="help-block">Enter caption... (optional)</span>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <br><br>

                            <div class="col-md-12 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">About</label>
                                <textarea rows="8" name="about" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('about') ? ' is-invalid' : '' }}">{{ old('about') }}</textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Vision</label>
                                <textarea rows="8" name="vision" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('vision') ? ' is-invalid' : '' }}">{{ old('vision') }}</textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Mission</label>
                                <textarea rows="8" name="mission" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('mission') ? ' is-invalid' : '' }}">{{ old('mission') }}</textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Objective</label>
                                <textarea rows="8" name="objective" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('objective') ? ' is-invalid' : '' }}">{{ old('objective') }}</textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Values</label>
                                <textarea rows="8" name="values" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('values') ? ' is-invalid' : '' }}">{{ old('values') }}</textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Goals</label>
                                <textarea rows="8" name="goals" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('goals') ? ' is-invalid' : '' }}">{{ old('goals') }}</textarea>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="summernote_1" data-sort-name="" class="control-label">Keywords</label>
                                <textarea rows="4" name="keywords" id="summernote_1" placeholder="Your content text here" class="form-control{{ $errors->has('keywords') ? ' is-invalid' : '' }}">{{ old('keywords') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mt-checkbox-inline">
                                <label class="mt-checkbox">
                                    <input type="checkbox" name="published" id="published" /> Publish
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <button type="submit" class="btn btn-sm blue">Update</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>

                    @endif

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
