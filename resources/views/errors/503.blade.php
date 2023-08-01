
<?php
$company = \App\Models\Profile\CcAbout::first();
$email = \App\Models\Profile\CcEmail::where('main',1)->first();
$phone = \App\Models\Profile\CcPhone::where('main',1)->first();
$address = \App\Models\Profile\CcAddress::where('main',1)->first();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ $company->title }} :: Under Maintenance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('public/maintenance/img/favicon.ico') }}" rel="shortcut icon">
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('public/maintenance/maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') }}">
    <link href="{{ asset('public/maintenance/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/maintenance/css/jquery.pagepiling.css') }}" rel="stylesheet">
    <link href="{{ asset('public/maintenance/css/selectik.css') }}" rel="stylesheet">
    <link href="{{ asset('public/maintenance/css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('public/maintenance/css/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('public/maintenance/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('public/maintenance/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/maintenance/css/style.css') }}" rel="stylesheet">
</head>
<body class="under-construction">
<div class="loader">
    <div class="loader-inner line-scale">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<header>
    <div class="soc-block">
        <div class="soc-link">
            <img class="svg img-responsive soc-link-img" src="{{ asset('public/maintenance/img/svg/share.svg') }}" alt="share">
        </div>

        <div class="social-links-wrap">
            <div class="social-links animated fadeOutRight">
                <?php
                    $socials = \App\Models\Profile\CcSocial::get();
                ?>
                <a href="#" class="social-btn soc-link-close">
                    <img class="svg" width="13" height="13" src="{{ asset('public/maintenance/img/svg/close.svg') }}" alt="close">
                </a>
                    @foreach($socials as $social)
{{--                        @if ($social->alias == 'facebook')--}}
                            <a target="_blank" href="{{ $social->link ?? "#" }}" class="social-btn">
                                <img class="svg" width="25" height="25" src="{{ asset("public/maintenance/img/svg/social/$social->title.svg") }}" alt="Facebook">
                            </a>
{{--                        @endif--}}
                    @endforeach
            </div>
        </div>
    </div>
</header>

<div class="general-block pagepiling">

    <section id="page1" class="wrap-block">
        <div class="container-wrap-block">
            <div class="container-wrazp">
                <div class="container">
                    <div data-duration="1000" class="row animated right-animate ">
                        <div class="col-sm-12 col-xs-12">
                            <h2>
                                <span class="h-under">U</span>NDER MAINTENANCE
                            </h2>
                        </div>
                    </div>
                </div>

                <div data-duration="1900" class="animated left-animate adress-container">
                    <div class="container">
                        <div class="row">
                            <div class="adress-block col-sm-6 col-xs-12">
                                {{ $address->address }} <br/>
                                {{ $address->city }}, {{ $address->countryProp['country_name'] }} <br/>
                                Tel: ({{ $address->countryProp['zip_code'] }}) {{ $phone->phone }} <br/>
                                Email: {{ $email->email }}	 <br/>
                            </div>
                            <div class="form-block col-sm-6 col-xs-12">
{{--                                @component('components.messages')@endcomponent--}}
                                <form action="{{ route('contact.submit') }}" role="form" class="contact-form" method="post">
                                    @csrf
                                    <div class="border-top"></div>
                                    <div class="border-bottom"></div>
                                    <div class="form-group name">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                    </div>

                                    <div class="form-group email">
                                        <input type="email" class="form-control" name="email" placeholder="Your email">
                                    </div>

                                    <div class="form-group comment">
                                        <textarea class="form-control" name="comment" placeholder="Message"></textarea>
                                    </div>
                                    <button type="submit" class="btn">
                                        <input type="hidden" name="mail_to" id="mail_to" value="{{ $email->email }}" />
                                        <span class="form-message" style="display: none;"></span>Send
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- adress-container -->
            </div>

            <div class="footer animated down-animate">
                <div class="footer-block">
                    <a href="https://www.mavenhub.net/" target="_blank">Powered By: <img src="{{ asset('public/admin/assets/images/logo/maven_hub_logo.png') }}" alt="Maven Hub" width="100"></a>
                </div>
            </div><!-- footer -->
        </div><!-- container-wrap-block -->
    </section><!-- page3 -->

</div><!-- general-block -->

<!--[if (!IE)|(gt IE 8)]><!-->
<script src="{{ asset('public/maintenance/js/jquery-2.1.3.min.js') }}"></script>
<!--<![endif]-->

<!--[if lte IE 8]>
<script src="{{ asset('public/maintenance/js/jquery-1.9.1.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('public/maintenance/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/maintenance/js/jquery.carouFredSel-6.2.1-packed.js') }}"></script>
<script src="{{ asset('public/maintenance/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('public/maintenance/js/jquery.mCustomScrollbar.js') }}"></script>
<script src="{{ asset('public/maintenance/js/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('public/maintenance/js/jquery.pagepiling.js') }}"></script>
<script src="{{ asset('public/maintenance/js/jquery.selectik.min.js') }}"></script>
<script src="{{ asset('public/maintenance/js/jquery.touchwipe.min.js') }}"></script>
<script src="{{ asset('public/maintenance/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/maintenance/js/responsiveslides.min.js') }}"></script>
<script src="{{ asset('public/maintenance/js/forms.js') }}"></script>
<script src="{{ asset('public/maintenance/js/main.js') }}"></script>
</body>

</html>
