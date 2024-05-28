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
            <div class="alert alert-danger" id="error-message">Loading...</div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tahun Akademik</h4>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        @if(Auth::user()->level == 0)
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">
                          <i class="bi bi-plus-lg"></i> Tambah
                        </button>
                        @endif
                      </div>
                    <div class="table-responsive" id="tabel-tahun-akademik">
                        
                    </div>
                </div>
            </div>
        </div>

      </div>

    </section>

    <!-- Modal Add -->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus-lg"></i> Tambah Tahun Akademik</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" id="tahun" class="form-control" placeholder="Tahun akademik" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <select name="semester" id="semester" class="form-control">
                            <option value="1">--Pilih Semester--</option>
                            <option value="1">1. Ganjil</option>
                            <option value="2">2. Genap</option>
                        </select>
                        <button class="btn btn-outline-success" type="button" id="button-addon">Tambah</button>
                    </div>
                    <div class="form-text text-success fw-bold"><i class="bi bi-exclamation-circle"></i> Jangan gunakan karakter "/".</div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> Edit Tahun Akademik</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="">
                  <div class="input-group mb-3">
                    <input type="hidden" id="idsm">
                      <input type="text" id="tahun-edit" class="form-control" placeholder="Tahun akademik" aria-label="Recipient's username" aria-describedby="button-addon2">
                      <select name="semester-edit" id="semester-edit" class="form-control">
                          <option value="1">1. Semester Ganjil</option>
                          <option value="2">2. Semester Genap</option>
                      </select>
                      <button class="btn btn-outline-success" type="button" id="btn-update">Update</button>
                  </div>
                  <div class="form-text text-success fw-bold"><i class="bi bi-exclamation-circle"></i> Jangan gunakan karakter "/".</div>
              </form>
          </div>
          <div class="modal-footer">
          </div>
          </div>
      </div>
    </div>

    <!-- Modal Active -->
    <div class="modal fade" id="modalActive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-circle"></i> Alert!</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <span class="fst-italic">Aktfikan tahun ajaran </span>
              <span class="fst-italic fw-bold" id="alert-tahun-ajaran"></span>
              <span class="fst-italic">, Semester </span>
              <span class="fst-italic fw-bold" id="alert-semester"></span>?
          </div>
          <div class="modal-footer">
            <input type="hidden" id="idsm-active">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Tidak</button>
            <button type="button" class="btn btn-success" id="btn-active" onclick="setActiveProses()"><i class="bi bi-check-lg"></i> Ya</button>
          </div>
          </div>
      </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-circle"></i> Konfirmasi!</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <span class="fst-italic">Hapus tahun ajaran </span>
              <span class="fst-italic fw-bold" id="alert-tahun-ajaran-del"></span>
              <span class="fst-italic">, Semester </span>
              <span class="fst-italic fw-bold" id="alert-semester-del"></span>?
          </div>
          <div class="modal-footer">
            <input type="hidden" id="idsm-delete">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Tidak</button>
            <button type="button" class="btn btn-danger" id="delete-semester" onclick="deleteSemester()">
            <i class="bi bi-check-lg"></i> Ya
          </button>
          </div>
          </div>
      </div>
    </div>


    <input type="hidden" name="level-status" id="level-status" value="{{Auth::user()->status}}">
    <script src="{{asset('Admin/assets/js/v1/tahun_akademik.js')}}"></script>
  </main><!-- End #main -->

  @endsection
