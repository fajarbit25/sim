@extends('template/layout')
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

  <div class="row">

    <div class="col-sm-8">
      <div class="card">
        <div class="card-body">
          @if(Auth::user()->campus_id == 2)
          <h5 class="card-title">Sentra</h5>
          @else
          <h5 class="card-title">Mata Pelajaran</h5>
          @endif
          <div class="row">
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <button class="btn btn-outline-success" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-lg"></i> New</button>
                <input type="search" class="form-control" placeholder="Search..." onkeyup="search()" id="key" aria-label="Example text with button addon" aria-describedby="button-addon1">
              </div>              
            </div>
          </div>
          <div class="tabel-responsive" id="tabel-mapel"></div>
        </div>
      </div>
    </div>
    
    @if(Auth::user()->campus_id != 2)
    <div class="col-sm-4">
      @livewire('mapel-kkm')
    </div>
    @endif

  </div>
</main>


<!-- Modal Create -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="{{url('/mapel')}}">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus-lg"></i> Tambah Mata Pelajaran</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="jenis">Jenis </label>
            <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror">
              <option value="Reguler">Reguler</option>
              <option value="Muatan Lokal">Muatan Lokal</option>
              <option value="Seni">Seni</option>
              <option value="Ekstrakulikuler">Ekstrakulikuler</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="kode_mapel">Kode <span class="text-secondary fst-italic">| Max 6 Karakter</span></label>
            <input type="text" name="kode_mapel" id="kode_mapel" class="form-control @error('kode_mapel') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="nama_mapel">Mata Pelajaran</label>
            <input type="text" name="nama_mapel" id="nama_mapel" class="form-control @error('nama_mapel') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="kkm">KKM</label>
            <input type="number" name="kkm" id="kkm" class="form-control @error('kkm') is-invalid @enderror" 
            required autocomplete="off" @if(Auth::user()->campus_id == 2) value="99" @disabled(true) @endif>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="" action="">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> Edit Mata Pelajaran</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="jenis_edit">Jenis</label>
            <select name="jenis_edit" id="jenis_edit" class="form-control @error('jenis_edit') is-invalid @enderror">
              <option value="Reguler">Reguler</option>
              <option value="Muatan Lokal">Muatan Lokal</option>
              <option value="Seni">Seni</option>
              <option value="Ekstrakulikuler">Ekstrakulikuler</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="kode_mapel">Kode <span class="text-secondary fst-italic">| Max 6 Karakter</span></label>
            <input type="text" name="kode_mapel" id="kode_mapel_edit" class="form-control @error('kode_mapel') is-invalid @enderror" required autocomplete="off">
          </div>

          <div class="form-group mb-3">
            <label for="nama_mapel">Mata Pelajaran</label>
            <input type="text" name="nama_mapel" id="nama_mapel_edit" class="form-control @error('nama_mapel') is-invalid @enderror" required autocomplete="off">
          </div>

          @if(Auth::user()->campus_id != 2)
          <div class="form-group mb-3">
            <label for="kkm_edit">KKM</label>
            <input type="number" name="kkm_edit" id="kkm_edit" class="form-control @error('kkm_edit') is-invalid @enderror" required autocomplete="off">
          </div>
          @endif


        </div>
        <div class="modal-footer">
          <input type="hidden" name="idDelete" id="idDelete" required/>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" onclick="updateMapel()" class="btn btn-primary">Update </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-exclamation-triangle"></i> Warning!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span class="text-danger fw-bold">Alert!</span> Hapus mata pelajaran ini?
      </div>
      <div class="modal-footer">
        <input type="hidden" name="idmapel" id="idmapel"/>
        <button type="button" class="btn btn-danger" onclick="deleteMapel()"><i class="bi bi-check-lg"></i> Ya</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Tidak</button>
      </div>
    </div>
  </div>
</div>
<script src="{{url('Admin/assets/js/mapel.js?v.1.2')}}"></script>
@endsection