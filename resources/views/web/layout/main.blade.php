<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('web.layout.head')

<body data-bs-spy="scroll" data-bs-target="#site-navbar" class="home-classic">

<!-- PRE LOADER -->
<div class="preloader js-preloader flex-center">
  <div class="dots">
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
  </div>
</div>

@include('web.layout.header')

@include('web.layout.hero')

@yield('content')

@include('web.layout.footer')

@include('web.layout.scripts')

</body>

</html>