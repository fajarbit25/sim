<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" id="csrf_token" content="{{ csrf_token() }}" />
  <meta name="viewport"  content="width=device-width, initial-scale=1">

  <title>{{$title}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('/Admin/assets/img/favicon-iqis.png')}}" rel="icon">
  <link href="{{asset('/Admin/assets/img/favicon-iqis.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{url('Admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('Admin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{url('Admin/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{url('Admin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{url('Admin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{url('Admin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{url('Admin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
   
  <!-- Vendor Ajax JQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!-- Template Main CSS File -->
  <link href="{{url('Admin/assets/css/style.css')}}" rel="stylesheet">

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  {{-- Select2 --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


  @livewireStyles
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/dashboard" class="logo d-flex align-items-center">
        <img src="{{asset('/Admin/assets/img/favicon-iqis.png')}}" alt="">
        <span class="d-none d-lg-block">SIM IQIS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{Auth::user()->photo}}" alt="Profile" class="rounded-circle">

            <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->first_name}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</h6>
              
              @if(Auth::user()->level == 0)<span>Superadmin</span>@endif
              @if(Auth::user()->level == 1)<span>Administrator</span>@endif
              @if(Auth::user()->level == 2)<span>Guru</span>@endif
              @if(Auth::user()->level == 3)<span>Staf</span>@endif
              @if(Auth::user()->level == 4)<span>User</span>@endif
              @if(Auth::user()->level == 5)<span>Finance</span>@endif
              

            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            @if(Auth::user()->level == 4)
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{url('/siswa/profile')}}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            @else
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{url('/profile')}}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              @endif
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="{{route('logout')}}" method="post">
              <button type="submit" class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                @csrf
                <span>Sign Out</span>
              </button>
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
  
  {{-- Akses Menu Berdasarkan role user --}}
 {{-- Superadmin --}}
  @if(Auth::user()->level == 0)
    @include('template.aside-0')
  @endif

  {{-- Administrator --}}
  @if(Auth::user()->level == 1)
    @include('template.aside-1')
  @endif

  {{-- Guru --}}
  @if(Auth::user()->level == 2)
    @include('template.aside-2')
  @endif

  {{-- Orang Tua / Siswa --}}
  @if(Auth::user()->level == 4)
    @include('template.aside-4')
  @endif

    {{-- Bendahara --}}
  @if(Auth::user()->level == 5)
    @include('template.aside-5')
  @endif

  {{-- End Akses Menu Berdasarkan role user --}}
  @yield('main')
  
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SIMS</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="#">PurnamaSinarGemilang</a> | ENV : Development
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  {{-- <script src="{{url('Admin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script> --}}
  <script src="{{url('Admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('Admin/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{url('Admin/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{url('Admin/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{url('Admin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{url('Admin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{url('Admin/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{asset('Admin/assets/js/sims.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{url('Admin/assets/js/main.js')}}"></script>

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

@stack('scripts')
@livewireScripts
</body>

</html>