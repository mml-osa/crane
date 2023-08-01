<!-- SITE FOOTER -->
<footer class="site-footer" id="site-footer">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-lg-6 text-center branding-block">
{{--        <a class="footer-brand" href="#"><img src="{{asset('public/web/image/fungi_logo.png')}}" alt="Pori logo"></a>--}}
        <p>
          @foreach($posts as $post)
            @if($post->alias == 'footer-quote')
              {!! $post->content !!}
            @endif
          @endforeach
        </p>
        <ul class="list-inline footer-social">
          @foreach($socials as $social)
            <li class="list-inline-item"><a href="{{$social->link}}" target="_blank"><i class="fab fa-{{$social->alias}}"></i></a></li>
          @endforeach
        </ul>
      </div>

    </div> <!-- .row -->

{{--    <div class="row g-0">--}}
{{--      <div class="col-auto ms-auto" style="margin-top: -70px;">--}}
{{--        <a href="#." onclick="topFunction()" id="myBtn"><i class="fa fa-chevron-circle-up" style="font-size: 50px;color: #fff;"></i></a>--}}
{{--      </div>--}}
{{--    </div>--}}

    <div class="back-to-top"><a href="#site-header" id="back-to-top"><i class="bi bi-box-arrow-up"></i></a></div>

    <div class="row footer-bottom">
      <div class="col-md-6">
        <p>&copy; {{date('Y')}}, All rights reserved! <strong>{{env('APP_NAME')}}</strong></p>
      </div>
      <div class="col-md-6">
        <ul class="list-inline text-md-end">
          <li class="list-inline-item"><a href="#">Terms &amp; Condition</a></li>
          <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul>
      </div>
    </div> <!-- .footer-bottom -->
  </div> <!-- .container -->
</footer> <!-- .site-footer -->