@extends('user.layout.view.app')
@section('content')

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Media Content</span>
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
        <small>upload media album content</small>
    </h1>
    <!-- END PAGE TITLE-->
    @component('admin.layouts.components.messages')@endcomponent
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <i class="icon-layers font-green"></i>
                        <span class="caption-subject bold uppercase"> Media Content </span>
                    </div>
                </div>
                <div class="portlet-body form">

                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('admin.media.image.store',$album->id)}}" class="dropzone dropzone-file-area" id="my-dropzone" style="width: 500px; margin-top: 50px;" enctype="multipart/form-data">
                                @csrf
                                <h3 class="bold">Drop files here or click to upload</h3>
                                {{--<p> This is just a demo dropzone. Selected files are not actually uploaded. </p>--}}
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
