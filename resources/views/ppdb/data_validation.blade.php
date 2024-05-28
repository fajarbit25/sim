<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" id="csrf_token" content="{{ csrf_token() }}" />

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

</head>

<body>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Validate</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="row">

                <div class="col-sm-10">
                  <h5 class="card-title"> 
                    VALIDASI DOKUMEN
                  </h5>
                </div>
                @if($cek == 0)

                    <div class="col-12">
                        <table class="table table-bordered">
                        <tr>
                            <td class="text-center">
                                <h2 class="card-title text-danger">Status : TIDAK VALID</h2>
                            </td>
                        </tr>
                        </table>
                    </div>
    
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                        <tr>
                            <td>
                            <strong>CATATAN ! </strong><br/>
                            Dokumen <strong>Tidak Ditemukan</strong>, 
                            Dokumen yang sah hanya dibuat melalui <strong><i>https://iqis.sch.id</i></strong>.
                            </td>
                        </tr>
                        </table>
                    </div>

                @else 

                <div class="col-12">
                    <table class="table table-bordered">
                        <tr>
                          <th class="bg-secondary">Jenis Dokumen</th>
                          <th class="bg-secondary">Pemilik Dokumen</th>
                        </tr>
                        <tr>
                            <td>PPDB</td>
                            <td>{{$user->first_name}}</td>
                        </tr>
                      </table>
                </div>

                <div class="col-12">
                  <table class="table table-bordered">
                    <tr>
                      <td class="text-center">
                          <h2 class="card-title">Status : VALID</h2>
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="col-sm-12">
                  <table class="table table-bordered">
                    <tr>
                      <td>
                        <strong>CATATAN ! </strong><br/>
                        Dokumen ini dikeluarkan oleh <strong>IBNUL QAYYIM ISLAMIC SCHOOL</strong>, 
                        Melalui <strong><i>https://iqis.sch.id</i></strong>.
                      </td>
                    </tr>
                  </table>
                </div>

                @endif


              </div>
              {{-- Row --}}
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

{{-- JavaScript --}}
<script src="{{asset('Admin/assets/js/guru.js')}}"></script>

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
</body>

</html>