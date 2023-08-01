@extends('user.layout.view.app')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Media Type</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Manage Media Type |
        <small>manage website media types</small>
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
                        <button type="button" class="btn btn-sm blue" data-toggle="modal" href="#newType">New Type</button>
                        <div class="modal fade" id="newType" tabindex="-1" role="form" aria-hidden="true">
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
                                                            <span class="caption-subject bold uppercase"> Create New Media Type</span>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <div class="portlet-body form">
                                                        <form method="POST" action="{{ route('media.type.store') }}" role="form">
                                                            @csrf
                                                            <div class="form-body">
                                                                
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <input id="type" type="text" class="form-control" name="type" required autofocus autocomplete="type" />
                                                                        <label for="type">Media Type</label>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <textarea name="description" class="form-control" id="description" rows="5"></textarea>
                                                                        <label for="description">Description</label>
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
                                    <th> Type </th>
                                    <th> Alias</th>
                                    <th> Description</th>
                                    <th> Created </th>
                                    <th> Updated </th>
                                    <th> Control </th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php $count = 1 ?>
                            @foreach($mediaTypes as $type)
                                <tr class="text-center">
                                    <td> {{$count}} </td>
                                    <td> {{$type->type}} </td>
                                    <td> {{$type->alias}} </td>
                                    <td> {{$type->description}} </td>
                                    <?php $date = date_format($type->created_at,"M d, Y - H:i"); ?>
                                    <?php $update = date_format($type->updated_at,"M d, Y - H:i"); ?>
                                    <td title="{{ $type->createdBy['email'] }}">{{ $date }}</td>
                                    <td title="{{ $type->updatedBy['email'] }}">{{ $update }}</td>
                                    <td>
                                        <a class="text-success" data-toggle="modal" href="#update{{$type->id}}" title="edit media type"><i class="fa fa-pencil-square"></i></a> &bullet;
                                        <a class="text-danger" data-toggle="modal" href="#delete{{$type->id}}" title="delete media type"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                {{--EDIT USER--}}
                                <div class="modal fade" id="update{{$type->id}}" tabindex="-1" role="form" aria-hidden="true">
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
                                                                    <span class="caption-subject bold uppercase"> Update Media Type - [ {{$type->type}} ]</span>
                                                                </div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            </div>

                                                            <div class="portlet-body form">
                                                                <form role="form" action="{{ route('media.type.update',$type->id) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    <div class="form-body">
    
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <input id="type" type="text" class="form-control" name="type" value="{{ $type->type }}" required autofocus autocomplete="type" />
                                                                                <label for="type">Media Type</label>
                                                                            </div>
                                                                        </div>
    
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                                <textarea name="description" class="form-control" id="description" rows="5">{{ $type->description }}</textarea>
                                                                                <label for="description">Description</label>
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
                                <div class="modal fade" id="delete{{$type->id}}" tabindex="-1" role="form" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Delete This Media Type</h4>
                                            </div>
                                            <div class="modal-body text-center text-danger"> Are you sure you want to delete this media type? </div>
                                            <div class="modal-footer">
                                                <form id="delete-user" action="{{ route('media.type.destroy',$type->id) }}" method="POST" style="display: none;">
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
