@extends('template/layout')
@section('main')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12" id="notifSuccess">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <span id="textSuccess">Success</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
        <div class="col-lg-12" id="notifDanger">
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <span id="textDanger">Fail..</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-wallet2"></i> Form Transaksi</h5>
                      <form method="POST" id="formTransaksi">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 from-group" id="formTipe">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 from-group">
                                    <label for="jenis">Tipe <span class="text-danger">*</span></label>
                                    <select name="jenis" id="jenis" class="form-control">
                                        <optgroup label="Pilih Tipe Transaksi">
                                            <option value="IN">IN - Dana Masuk</option>
                                            <option value="OUT">OUT - Dana Keluar</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 from-group">
                                    <label for="nominal">Amount <span class="text-danger">*</span></label>
                                    <input type="text" name="nominal" id="nominal" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 from-group">
                                    <label for="status">Status Pembayaran <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <optgroup label="Pilih Tipe Transaksi">
                                            <option value="PAID">PAID</option>
                                            <option value="UNPAID">UNPAID</option>
                                            <option value="PENDING">PENDING</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3 from-group">
                                    <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                                    <textarea name="keterangan" id="keterangan" rows="2" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3 from-group text-end">
                                    <button type="button" class="btn btn-success" onclick="transaction()" id="btnSubmitTransaksi">Submit</button>
                                    <button class="btn btn-secondary" type="button" id="btnLoadingTransaksi" disabled>
                                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                      Loading...
                                    </button>
                                </div>
                            </div>

                        </div>
                      </form>
                    </div>
                </div>
            </div>

            <!-- Table Mutasi 5 Hari -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><span><i class="bi bi-funnel"></i></span> Transaksi Terbaru  </h5>
                        
                        <div class="table-responsive" id="tableTransaksi">
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Table Mutasi 5 Hari -->

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Jenis Transaksi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3 from-group">
                <label for="addTipe">Jenis Transaksi</label>
                <input type="text" name="addTipe" id="addTipe" class="form-control" required/>
            </div>
            <hr>
            <div class="mb-3 row" id="tipeTransakti"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-tipe" onclick="tambahType()">Tambah</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Javascript --}}
  <script src="{{asset('Admin/assets/js/transaksi.js')}}"></script>
  @endsection
