@extends('admin.layouts.view.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li><span>Address</span></li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button class="btn blue btn-sm"> <div id="clockbox"></div></button>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Address | <small>company address</small></h1>
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
                        <span class="caption-subject bold uppercase"> Address </span>
                    </div>
                </div>
                <div class="portlet-body form">

                    <form method="POST" action="{{ route('profile.address.store') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 text-right">
                            <div class="form-actions noborder">
                                <button type="submit" class="btn btn-sm blue">Save</button>
                                {{--                                <a href="{{route('profile.about.index')}}" class="btn btn-sm default">Close</a>--}}
                            </div>
                        </div>

                        <div class="form-body">

                            <div class="col-md-4">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="title" type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" id="title" autofocus autocomplete="title" />
                                    <label for="title">Title</label>
                                    <span class="help-block">Title...</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="address" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" id="address" autofocus autocomplete="address" />
                                    <label for="address">Residential Address</label>
                                    <span class="help-block">Company Location Address...</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="postal" type="text" class="form-control {{ $errors->has('postal') ? ' is-invalid' : '' }}" value="{{ old('postal') }}" id="postal" autocomplete="postal" />
                                    <label for="postal">Postal Address</label>
                                    <span class="help-block">Company Postal Address...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="city" type="text" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{ old('city') }}" id="city" autocomplete="city" />
                                    <label for="city">City</label>
                                    <span class="help-block">Company City...</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select name="country" id="country" class="form-control select2 single">
                                        <option hidden selected value="">Select...</option>
                                            @foreach($countries as $country)
                                                @if($country == null)<option>-- No Countries Available --</option>@endif
                                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @endforeach
                                    </select>
                                    <label for="country">Country</label>
                                    <span class="help-block">Company Country...</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input name="map" type="text" class="form-control {{ $errors->has('map') ? ' is-invalid' : '' }}" value="{{ old('map') }}" id="map" autocomplete="map" />
                                    <label for="map">Map Embed URL</label>
                                    <span class="help-block">Location Map URL...</span>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mt-checkbox-inline">
                                    <label class="mt-checkbox">
                                        <input type="checkbox" name="published" id="published" value="1"> Mark As Publish
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mt-checkbox-inline">
                                    <label class="mt-checkbox">
                                        <input type="checkbox" name="main" id="main" value="1"> Mark As Main
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <br><br>

                        </div>
                    </form>

                        <div class="clearfix"></div>

                        <div class="portlet-body">
                            <div class="table-container">
                                <table class="table table-striped table-bordered table-hover table_content" id="sample_2">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Country</th>
                                        <th>Map</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        @if($session->userRole['alias'] != 'moderator')
                                            <th>Main</th>
                                            <th>Published</th>
                                            <th>Control</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($addresses as $address)
                                        <tr class="text-center">
                                            <td> <b>{{$address->title}}</b> </td>
                                            <td> {{$address->address}} </td>
                                            <td> {{$address->city}} </td>
                                            <td> {{$address->country_data['country_name'] ?? null}} </td>
                                            <td> @if ($address->map != null) Yes @else No @endif </td>
                                            <?php $date = date_format($address->created_at, "M d, Y - H:i "); ?>
                                            <?php $update = date_format($address->updated_at, "M d, Y - H:i "); ?>
                                            <td>{{ $date }}</td>
                                            <td>{{ $update }}</td>
                                            @if($session->userRole['alias'] != 'moderator')
                                                <td>
                                                    @if($address->main == 0) <a class="text-danger" data-toggle="modal" href="#main{{$address->id}}" title="Click To Enable As Main Address" @if($session->userRole['alias'] != 'moderator') disabled @endif ><i class="fa fa-close"></i></a>
                                                    @else <a class="text-primary" data-toggle="modal" href="#main{{$address->id}}" title="Click To Disable As main Address" @if($session->userRole['alias'] != 'moderator') disabled @endif ><i class="fa fa-check"></i></a> @endif

                                                    {{--PUBLISH SWITCH--}}
                                                    <div class="modal fade" id="main{{$address->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">
                                                                        @if($address->main == 0) Enable
                                                                        @elseif($address->main == 1) Disable @endif As Main
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-body"> Are you sure you want to
                                                                    @if($address->main == 0) <span class="text-primary">enable</span>
                                                                    @elseif($address->main == 1)<span class="text-danger">disable</span>
                                                                    @endif as main address?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form class="form-horizontal" method="post" action="{{ route('profile.address.main',$address->id) }}">
                                                                        @csrf
                                                                        @if($address->main == 0) <input type="hidden" name="switch" value="1">
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
                                                    @if($address->published == 0) <a class="text-danger" data-toggle="modal" href="#publish{{$address->id}}" title="Click To Publish" @if($session->userRole['alias'] != 'administrator') disabled @endif ><i class="fa fa-close"></i></a>
                                                    @else <a class="text-primary" data-toggle="modal" href="#publish{{$address->id}}" title="Click To Unpublish" @if($session->userRole['alias'] != 'administrator') disabled @endif ><i class="fa fa-check"></i></a> @endif

                                                    {{--PUBLISH SWITCH--}}
                                                    <div class="modal fade" id="publish{{$address->id}}" tabindex="-1" role="form" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">
                                                                        @if($address->published == 0) Publish
                                                                        @elseif($address->published == 1) Unpublish @endif Address
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-body"> Are you sure you want to
                                                                    @if($address->published == 0) <span class="text-primary">publish</span>
                                                                    @elseif($address->published == 1)<span class="text-danger">unpublish</span>
                                                                    @endif this address?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form class="form-horizontal" method="post" action="{{ route('profile.address.publish',$address->id) }}">
                                                                        @csrf
                                                                        @if($address->published == 0) <input type="hidden" name="switch" value="1">
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
                                                    {{--PUBLISH SWITCH--}}
                                                    <div class="modal fade" id="update{{$address->id}}" tabindex="-1" role="basic" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Modal Title</h4>
                                                                </div>
                                                                <form class="form-horizontal" method="post" action="{{ route('profile.address.update',$address->id) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                <div class="modal-body">
                                                                    <div class="col-md-12">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <input name="title" type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') ?? $address->title }}" id="title" autocomplete="title" />
                                                                                <label for="form_control_1">Title</label>
                                                                                <span class="help-block">Enter title of address...</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <input name="address" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') ?? $address->address }}" id="address" autocomplete="address" />
                                                                                <label for="form_control_1">Location Address</label>
                                                                                <span class="help-block">Enter location address...</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <input name="postal" type="text" class="form-control {{ $errors->has('postal') ? ' is-invalid' : '' }}" value="{{ old('postal') ?? $address->postal }}" id="postal" autocomplete="postal" />
                                                                                <label for="form_control_1">Postal Address</label>
                                                                                <span class="help-block">Enter postal address...</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group form-md-line-input">
                                                                                <input name="city" type="text" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{ old('city') ?? $address->city }}" id="city" autocomplete="city" />
                                                                                <label for="form_control_1">City</label>
                                                                                <span class="help-block">Enter city of organization...</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group form-md-line-input">
                                                                                <select name="country" id="country" class="form-control select2 single">
                                                                                    @if($address->country != null) <option hidden selected value="{{ $address->country }}">{{ $address->countryProp['country_name'] ?? null}}</option>
                                                                                    @else <option hidden selected value="">Select...</option> @endif
                                                                                    @if($countries != null)
                                                                                        @foreach($countries as $country)
                                                                                            @if($country == null)<option>-- No Countries Available --</option>@endif
                                                                                            <option value="{{$country->id}}">{{$country->country_name}}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                                {{--                                                                                            <label for="country">Country</label>--}}
                                                                                <span class="help-block">Country...</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <input name="map" type="text" class="form-control {{ $errors->has('map') ? ' is-invalid' : '' }}" value="{{ old('map') ?? $address->map }}" id="map" autocomplete="map" />
                                                                                <label for="form_control_1">Map</label>
                                                                                <span class="help-block">Location Map URL...</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn green">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->

                                                    <a class="text-success" data-toggle="modal" href="#update{{$address->id}}" @if($session->userRole['alias'] != 'moderator') disabled @endif title="update logo"><i class="fa fa-pencil-square"></i></a>
                                                    &bullet;
                                                    <a class="text-danger" data-toggle="modal" data-target="#delete{{$address->id}}" @if($session->userRole['alias'] != 'moderator') disabled @endif title="remove logo"><i class="fa fa-trash"></i></a>
                                                </td>
                                            @endif
                                        </tr>

                                        <script type="text/javascript">
                                            $(function () {
                                                $("#level_edit").change(function () {
                                                    if ($(this).val() == "2") {
                                                        $("#parent_edit").slideDown(500);
                                                    } else {
                                                        $("#parent_edit").slideUp(500);
                                                    }
                                                });
                                            });
                                        </script>

                                        {{--DELETE USER MODAL--}}
                                        <div class="modal fade" id="delete{{$address->id}}" tabindex="-1" role="form" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">Remove Address</h4>
                                                    </div>
                                                    <div class="modal-body text-center" style="color: red"> Are you sure you want to remove this address?</div>
                                                    <div class="modal-footer">
                                                        <form id="delete-user" action="{{ route('profile.address.destroy',$address->id) }}" method="POST" style="display: none;">
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
                                        {{--END DELETE USER MODAL--}}
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix"></div>
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
