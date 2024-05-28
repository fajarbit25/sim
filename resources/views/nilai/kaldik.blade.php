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
                    <h5 class="card-title">{{$title}}</h5>
                    <div class="row">

                      <div class="mb-3 col-sm-6">
                        <select name="campus" id="campus" class="form-control" @if(Auth::user()->level != '0') @disabled(true) @endif>
                          @foreach($campus as $camp)
                          <option value="{{$camp->idcampus}}" @if($camp->idcampus == Auth::user()->campus_id) selected @endif>{{$camp->campus_name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="mb-3 col-sm-6">
                        <select name="tahunAjaran" id="tahunAjaran" class="form-control">
                          @foreach($ta as $ta)
                          <option value="{{$ta->idsm}}" @if($ta->is_active == 'true') selected @endif>Tahun Ajaran {{$ta->tahun_ajaran}}</option>
                          @endforeach
                        </select>
                      </div>

                    </div>
                </div>
            </div>
        </div> 

        @if(Auth::user()->campus_id == 2)
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body py-3">
                <h3 class="card-title">Detail</h3>
                <div id="loading" style="display: none;">
                    <!-- Tambahkan animasi loading di sini -->
                     <span class="fw-bold fst-italic">Loading...</span>
                </div>

                <div class="row" id="fileKaldikTK">
                </div>
              </div>
            </div>
          </div>
        @else

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Tabel Kalender Pendidikan</h5>
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 9px;">
                    <thead>
                        <tr>
                          <th rowspan="2">Tahun</th>
                          <th rowspan="2">Bulan</th>
                          <th colspan="35" class="text-center"> HARI / TANGGAL </th>
                          <th rowspan="2" class="vertical-text">
                            Hari Efektif <br/> Sekolah
                          </th>
                          <th rowspan="2" class="vertical-text">
                            Hari Efektif <br/> Semester
                          </th>
                          <th rowspan="2" class="vertical-text">
                            Pekan Efektif
                          </th>
                          <th rowspan="2" class="vertical-text">
                            Jumlah <br/> Pekan Efektif
                          </th>
                          <th rowspan="2">Hapus</th>
                        </tr>
                        <tr>

                            @foreach($hari as $hr)
                            <th class="vertical-text"> {{$hr->hari}} </th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody id="tableBulan">
                    </tbody>
                    <tr>
                      <td colspan="41">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalBaris">
                          Tambah Baris <i class="bi bi-arrow-right"></i>
                        </button>
                      </td>
                    </tr>
                </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Keterangan</h3>
                <div class="col-sm-12 mb-3">
                  <button type="button" class="btn btn-success btn-sm" onclick="modalKeterangan()">
                    <i class="bi bi-plus"></i> Tambah Keterangan
                  </button>
                </div>
                  <div class="row" id="keteranganKaldik" data-url="{{ route('nilai.loadKeterangan') }}">
                  </div>
              </div>
            </div>
          </div>

        @endif

      </div>
    </section>
</main>

<div class="modal fade" id="modalBaris" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-plus"></i> Tambahkan Baris</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="form-group mb-3">
            <label for="tahun">Masukan Tahun <span class="text-danger">*</span> </label>
            <input type="text" name="tahun" id="tahun" value="{{date('Y')}}" class="form-control">        
          </div>

          <div class="form-group mb-3">
            <label for="semester">Pilih Semester <span class="text-danger">*</span> </label>
            <select name="semester" id="semester" class="form-control">
                <option value="1">1. Ganjil</option>
                <option value="2">2. Genap</option>
            </select>          
          </div>

          <div class="form-group mb-3">
            <label for="bulan">Pilih Bulan <span class="text-danger">*</span> </label>
            <select name="bulan" id="bulan" class="form-control">
                <option value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="Juni">Juni</option>
                <option value="Juli">Juli</option>
                <option value="Agustus">Agustus</option>
                <option value="September">September</option>
                <option value="Oktober">Oktober</option>
                <option value="November">November</option>
                <option value="Desember">Desember</option>
            </select>          
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnTambahBulan" onclick="addBulan()"><i class="bi bi-plus"></i> Tambahkan</button>
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->

<div class="modal fade" id="modalKeterangan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-plus"></i> Tambahkan Keterangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="form-group mb-3">
            <label for="keterangan">Masukan Keterangan <span class="text-danger">*</span> </label>
            <input type="text" id="keterangan" class="form-control">        
          </div>
          
          <div class="form-group mb-3">
            <label for="warna" class="form-label">Color picker</label>
            <input type="color" class="form-control form-control-color" id="warna" value="#563d7c" title="Choose your color">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnTambahKeterangan" onclick="addKeterangan()"><i class="bi bi-plus"></i> Tambahkan</button>
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->

<div class="modal fade" id="modalEditKeterangan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-plus"></i> Edit Keterangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="form-group mb-3">
            <label for="keteranganEdit">Masukan Keterangan <span class="text-danger">*</span> </label>
            <input type="text" id="keteranganEdit" class="form-control">        
          </div>
          
          <div class="form-group col-sm-4 mb-3">
            <label for="warnaEdit" class="form-label">Color picker</label>
            <input type="color" class="form-control form-control-color" id="warnaEdit" value="#563d7c" title="Choose your color">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnEditKeterangan" onclick="updateKeterangan()"><i class="bi bi-plus"></i> Update</button>
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->

<div class="modal fade" id="modalAddKeterangan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-plus"></i> Keterangan Tanggal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" name="idhari" id="idhari">
          
          <div class="form-group mb-3">
            <label for="tag">Pilih Keterangan <span class="text-danger">*</span> </label>
            <select name="tag" id="tag" class="form-control">
            </select>   
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnTambahKeteranganTanggal" onclick="addKeteranganTanggal()"><i class="bi bi-plus"></i> Add</button>
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->

<div class="modal fade" id="modalDeleteKeterangan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-exclamation-circle"></i> Confirm!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" name="idKeterangan" id="idKeterangan">
          <div class="col-6 mb-3">
              <span class="fw-bold fst-italic">Hapus Keterangan?</span>
          </div>
          
          <div class="col-6 text-end">
            <button type="button" class="btn btn-danger" id="btnDeleteKeteranganTanggal" 
            onclick="deleteKeteranganTanggal()"><i class="bi bi-trash"></i> Hapus</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
          </div>

        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->

<div class="modal fade" id="modalDeleteBulan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-exclamation-circle"></i> Confirm!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" name="idBulan" id="idBulan">
          <div class="col-6 mb-3">
              <span class="fw-bold fst-italic">Hapus Baris ini?</span>
          </div>
          
          <div class="col-6 text-end">
            <button type="button" class="btn btn-danger" id="btnDeleteBulan" 
            onclick="deleteBulan()"><i class="bi bi-trash"></i> Hapus</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
          </div>

        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->

<div class="modal fade" id="modalDeleteKaldikTK" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-exclamation-circle"></i> Confirm!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" name="idKaldikTK" id="idKaldikTK">
          <div class="col-6 mb-3">
              <span class="fw-bold fst-italic">Hapus data ini?</span>
          </div>
          
          <div class="col-6 text-end">
            <button type="button" class="btn btn-danger" id="btnDeleteKaldikTK" 
            onclick="deleteKaldikTK()"><i class="bi bi-trash"></i> Hapus</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
          </div>

        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->


<script>
  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //loadKaldikBulan()
    //loadKeterangan()

    // Check if the user is authenticated
    @auth
        // Check the user's campus_id
        @if(auth()->user()->campus_id == 2)
            loadKaldikTK()
        @else
            loadKeterangan();
            loadKaldikBulan();
        @endif
    @endauth
  });
</script>

<script src="{{asset('Admin/assets/js/v1/penilaian.js')}}"></script>
@endsection
