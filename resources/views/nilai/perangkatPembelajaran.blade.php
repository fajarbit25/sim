@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>SIMS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item">Nilai Akademik</li>
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

        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{$title}}</h5>

              <div class="row">

                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                      <i class="bi bi-house"></i>
                    </span>
                    <select name="campus" id="campus" class="form-control" @if(Auth::user()->level != '0') @disabled(true) @endif>
                      @foreach($campus as $camp)
                      <option value="{{$camp->idcampus}}" @if($camp->idcampus == Auth::user()->campus_id) selected @endif>{{$camp->campus_name}}</option>
                      @endforeach
                    </select>
                    <span class="input-group-text"><i class="bi bi-chevron-down"></i></span>
                  </div>  
                </div>

                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                      <i class="bi bi-calendar2-week"></i>
                    </span>
                    <select name="tahunAjaran" id="tahunAjaran" class="form-control">
                      @foreach($ta as $ta)
                      <option value="{{$ta->idsm}}" @if($ta->is_active == 'true') selected @endif>Tahun Ajaran {{$ta->tahun_ajaran}}</option>
                      @endforeach
                    </select>
                    <span class="input-group-text"><i class="bi bi-chevron-down"></i></span>
                  </div>  
                </div>

              </div>

              <hr/>

              <!-- Vertical Pills Tabs -->
              <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                  <button class="nav-link active" id="v-pills-silabus-tab" data-bs-toggle="pill" 
                  data-bs-target="#v-pills-silabus" type="button" role="tab" aria-controls="v-pills-silabus" 
                  aria-selected="true">@if(Auth::user()->campus_id == 2) MATRIKS @else SILABUS @endif</button>

                  <button class="nav-link" id="v-pills-prota-tab" data-bs-toggle="pill" 
                  data-bs-target="#v-pills-prota" type="button" role="tab" aria-controls="v-pills-prota" 
                  aria-selected="false" onclick="loadProta()">@if(Auth::user()->campus_id == 2) MODUL AJAR @else PROTA @endif</button>

                  @if(Auth::user()->campus_id == 2)
                  <button class="nav-link" id="v-pills-p5-tab" data-bs-toggle="pill" 
                  data-bs-target="#v-pills-p5" type="button" role="tab" aria-controls="v-pills-p5" 
                  aria-selected="false" onclick="loadP5()">MODUL P5</button>
                  @endif

                  <button class="nav-link" id="v-pills-prosem-tab" data-bs-toggle="pill" 
                  data-bs-target="#v-pills-prosem" type="button" role="tab" aria-controls="v-pills-prosem" 
                  aria-selected="false" onclick="loadProsem()">PROSEM</button>

                </div>
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-silabus" role="tabpanel" aria-labelledby="v-pills-silabus-tab">
                  </div>

                  <div class="tab-pane fade" id="v-pills-prota" role="tabpanel" aria-labelledby="v-pills-prota-tab"></div>

                  <div class="tab-pane fade" id="v-pills-prosem" role="tabpanel" aria-labelledby="v-pills-prosem-tab"></div>

                  <div class="tab-pane fade" id="v-pills-p5" role="tabpanel" aria-labelledby="v-pills-p5-tab"></div>

                </div>
              </div>
              <!-- End Vertical Pills Tabs -->

            </div>
          </div>
        </div>

        

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


<div class="modal fade" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-exclamation-circle"></i> Confirm!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" name="idPb" id="idPb">
          <input type="hidden" name="table" id="table">
          <div class="col-6 mb-3">
              <span class="fw-bold fst-italic">Hapus <span id="textAlert"></span> ?</span>
          </div>
          
          <div class="col-6 text-end">
            <button type="button" class="btn btn-danger" id="btnDeletePb" 
            onclick="deletePbProcessing()"><i class="bi bi-trash"></i> Hapus</button>
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

        loadAll()
    });
</script>

<script src="{{asset('Admin/assets/js/v1/perangkat_pembelajaran.js?v.1')}}"></script>
@endsection
