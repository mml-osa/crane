<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8">

  <!-- Title of Website -->
  <title>Crane Content Manager - Setup</title>

  <!-- Favicon -->
  <link rel="icon" href="{{asset('public/admin/assets/images/logo/maven_hub_logo_mini.png')}}" type="image/png">
  <link rel="apple-touch-icon" href="{{asset('public/setup/apple-touch-icon.png')}}">
  <link rel="shortcut icon" href="{{asset('public/admin/assets/images/logo/maven_hub_logo_mini.png')}}"
        type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset('public/setup/css/plugins/bootstrap.min.css')}}">

  <!-- Font Icons -->
  <link rel="stylesheet" href="{{asset('public/setup/css/icons/font-awesome.css')}}">
  <link rel="stylesheet" href="{{asset('public/setup/css/icons/linea.css')}}">

  <!-- Google Fonts -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">

  <!-- Plugins CSS -->
  <link rel="stylesheet" href="{{asset('public/setup/css/plugins/loaders.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/setup/css/plugins/photoswipe.css')}}">
  <link rel="stylesheet" href="{{asset('public/setup/css/icons/photoswipe/icons.css')}}">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{asset('public/setup/css/style.css')}}">

  <!-- Responsive CSS -->
  <link href="{{asset('public/setup/css/responsive.css')}}" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

</head>
<body data-spy="scroll" data-target=".scrollspy" class="bg-dark">

<!-- Preloader  -->
<div class="loader bg-dark">
  <div class="loader-inner ball-scale-ripple-multiple ball-scale-ripple-multiple-color">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<!-- /End Preloader  -->

<div id="page">

  <!-- ============================
       BG & Overlays
  ================================= -->

  <!-- Flat Surface Shader BG -->
  <div id="page-fss" class="section-overlay" data-ambient-color="#570087" data-diffuse-color="#e000ff"></div>
  <!-- /End Flat Surface Shader BG -->

  <!-- Overlay BG -->
  <div class="section-overlay bg-black overlay-opacity-2"></div>
  <!-- /End Overlay BG -->

  <!-- ============================
       Header Navigation
  ================================= -->

  <div class="container-fluid">
    <div class="row">

      <!-- ============================
           Info
      ================================= -->

      <div id="info" class="col-md-12 text-white text-center page-info col-transform">
        <div class="vert-middle">
          <div class="reveal scale-out">

            <!-- Logo -->
{{--            <div class="p-t-b-15">--}}
              {{--                            <img src="{{asset('public/admin/assets/images/logo/maven_hub_logo.png')}}" alt="">--}}
{{--            </div>--}}
            <!-- /End Logo -->

            <div class="p-t-b-5">
              <!-- Headline & Description -->
              <h2><span class="font-weight-200">We are setting up your </span><br>Website</h2>
              <p>Please wait while Crane is set up. This will take a few minutes...<br></p>
              <!-- /End Headline & Description -->
            </div>

            <!-- Arrow -->
            <div class="p-t-b-10">
              <i class="icon icon-sm icon-arrows-slim-down-dashed"></i>
            </div>
            <!-- /End Arrow -->

            <!-- Buttons -->
            <div class="p-t-b-10">
              <h3>Please Wait...</h3>
              <br>
              <img style="border-radius: 20px" src="{{asset('public/admin/assets/images/auth/loadings.gif')}}" alt="" width="150">
            </div>
            <!-- /End Buttons -->

            <div class="clearfix"></div>

            <!-- Buttons -->
            <div class="p-t-b-15 btn-row">
              {{--<button class="btn btn-color" data-toggle="modal" data-target="#modal-notify" role="button">Notify me</button>--}}
              <a class="btn btn-border-white show-info" role="button" data-href="#content">More info</a>
            </div>
            <!-- /End Buttons -->

          </div>
        </div>
      </div>

      <!-- ============================
           Content
      ================================= -->

      <div id="content" class="page-content col-md-6 text-center bg-white-09">

        <!-- ----------------------------
             About Section
        --------------------------------- -->
      </div>
    </div>
  </div>

</div>
<!-- /#page -->
<div id="photoswipe"></div>

<!-- Scripts -->
<script src="{{asset('public/setup/js/plugins/jquery1.11.2.min.j')}}s"></script>
<script src="{{asset('public/setup/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('public/setup/js/plugins/scrollreveal.min.js')}}"></script>
<script src="{{asset('public/setup/js/plugins/contact-form.js')}}"></script>
<script src="{{asset('public/setup/js/plugins/newsletter-form.js')}}"></script>
<script src="{{asset('public/setup/js/plugins/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('public/setup/js/plugins/photoswipe/photoswipe.min.js')}}"></script>
<script src="{{asset('public/setup/js/plugins/photoswipe/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('public/setup/js/plugins/jquery.countdown.min.js')}}"></script>
<script src="{{asset('public/setup/js/plugins/fss.min.js')}}"></script>
<script src="{{asset('public/setup/js/plugins/fss-animate.js')}}"></script>
<script src="{{asset('public/setup/js/plugins/prefixfree.min.js')}}"></script>

<!-- Custom Script -->
<script src="{{asset('public/setup/js/custom.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    // console.log('Working')
    $.ajax({
      type: 'GET',
      url: `/{{env('APP_ALIAS')}}/create`,
      success: function (html) {
        window.location.href = "/{{env('APP_ALIAS')}}/login";
      },
      error: function (xhr, status, error) {
        toastr.error("Kakai.");
      }
    });
  });
</script>

</body>
</html>
