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
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> 11. Beasiswa</h5>

                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-lg"></i> Tambah Data Beasiswa</button>
                    <div class="table-responsive" id="tableBeasiswa">
                        
                    </div>

                    
                    <div class="col-lg-12 my-3 text-end">
                        <a href="/ppdb/kesejahteraan" class="btn btn-success">Simpan dan lanjutkan <i class="bi bi-arrow-right"></i></a>
                    </div>

                    <div class="col-sm-12">
                      <div class="alert alert-info">
                        <span class="fst-italic fw-bold">Catatan :</span><br/>
                        <span class="fst-italic">Silahkan pilih "Simpan dan lanjutkan" apabila tidak ada!</span>
                      </div>
                    </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus-lg"></i> Tambah Data Beasiswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formBeasiswa">

            <div class="row mb-3">
                <label for="jenis" class="col-sm-4 col-form-label">1. Jenis Beasiswa</label>
                <div class="col-sm-8">
                  <select name="jenis" id="jenis" class="form-control" required>
                    <optgroup label="Pilih Jenis Prestasi">
                        <option value="Anak Berprestasi">1. Anak Berprestasi</option>
                        <option value="Anak Miskin">2. Anak Miskin</option>
                        <option value="Pendidikan">3. Pendidikan</option>
                        <option value="Unggulan">4. Unggulan</option>
                    </optgroup>
                  </select>
                </div>
            </div>

            

            <div class="row mb-3">
                <label for="keterangan" class="col-sm-4 col-form-label">2. Keterangan</label>
                <div class="col-sm-8">
                  <input type="text" name="keterangan" id="keterangan" class="form-control" required/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tahun_mulai" class="col-sm-4 col-form-label">3. Tahun Mulai</label>
                <div class="col-sm-8">
                  <input type="text" name="tahun_mulai" id="tahun_mulai" class="form-control" required/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tahun_selesai" class="col-sm-4 col-form-label">3. Tahun Selesai</label>
                <div class="col-sm-8">
                  <input type="text" name="tahun_selesai" id="tahun_selesai" class="form-control" required/>
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="btnSaveBeasiswa" onclick="saveBeasiswa()">Simpan</button>
          <button type="button" class="btn btn-secondary" id="btnLoadingBeasiswa"><i class="bi bi-arrow-clockwise"></i> Loading...</button>
        </div>
      </div>
    </div>
  </div>
  


{{-- JavaScript --}}
<script src="{{asset('Admin/assets/js/ppdb.js')}}"></script>

@endsection