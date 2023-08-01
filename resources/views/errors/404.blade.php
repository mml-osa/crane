@extends('web.layout.main')
@section('content')

  <!-- Inner Page Banner ______________________ -->
{{--  <div class="inner-banner">--}}
{{--    <div class="opacity">--}}
{{--      <div class="container">--}}
{{--        <div class="page-title clear-fix">--}}
{{--          <h2 class="float-left">404</h2>--}}
{{--          <ul class="float-right">--}}
{{--            <li><a href="{{ route('home') }}" class="tran3s">Home</a></li>--}}
{{--            <li>/</li>--}}
{{--            <li><a href="#" class="tran3s">Page</a></li>--}}
{{--            <li>/</li>--}}
{{--            <li class="active">Error</li>--}}
{{--          </ul>--}}
{{--        </div> <!-- .page-title -->--}}
{{--      </div> <!-- /.container -->--}}
{{--    </div> <!-- /.opacity -->--}}
{{--  </div> <!-- /.inner-banner -->--}}



  <!-- Error Page Content _____________________ -->
  <div class="error-page">
    <div class="container">
      <span>4<i class="fa fa-linux p-color" aria-hidden="true"></i>4</span>
      <h5>SOMETHING WENT WRONG :(</h5>
      <h6>Sorry, the page could not be found</h6>
{{--      <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolore eius modi tempora incidunt ut labore et dolore magnam aliquam</p>--}}
      <a href="/" class="tran3s p-color-bg"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> GO HOME</a>
    </div> <!-- .container -->
  </div> <!-- /.error-page -->

  <!-- Scroll Top Button -->
{{--  <button class="scroll-top tran3s p-color-bg">--}}
{{--    <i class="fa fa-angle-up" aria-hidden="true"></i>--}}
{{--  </button>--}}
  <!-- pre loader  -->
{{--  <div id="loader-wrapper">--}}
{{--    <div id="loader"></div>--}}
{{--  </div>--}}


@endsection