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

    <section class="section">

      <div class="row">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tabel Kelas</h5>
              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group mb-3">
                    <button class="btn btn-outline-success" type="button"  data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="bi bi-plus-lg"></i> New</button>
                    <input type="search" class="form-control" placeholder="Search..." onkeyup="search()" id="key" aria-label="Example text with button addon" aria-describedby="button-addon1">
                  </div>              
                </div>
              </div>
              <div class="" id="tabelKelas"></div>
            </div>
          </div>
      </div>
      
    </section>

  </main><!-- End #main -->

  <!-- Modal Add-->
  <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-houses"></i> Tambah data kelas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group mb-3 col-sm-6">
              <label for="tingkat">Nama Tingkat</label>
              <input type="text" name="tingkat" id="tingkat" class="form-control" required autocomplete="off"/>
            </div>
            <div class="form-group mb-3 col-sm-6">
              <label for="kelas">Kode / Kelompok</label>
              <input type="text" name="kelas" id="kelas" class="form-control" required autocomplete="off"/>
            </div>
            <div class="form-group mb-3">
              <label for="wali">Wali Kelas</label>
              <select name="wali" id="wali" class="form-control">
                  @foreach($guru as $gr)
                    <option value="{{$gr->id}}">{{$gr->first_name. ' ' .$gr->last_name}}</option>
                  @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="campus_id" id="campus_id" value="{{Auth::user()->campus_id}}" required/>
          <button type="button" class="btn btn-secondary" id="closeModal" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
          <button type="button" class="btn btn-primary" onclick="saveKelas()"><i class="bi bi-check-lg"></i> Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit-->
  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-houses"></i> Edit data kelas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group mb-3 col-lg-6">
              <label for="tingkatEdit">TingkatEdit</label>
              <input type="text" name="tingkatEdit" id="tingkatEdit" class="form-control" required autocomplete="off"/>
            </div>
            <div class="form-group mb-3 col-lg-6">
              <label for="kelas">Kode / Kelompok</label>
              <input type="text" name="kelas" id="kelasEdit" value="{{old('kelasEdit')}}" class="form-control" required autocomplete="off"/>
            </div>
            <div class="form-group mb-3 col-lg-6">
              <label for="waliOld">Wali Kelas</label>
              <input type="text" name="waliOld" id="waliOld" class="form-control" required autocomplete="off" readonly disabled/>
            </div>
            <div class="form-group mb-3 col-lg-6">
              <label for="wali">Ganti Wali Kelas</label>
              <select name="wali" id="waliNew" class="form-control">
                @foreach($guru as $gr)
                  <option value="{{$gr->id}}">{{$gr->first_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="idkelas" id="idkelas" required/>
          <button type="button" class="btn btn-secondary" id="closeModal" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
          <button type="button" class="btn btn-primary" onclick="update()"><i class="bi bi-check-lg"></i> Save</button>
        </div>
      </div>
    </div>
  </div>
  <script src="{{url('Admin/assets/js/kelas.js')}}"></script>
@endsection