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
              <h5 class="card-title"> 10. Prestasi</h5>

                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-lg"></i> Tambah</button>
                    <div class="table-responsive" id="tablePrestasi">
                        
                    </div>

                    
                    <div class="col-lg-12 my-3 text-end">
                        <a href="/ppdb/beasiswa" class="btn btn-success">Simpan dan lanjutkan <i class="bi bi-arrow-right"></i></a>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus-lg"></i> Tambah Prestasi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formPrestasi">
            <div class="row mb-3">
                <label for="jenis" class="col-sm-4 col-form-label">1. Jenis Prestasi</label>
                <div class="col-sm-8">
                  <select name="jenis" id="jenis" class="form-control" required>
                    <optgroup label="Pilih Jenis Prestasi">
                        <option value="Sains">1. Sains</option>
                        <option value="Seni">2. Seni</option>
                        <option value="Olahraga">3. Olahraga</option>
                        <option value="Lain-lain">4. Lain-lain</option>
                    </optgroup>
                  </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tingkat" class="col-sm-4 col-form-label">2. Tingkat</label>
                <div class="col-sm-8">
                  <select name="tingkat" id="tingkat" class="form-control" required>
                    <optgroup label="Pilih Tingkat">
                        <option value="Sekolah">1.Sekolah</option>
                        <option value="Kecamatan">2. Kecamatan</option>
                        <option value="Kabupaten">3. Kabupaten</option>
                        <option value="Provinsi">4. Provinsi</option>
                        <option value="Nasional">5. Nasional</option>
                        <option value="Internasional">6. Internasional</option>
                    </optgroup>
                  </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama_prestasi" class="col-sm-4 col-form-label">3. Nama Prestasi</label>
                <div class="col-sm-8">
                  <input type="text" name="nama_prestasi" id="nama_prestasi" class="form-control" required/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tahun" class="col-sm-4 col-form-label">4. Tahun</label>
                <div class="col-sm-8">
                  <input type="text" name="tahun" id="tahun" class="form-control" required/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="penyelenggara" class="col-sm-4 col-form-label">5. Penyelenggara</label>
                <div class="col-sm-8">
                  <input type="text" name="penyelenggara" id="penyelenggara" class="form-control" required/>
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="btnSavePrestasi" onclick="savePrestasi()">Simpan</button>
          <button type="button" class="btn btn-secondary" id="btnLoadingPrestasi" onclick="savePrestasi()"><i class="bi bi-arrow-clockwise"></i> Loading...</button>
        </div>
      </div>
    </div>
  </div>
  


{{-- JavaScript --}}
<script src="{{asset('Admin/assets/js/ppdb.js')}}"></script>

@endsection