<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{$title}}</title>
  <!-- Favicons -->
  <link href="{{url('Admin/assets/img/favicon.png')}}" rel="icon">
  <link href="{{url('Admin/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

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
  <style>
    *{
      font-size: 9px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-12 my-5">
        
        <img src="{{asset('Admin/assets/img/kop-surat/smkit.png')}}" alt="" style="width: 100%">
      </div>

      <div class="col-10">
        <h5 class="card-title"> 
          TANDA BUKTI PENDAFTARAN <br/> 
          PENERIMAAN PESERTA DIDIK BARU
        </h5>
        <P>Tahun Pelajaran 2022/2023</P>
      </div>
      <div class="col-2 my-3">
        <img src="{{Auth::user()->photo}}" style="width: 100px" alt="img">
      </div>
    
      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <td class="bg-light" colspan="5"><strong>Info Pendaftaran</strong></td>
            </tr>
            <tr>
              <td>Nomor Pendaftaran</td>
              <td>Nomor Formulir</td>
              <td>Lokasi Pendaftaran</td>
              <td>Jalur</td>
            </tr>
            <tr>
              <td><strong>{{$ppdb->nomor_pendaftaran}}</strong></td>
              <td>#{{$ppdb->nomor_formulir}}</td>
              <td>{{$ppdb->lokasi_pendaftaran}}</td>
              <td>{{$ppdb->jalur}}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-8">
        <table class="table table-bordered">
          <tr>
            <td colspan="2"><strong>Biodata Siswa</strong></td>
          </tr>
          <tr>
            <td class="bg-light">Nomor Peserta</td>
            <td>909070040089</td>
          </tr>
          <tr>
            <td class="bg-light">NISN</td>
            <td>{{$student->nisn}}</td>
          </tr>
          <tr>
            <td class="bg-light">Nama Lengkap</td>
            <td>{{$user->first_name}}</td>
          </tr>
          <tr>
            <td class="bg-light">Jenis Kelamin</td>
            <td>{{$student->gender}}</td>
          </tr>
          <tr>
            <td class="bg-light">Tempat, Tanggal Lahir</td>
            <td>{{$student->tempat_lahir}}, {{$student->tanggal_lahir}}</td>
          </tr>
          <tr>
            <td class="bg-light">Alamat</td>
            <td>
              {{$alamat->jalan.', '.$alamat->kel.', KEC.'.$alamat->kec.', '.$alamat->kota.', '.$alamat->provinsi.' '.$alamat->kode_pos}}
            </td>
          </tr>
          <tr>
            <td class="bg-light">Sekolah Asal</td>
            <td>{{$register->sekolah_asal}}</td>
          </tr>
          <tr>
            <td class="bg-light">Jenis Lulusan</td>
            <td>Reguler</td>
          </tr>
          <tr>
            <td class="bg-light">Tahun Lulus</td>
            <td>{{substr(date('Y'), 0, 2).substr($register->nomor_ijazah, 15, 2)}}</td>
          </tr>
        </table>
      </div>

      <div class="col-4">
        <table class="table table-bordered">
          <tr>
            <td colspan="3"><strong>Data Nilai Siswa</strong></td>
          </tr>
          <tr>
            <td class="bg-light">B.IND</td>
            <td class="bg-light">MTK</td>
            <td class="bg-light">IPA</td>
          </tr>
          <tr>
            <td>{{$register->bahasa_indonesia}}</td>
            <td>{{$register->matematika}}</td>
            <td>{{$register->ipa}}</td>
          </tr>
        </table>

        <table class="table table-bordered">
          <tr>
            <td colspan="4"><strong>Data Prestasi</strong></td>
          </tr>
          <tr>
            <td class="bg-light">Jenis</td>
            <td class="bg-light">Nama</td>
            <td class="bg-light">Tahun</td>
            <td class="bg-light">Tingkat</td>
          </tr>
          @foreach($prestasi as $pres)
          <tr>
            <td>{{$pres->jenis}}</td>
            <td>{{$pres->nama_prestasi}}</td>
            <td>{{$pres->tahun}}</td>
            <td>{{$pres->tingkat}}</td>
          </tr>
          @endforeach
        </table>
      </div>

      <div class="col-12">
        <table class="table table-bordered">
          <tr>
            <td class="text-center">
              @if($ppdb->status == 200)
                <h2 class="card-title">Status : LULUS</h2>
              @elseif($ppdb->status == 500)
                <h2 class="card-title">Status : TIDAK LULUS</h2>
              @else
                <h2 class="card-title">Status : Verifikasi</h2>
              @endif
            </td>
          </tr>
        </table>
      </div>

      <div class="col-12">
        <table class="table table-bordered">
          <tr>
            <td>
              <strong>PERINGATAN ! </strong> Siswa yang dinyatakan diterima namun <strong>TIDAK MENDAFTAR ULANG </strong>
              sesuai jadwal yang ditentukan, dianggap <strong>MENGUNDURKAN DIRI.</strong>
            </td>
          </tr>
        </table>
      </div>

      <div class="col-8 mb-3">
        {!! $qrcode !!}
      </div>
      <div class="col-4 mb-3">
        Dokumen ini resmi dikeluarkan oleh <strong>Yayasan Pendidikan Islam Ibnul Qayyim Makassar </strong>
        melalui <i>https://iqis.sch.id</i> 
      </div>


    </div>
    {{-- Row --}}
  </div>


  <!-- Vendor JS Files -->
  <script src="{{url('Admin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
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
  <script>
    window.print();
  </script>
</body>
</html>