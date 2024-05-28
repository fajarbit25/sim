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
                    <h5 class="card-title">Form Input Nilai Siswa</h5>
                    <form action="" method="">
                        @csrf
                        <div class="row">
                            <div class="col lg-6">
                                <div class="row mb-3">
                                    <label for="kelas-form" class="col-sm-4 col-form-label">Kelas</label>
                                    <div class="col-sm-8">
                                      <select name="kelas-form" id="kelas-form" class="form-control form-control-sm">
                                        @foreach($kelas as $kls)
                                        <option value="{{$kls->idkelas}}">{{'Kelas '.$kls->kode_kelas}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Mata Pelajaran</label>
                                    <div class="col-sm-8">
                                      <select name="mapel" id="mapel" class="form-control form-control-sm">
                                        <option value="0" selected>--Pilih Mapel--</option>
                                        @foreach($mapel as $mpl)
                                        <option value="{{$mpl->idmapel}}">{{$mpl->nama_mapel}}</option>
                                        @endforeach
                                        
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col lg-6">
                              <div class="row mb-3">
                                  <label for="tahun_ajaran" class="col-sm-4 col-form-label">Tahun Ajaran</label>
                                  <div class="col-sm-8">
                                    <input type="text" name="tahun_ajaran" id="tahun_ajaran" value="{{$tahun_ajaran}}" class="form-control form-control-sm" disabled/>
                                  </div>
                              </div>
                                <div class="row mb-3">
                                    <label for="semester" class="col-sm-4 col-form-label">Semester</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="semester" id="semester" value="{{$semester}}" class="form-control form-control-sm" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="button" id="btn-submit" onclick="submitForm()" class="btn btn-success btn-sm">Mulai Penilaian</button>
                                <button type="button" id="btn-loading" class="btn btn-secondary btn-sm">Loading...</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12" id="formNilai">
        </div>

      </div>
    </section>
</main>
<script src="{{asset('Admin/assets/js/nilai.js')}}"></script>
@endsection
