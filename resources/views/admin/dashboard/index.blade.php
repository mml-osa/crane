@extends('admin.layouts.view.main')
@section('content')

            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('dashboard')}}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li><span>Dashboard</span></li>
                </ul>
                <div class="page-toolbar">
                    <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                        <i class="icon-calendar"></i>&nbsp;
                        <span class="thin uppercase hidden-xs"></span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->

            <!-- BEGIN PAGE TITLE-->
            <h1 class="page-title"> Dashboard
                <small>statistics, charts, recent events and reports</small>
            </h1>

            @component('components.messages')@endcomponent
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->

            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 blue" href="{{route('pages.index')}}">
                        <div class="visual"><i class="fa fa-database"></i></div>
                        <div class="details">
                            <div class="number"><span data-counter="counterup" data-value="{{ $pages->count() }}">0</span></div>
                            <div class="desc"> Pages </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 red" href="{{route('posts.index')}}">
                        <div class="visual"><i class="fa fa-database"></i></div>
                        <div class="details">
                            <div class="number"><span data-counter="counterup" data-value="{{ $posts->count() }}">0</span></div>
                            <div class="desc"> Posts </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 purple" href="{{route('services.index')}}">
                        <div class="visual"><i class="fa fa-database"></i></div>
                        <div class="details">
                            <div class="number"><span data-counter="counterup" data-value="{{ $services->count() }}">0</span></div>
                            <div class="desc"> Services </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="{{route('comment.index')}}">
                        <div class="visual"><i class="fa fa-database"></i></div>
                        <div class="details">
                            <div class="number"><span data-counter="counterup" data-value="{{ $comments->count() }}">0</span></div>
                            <div class="desc"> Comments </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- END DASHBOARD STATS 1-->

            <div class="row">
                <div class="col-lg-6 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-globe font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">Comments</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1_1" class="active" data-toggle="tab"> Pending  </a></li>
                                <li><a href="#tab_1_2" data-toggle="tab"> Published </a></li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <!--BEGIN TABS-->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                        <div class="mt-comments">
                                        @foreach($comments as $comment)
                                            @if($comment->published == 0)
                                                @if($comment->reply == 0)
                                                    <div class="mt-comment">
                                                        <div class="mt-comment-img"><img src="{{asset('storage/app/public/web/avatar/user.png')}}" width="20" /> </div>
                                                        <div class="mt-comment-body">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author">{{$comment->name}}</span>
                                                                <span class="mt-comment-date">{{$comment->created_at}}</span>
                                                            </div>
                                                            <div class="mt-comment-text"> {!! substr($comment->comment, 0, 100)  !!}... </div>
                                                            <div class="mt-comment-details">
                                                                <span class="mt-comment-status  mt-comment-status-pending">Pending</span>
                                                                <ul class="mt-comment-actions">
                                                                    <li><a class="text-danger" data-target="#publish{{$comment->id}}" data-toggle="modal" href="#publish{{$comment->id}}" title="Click To Approve" @if($session->userRole['alias'] != 'administrator') disabled @endif>Approve</a></li>
                                                                    <li><a href="#">View</a></li>
                                                                    <li><a class="text-danger" href="#delete{{$comment->id}}" data-toggle="modal" data-target="#delete{{$comment->id}}">Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @foreach($comments as $reply)
                                                    @if($reply->reply == 1 && $reply->comment_id == $comment->id)
                                                        <div class="mt-comment">
                                                            <div class="mt-comment-img"><img src="{{asset('storage/app/public/web/avatar/user.png')}}" width="20" /> </div>
                                                            <div class="mt-comment-body">
                                                                <div class="mt-comment-info">
                                                                    <span class="mt-comment-author">{{$reply->name}} (<i>Reply To {{$comment->name}}</i>)</span>
                                                                    <span class="mt-comment-date">{{$reply->created_at}}</span>
                                                                </div>
                                                                <div class="mt-comment-text"> {!! substr($reply->comment, 0, 100)  !!}... </div>
                                                                <div class="mt-comment-details">
                                                                    <span class="mt-comment-status mt-comment-status-pending">Pending</span>
                                                                    <ul class="mt-comment-actions">
                                                                        <li><a class="text-danger" data-target="#publish{{$comment->id}}" data-toggle="modal" href="#publish{{$comment->id}}" title="Click To Approve" @if($session->userRole['alias'] != 'administrator') disabled @endif>Approve</a></li>
                                                                        <li><a href="#">View</a></li>
                                                                        <li><a class="text-danger" href="#delete{{$reply->id}}" data-toggle="modal" data-target="#delete{{$reply->id}}">Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else <?php $null = "No Pending Comments.."?>
                                            @endif
                                        @endforeach
                                        {{$null ?? ""}}
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_1_2">
                                    <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
                                        <div class="mt-comments">
                                        @foreach($comments as $comment)
                                            @if($comment->published == 1)
                                                @if($comment->reply == 0)
                                                    <div class="mt-comment">
                                                        <div class="mt-comment-img"><img src="{{asset('storage/app/public/web/avatar/user.png')}}" width="20" /> </div>
                                                        <div class="mt-comment-body">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author">{{$comment->name}}</span>
                                                                <span class="mt-comment-date">{{$comment->created_at}}</span>
                                                            </div>
                                                            <div class="mt-comment-text"> {!! substr($comment->comment, 0, 100)  !!}... </div>
                                                            <div class="mt-comment-details">
                                                                <span class="mt-comment-status mt-comment-status-pending">Pending</span>
                                                                <ul class="mt-comment-actions">
                                                                    <li><a class="text-danger" data-target="#publish{{$comment->id}}" data-toggle="modal" href="#publish{{$comment->id}}" title="Click To Approve" @if($session->userRole['alias'] != 'administrator') disabled @endif>Approve</a></li>
                                                                    <li><a href="#">View</a></li>
                                                                    <li><a class="text-danger" href="#delete{{$comment->id}}" data-toggle="modal" data-target="#delete{{$comment->id}}">Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else <?php $null = "No Approved Comments.."?>
                                                @endif
                                                @foreach($comments as $reply)
                                                    @if($reply->reply == 1 && $reply->comment_id == $comment->id)
                                                        <div class="mt-comment">
                                                            <div class="mt-comment-img"><img src="{{asset('storage/app/public/web/avatar/user.png')}}" width="20" /> </div>
                                                            <div class="mt-comment-body">
                                                                <div class="mt-comment-info">
                                                                    <span class="mt-comment-author">{{$reply->name}} (<i>Reply To {{$comment->name}}</i>)</span>
                                                                    <span class="mt-comment-date">{{$reply->created_at}}</span>
                                                                </div>
                                                                <div class="mt-comment-text"> {!! substr($reply->comment, 0, 100)  !!}... </div>
                                                                <div class="mt-comment-details">
                                                                    <span class="mt-comment-status mt-comment-status-pending">Pending</span>
                                                                    <ul class="mt-comment-actions">
                                                                        <li><a class="text-danger" data-target="#publish{{$comment->id}}" data-toggle="modal" href="#publish{{$comment->id}}" title="Click To Approve" @if($session->userRole['alias'] != 'administrator') disabled @endif>Approve</a></li>
                                                                        <li><a href="#">View</a></li>
                                                                        <li><a href="#delete{{$reply->id}}" data-toggle="modal" data-target="#delete{{$reply->id}}">Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else <?php $null = "No Approved Comments.."?>
                                            @endif
                                        @endforeach
                                        {{$null ?? ""}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END TABS-->
                        </div>
                    </div>
                </div>

                {{--DELETE USER MODAL--}}
                @foreach($comments as $comment)

                    <div class="modal fade" id="publish{{$comment->id}}" tabindex="-1" role="form" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">@if($comment->published == 0) Publish @elseif($comment->published == 1) Unpublish @endif Comment </h4>
                                </div>
                                <div class="modal-body"> Are you sure you want to @if($comment->published == 0) publish @elseif($comment->published == 1) unpublish @endif this comment? </div>
                                <div class="modal-footer">
                                    <form class="form-horizontal" method="post" action="{{ route('comment.publish',$comment->id) }}">
                                        @csrf
                                        @if($comment->published == 0) <input type="hidden" name="switch" value="1">
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

                <div class="modal fade" id="delete{{$comment->id}}" tabindex="-1" role="form" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Delete Comment</h4>
                            </div>
                            <div class="modal-body text-center" style="color: red"> Are you sure you want to delete this comment? </div>
                            <div class="modal-footer">
                                <form id="delete-user" action="{{ route('comment.destroy',$comment->id) }}" method="POST">
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
                @endforeach
                {{--END DELETE USER MODAL--}}

                <div class="col-lg-6 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class=" icon-social-twitter font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">Recent Posts</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_actions_pending" data-toggle="tab"> Published </a></li>
                                <li><a href="#tab_actions_completed" data-toggle="tab"> Unpublished </a></li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_actions_pending">
                                    <!-- BEGIN: Actions -->
                                    <div class="mt-actions">

                                        @foreach($posts->take(4) as $post)
                                            <div class="mt-action">
                                            <div class="mt-action-img"><img src="../assets/pages/media/users/avatar10.jpg" /> </div>
                                                <div class="mt-action-body">
                                                    <div class="mt-action-row">
                                                        <div class="mt-action-info ">
{{--                                                            <div class="mt-action-icon ">--}}
{{--                                                                <i class="icon-magnet"></i>--}}
{{--                                                            </div>--}}
                                                            <div class="mt-action-details ">
                                                                <span class="mt-action-author">{{$post->title}}</span>
                                                                <p class="mt-action-desc">{{$post->caption}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-action-datetime ">
                                                            <?php
                                                            $carbon = new \Carbon\Carbon($post->created_at);
                                                            $day = date_format($carbon,"d M");
                                                            $time = date_format($carbon,"H:i:a");
                                                            ?>
                                                            <span class="mt-action-date">{{$day}}</span>
                                                            <span class="mt-action-dot bg-green"></span>
                                                            <span class="mt=action-time">{{$time}}</span>
                                                        </div>
                                                        <div class="mt-action-buttons ">
                                                            <div class="btn-group btn-group-circle">
                                                                <button type="button" class="btn btn-outline green btn-sm"><i class="fa fa-search"></i></button>
                                                                <button type="button" class="btn btn-outline blue btn-sm">Publish</button>
                                                                <button type="button" class="btn btn-outline red btn-sm"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <!-- END: Actions -->
                                </div>
                                <div class="tab-pane" id="tab_actions_completed">
                                    <!-- BEGIN:Completed-->
                                    <div class="mt-actions">

                                        @foreach($posts->take(4) as $post)
                                            @if($post->published == 0)
                                                <div class="mt-action">
                                                    {{--                                            <div class="mt-action-img"><img src="../assets/pages/media/users/avatar10.jpg" /> </div>--}}
                                                    <div class="mt-action-body">
                                                        <div class="mt-action-row">
                                                            <div class="mt-action-info ">
                                                                {{--                                                            <div class="mt-action-icon ">--}}
                                                                {{--                                                                <i class="icon-magnet"></i>--}}
                                                                {{--                                                            </div>--}}
                                                                <div class="mt-action-details ">
                                                                    <span class="mt-action-author">{{$post->title}}</span>
                                                                    {{--                                                                <p class="mt-action-desc">Dummy text of the printing</p>--}}
                                                                </div>
                                                            </div>
                                                            <div class="mt-action-datetime ">
                                                                <span class="mt-action-date">3 jun</span>
                                                                <span class="mt-action-dot bg-green"></span>
                                                                <span class="mt=action-time">9:30-13:00</span>
                                                            </div>
                                                            <div class="mt-action-buttons ">
                                                                <div class="btn-group btn-group-circle">
                                                                    <button type="button" class="btn btn-outline green btn-sm">View</button>
                                                                    <button type="button" class="btn btn-outline blue btn-sm">Publish</button>
                                                                    <button type="button" class="btn btn-outline red btn-sm">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <!-- END: Completed -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-xs-12 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-globe font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">Feeds</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" class="active" data-toggle="tab"> System </a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab"> Activities </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <!--BEGIN TABS-->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                        <ul class="feeds">
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> You have 4 pending tasks.
                                                                <span class="label label-sm label-info"> Take action
                                                                                <i class="fa fa-share"></i>
                                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> Just now </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New version v1.4 just lunched! </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 20 mins </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-danger">
                                                                <i class="fa fa-bolt"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> Database server #12 overloaded. Please fix the issue. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 24 mins </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 30 mins </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 40 mins </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-warning">
                                                                <i class="fa fa-plus"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New user registered. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 1.5 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> Web server hardware needs to be upgraded.
                                                                <span class="label label-sm label-default "> Overdue </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 2 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 3 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-warning">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 5 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 18 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 21 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 22 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 21 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 22 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 21 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 22 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 21 hours </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received. Please take care of it. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 22 hours </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_1_2">
                                    <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
                                        <ul class="feeds">
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New user registered </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> Just now </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 10 mins </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-danger">
                                                                <i class="fa fa-bolt"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> Order #24DOP4 has been rejected.
                                                                <span class="label label-sm label-danger "> Take action
                                                                                <i class="fa fa-share"></i>
                                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 24 mins </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New user registered </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> Just now </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New user registered </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> Just now </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New user registered </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> Just now </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New user registered </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> Just now </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New user registered </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> Just now </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New user registered </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> Just now </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New user registered </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> Just now </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END TABS-->
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
        <!-- END CONTENT BODY -->
@endsection
