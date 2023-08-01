@extends('admin.layouts.view.main')
@section('content')

<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{route('dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li><span>Navigation</span></li>
    </ul>
{{--    <div class="page-toolbar">--}}
{{--        <div class="btn-group pull-right">--}}
{{--            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions--}}
{{--                <i class="fa fa-angle-down"></i>--}}
{{--            </button>--}}
{{--            <ul class="dropdown-menu pull-right" role="menu">--}}
{{--                <li><a href="#"><i class="icon-bell"></i> Action</a></li>--}}
{{--                <li><a href="#"><i class="icon-shield"></i> Another action</a></li>--}}
{{--                <li><a href="#"><i class="icon-user"></i> Something else here</a></li>--}}
{{--                <li class="divider"> </li>--}}
{{--                <li><a href="#"><i class="icon-bag"></i> Separated link</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Navigation Menu <small>manage website navigation menu</small></h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
{{--<div class="note note-success">--}}
{{--    <span class="label label-danger">NOTE!</span>--}}
{{--    <span class="bold">Nestable List Plugin </span> supported in Firefox, Chrome, Opera, Safari, Internet Explorer 10 and Internet Explorer 9 only. Internet Explorer 8 not supported. For more info please check out--}}
{{--    <a href="http://dbushell.github.com/Nestable/"--}}
{{--       target="_blank">the official documentation</a>.--}}
{{--</div>--}}

<div class="row">
    <div class="col-md-5">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-database font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Categories</span>
                </div>
                <div class="actions"><button class="btn btn-primary btn-sm" data-target="#navCategoryNew" data-toggle="modal">Add New</button></div>
                <div class="modal fade" id="navCategoryNew" tabindex="-1" role="form" aria-hidden="true">
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
                                                    <span class="caption-subject bold uppercase"> New Navigation Category</span>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="portlet-body form">
                                                <form method="POST" action="{{ route('nav.cat.store') }}" role="form">
                                                    @csrf
                                                    <div class="form-body">
                                                        <div class="col-md-12">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <input id="title" type="text" class="form-control" name="title" spellcheck="true" autofocus autocomplete="title" required />
                                                                <label for="title">Category Title</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <input id="description" type="text" class="form-control" name="description" autocomplete="description" />
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
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Title </th>
                            <th> Published </th>
                            <th> Created </th>
                            <th> Control </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1?>
                        @foreach($navCats as $navCat)
                            <tr>
                                <td> {{ $count }} </td>
                                <td> {{$navCat->title}} </td>
                                <td>
                                    @if($navCat->published == 0)<a class="text-danger" data-toggle="modal" href="#navCatPublish{{$navCat->id}}" title="Click To Publish"><i class="fa fa-eye-slash"></i></a>
                                    @else<a class="text-primary" data-toggle="modal" href="#navCatPublish{{$navCat->id}}" title="Click To Unpublish"><i class="fa fa-eye"></i></a> @endif

                                    {{--PUBLISH SWITCH--}}
                                    <div class="modal fade" id="navCatPublish{{$navCat->id}}" tabindex="-1" role="form" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">@if($navCat->published == 0) Publish @elseif($navCat->published == 1) Unpublish @endif Navigation Category </h4>
                                                </div>
                                                <div class="modal-body"> Are you sure you want to @if($navCat->published == 0) publish @elseif($navCat->published == 1) unpublish @endif this navigation category? </div>
                                                <div class="modal-footer">
                                                    <form class="form-horizontal" method="post" action="{{ route('nav.cat.publish',$navCat->id) }}">
                                                        @csrf
                                                        @if($navCat->published == 0) <input type="hidden" name="switch" value="1">
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
                                <td> {{ $navCat->created_at }} </td>
                                <td>
                                    <a class="text-success" data-toggle="modal" href="#navCatEdit{{$navCat->id}}" data-target="#navCatEdit{{$navCat->id}}" @if($session->userRole['alias'] == 'moderator') disabled @endif><i class="fa fa-pencil-square-o"></i></a> &bullet;
                                    <a class="text-info" data-toggle="modal" href="{{ route('nav.index') }}?cat={{$navCat->id}}"><i class="fa fa-search"></i></a> &bullet;
                                    <a class="text-danger" data-toggle="modal" data-target="#navCatDestroy{{$navCat->id}}" href="#navCatDestroy{{$navCat->id}}" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-trash"></i></a>
                                </td>
                                <?php $count++?>
                            </tr>

                            <div class="modal fade" id="navCatEdit{{$navCat->id}}" tabindex="-1" role="form" aria-hidden="true">
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
                                                            <form method="POST" action="{{ route('nav.cat.update',$navCat->id) }}" role="form">
                                                                @csrf
                                                                <div class="form-body">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                                            <input id="title" type="text" class="form-control" name="title" spellcheck="true" value="{{$navCat->title}}" autofocus autocomplete="title" required />
                                                                            <label for="title">Category Title</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                                            <input id="description" type="text" class="form-control" name="description" value="{{$navCat->description}}" autocomplete="description" />
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

                            {{--DELETE USER MODAL--}}
                            <div class="modal fade" id="navCatDestroy{{$navCat->id}}" tabindex="-1" role="form" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">Delete Navigation Category</h4>
                                        </div>
                                        <div class="modal-body text-center" style="color: red"> Are you sure you want to delete this category? </div>
                                        <div class="modal-footer">
                                            <form id="delete-user" action="{{ route('nav.cat.destroy',$navCat->id) }}" method="POST">
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
                            {{--END DELETE USER MODAL--}}

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>

    @if($catNav != null)

    <div class="col-md-7">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-social-dribbble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Navigation</span>
{{--                    <p>{{$catNav}}</p>--}}
                </div>
                <div class="actions"><button class="btn btn-primary btn-sm" data-target="#newNavigation" data-toggle="modal">Add New</button></div>
                <div class="modal fade" id="newNavigation" tabindex="-1" role="form" aria-hidden="true">
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
                                                    <span class="caption-subject bold uppercase"> New Navigation Item </span>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="portlet-body form">
                                                <form method="POST" action="{{ route('nav.store') }}" role="form">
                                                    @csrf
                                                    <div class="form-body">
                                                        <div class="col-md-6">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <input id="title" type="text" class="form-control" name="title" spellcheck="true" autofocus autocomplete="title" required />
                                                                <label for="title">Nav Title</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <input id="order" type="text" class="form-control" name="order" spellcheck="true" autocomplete="order" />
                                                                <label for="order">Nav Order</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <select class="form-control" name="page_id" id="page_id">
                                                                    <option value="" selected hidden>Target Page...</option>
                                                                    <option value="">None</option>
                                                                    @foreach ($pages as $page)
                                                                        <option value="{{$page->id}}">{{$page->name}} Page</option>
                                                                    @endforeach
                                                                    <option value=""><span class="small_text">--Services</span></option>
                                                                    @foreach ($services as $service)
                                                                        <option value="{{$service->id}}">{{$service->title}} Service</option>
                                                                    @endforeach
                                                                </select>
{{--                                                                <span class="help-block"> Target Page </span>--}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <select class="form-control" name="cat_id" id="cat_id">
                                                                    <option value="" selected hidden>Nav Category...</option>
                                                                    <option value="">None</option>
                                                                    @foreach ($navCats as $navCat)
                                                                        <option value="{{$navCat->id}}">{{$navCat->title}}</option>
                                                                    @endforeach
                                                                </select>
{{--                                                                <span class="help-block"> Nav Category </span>--}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mt-checkbox-inline mt-20">
                                                                <label class="mt-checkbox">
                                                                    <input type="checkbox" name="sub" id="sub" value="1"> Sub Menu
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <select class="form-control" name="parent_id" id="parent_id">
                                                                    <option value="" selected hidden>Parent Navigation (if sub)...</option>
                                                                    <option value="">None</option>
                                                                    @foreach ($navs as $nav)
                                                                        <option value="{{$nav->id}}">{{$nav->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                                {{--                                                                <span class="help-block"> Nav Parent </span>--}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <input id="route" type="text" class="form-control" name="route" spellcheck="true" autocomplete="route" />
                                                                <label for="route">Nav Route</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <select class="form-control" name="target_id" id="target_id">
                                                                    <option value="" selected hidden>Nav Target...</option>
                                                                    <option value="">None</option>
                                                                    @foreach ($targets as $target)
                                                                        <option value="{{$target->id}}">{{$target->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                                {{--                                                                <span class="help-block"> Nav Parent </span>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-actions noborder pull-right">
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
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Title </th>
                            <th> Category </th>
                            <th> Page </th>
                            <th> Sub Nav </th>
                            <th> Target </th>
                            <th> Published </th>
                            <th> Control </th>
                        </tr>
                        </thead>
                        <tbody>
                        <a href="#" target="_"></a>
                        @foreach($catNav as $nav)
                            <tr>
                                <td> {{ $nav->order }} </td>
                                <td> {{ $nav->title }}</td>
                                <td> {{ $nav->navCat['title'] }} </td>
                                <td> {{ $nav->navPage['name'] ?? 'No Linked Page' }} ({{ $nav->navPage['alias'] ?? 'no route' }})</td>
                                <td> @if($nav->sub == 0)No @else Yes @endif </td>
                                <td> {{ $nav->navTarget['title'] ?? null}} </td>
                                <td>
                                    @if($nav->published == 0)<a class="text-danger" data-toggle="modal" href="#publish{{$nav->id}}" title="Click To Publish"><i class="fa fa-eye-slash"></i></a>
                                    @else<a class="text-primary" data-toggle="modal" href="#publish{{$nav->id}}" title="Click To Unpublish"><i class="fa fa-eye"></i></a> @endif
                                    {{--PUBLISH SWITCH--}}
                                    <div class="modal fade" id="publish{{$nav->id}}" tabindex="-1" role="form" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">@if($nav->published == 0) Publish @elseif($nav->published == 1) Unpublish @endif Navigation </h4>
                                                </div>
                                                <div class="modal-body"> Are you sure you want to @if($nav->published == 0) publish @elseif($nav->published == 1) unpublish @endif this navigation? </div>
                                                <div class="modal-footer">
                                                    <form class="form-horizontal" method="post" action="{{ route('nav.publish',$nav->id) }}">
                                                        @csrf
                                                        @if($nav->published == 0) <input type="hidden" name="switch" value="1">
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
                                    <a href="#" class="text-success" data-toggle="modal" data-target="#navEdit{{ $nav->id }}" @if($session->userRole['alias'] == 'moderator') disabled @endif><i class="fa fa-pencil-square-o"></i></a> &bullet;
                                    <a href="#" class="text-danger" data-toggle="modal" data-target="#navDestroy{{$nav->id}}" @if($session->userRole['alias'] != 'administrator') disabled @endif><i class="fa fa-trash"></i></a>
                                    {{--DELETE USER MODAL--}}
                                    <div class="modal fade" id="navDestroy{{ $nav->id }}" tabindex="-1" role="form" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Delete Navigation</h4>
                                                </div>
                                                <div class="modal-body text-center" style="color: red"> Are you sure you want to delete this navigation? </div>
                                                <div class="modal-footer">
                                                    <form id="delete-user" action="{{ route('nav.destroy',$nav->id) }}" method="POST">
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
                                    {{--END DELETE USER MODAL--}}
                                </td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td></td>--}}
{{--                                <td>Test1</td>--}}
{{--                                <td>Test2</td>--}}
{{--                                <td>Test3</td>--}}
{{--                                <td>Test4</td>--}}
{{--                                <td>ttt</td>--}}
{{--                                <td>eee</td>--}}
{{--                                <td>www</td>--}}
{{--                            </tr>--}}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>
        @foreach($catNav as $navEdit)
            <div class="modal fade" id="navEdit{{ $navEdit->id }}" tabindex="-1" role="form" aria-hidden="true">
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
                                                <span class="caption-subject bold uppercase"> Edit Navigation Item </span>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="portlet-body form">
                                            <form method="POST" action="{{ route('nav.update',$navEdit->id) }}" role="form">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <input id="title" type="text" class="form-control" name="title" value="{{ $navEdit->title }}" autofocus autocomplete="title" required />
                                                            <label for="title">Nav Title</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <input id="order" type="text" class="form-control" name="order" value="{{ $navEdit->order }}" autocomplete="order" />
                                                            <label for="order">Nav Order</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <select class="form-control" name="page_id" id="page_id">
                                                                <option value="">None</option>
                                                                @if($navEdit->page_id !== null)
                                                                    <option value="{{ $navEdit->page_id ?? null }}" selected hidden>{{ $navEdit->navPage['name'] ?? null }} Page</option>
                                                                @endif
                                                                @foreach ($pages as $page)
                                                                    <option value="{{$page->id}}">{{$page->name}} Page</option>
                                                                @endforeach
                                                                <option value=""><span class="small_text">--Services</span></option>
                                                                @foreach ($services as $service)
                                                                    <option value="{{$service->id}}">{{$service->title}} Service</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="level">Target Page</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <select class="form-control" name="cat_id" id="cat_id">
                                                                <option value="{{ $navEdit->cat_id }}">{{ $navEdit->navCat['title'] }}</option>
                                                                <option value="">None</option>
                                                                @foreach ($navCats as $navCat)
                                                                    <option value="{{$navCat->id}}">{{$navCat->title}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="level">Navigation Category</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mt-checkbox-inline mt-20">
                                                        <label class="mt-checkbox">
                                                            <input type="checkbox" name="sub" id="sub" value="1" @if($navEdit->sub == '1') checked @endif> Sub Menu
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <select class="form-control" name="parent_id" id="parent_id">
                                                            <option value="{{ $navEdit->navParent['id'] ?? null }}" selected hidden>{{ $navEdit->navParent['title'] ?? null }}</option>
                                                            <option value="">None</option>
                                                            @foreach ($navs as $nav)
                                                                <option value="{{$nav->id}}">{{$nav->title}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="level">Parent Nav</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input id="route" type="text" class="form-control" name="route" value="{{ $navEdit->alias ?? null}}" autofocus autocomplete="title" />
                                                        <label for="route">Nav Route</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <select class="form-control" name="target_id" id="target_id">
                                                            <option value="{{ $navEdit->navTarget['id'] ?? null }}" selected hidden>{{ $navEdit->navTarget['title'] ?? null }}</option>
                                                            <option value="">None</option>
                                                            @foreach ($targets as $target)
                                                                <option value="{{$target->id}}" >{{$target->title}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="level">Nav Target</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-actions noborder pull-right">
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
        @endforeach
    @endif
</div>

@endsection
