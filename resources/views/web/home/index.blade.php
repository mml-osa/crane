@extends('web.layout.main')
@section('content')


<!-- INTRO SECTION -->
<section class="intro-section section-block">
  <div class="container">
    <div class="section-title">
      @foreach($posts as $post)
      @if($post->alias == 'welcome')
      <h2>{{$post->title}}</h2>
      <p class="lead">
        {{$post->caption}}
      </p>
        @endif
      @endforeach
    </div><!-- .section-title -->
    <div class="row">
      <div class="col-xl-4 col-lg-6" data-aos="fade-up">
        <div class="item-wrapper">
          <div class="icon-box"><i class="pe-7s-science"></i></div>
          <div class="content-wrapper">
            <h3>Creativity</h3>
            <p>
              The act of using one's imagination and intellect to generate unique ideas or solutions.
            </p>
          </div> <!-- .content-wrapper -->
        </div> <!-- .item-wrapper -->
      </div>
      <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1200">
        <div class="item-wrapper">
          <div class="icon-box"><i class="pe-7s-diamond"></i></div>
          <div class="content-wrapper">
            <h3>Dedication</h3>
            <p>
              Consistently putting in effort and showing a strong commitment towards a particular goal or purpose.
            </p>
          </div> <!-- .content-wrapper -->
        </div> <!-- .item-wrapper -->
      </div>
      <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1200">
        <div class="item-wrapper">
          <div class="icon-box"><i class="pe-7s-rocket"></i></div>
          <div class="content-wrapper">
            <h3>Hard Work</h3>
            <p>
              Being hardworking involves putting in consistent effort and demonstrating a strong work ethic towards achieving one's goals or objectives.
            </p>
          </div> <!-- .content-wrapper -->
        </div> <!-- .item-wrapper -->
      </div>
    </div> <!-- .row -->
  </div> <!-- .container -->

</section> <!-- .intro-section -->

<!-- FACTS SECTION -->
{{--<section class="facts-section section-block">--}}
{{--  <div class="container">--}}
{{--    <div class="section-title dark visually-hidden">--}}
{{--      <h2>Fun Facts</h2>--}}
{{--    </div><!-- .section-title -->--}}
{{--    <div class="row">--}}
{{--      <div class="col-xl-3 col-md-6 text-center" data-aos="fade-up">--}}
{{--        <div class="icon-box"><i class="pe-7s-plugin"></i></div>--}}
{{--        <h3>Digital<br>Products</h3>--}}
{{--        <p class="number-data"><strong class="counter">30</strong></p>--}}
{{--      </div>--}}
{{--      <div class="col-xl-3 col-md-6 text-center" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">--}}
{{--        <div class="icon-box"><i class="pe-7s-users"></i></div>--}}
{{--        <h3>Clients<br>Wordwide</h3>--}}
{{--        <p class="number-data"><strong class="counter">200</strong><span>+</span></p>--}}
{{--      </div>--}}
{{--      <div class="col-xl-3 col-md-6 text-center" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="400">--}}
{{--        <div class="icon-box"><i class="pe-7s-portfolio"></i></div>--}}
{{--        <h3>Total<br>Projects</h3>--}}
{{--        <p class="number-data"><strong class="counter">15</strong><span>+</span></p>--}}
{{--      </div>--}}
{{--      <div class="col-xl-3 col-md-6 text-center" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="600">--}}
{{--        <div class="icon-box"><i class="pe-7s-cup"></i></div>--}}
{{--        <h3>Happy<br>Clients</h3>--}}
{{--        <p class="number-data"><strong class="counter">11</strong></p>--}}
{{--      </div>--}}
{{--    </div> <!-- .row -->--}}
{{--  </div> <!-- .container -->--}}
{{--</section> <!-- .facts-section -->--}}

<!-- SKILL SECTION -->
<section class="skill-section section-block" id="skill-section"></section> <!-- .skill-section -->

<!-- ABOUT SECTION -->
<section class="about-section section-block" id="about-section" data-aos="fade-up">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 image-block" data-aos="fade-right" data-aos-delay="200" data-aos-duration="2000">
        <div class="img-wrapper about-img-wrap" data-tilt data-tilt-max="10">
          <img class="about-img-1 img-fluid" src="{{asset('public/web/image/about-image-1.png')}}" alt="about image">
        </div>
      </div>
      <div class="col-xl-6 content-block" data-aos="fade-right" data-aos-delay="400" data-aos-duration="2000">
        @foreach($posts as $post)
          @if($post->alias == 'welcome')
            <h2><span>About Me</span>A Senior Developer From GH</h2>
            <p class="lead">
              {!! $post->content !!}
            </p>
          @endif
        @endforeach
        <div class="personal-details row">
          <div class="col-md-6">
            <a class="btn-main" href="#contact-section">Get In Touch</a>
          </div> <!-- .col-md-6 -->

        </div> <!-- .personal-details -->
{{--        <a class="btn-main" href="#">Download CV</a>--}}
      </div>
    </div> <!-- .row -->
  </div> <!-- .container -->
</section> <!-- .about-section -->

<!-- SERVICE SECTION -->
<section class="service-section section-block" id="service-section">
  <div class="container">
    <div class="section-title dark">
      @foreach($posts as $post)
        @if($post->alias == 'my-services')
          <h2>{{$post->title}}</h2>
          <p class="lead">
            {{$post->caption}}
          </p>
        @endif
      @endforeach
    </div><!-- .section-title -->
    <div class="row">
      @foreach($posts as $post)
        @if($post->postCategory['alias'] == 'services')
          <div class="col-xl-4 col-lg-6" data-aos="fade-up">
            <div class="content-wrapper service-tilt" data-tilt data-tilt-max="15">
              <div class="icon-box"><i class="pe-7s-monitor"></i></div>
              <h3>{{$post->title}}</h3>
              <p>
                {!! $post->content !!}
              </p>
            </div>
          </div>
        @endif
      @endforeach
    </div><!-- .row -->
  </div> <!-- .container -->
</section> <!-- .service-section -->

<!-- CONTACT SECTION -->
<section class="contact-section section-block" id="contact-section">
  <div class="container">
    <div class="section-title">
      @foreach($posts as $post)
        @if($post->alias == 'get-in-touch')
          <h2>{{$post->title}}</h2>
          <p class="lead">
            {{$post->caption}}
          </p>
        @endif
      @endforeach
    </div><!-- .section-title -->

    <div class="row contact-options">
      <div class="col-lg-4 d-flex justify-content-xxl-center align-items-xl-center" data-aos="fade-down" data-aos-duration="1000">
        <div class="icon-box"><i class="pe-7s-map-marker"></i></div>
        <div class="content-wrapper">
          <h4>Address</h4>
          @foreach(session('addresses') as $address)
            <address>{{$address->address}}, {{$address->city}}, {{$address->country_data['country_name']}}</address>
          @endforeach
        </div>
      </div>
      <div class="col-lg-4 d-flex justify-content-xxl-center align-items-xl-center" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">
        <div class="icon-box"><i class="pe-7s-call"></i></div>
        <div class="content-wrapper">
          <h4>Phone</h4>
          @foreach(session('phones') as $phone)
            <a href="tel:{{$phone->phone}}">({{$address->country_data['country_code']}}) {{$phone->phone}}</a>
          @endforeach
        </div>
      </div>
      <div class="col-lg-4 d-flex justify-content-xxl-center align-items-xl-center" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="400">
        <div class="icon-box"><i class="pe-7s-mail"></i></div>
        <div class="content-wrapper">
          <h4>Email</h4>
          @foreach(session('emails') as $email)
            <a href="mailto:{{$email->email}}">{{$email->email}}</a>
          @endforeach
        </div>
      </div>
    </div> <!-- .row -->

    <div class="row">
      <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="600">
        <div class="map-wrapper" id="mapwrapper">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.01842024671!2d-0.16354548433419244!3d5.7104763336620055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf9d4735b77bd1%3A0x5c30148712e7cfce!2sVanilla%20St%2C%20Adenta%20Municipality!5e0!3m2!1sen!2sgh!4v1676969465831!5m2!1sen!2sgh" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
      <div class="col-lg-6 form-block" data-aos="fade-right" data-aos-duration="1500" data-aos-delay="1100">
        <h3>Write me a message</h3>
        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
          Thank you for getting in touch!
        </div>
        <br>
        <form class="row g-3" id="SubmitForm">
          @csrf
          <div class="col-md-6">
            <div class="input-group mb-3">
              <label for="name" class="form-label visually-hidden">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" placeholder="Name*" required>
              <span class="text-danger" id="nameErrorMsg"></span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group mb-3">
              <label for="email" class="form-label visually-hidden">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" {{ old('email') }} placeholder="Email*" required>
              <span class="text-danger" id="emailErrorMsg"></span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="input-group mb-3">
              <label for="subject" class="form-label visually-hidden">Subject</label>
              <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" {{ old('subject') }} name="subject" placeholder="Subject*" required>
              <span class="text-danger" id="subjectErrorMsg"></span>
            </div>
          </div>
          <div class="col-md-12">
            <label for="message" class="form-label visually-hidden">Message</label>
            <textarea class="form-control @error('name') is-invalid @enderror mb-3" id="message" name="message" placeholder="Your message here*" required>{{ old('message') }}</textarea>
            <span class="text-danger" id="messageErrorMsg"></span>

            <input type="hidden" name="mailTo" value="<?php echo session('formMail')->email ?>">
            <button data-sitekey="{{env('RECAPTCHA_SITE_KEY_V3')}}" data-callback='onSubmit' data-action='submit' class="btn btn-main g-recaptcha">Send Message</button>
          </div>
        </form> <!-- .row -->

        <script>
          function onSubmit(token) {
            // document.getElementById("SubmitForm").submit();
            console.log('working');
            // e.preventDefault();
            let name = $('#name').val();
            let email = $('#email').val();
            let subject = $('#subject').val();
            let message = $('#message').val();

            console.log(message);

            $.ajax({
              type:"POST",
              url: "{{ route('contact.submit') }}",
              data:{
                "_token": "{{ csrf_token() }}",
                name:name,
                email:email,
                subject:subject,
                message:message,
              },
              success:function(response){
                $('#successMsg').show();
                console.log(response);
                document.getElementById("SubmitForm").reset();
              },
              error: function(response) {
                $('#nameErrorMsg').text(response.responseJSON.errors.name);
                $('#emailErrorMsg').text(response.responseJSON.errors.email);
                $('#mobileErrorMsg').text(response.responseJSON.errors.mobile);
                $('#messageErrorMsg').text(response.responseJSON.errors.message);
              },
            });
          }
        </script>

      </div>
    </div> <!-- .row -->
  </div> <!-- .container -->
</section> <!-- .contact-section -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>

{{--<script type="text/javascript">--}}

{{--  function myFunction() {--}}
{{--    console.log('working');--}}
{{--    $('#SubmitForm').on('submit',function(e){--}}

{{--      e.preventDefault();--}}

{{--      let name = $('#name').val();--}}
{{--      let email = $('#email').val();--}}
{{--      let subject = $('#subject').val();--}}
{{--      let message = $('#message').val();--}}

{{--      $.ajax({--}}
{{--        url: "/contact/submit",--}}
{{--        type:"POST",--}}
{{--        data:{--}}
{{--          "_token": "{{ csrf_token() }}",--}}
{{--          name:name,--}}
{{--          email:email,--}}
{{--          subject:subject,--}}
{{--          message:message,--}}
{{--        },--}}
{{--        success:function(response){--}}
{{--          $('#successMsg').show();--}}
{{--          console.log(response);--}}
{{--        },--}}
{{--        error: function(response) {--}}
{{--          $('#nameErrorMsg').text(response.responseJSON.errors.name);--}}
{{--          $('#emailErrorMsg').text(response.responseJSON.errors.email);--}}
{{--          $('#mobileErrorMsg').text(response.responseJSON.errors.mobile);--}}
{{--          $('#messageErrorMsg').text(response.responseJSON.errors.message);--}}
{{--        },--}}
{{--      });--}}
{{--    });--}}
{{--  }--}}
{{--</script>--}}

@endsection
