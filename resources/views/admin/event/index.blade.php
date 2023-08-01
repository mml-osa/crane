@extends('admin.layouts.view.main')
@section('content')

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Home</a>
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
        <small>all event table</small>
    </h1>
    <!-- END PAGE TITLE-->
    @component('components.messages')@endcomponent
    <!-- END PAGE HEADER-->
    {{--<div class="m-heading-1 border-green m-bordered">--}}
    {{--<h3>DataTables Buttons Extension</h3>--}}
    {{--<p> A common UI paradigm to use with interactive tables is to present buttons that will trigger some action - that may be to alter the table's state, modify the data in the table, gather the data from the table or even to activate--}}
    {{--some external process. Showing such buttons is an interface that end users are comfortable with, making them feel at home with the table. </p>--}}
    {{--<p> For more info please check out--}}
    {{--<a class="btn red btn-outline" href="http://datatables.net/extensions/buttons/" target="_blank">the official documentation</a>--}}
    {{--</p>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <a  type="button" class="btn btn-sm blue" data-toggle="modal" href="{{route('event.create')}}">Add New</a>
                    </div>
                </div>

                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table_content text-center" id="sample_2">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> Title </th>
                                <th> Caption </th>
                                <th> Published </th>
                                <th> Current </th>
                                <th> Views </th>
{{--                                <th> Likes </th>--}}
                                <th> Created </th>
                                <th> Control </th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $count = 1 ?>
                            @foreach($events as $event)
                                <tr>
                                    <td> {{$count}} </td>
                                    <td><a href="{{route('event.edit',$event->id)}}" title="click to update post" >{{$event->title}}</a></td>
                                    <td> {{$event->caption}} </td>
                                    <td>
                                        @if($event->published == 0)
                                            <button type="button" class="btn btn-xs red btn-sm" data-toggle="modal" href="#publish{{$event->id}}" title="Click To Publish">No</button>
                                        @else
                                            <button type="button" class="btn btn-xs blue btn-sm" data-toggle="modal" href="#publish{{$event->id}}" title="Click To Unpublish">Yes</button>
                                        @endif

                                        {{--ACTIVATE USER ACCOUNT--}}
                                        <div class="modal fade" id="publish{{$event->id}}" tabindex="-1" role="form" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">@if($event->published == 0) Publish @elseif($event->published == 1) Unpublish @endif Event </h4>
                                                    </div>
                                                    <div class="modal-body"> Are you sure you want to @if($event->published == 0) publish @elseif($event->published == 1) unpublish @endif this event? </div>
                                                    <div class="modal-footer">
                                                        <form class="form-horizontal" method="post" action="{{ route('event.publish',$event->id) }}">
                                                            @csrf
                                                            @if($event->published == 0) <input type="hidden" name="switch" value="1">
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
                                        @if($event->current == 0)
                                            <button type="button" class="btn btn-xs red btn-sm" data-toggle="modal" href="#current{{$event->id}}" title="Click To Set As Current">No</button>
                                        @else
                                            <button type="button" class="btn btn-xs blue btn-sm" data-toggle="modal" href="#current{{$event->id}}" title="Click To Remove As Current">Yes</button>
                                        @endif

                                        {{--ACTIVATE USER ACCOUNT--}}
                                        <div class="modal fade" id="current{{$event->id}}" tabindex="-1" role="form" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">Set Event Status As Current</h4>
                                                    </div>
                                                    <div class="modal-body"> Are you sure you want to @if($event->current == 0) set @elseif($event->current == 1) remove @endif event status as current? </div>
                                                    <div class="modal-footer">
                                                        <form class="form-horizontal" method="post" action="{{ route('event.current',$event->id) }}">
                                                            @csrf
                                                            @if($event->current == 0) <input type="hidden" name="switch" value="1">
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
                                    <td> {{$event->views}} </td>
{{--                                    <td> {{$event->likes}} </td>--}}
                                    <td> {{$event->created_at}} </td>
                                    <td>
                                        <a class="btn green btn-xs" href="{{route('event.copy',$event->id)}}">Copy</a>
                                        <a class="btn blue btn-xs" href="{{route('event.edit',$event->id)}}">Edit</a>
                                        <button type="button" class="btn red btn-xs" data-toggle="modal" href="#delete{{$event->id}}">Delete</button>
                                    </td>
                                </tr>

                                {{--DELETE USER MODAL--}}
                                <div class="modal fade" id="delete{{$event->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Delete Content</h4>
                                            </div>
                                            <div class="modal-body text-center text-danger"> Are you sure you want to delete this article? </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('event.destroy',$event->id) }}" method="POST" style="display: none;">
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

@endsection
