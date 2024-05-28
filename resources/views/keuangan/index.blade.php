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

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Saldo</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-wallet"></i>
                    </div>
                    <div class="ps-3 text-end">
                      <h6>{{number_format($saldo->saldo_akhir)}}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->


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

    <!-- Modal -->
    <div class="modal" tabindex="-1" id="modal-transaksi">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Transaksi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table">
              <tbody>
                <tr>
                  <th scope="row">ID</th>
                  <td id="view-kode"></td>
                </tr>
                <tr>
                  <th scope="row">Tanggal</th>
                  <td id="view-tanggal"></td>
                </tr>
                <tr>
                  <th scope="row">Jenis</th>
                  <td id="view-tipe"></td>
                </tr>
                <tr>
                  <th scope="row">Tipe</th>
                  <td id="view-jenis"></td>
                </tr>
                <tr>
                  <th scope="row">Nominal</th>
                  <td id="view-nominal"></td>
                </tr>
                <tr>
                  <th scope="row">Status</th>
                  <td id="view-status"></td>
                </tr>
                <tr>
                  <th scope="row">Keterangan</th>
                  <td id="view-description"></td>
                </tr>
                
              </tbody>
            </table>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </main><!-- End #main -->
  <script src="{{asset('Admin/assets/js/transaksi.js')}}"></script>
  @endsection
