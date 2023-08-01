<!doctype html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->

@include('admin.layouts.auth.head')

<body class="login">

<main class="py-4">
    @yield('content')
</main>

{{--<div class="copyright bold"> {{date('Y')}} © {{ config('app.name', 'Laravel') }}. All Rights Reserved! </div>--}}

@include('admin.layouts.auth.scripts')
<!-- End -->
</body>
</html>
