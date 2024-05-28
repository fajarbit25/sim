@extends('template/layout')
@section('main')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-danger" id="error-message">
          </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Master PPDB</h4>
                    <form action="" id="formMaster">
                      <input type="hidden" name="idpm" id="idpm" value="{{$master->idpm}}" required>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-md-4">
                              <label for="tahun_ajaran" class="col-form-label">Tahun Ajaran Aktif :</label>
                            </div>
                            <div class="col-md-8">
                              <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" value="{{$semester->tahun_ajaran}}" readonly/>
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-md-4">
                              <label for="tahun_penerimaan" class="col-form-label">Tahun Penerimaan Peserta Didik Baru :</label>
                            </div>
                            <div class="col-md-8">
                              <input type="text" name="tahun_penerimaan" id="tahun_penerimaan" class="form-control" value="{{$master->tahun_penerimaan}}"/>
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-md-4">
                              <label for="gelombang" class="col-form-label">Gelombang Pendaftaran :</label>
                            </div>
                            <div class="col-md-8">
                              <input type="text" name="gelombang" id="gelombang" class="form-control" value="{{$master->gelombang}}"/>
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-md-4">
                              <label for="status" class="col-form-label">Status Penerimaan Peserta Didik Baru :</label>
                            </div>
                            <div class="col-md-8">
                              <select name="status" id="status" class="form-control">
                                <optgroup label="Pilih Status">
                                    <option value="Dibuka" @if($master->status == 'Dibuka') selected @endif>Dibuka</option>
                                    <option value="Ditutup" @if($master->status == 'Ditutup') selected @endif>Ditutup</option>
                                </optgroup>
                              </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-md-4">
                              <label for="tanggal_mulai" class="col-form-label">Tanggal Mulai Pendaftaran :</label>
                            </div>
                            <div class="col-md-8">
                              <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{$master->tanggal_mulai}}"/>
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-md-4">
                              <label for="tanggal_selesai" class="col-form-label">Tanggal Selesai Pendaftaran :</label>
                            </div>
                            <div class="col-md-8">
                              <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{$master->tanggal_selesai}}"/>
                            </div>
                        </div>
                        <div class="g-3 mb-3 align-items-center">
                            <button type="submit" class="btn btn-success" id="btn-submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

      </div>

    </section>

    <input type="hidden" name="level-status" id="level-status" value="{{Auth::user()->status}}">
    <script src="{{asset('Admin/assets/js/v1/master_ppdb.js')}}"></script>
  </main><!-- End #main -->

  @endsection
