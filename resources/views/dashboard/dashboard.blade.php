@extends('template/layout')
@section('main')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-lg-3">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Siswa <span>| All</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$count_siswa}}</h6>
                      <span class="text-success small pt-1 fw-bold">Orang</span> 

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-lg-3">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Guru/Pegawai <span>| All</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$count_guru}}</h6>
                      <span class="text-success small pt-1 fw-bold">Orang</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Sales Card -->
            <div class="col-lg-3">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Sekolah <span>| All</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-buildings"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$count_campus}}</h6>
                      <span class="text-success small pt-1 fw-bold">Kampus</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col-lg-3">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Postingan <span>| All</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-newspaper"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$count_campus}}</h6>
                      <span class="text-success small pt-1 fw-bold">Berita</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            {{-- Report PPBD --}}
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Informasi Penerimaan Peserta Didik Baru</h5>
    

                  <div class="row">
                    <div class="col-sm-6">
                      <dl class="row">
                        <dt class="col-sm-6">Tahun Pelajaran Aktif</dt>
                        <dd class="col-sm-6">: {{$ppdb_master->tahun_id}} / @if($ppdb_master->semester_kode == 1) Ganjil @else Genap @endif </dd>
    
                        <dt class="col-sm-6">Tahun Penerimaan Peserta Didik Baru</dt>
                        <dd class="col-sm-6">: {{$ppdb_master->tahun_penerimaan}} </dd>
    
                        <dt class="col-sm-6">Gelombang Pendaftaran</dt>
                        <dd class="col-sm-6">: Gelombang {{$ppdb_master->gelombang}} </dd>
                      </dl>
                    </div>
                    <div class="col-sm-6">
                      <dl class="row">
                        <dt class="col-sm-6">Tanggal Mulai Pendaftaran</dt>
                        <dd class="col-sm-6">: {{$ppdb_master->tanggal_mulai}} </dd>
    
                        <dt class="col-sm-6">Tanggal Selesai Pendaftaran</dt>
                        <dd class="col-sm-6">: {{$ppdb_master->tanggal_selesai}} </dd>
    
                        <dt class="col-sm-6">Status Penerimaan Peserta Didik Baru</dt>
                        <dd class="col-sm-6">: {{$ppdb_master->status}} </dd>
                      </dl>
                    </div>
                  </div>
 

                </div>
              </div>
            </div>

            {{-- End Report PPDF --}}

          </div>
        </div><!-- End Left side columns -->

      </div>

      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Recent Activity <span>| today {{date('d/m/Y')}} - {{date('H:i')}} </span></h5>
            <div class="col-sm-12 mb-3 text-end">
              <button type="button" onclick="modalKelas()" class="btn btn-primary btn-sm">
                <i class="bi bi-house-door"></i> Filter Kelas
              </button>
              <button type="button" onclick="modalGuru()" class="btn btn-success btn-sm">
                <i class="bi bi-person-video2"></i> Filter Guru
              </button>
              <button type="button" onclick="tableActivity()" class="btn btn-warning btn-sm">
                <i class="bi bi-arrow-repeat"></i> Reset
              </button>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Jam</th>
                    <th>Kelas</th>
                    <th>Kegiatan</th>
                    <th>Guru</th>
                  </tr>
                </thead>
                <tbody id="tableActivity">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </section>


<!-- Modal Kelas -->
<div class="modal fade" id="modal-kelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Filter Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="kelas">Pilih Kelas</label>
          <select name="kelas" id="kelas" class="form-control">
            <optgroup label="Pilih Kelas">
              @foreach($kelas as $kls)
                <option value="{{$kls->idkelas}}">{{$kls->kode_kelas}}</option>
              @endforeach
            </optgroup>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-kelas">Tampilkan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Guru -->
<div class="modal fade" id="modal-guru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Filter Guru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="guru">Pilih Guru</label>
          <select name="guru" id="guru" class="form-control">
            <optgroup label="Pilih guru">
              @foreach($guru as $gr)
                <option value="{{$gr->id}}">{{$gr->first_name}}</option>
              @endforeach
            </optgroup>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-guru">Tampilkan</button>
      </div>
    </div>
  </div>
</div>

    <input type="hidden" name="level-status" id="level-status" value="{{Auth::user()->status}}">
    <script src="{{asset('Admin/assets/js/dashboard.js')}}"></script>
  </main><!-- End #main -->


  @endsection
