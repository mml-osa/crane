<!-- BEGIN HEAD -->
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Login') }}</title>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Crane Content Manager" name="description" />
    <meta content="Maven Hub" name="author" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href={{asset("public/admin/assets/global/plugins/font-awesome/css/font-awesome.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("public/admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("public/admin/assets/global/plugins/bootstrap/css/bootstrap.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("public/admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}} rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href={{asset("public/admin/assets/global/plugins/select2/css/select2.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("public/admin/assets/global/plugins/select2/css/select2-bootstrap.min.css")}} rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href={{asset("public/admin/assets/global/css/components.min.css")}} rel="stylesheet" id="style_components" type="text/css" />
    <link href={{asset("public/admin/assets/global/css/plugins.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("public/admin/assets/layouts/layout/css/custom.min.css")}} rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href={{asset("public/admin/assets/pages/css/login-2.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("public/admin/assets/pages/css/login-3.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("public/admin/assets/pages/css/login-5.min.css")}} rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    @if(session('favicon') != null) <link rel="shortcut icon" type="image/png" sizes="64x64" href="{{asset("storage/app/public/web/logo/".session('favicon')->img)}}">
    @elseif(session('logo') != null) <link rel="shortcut icon" type="image/png" sizes="64x64" href="{{asset("storage/app/public/web/logo/".session('logo')->img)}}"> @endif
</head>
<!-- END HEAD -->
