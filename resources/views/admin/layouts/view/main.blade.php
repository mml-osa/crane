<!doctype html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->

@include('admin.layouts.view.head')

<body class="page-header-fixed page-sidebar-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    @include('admin.layouts.view.header')
    <!-- END HEADER -->

    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container">

        <!-- BEGIN SIDEBAR -->
        @include('admin.layouts.view.sidebar')
        <!-- END SIDEBAR -->

        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN THEME PANEL -->
            @include('admin.layouts.view.theme-panel')
            <!-- END THEME PANEL -->

            <!-- BEGIN CONTENT -->
            <main class="py-4">
                @yield('content')
            </main>
            <!-- END CONTENT -->

            </div>

        </div>

        <!-- BEGIN QUICK SIDEBAR -->
        @include('admin.layouts.view.quick-sidebar')
        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    @include('admin.layouts.view.footer')
    <!-- END FOOTER -->
</div>
<!-- BEGIN QUICK NAV -->
{{--@include('admin.layouts.view.quick-nav')--}}
<!-- END QUICK NAV -->

@include('admin.layouts.view.scripts')

</body>

</html>
