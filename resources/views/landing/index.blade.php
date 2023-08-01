<!DOCTYPE html>

<html lang="en">

<head>

  <title>Coming Soon - {{env('APP_NAME')}}</title>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
  <!-- Favicon -->
  @if(session('favicon') != null)
    <link rel="shortcut icon" type="image/png" sizes="64x64" href="{{asset("storage/app/public/web/logo/".session('logo')->img)}}">
  @endif
  {{--    <link rel="icon" type="image/png" href="{{asset('public/landing/assets/images/logo.png')}}" />--}}

  <!-- FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=cyrillic" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"> -->

  <!-- CSS -->
  <link rel="stylesheet" href="{{asset('public/landing/assets/css/bootstrap.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('public/landing/assets/css/animate.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('public/landing/assets/css/magnific-popup.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('public/landing/assets/css/jquery.mCustomScrollbar.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('public/landing/assets/css/style.css')}}" type="text/css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->
</head>

<body>

<!-- Preloader -->
<div class="loader">
  <div class="sk-folding-cube">
    <div class="sk-cube1 sk-cube"></div>
    <div class="sk-cube2 sk-cube"></div>
    <div class="sk-cube4 sk-cube"></div>
    <div class="sk-cube3 sk-cube"></div>
  </div>
</div>
<!-- Preloader -->

<!-- Header -->
<header class="header">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>

      <!-- Logo -->
      <div class="col-md-2 col-sm-6 col-xs-8">
        <a href="#home" class="logo nav home">
          @if(session('logo') != null)
            <img src="{{asset("storage/app/public/web/logo/".session('logo')->img)}}" alt="Logo">
          @endif<!-- Change logo text -->
        </a>
      </div> <!-- end col-sm-6 -->
      <!-- / Logo -->

      <!-- Menu -->
      <div class="col-md-6 text-right hidden-xs hidden-sm">
        <ul class="menu">
          <li><a href="#home" class="nav home">Home</a></li>
          <li><a href="#about" class="nav left">About us</a></li>
          {{--                    <li><a href="#portfolio" class="nav right">Portfolio</a></li>--}}
          <li><a href="#contact" class="nav left">Contact</a></li>
        </ul>
      </div> <!-- end col-sm-6 -->
      <!-- / Menu -->

      <!-- Social link -->
      <div class="col-md-2 text-right hidden-xs hidden-sm">
        <ul class="social">
          <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        </ul>
      </div> <!-- end col-sm-6 -->
      <!-- / Social link -->

      <!-- Mobile Menu -->
      <div class="col-xs-4 col-sm-6 visible-xs visible-sm hidden-md hidden-lg">
        <div class="sandwich_menu">
          <div id="nav-icon2">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>

        <div class="mobile_menu">
          <ul>
            <li><a href="#home" class="nav home">Home</a></li>
            <li><a href="#about" class="nav left_m">About us</a></li>
            {{--                        <li><a href="#portfolio" class="nav right_m">Portfolio</a></li>--}}
            <li><a href="#contact" class="nav left_m">Contact</a></li>
          </ul>
        </div>
      </div>
      <!-- end Mobile Menu -->

      <div class="col-md-1"></div>
    </div> <!-- end row -->
  </div> <!-- end container -->
</header>
<!-- / Header -->

<!-- Overlay - Bg -->
<div class="overlay">
  <div class="overlay-wrapper">
    <div class="overlay-bg-s"></div>
    <div class="overlay-bg"></div>
    @if(session('landingImage') != null )
      <?php $img = session('landingImage')->mediaItem['file'] ?? 'blank.jpg'?>
      <div class="bg-section"
           style="background-image: url('{{asset("storage/app/public/web/album/landing/landing.jpeg")}}')"></div>
    @endif
  </div>
</div>
<!-- / Overlay - Bg -->

<!-- Wrapper -->
<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center block_home">

        <div id="home">
          <h2 class="bold"><b>{{env('APP_NAME')}}</b></h2>

          <div class="headline mb-5">
            <h3 class="wow fadeIn">we are launching in...</h3><!-- end headline -->
          </div>

          <div class="row">
            <div class="col-md-6 col-xs-12 col-md-offset-3">
              <div id="countdown" class="clearfix wow fadeIn" data-time="2022/11/01 00:00:00"></div>
              <!-- end countdown -->

              <div class="newsletter">
                <form id="mc-form">
                  <div class="row">
                    <div class="col-xs-5 col-xs-offset-3 p0 pr-5"><input id="mc-email" type="email" class="form-control"
                                                                         placeholder="Get notified by e-mail"></div>
                    <div class="col-xs-2 text-left p0">
                      <button type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i><b>Send</b></button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12"><label for="mc-email"></label></div>
                  </div>
                </form>
              </div><!-- end newsletter -->
            </div> <!-- end col-md-6 -->
          </div> <!-- end row -->
        </div> <!-- end home -->


        <!-- About -->
        <div id="about" class="text-left pt">
          <div class="row">
            <div class="col-md-2"></div>
            <br>
            <div class="col-md-4">
              <div class="headline wow fadeInLeft">
                <h1>About Us</h1>
              </div>
              <hr class="xs">
              @if(session('profile') != null)
                <p class="subhead wow fadeInLeft wtt" data-wow-delay="0.2s">{{session('profile')->title}}</p>
              @endif
            </div><!-- end col-md-3 -->

            <div class="col-md-7">
              <div class="row boxs wow fadeIn" data-wow-delay="1s">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-md-12 box_one text-justify">
                      {{--                                            <img src="{{asset('public/landing/assets/images/globe.png')}}" alt="">--}}
                      <h3>@if(session('profile') != null)
                          {{session('profile')->title}}
                        @endif</h3>
                      <hr class="xs colorgreen">
                      <p class="subhead fregular">@if(session('profile') != null)
                          {!! session('profile')->about !!}
                        @endif</p>
                    </div><!-- end col-md-6 -->
                  </div><!-- end row -->
                </div>
              </div>
            </div><!-- end col-md-7 -->
            {{--                        <div class="col-md-1"></div>--}}
          </div><!-- end row -->
        </div><!-- end About -->
        <!-- Portfolio -->

        {{--                <div id="portfolio" class="text-left pt">--}}
        {{--                    <div class="row">--}}

        {{--                        <div class="col-md-1"></div>--}}

        {{--                        <div class="col-md-3">--}}
        {{--                            <div class="headline wow fadeInLeft"><h1>Portfolio</h1></div>--}}

        {{--                            <hr class="xs">--}}
        {{--                            <p class="subhead wow fadeInLeft wt" data-wow-delay="0.2s">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}

        {{--                            <div class="category">--}}
        {{--                                <div class="btn-toolbar filters">--}}
        {{--                                    <div class="btn-group wow zoomIn" data-toggle="buttons">--}}
        {{--                                        <ul>--}}
        {{--                                            <li>--}}
        {{--                                                <label data-filter="" class="btn btn-primary active">--}}
        {{--                                                    <input type="radio" name="options" id="option1">All categories--}}
        {{--                                                </label>--}}
        {{--                                            </li>--}}
        {{--                                            <li>--}}
        {{--                                                <label data-filter="one" class="btn btn-primary">--}}
        {{--                                                    <input type="radio" name="options" id="option2"> Print Design <!-- Change name category -->--}}
        {{--                                                </label>--}}
        {{--                                            </li>--}}
        {{--                                            <li>--}}
        {{--                                                <label data-filter="two" class="btn btn-primary">--}}
        {{--                                                    <input type="radio" name="options" id="option3"> Product Design <!-- Change name category -->--}}
        {{--                                                </label>--}}
        {{--                                            </li>--}}
        {{--                                            <li>--}}
        {{--                                                <label data-filter="three" class="btn btn-primary">--}}
        {{--                                                    <input type="radio" name="options" id="option4">Web Design <!-- Change name category -->--}}
        {{--                                                </label>--}}
        {{--                                            </li>--}}
        {{--                                        </ul>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div><!-- end col-md-3 -->--}}

        {{--                        <div class="col-md-7">--}}
        {{--                            <div class="row boxs boxs-height wow fadeIn" data-wow-delay="1s">--}}
        {{--                                <div class="col-sm-12">--}}
        {{--                                    <div id="grids" class="grid">--}}
        {{--                                        <div data-filter="one" class="grid-item w1 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic01.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic01.jpg')}}" alt="pic01">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="two" class="grid-item w2 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic02.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic02.jpg')}}" alt="pic02">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="one" class="grid-item w2 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic03.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic03.jpg')}}" alt="pic03">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="two" class="grid-item w1 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic04.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic04.jpg')}}" alt="pic04">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="one" class="grid-item w1 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic01.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic01.jpg')}}" alt="pic01">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="two" class="grid-item w2 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic02.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic02.jpg')}}" alt="pic02">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="three" class="grid-item w2 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic03.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic03.jpg')}}" alt="pic03">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="three" class="grid-item w1 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic04.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic04.jpg')}}" alt="pic04">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="three" class="grid-item w1 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic01.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic01.jpg')}}" alt="pic01">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="two" class="grid-item w2 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic02.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic02.jpg')}}" alt="pic02">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="one" class="grid-item w2 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic03.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic03.jpg')}}" alt="pic03">--}}
        {{--                                        </div>--}}
        {{--                                        <div data-filter="three" class="grid-item w1 wow zoomIn">--}}
        {{--                                            <a href="{{asset('public/landing/assets/images/portfolio/pic04.jpg')}}" class="popup">--}}
        {{--                                                <div class="img_hover"></div>--}}
        {{--                                            </a>--}}
        {{--                                            <img src="{{asset('public/landing/assets/images/portfolio/pic04.jpg')}}" alt="pic04">--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div><!-- end col-md-7 -->--}}

        {{--                        <div class="col-md-1"></div>--}}
        {{--                    </div><!-- end row -->--}}
        {{--                </div><!-- end Portfolio -->--}}

        <!-- Contact -->
        <div id="contact" class="text-left pt">
          <div class="row">

            <div class="col-md-2"></div>
            <br>
            <div class="col-md-4">
              <div class="headline wow fadeInLeft">
                <h1>Contact <span>Us</span></h1>
              </div>

              <hr class="xs up">

              <div class="contact_table">
                <div class="contact_row wow slideInLeft">
                  <div class="contact_cell">
                    <img src="{{asset('public/landing/assets/images/c_phone.png')}}" alt="contact">
                  </div>

                  <div class="contact_cell">
                    <div class="contact_content">
                      <p class="contact_top">call us</p>
                      <hr class="xs">
                      @if(session('phoneMain') != null)
                        <p class="contact_bottom">{{session('phoneMain')->phone}}</p>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="contact_row wow slideInLeft">
                  <div class="contact_cell">
                    <img src="{{asset('public/landing/assets/images/c_envelope.png')}}" alt="contact">
                  </div>

                  <div class="contact_cell">
                    <div class="contact_content">
                      <p class="contact_top">write us</p>
                      <hr class="xs">
                      @if(session('emailMain') != null)
                        <p class="contact_bottom">{{session('emailMain')->email}}</p>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="contact_row wow slideInLeft">
                  <div class="contact_cell">
                    <img src="{{asset('public/landing/assets/images/c_place.png')}}" alt="contact">
                  </div>

                  <div class="contact_cell">
                    <div class="contact_content">
                      <p class="contact_top">visit us</p>
                      <hr class="xs">
                      @if(session('address') != null && session('country_name') != null)
                        <p class="contact_bottom">{{session('address')->address}}</p>
                        <p
                          class="contact_bottom">{{session('address')->city.", ".session('address')->countryName['country_name']}}</p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- end col-md-3 -->

            <div class="col-md-7">
              <div class="row boxs wow fadeIn" data-wow-delay="1s">
                <div class="col-sm-12">

                  <form id="ajax-contact" method="post" action="#.">
                    @csrf
                    <div id="form-messages"></div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Your Name"
                             data-error="Please type your name!!!" required>
                      <div class="help-block with-errors"></div>
                    </div><!-- end form-group -->

                    <div class="form-group">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Your Email"
                             data-error="Bruh, that email address is invalid" required>
                      <div class="help-block with-errors"></div>
                    </div><!-- end form-group -->

                    <div class="form-group">
                      <input type="text" class="form-control" id="subject" name="subject" placeholder="Your Subject"
                             data-error="Please type your subject!!!" required>
                      <div class="help-block with-errors"></div>
                    </div><!-- end form-group -->

                    <div class="form-group">
                      <textarea class="form-control" rows="8" id="message" name="message" placeholder="Your Message"
                                data-error="Please type your message!!!" required></textarea>
                      <div class="help-block with-errors"></div>
                    </div><!-- end form-group -->

                    <div class="help-block msg-finish"></div>
                    <button type="submit" class="btn btn-transparent">Send</button>
                  </form><!-- end form -->

                </div>
              </div>
            </div><!-- end col-md-7 -->
            {{--                        <div class="col-md-1"></div>--}}
          </div><!-- end row -->
        </div><!-- end Contact -->

      </div> <!-- end col-md-12 -->
    </div> <!-- end row -->
  </div><!-- end container -->
</div>
<!-- / Wrapper -->

<!-- JS -->
<script src='{{asset('public/landing/assets/js/jquery.min.js')}}'></script>
<script src='{{asset('public/landing/assets/js/bootstrap.min.js')}}'></script>
<script src='{{asset('public/landing/assets/js/wow.min.js')}}'></script>
<script src='{{asset('public/landing/assets/js/jquery.countdown.min.js')}}'></script>
7
<script src='{{asset('public/landing/assets/js/masonry-3.1.4.js')}}'></script>
<script src='{{asset('public/landing/assets/js/magnific-popup.min.js')}}'></script>
<script src='{{asset('public/landing/assets/js/mail.js')}}'></script>
<script src='{{asset('public/landing/assets/js/jquery.ajaxchimp.min.js')}}'></script>
<script src='{{asset('public/landing/assets/js/ofi.browser.js')}}'></script>
<script src='{{asset('public/landing/assets/js/jquery.mCustomScrollbar.concat.min.js')}}'></script>
<script src='{{asset('public/landing/assets/js/script.js')}}'></script>


</body>

</html>
