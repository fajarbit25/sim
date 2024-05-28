<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{$title}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{url('Home/assets/img/favicon-iqis.png')}}" rel="icon">
  <link href="{{url('Home/assets/img/favicon-iqis.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{url('Home/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{url('Home/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('Home/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{url('Home/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{url('Home/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{url('Home/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  {{-- Vendor JQuery --}}
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!-- Template Main CSS File -->
  <link href="{{url('Home/assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">{{$contact->email_campus}}</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>{{$contact->campus_contact}}</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="https://www.youtube.com/channel/UCZcQXArBRQmtFaTkvqlQlwA" target="_blank" class="twitter"><i class="bi bi-youtube"></i></a>
        <a href="http://fb.me/ibnulqayyim.sch.id" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="http://instagram.com/iqismakassar" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="http://t.me/iqismakassar" target="_blank" class="linkedin"><i class="bi bi-telegram"></i></a>
        <a href="{{url('/dashboard')}}"><i class="bi bi-person-circle"></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      {{-- <h1 class="logo"><a href="index.html">IQIS<span>.</span></a></h1> --}}
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="/" class="logo"><img src="{{url('Home/assets/img/iqis-logo.png')}}" alt=""></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{url('/#hero')}}">Home</a></li>
          <li><a class="nav-link scrollto" href="{{url('/#about')}}">Tentang Kami</a></li>
          <li><a class="nav-link scrollto" href="{{url('/#services')}}">Fasilitas</a></li>
          <li><a class="nav-link scrollto " href="{{url('/#team')}}">Team</a></li>
          <li><a class="nav-link scrollto " href="{{url('/#portfolio')}}">Berita</a></li>
          <li class="dropdown"><a href="#"><span>PPDB</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="/tkit/ppdb">PPDB TKIT</a></li>
              <li><a href="/sdit/ppdb">PPDB SDIT</a></li>
              <li><a href="/smpit/ppdb">PPDB SMPIT</a></li>
              <li><a href="/smkit/ppdb">PPDB SMKIT</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="{{url('/#contact')}}">Contact</a></li>
          <li><a class="nav-link scrollto" href="{{url('/dashboard')}}">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->



  @yield('main');

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Ibnu Qayyim <span>Islamic School</span></h3>
            <p> {{$contact->campus_alamat}} <br/>
              <strong>Phone:</strong> {{$contact->campus_contact}}<br>
              <strong>Email:</strong> {{$contact->email_campus}}<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{url('/')}}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{url('/#about')}}">Tentang Kami</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{url('/#services')}}">Fasilitas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{url('/#portfolio')}}">Berita</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{url('/#team')}}">Tim</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{url('/#contact')}}">Kontak</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{url('/dashboard')}}">Login</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Social Media</h4>
            <p>Anda juga dapat mengikuti kami melalui sosial media.</p>
            <div class="social-links mt-3">
              <a href="https://www.youtube.com/channel/UCZcQXArBRQmtFaTkvqlQlwA" target="_blank" class="twitter"><i class="bi bi-youtube"></i></a>
              <a href="http://fb.me/ibnulqayyim.sch.id" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="http://instagram.com/iqismakassar" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="http://t.me/iqismakassar" target="_blank" class="linkedin"><i class="bi bi-telegram"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>IQIS</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="#">Purnama Sinar Gemilang</a> | ENV : Development
      </div>
    </div>
  </footer><!-- End Footer -->

  {{-- <div id="preloader"></div> --}}
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{url('Home/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{url('Home/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{url('Home/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('Home/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{url('Home/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{url('Home/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{url('Home/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{url('Home/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{url('Home/assets/js/main.js')}}"></script>

  {{-- Sweet Alert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Flash Mesege -->
  @if ($message = Session::get('success'))
    <script type="text/javascript">
        Swal.fire({
          icon: 'success',
          title: 'Congrats...',
          text: "{{ $message }}",
        });
    </script>
  @endif
  @if ($message = Session::get('warning'))
  <script type="text/javascript">
      Swal.fire({
        icon: 'warning',
        title: 'Alert...',
        text: "{{ $message }}",
      });
  </script>
  @endif
</body>

</html>