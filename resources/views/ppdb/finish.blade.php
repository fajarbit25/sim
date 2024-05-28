@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>PPDB</h1>
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
              <h5 class="card-title"> Progres Pendaftaran </h5>
              <!-- Progress Bars with labels-->
              <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{$percent}}%" aria-valuenow="{{$valueNow}}" aria-valuemin="0" aria-valuemax="$valueMax">{{$percent}}%</div>
              </div>
              <!-- End Progress Bars with labels-->
            </div>
          </div>
        </div>

        @if($ppdb->status == 200)
        <div class="col-lg-12">
          <div class="alert alert-info">
            <p class="fw-bold">
              {{Auth::user()->first_name}}, SELAMAT ANDA DINYATAKAN LULUS SELEKSI BERKAS PPDB 
              IBNUL QAYYIM ISLAMIC SCHOOL TAHUN {{$master->tahun_penerimaan}}
            </p>
          </div>
        </div>
        @elseif($ppdb->status == 500)
        <div class="col-lg-12">
          <div class="alert alert-danger">
            <p class="fw-bold">
              {{Auth::user()->first_name}}, ANDA DINYATAKAN TIDAK LULUS SELEKSI BERKAS PPDB 
              IBNUL QAYYIM ISLAMIC SCHOOL TAHUN {{$master->tahun_penerimaan}}
            </p>
          </div>
        </div>
        @endif

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="row">

                <div class="col-sm-10">
                  <h5 class="card-title"> 
                    TANDA BUKTI PENDAFTARAN <br/> 
                    PENERIMAAN PESERTA DIDIK BARU
                  </h5>
                  <P>Tahun Pelajaran {{$master->tahun_id}}</P>
                </div>
                <div class="col-sm-2 my-3 text-center">
                  <img src="{{asset('storage/document/'.$doc->foto)}}" style="width: 150px" alt="img">
                </div>
              
                {{-- <div class="col-2 mb-3 text-center">
                  <img src="{{asset('storage/document/'.$doc->foto)}}" style="width: 150px" alt="img">
                </div> --}}
                <div class="col-sm-8">
                  <table class="table table-bordered">
                    <tr>
                      <td colspan="2"><strong>Biodata Siswa</strong></td>
                    </tr>
                    <tr>
                      <td class="bg-light">Nomor Peserta</td>
                      <td><strong>{{$ppdb->nomor_pendaftaran}}</strong></td>
                    </tr>
                    <tr>
                      <td class="bg-light">NISN</td>
                      <td>
                        @if($student->nisn == NULL)
                          Belum ada NIK
                        @else 
                          {{$student->nisn}}
                        @endif
                      </td>
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
                      <td class="bg-light">Agama</td>
                      <td>{{$student->agama}}</td>
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
                      <td>
                        @if($register->sekolah_asal == NULL)
                          -
                        @else 
                          {{$register->sekolah_asal}}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td class="bg-light">Kewarganegaraan</td>
                      <td>{{$student->kewarganegaraan}} - {{$student->negara}}</td>
                    </tr>
                  </table>
                </div>

                <div class="col-sm-4">
                  <table class="table table-bordered">
                    <tr>
                      <td colspan="3"><strong>Data Priodik</strong></td>
                    </tr>
                    <tr>
                      <td class="bg-light">Berat Badan</td>
                      <td class="bg-light">Tinggi Badan</td>
                      <td class="bg-light">Lingkar Kelapa</td>
                    </tr>
                    <tr>
                      <td>{{$priodik->berat}} Kg</td>
                      <td>{{$priodik->tinggi}} Cm</td>
                      <td>{{$priodik->lingkar_kepala}} Cm</td>
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
                    @if(count($prestasi) == 0)
                      <tr>
                        <td colspan="4">
                          <span class="fst-italic">Tidak ada data prestasi!</span>
                        </td>
                      </tr>
                    @else 
                      @foreach($prestasi as $pres)
                      <tr>
                        <td>{{$pres->jenis}}</td>
                        <td>{{$pres->nama_prestasi}}</td>
                        <td>{{$pres->tahun}}</td>
                        <td>{{$pres->tingkat}}</td>
                      </tr>
                      @endforeach
                    @endif
                  </table>
                </div>

                <div class="col-12">
                  <table class="table table-bordered">
                    <tr>
                      <td class="text-center">
                        @if($ppdb->status == 200)
                          <h2 class="card-title">Status : LULUS</h2>
                          <a href="{{url('/ppdb/pdf')}}" class="btn btn-outline-success"><i class="bi bi-download"></i> Cetak Bukti</a>
                        @elseif($ppdb->status == 500)
                          <h2 class="card-title">Status : TIDAK LULUS</h2>
                        @elseif($ppdb->status == 400)
                          <h2 class="card-title">Status : VERIFIKASI DATA</h2>
                          <p class="fst-italic">Sedang diverifikasi oleh tim Admin</p>
                        @else
                          <h2 class="card-title">Status : MENUNGGU VERIFIKASI</h2>
                          <p class="fst-italic">Dalam antrian</p>
                        @endif
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="col-sm-12">
                  <table class="table table-bordered">
                    <tr>
                      <td>
                        <strong>PERINGATAN ! </strong> Siswa yang dinyatakan diterima namun <strong>TIDAK MENDAFTAR ULANG </strong>
                        sesuai jadwal yang ditentukan, dianggap <strong>MENGUNDURKAN DIRI.</strong>
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="col-sm-12 mb-3">
                  {!! $qrcode !!}
                </div>

                @if($ppdb->status == 2)
                <div class="col-sm-12 text-end">
                      <a href="/ppdb/pdf" target="_blank" class="btn btn-success">
                        <i class="bi bi-printer"></i> Cetak Bukti Lulus
                      </a>
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

@endsection