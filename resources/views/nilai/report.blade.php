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
                    <button type="button" id="btn-kelas" class="btn btn-success btn-sm"><i class="bi bi-people"></i> Laporan Perkelas</button>
                    <button type="button" id="btn-siswa" class="btn btn-info btn-sm"><i class="bi bi-person"></i> Laporan Persiswa</button>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Nilai</h5>
                    <div class="col-sm-12" id="table-report"></div>
                </div>
            </div>
        </div>


      </div>
    </section>
</main>

<!-- Modal Kelas -->
<div class="modal fade" id="modalkelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Laporan Nilai Perkelas</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                        <select name="kelas" id="kelas" class="form-control">
                            <optgroup label="Pilih Kelas">
                                @foreach($kelas as $kls)
                                <option value="{{$kls->idkelas}}">Kelas {{$kls->kode_kelas}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                        <select name="mapel" id="mapel" class="form-control">
                            <optgroup label="Pilih Mapel">
                                @foreach($mapel as $mpl)
                                <option value="{{$mpl->idmapel}}">{{$mpl->kode_mapel.'-'.$mpl->nama_mapel}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                        <select name="semester" id="semester" class="form-control">
                            <optgroup label="Pilih Semester">
                                <option value="1">Ganjil</option>
                                <option value="2">Genap</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="ta" class="form-label">Tajun Ajaran <span class="text-danger">*</span></label>
                        <select name="ta" id="ta" class="form-control">
                            <optgroup label="Pilih Kelas">
                                @foreach($semester as $smt)
                                <option value="{{$smt->tahun_ajaran}}">{{$smt->tahun_ajaran}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btn-cari-kelas">Cari</button>
        </div>
        </div>
    </div>
</div>
<!-- Modal Siswa -->
<div class="modal fade" id="modalSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Laporan Nilai Persiswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="sta" class="form-label">Tajun Ajaran <span class="text-danger">*</span></label>
                        <select name="sta" id="sta" class="form-control">
                            <optgroup label="Pilih Kelas">
                                @foreach($semester as $smt)
                                <option value="{{$smt->tahun_ajaran}}">{{$smt->tahun_ajaran}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="ssemester" class="form-label">Semester <span class="text-danger">*</span></label>
                        <select name="ssemester" id="ssemester" class="form-control">
                            <optgroup label="Pilih Semester">
                                <option value="0">--Pilih Semester--</option>
                                <option value="1">Ganjil</option>
                                <option value="2">Genap</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="skelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                    <select name="skelas" id="skelas" class="form-control"></select>
                </div>
                <div class="col-sm-12">
                    <label for="ssiswa" class="form-label">Siswa <span class="text-danger">*</span></label>
                    <select name="ssiswa" id="ssiswa" class="form-control"></select>
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btn-cari-siswa">Cari</button>
        </div>
        </div>
    </div>
</div>
<script src="{{asset('Admin/assets/js/reportNilai.js')}}"></script>
@endsection
