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
                <h5 class="card-title">Lihat Laporan <span>Filter</span> </h5>
                  <form method="" action="">
                    @csrf
                  <div class="input-group">
                    @if(Auth::user()->level == 0)
                    <select class="form-select" id="campus" name="campus" title="campus" required>
                      @foreach($campus as $camp)
                      <option value="{{$camp->idcampus}}"> {{$camp->campus_initial}} </option>
                      @endforeach
                    </select>
                    @else
                    <input type="hidden" name="campus" id="campus" value="{{Auth::user()->campus_id}}">
                    @endif

                    <select class="form-select" id="kelas" name="kelas" title="Kelas" required>
                        @foreach($kelas as $kl)
                        <option value="{{$kl->idkelas}}"> {{'Kelas '.$kl->kode_kelas}} </option>
                        @endforeach
                    </select>
                    
                    <input type="date" name="date_start" class="form-control" @if($tabel == 1) value="{{$start}}" @endif title="Tanggal Mulai" id="tanggal" required/>

                    <button class="btn btn-success" type="button" id="btn-loading-report" disabled>
                      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                      <span role="status">Loading...</span>
                    </button>
                    <button class="btn btn-success" type="button" id="btn-submit-report"><i class="bi bi-search"></i> Cari</button>
                  </div>
                  </form>
            </div>
        </div>
      </div>

      <div class="col-lg-12 row">
        <div class="col-sm-4" id="listAbsen"></div>
        <div class="col-sm-8" id="tableReport"></div>
      </div>


    </section>
</main>
<script src="{{url('Admin/assets/js/absen.js')}}"></script>
@endsection
