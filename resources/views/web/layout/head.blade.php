<?php
use \App\Models\Pages\CcPage;
use \App\Models\Post\CcPost;
use \App\Models\Services\CcServices;

$baseUrl = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$url = $_SERVER['REQUEST_URI'];
$pageAlias = explode('/', $url);
$urlCount = count($pageAlias) - 2;
$baseUrl2 = $pageAlias[$urlCount];
$page = CcPage::where('alias',$baseUrl)->orWhere('alias',$baseUrl2)->first();
$service = CcServices::where('alias',$baseUrl)->orWhere('alias',$baseUrl2)->first();
$post = CcPost::where('alias',$baseUrl)->orWhere('alias',$baseUrl2)->first();
$combo = $page ?? $service ?? $post;

if($baseUrl == " " || $baseUrl != env('APP_NAME')){ $alias = "home"; }
if(env('APP_NAME') != null){ $title = $combo->title ?? "Welcome to ".env('APP_NAME') ?? null; }
else{ $title = $combo->title ?? null; }
if ($combo == null && $baseUrl == " " ){ $title = 'Error! 404 - '.env('APP_NAME');}

$desc = $combo->description ?? null;
?>

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('title', "$title")</title>

  <meta name="description" content="{{ $desc ?? null }}" />
  <meta name="author" content="{{ session('profile')->author ?? null}}" />
  <meta name="keywords" content="{{ session('profile')->keywords ?? null }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Icons -->
  <link rel="stylesheet" type="text/css" href="{{asset('public/web/css/pe-icon-7-stroke.css')}}">
  <link rel="stylesheet" type="text/css" href={{asset('public/web/css/pe-helper.css')}}"">
  <link rel="stylesheet" href="{{asset('public/web/css/bootstrap-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/web/css/all.min.css')}}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&amp;family=Poppins:wght@700;900&amp;display=swap" rel="stylesheet">

  <!-- CSS -->
  <link href="{{asset('public/web/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('public/web/css/swiper-bundle.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/web/css/leaflet.css')}}">
  <link rel="stylesheet" href="{{asset('public/web/css/aos.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('public/web/css/style.css')}}">
</head>