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
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Daftar Siswa</h5>
                  
                  <div class="row">
                      <div class="col-sm-8 mb-4">
                          <form action="/absen/submit">
                              @csrf
                              <input type="hidden" name="kode_absen" value="{{$dataAbsen->kode_absen}}"/>
                              <button class="btn btn-success">
                                  <i class="bi bi-table"></i>  Selesai <i class="bi bi-arrow-right"></i>
                              </button>
                          </form>
                      </div>
                      <div class="col-sm-4 mb-4">
                          {{-- <input type="search" name="key" id="ke" class="form-control" placeholder="Cari siswa..."> --}}
                          <div class="input-group mb-3">
                              <input type="search" class="form-control" id="search" onkeyup="cariSiswa()" placeholder="Cari siswa.." aria-label="Cari siswa.." aria-describedby="basic-addon2">
                              <span class="input-group-text" id="basic-addon2">
                                  <i class="bi bi-search"></i>
                              </span>
                            </div>
                      </div>
                      <div class="col-sm-12">
                          <table class="table table-borderless">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>NIS</th>
                                      <th>Nama Lengkap</th>
                                      <th>Jenis Kelamin</th>
                                      <th>Status</th>
                                      <th>Manage</th>
                                  </tr>
                              </thead>
                              <tbody id="formAbsen">
                                  
                              </tbody>
                          </table>
                      </div>
                  </div>
                  
      
              </div>
          </div>
        </div>
      
      </div>
    </section>
</main>


<!-- Modal -->
<div class="modal fade" id="modal-absen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Absensi Action</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
        <form>
          <input type="hidden" name="mapel" id="mapel-absen">
          <div class="input-group mb-3">
              <select name="absen" id="absen" class="form-control">
                  <option value="Hadir">Hadir</option>
                  <option value="Izin">Izin</option>
                  <option value="Sakit">Sakit</option>
                  <option value="Alfa">Alfa</option>
              </select>
              <button class="btn btn-success" type="button" id="button-addon2">Simpan</button>
          </div>                          
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<script src="{{url('Admin/assets/js/absen.js')}}"></script>
@endsection
