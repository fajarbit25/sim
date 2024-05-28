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
              <h5 class="card-title">Import Data Siswa</h5>
                <div class="form">
                    <form action="/siswa/import" method="POST" id="formImport" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="file" class="form-control" name="file" id="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            <button class="btn btn-outline-secondary" type="submit" id="submitImport">Upload</button>
                        </div>
                    </form>
                </div>
                
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


@endsection