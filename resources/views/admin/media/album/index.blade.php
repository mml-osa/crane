@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Albums</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Manage Album |
        <small>manage website media albums</small>
    </h1>
    <!-- END PAGE TITLE-->
    @component('components.messages')@endcomponent
    <!-- END PAGE HEADER-->

    <!-- MAIN PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <button type="button" class="btn btn-sm blue" data-toggle="modal" href="#newAlbum">New Album</button>
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

{{--                                                                <div class="col-md-6">--}}
{{--                                                                    <div class="form-group form-md-line-input form-md-floating-label has-info">--}}
{{--                                                                        <label for="single" class="control-label">Select Category</label>--}}
{{--                                                                        <select name="cat_id" id="single" class="form-control select2 single" required>--}}
{{--                                                                            <option hidden selected value="" readonly>Select...</option>--}}

{{--                                                                            @if($categories != null)--}}
{{--                                                                                @foreach($categories as $category)--}}
{{--                                                                                    <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                                                                @endforeach--}}
{{--                                                                            @endif--}}

{{--                                                                        </select>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                --}}
{{--                                                                <div class="col-md-6">--}}
{{--                                                                    <div class="form-group form-md-line-input form-md-floating-label has-info">--}}
{{--                                                                        <label for="single" class="control-label">Select Sub Category</label>--}}
{{--                                                                        <select name="sub_cat_id" id="single" class="form-control select2 single">--}}
{{--                                                                            <option hidden selected value="" readonly>Select...</option>--}}
{{--    --}}
{{--                                                                            @if($categories != null)--}}
{{--                                                                                @foreach($categories as $category)--}}
{{--                                                                                    @if($category->sub == 1)<option disabled="" value="{{$category->id}}">{{$category->name}}</option>@endif--}}
{{--                                                                                    @if($category->sub >= 1)--}}
{{--                                                                                        @foreach($subCategories as $subCategory)--}}
{{--                                                                                            @if($subCategories != null && $subCategory->cat_id == $category->id)--}}
{{--                                                                                                <option value="{{$subCategory->id}}">&emsp;&emsp;•&nbsp;{{$subCategory->name}}</option>--}}
{{--                                                                                            @endif--}}
{{--                                                                                        @endforeach--}}
{{--                                                                                    @endif--}}
{{--                                                                                @endforeach--}}
{{--                                                                            @endif--}}

{{--                                                                        </select>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}

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
                                                                            @foreach($mediaTypes as $type)
                                                                                <option value="{{$type->id}}">{{$type->title}}</option>
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
                    </div>
                </div>

                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table_content" id="sample_2">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Title </th>
                                    <th> Album Type</th>
                                    <th> Main Album</th>
                                    <th> Media Type</th>
                                    <th> Content</th>
                                    <th> Created </th>
                                    <th> Updated </th>
                                    <th> Published </th>
                                    <th> Control </th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php $count = 1 ?>
                            @foreach($albums as $album)
                                <tr class="text-center">
                                    <td> {{$count}} </td>
                                    <td> {{$album->title ?? null}} </td>
                                    <td> @if($album->sub_id != null) Sub @else Main @endif</td>
                                    <td> {{$album->mainAlbum['title'] ?? 'None'}}</td>
                                    <?php $McMediaItem = \App\Models\Media\CcMediaItem::where('album_id',$album->id)->get() ?>
                                    <td> {{$album->mediaType['title'] ?? null}} </td>
                                    <td> {{$McMediaItem->count() ?? null}} Item(s)</td>
                                    <?php $date = date_format($album->created_at,"M d, Y - H:i"); ?>
                                    <?php $update = date_format($album->updated_at,"M d, Y - H:i"); ?>
                                    <td title="{{ $album->createdBy['email'] ?? null}}">{{ $date ?? null }}</td>
                                    <td title="{{ $album->updatedBy['email'] ?? null }}">{{ $update ?? null }}</td>
                                    <td>
                                        @if($album->published == 0) <a class="text-danger" data-toggle="modal" href="#publish{{$album->id}}" title="Click to publish album"><i class="fa fa-close"></i></a>
                                        @else <a class="text-primary" data-toggle="modal" href="#publish{{$album->id}}" title="Click to unpublish album"><i class="fa fa-check"></i></a> @endif

                                        {{--ACTIVATE USER ACCOUNT--}}
                                        <div class="modal fade" id="publish{{$album->id}}" tabindex="-1" role="form" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">@if($album->published == 0) Publish @else Unpublish @endif This Album </h4>
                                                    </div>
                                                    <div class="modal-body text-center"> Are you sure you want to @if($album->published == 0) publish @else unpublish @endif this album? </div>
                                                    <div class="modal-footer">
                                                        <form class="form-horizontal" method="post" action="{{ route('media.album.publish',$album->id) }}">
                                                            @csrf
                                                            {{--                                                            <input type="hidden" name="album_id" value="{{$album->id}}">--}}
                                                            @if($album->published == 0) <input type="hidden" name="switch" value="1">
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
                                        {{--END ACTIVATE USER ACCOUNT--}}
                                    </td>
                                    <td>
                                        <a class="text-primary" href="{{route('media.image.create',['type' => 'image','id' => $album->id] )}}" title="add items to album"><i class="fa fa-plus"></i></a> &bullet;
                                        <a class="text-success" data-toggle="modal" href="#update{{$album->id}}" title="update album"><i class="fa fa-pencil-square"></i> </a>&bullet;
                                        <a class="text-danger" data-toggle="modal" href="#delete{{$album->id}}" title="delete album"><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>

                                {{--EDIT USER--}}
                                <div class="modal fade" id="update{{$album->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <!-- BEGIN SAMPLE FORM PORTLET-->
                                                        <div class="portlet light bordered">
                                                            <div class="portlet-title">
                                                                <div class="caption font-blue-soft">
                                                                    <i class="icon-pencil font-blue"></i>
                                                                    <span class="caption-subject bold uppercase"> Update Album - [ {{$album->title}} ]</span>
                                                                </div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            </div>

                                                            <div class="portlet-body form">
                                                                <form role="form" action="{{ route('media.album.update',$album->id) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    <div class="form-body">

{{--                                                                        <div class="col-md-6">--}}
{{--                                                                            <div class="form-group form-md-line-input form-md-floating-label has-info">--}}
{{--                                                                                <label for="single" class="control-label">Select Category</label>--}}
{{--                                                                                <select name="cat_id" id="single" class="form-control select2 single" required>--}}
{{--                                                                                    @if($categories != null)--}}
{{--                                                                                        @foreach($categories as $category)--}}
{{--                                                                                            @if($album->cat_id == $category->id)--}}
{{--                                                                                                <option value="{{$category->id}}" selected hidden>{{$category->name}}</option>--}}
{{--                                                                                            @endif--}}
{{--                                                                                        @endforeach--}}
{{--                                                                                    --}}
{{--                                                                                        @foreach($categories as $category)--}}
{{--                                                                                            <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                                                                        @endforeach--}}
{{--                                                                                    @endif--}}
{{--                                                                                </select>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                        --}}
{{--                                                                        <div class="col-md-6">--}}
{{--                                                                            <div class="form-group form-md-line-input form-md-floating-label has-info">--}}
{{--                                                                                <label for="single" class="control-label">Select Sub Category</label>--}}
{{--                                                                                <select name="sub_cat_id" id="single" class="form-control select2 single">--}}
{{--                                                                                    @if($categories != null)--}}
{{--                                                                                        @foreach($subCategories as $subCategory)--}}
{{--                                                                                            @if($album->sub_cat_id == $subCategory->id)--}}
{{--                                                                                                <option value="{{$subCategory->id}}" selected hidden>{{$subCategory->name}}</option>--}}
{{--                                                                                            @endif--}}
{{--                                                                                        @endforeach--}}
{{--                                                                                            --}}
{{--                                                                                            <option value="" selected>None</option>--}}
{{--                                                                                        @foreach($categories as $category)--}}
{{--                                                                                            @if($category->sub == 1)--}}
{{--                                                                                                <option disabled="" value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                                                                                @foreach($subCategories as $subCategory)--}}
{{--                                                                                                    @if($subCategories != null && $subCategory->cat_id == $category->id)--}}
{{--                                                                                                        <option value="{{$subCategory->id}}">&emsp;&emsp;•&nbsp;{{$subCategory->name}}</option>--}}
{{--                                                                                                    @endif--}}
{{--                                                                                                @endforeach--}}
{{--                                                                                            @endif--}}
{{--                                                                                        @endforeach--}}
{{--                                                                                     --}}
{{--                                                                                    @endif--}}
{{--                                                                                </select>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}

                                                                        <div class="col-md-6">
                                                                            <div class="form-group form-md-line-input form-md-floating-label has-info">
                                                                                <label for="single" class="control-label">Select Album</label>
                                                                                <select name="sub_id" id="single" class="form-control select2 single">
                                                                                    @if($album->sub == 1 && $album->mediaAlbum != null) <option value="{{$album->mediaAlbum['id'] ?? null}}" selected hidden>{{$album->mediaAlbum['title'] ?? null}}</option> @endif
                                                                                    <option value="">None</option>
                                                                                    @foreach($albums as $all)
                                                                                        @if($all == null) <option>-- No Albums Created --</option>@endif
{{--                                                                                        @if($all->sub == 0)--}}
                                                                                            <option value="{{ $all->id }}">{{ $all->title }}</option>
{{--                                                                                        @endif--}}
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div id="parent" class="col-md-6">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <label for="type_id">Media Type</label>
                                                                                <select id="type_id" name="type_id" class="form-control">
                                                                                    <option value="{{$album->mediaType['id']}}" selected hidden readonly>{{$album->mediaType['title']}}</option>
                                                                                    @foreach($mediaTypes as $type)
                                                                                        @if($album->mediaType_id != $type->id)
                                                                                            <option value="{{$type->id}}">{{$type->title}}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <input id="title" type="text" class="form-control" name="title" value="{{ $album->title }}" required autofocus autocomplete="off">
                                                                                <label for="title">Album Title</label>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-actions noborder text-right">
                                                                            <button type="submit" class="btn btn-sm blue">Submit</button>
                                                                            <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                    </div>
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
                                {{--END EDIT USER--}}

                                {{--DELETE USER MODAL--}}
                                <div class="modal fade" id="delete{{$album->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Delete This Album</h4>
                                            </div>
                                            <div class="modal-body text-center text-danger"> Are you sure you want to delete this album? </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('media.album.destroy',$album->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <button type="submit" class="btn red">Delete</button>
                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{--END DELETE USER MODAL--}}
                                <?php $count++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- End: life time stats -->
        </div>
    </div>
    <!-- END MAIN PAGE CONTENT -->

@endsection
