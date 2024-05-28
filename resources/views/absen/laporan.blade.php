@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>SIMS</h1>
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
      <div class="col-lg-12" id="progres-loading">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Loading...</h5>

                <!-- Progress Bars with Striped Backgrounds-->
                <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div><!-- End Progress Bars with Striped Animated Backgrounds -->

            </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Laporan Absensi <span>Tanggal {{$dataAbsen->tanggal_absen}}</span></h5>
                <div class="table-responsive">
                    <table class="table table-bordered" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nis</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Absensi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absen as $ab)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$ab->nisn}}</td>
                                <td>{{$ab->first_name.' '.$ab->last_name}}</td>
                                <td>{{$ab->gender}}</td>
                                <td>
                                    @if($ab->absensi == 'Hadir')
                                        <span class="badge bg-success">{{$ab->absensi}}</span>
                                    @elseif($ab->absensi == 'Sakit')
                                        <span class="badge bg-warning">{{$ab->absensi}}</span>
                                    @elseif($ab->absensi == 'Alfa')
                                        <span class="badge bg-danger">{{$ab->absensi}}</span>
                                    @else
                                        <span class="badge bg-primary">{{$ab->absensi}}</span>
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="/absen" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>
        </div>
      </div>

    </section>
</main>
<script src="{{url('Admin/assets/js/absen.js')}}"></script>
@endsection
