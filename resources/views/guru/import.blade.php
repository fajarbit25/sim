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
              <h5 class="card-title">Import Data Guru</h5>
                <div class="form">
                    <form action="/teacher/excel/import" method="POST" id="formImport" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="file" class="form-control" name="file" id="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            <button class="btn btn-outline-secondary" type="submit" id="submitImport">Upload</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 mt-4">
                    <div class="alert alert-info">
                        <strong>Catatan : </strong><br/>
                        <span class="fst-italic">Untuk kolom Level Akun SIM gunakan panduan dibawah:</span><br/>
                        <span class="fw-bold">1</span> <i class="bi bi-chevron-right"></i> Administrator </br>
                        <span class="fw-bold">2</span> <i class="bi bi-chevron-right"></i> Guru </br>
                        <span class="fw-bold">3</span> <i class="bi bi-chevron-right"></i> Staff </br>
                        <span class="fw-bold">4</span> <i class="bi bi-chevron-right"></i> Siswa/Orang Tua </br>
                        <span class="fw-bold">5</span> <i class="bi bi-chevron-right"></i> Bendahara </br>
                    </div>
                </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


@endsection