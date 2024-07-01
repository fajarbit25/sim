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
      @livewire('siswa.table-siswa')
    </section>

  </main><!-- End #main -->




  
    

    <!-- Modal Filter-->
    <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-printer"></i> Print Data Siswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/siswa/pdf" method="GET">
            @csrf
          <div class="modal-body">
            <div class="form-group mb-3">
              <label for="kelas">Pilih kelas : </label>
              <select name="kelas" id="kelas" class="form-control">
                @foreach ($kelas as $kls)     
                  <option value="{{$kls->idkelas}}">{{'Kelas '.$kls->kode_kelas}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
            <button type="submit" class="btn btn-success"><i class="bi bi-printer"></i> Print</button>
          </div>
          </form>
        </div>
      </div>
    </div>


@endsection