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

    <section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Level Users</h5>
                {{-- <div class="col-lg-12 mb-3">
                    <div class="row g-3">
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="nama_level" placeholder="Nama Level" autocomplete="off">
                        </div>
                        <div class="col-sm">
                          <input type="text" class="form-control" id="kode_level" placeholder="Kode Level" autocomplete="off">
                        </div>
                        <div class="col-sm">
                          <button type="button" class="btn btn-success" onclick="save()" id="btn-submit">
                            <i class="bi bi-plus-lg"></i> Tambah
                          </button>
                          <button type="button" class="btn btn-secondary" id="btn-loading">
                             Loading <i class="bi bi-three-dots"></i>
                          </button>
                        </div>
                    </div>
                </div> --}}

                <div class="" id="tableLevel">
                </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script src="{{url('Admin/assets/js/level.js')}}"></script>
@endsection