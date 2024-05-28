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
      <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Absensi</h5>
                    <form action="/absen" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="tanggal_absen">Tanggal Absen <span class="text-danger">*</span></label>
                                    <input type="text" name="tanggal_absen" class="form-control @error('tanggal_absen') is-invalid @enderror" value="{{date('Y-m-d')}}" required>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        @error('tanggal_absen')
                                        {{$message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="semester">Semseter <span class="text-danger">*</span></label>
                                    <input type="text" name="semester" class="form-control @error('semester') is-invalid @enderror" value="{{$semester->semester_kode}}" required readonly/>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        @error('semester')
                                        {{$message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="kelas">Kelas <span class="text-danger">*</span></label>
                                    <select name="kelas" id="kelas" class="form-control @error('kelas') is-invalid @enderror">
                                        @foreach($kelas as $kl)
                                        <option value="{{$kl->idkelas}}">{{$kl->kode_kelas}}</option>
                                        @endforeach
                                    </select>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        @error('kelas')
                                        {{$message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="mapel">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <select name="mapel" id="mapel" class="form-control @error('mapel') is-invalid @enderror">
                                        @foreach($mapel as $mp)
                                        <option value="{{$mp->idmapel}}">{{$mp->nama_mapel}}</option>
                                        
                                        @endforeach
                                    </select>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        @error('mapel')
                                        {{$message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-success">Mulai Absensi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</main>
@endsection
