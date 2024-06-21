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

  

            <!-- Table Filter -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><span><i class="bi bi-funnel"></i></span> Filter</h5>
                       {{-- <form method="GET" action="{{'/finance/mutasi/filter'}}">  --}}
                        <form>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <select class="form-select" name="jenis" id="jenis">
                                    <optgroup label="Pilih Tipe Transaksi">
                                      <option value="ALL">ALL</option>
                                      @foreach($tipe as $tp)
                                      <option value="{{$tp->tipe}}">{{$loop->iteration.'. '.$tp->tipe}}</option>
                                      @endforeach
                                    </optgroup>
                                </select> 

                            </div>
                            <div class="col-sm">
                              <input type="date" class="form-control" name="mulai" id="mulai" value="{{old('mulai')}}"/>
                            </div>
                            <div class="col-sm">
                              <input type="date" class="form-control" name="sampai" id="sampai"/>
                            </div>
                            <div class="col-sm">
                                <button type="button" id="btnSubmit" onclick="filter()" class="btn btn-success w-100"><i class="bi bi-sort-up-alt"></i> Filter</button>
                                <button type="button" id="btnLoading" class="btn btn-secondary w-100">Loading...</button>
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
            <!-- End Table Filter -->


            <!-- Table Mutasi 5 Hari -->

            <div class="col-12" id="tableMutasi">
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

  <script src="{{asset('Admin/assets/js/mutasi.js')}}"></script>
  @endsection
