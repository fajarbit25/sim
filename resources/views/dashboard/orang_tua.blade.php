@extends('template/layout')
@section('main')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
            <div class="col-xxl-12 col-md-12">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">NIS/NISN : {{$students->nisn}} </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        {{-- <i class="bi bi-person-bounding-box"></i> --}}
                        <img src="{{Auth::user()->photo}}" alt="profile" style="width: 100%;">
                    </div>
                    <div class="ps-3">
                      <h6>{{Auth::user()->first_name}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{$campus->campus_initial}}</span> <span class="text-muted small pt-2 ps-1">{{$campus->campus_name}}</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            @if($countInv != 0)
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title">Informasi!</h2>
                  <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> &nbsp;
                    <div>
                      <a href="/user/invoice">
                      <span class="fst-italic"> Terdapat </span> <span class="fst-italic fw-bold">{{$countInv}} </span>
                      <span>tagihan pembayaran perlu dikonfirmasi!</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              @endif

            @if($ppdb->status == 1)
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title">Informasi!</h2>
                  <div class="alert alert-success col-md-12">
                    <p>
                        Data PPDB anda <span class="fw-bold">dalam antrian</span> verifikasi. Pantau terus untuk mendapatkan update.<br/><br/>
                        Terima Kasih<br/>
                        Salam
                        <br/>
                        <br/>
                        Management
                    </p>
                  </div>
                  <div class="col-sm-12">
                    <a href="/ppdb/selesai" class="fw-bold btn btn-primary btn-sm">
                      Cek data ppdb <i class="bi bi-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endif

            @if($ppdb->status == 400)
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title">Informasi!</h2>
                  <div class="alert alert-success col-md-12">
                    <p>
                        Data PPDB anda <span class="fw-bold">sedang diverifikasi</span> oleh admin. 
                        kami akan mengirimkan kepada anda informasi apabila data telah diverifikasi.<br/><br/>
                        Terima Kasih<br/>
                        Salam
                        <br/>
                        <br/>
                        Management
                    </p>
                  </div>
                  <div class="col-sm-12">
                    <a href="/ppdb/selesai" class="fw-bold btn btn-primary btn-sm">
                      Cek data ppdb <i class="bi bi-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endif

            @if($ppdb->status == 200 || $ppdb->status == 500)
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title">Informasi!</h2>
                  <div class="alert alert-success col-md-12">
                    <p>
                      Data anda <span class="fw-bold">telah diverifikasi.</span> 
                      Silahkan cek pengumuman PPDB anda melalui tautan dibawah!.
                      <br/>
                      <br/>
                        Terima Kasih<br/>
                        Salam
                        <br/>
                        <br/>
                        Management
                    </p>
                  </div>
                  <div class="col-sm-12">
                    <a href="/ppdb/selesai" class="fw-bold btn btn-primary btn-sm">
                      Cek hasil verifikasi <i class="bi bi-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endif

            @if($user->kelas != 0)

            @if(Auth::user()->campus_id == 2)
              @livewire('tk.report.today-activity')
            @endif

            {{-- Line Chart --}}

            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Recent Activity <span>| today</span></h5>
                  <div class="activity">

                    @foreach($logs as $log)
                    <div class="activity-item d-flex">
                      <div class="activite-label"><i class="bi bi-clock-history"></i> {{$log->jam}} </div>
                      <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                      <div class="activity-content">
                        {{$log->tipe}} Mata pelajaran  <br/> <span class="fw-bold text-dark"> {{$log->nama_mapel}} </span>
                      </div>
                    </div><!-- End activity item-->
                    @endforeach

                    {{-- <div class="activity-item d-flex">
                      <div class="activite-label"><i class="bi bi-clock-history"></i> 06:30</div>
                      <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                      <div class="activity-content">
                        Absensi mata pelajaran <span class="fw-bold text-dark">Bahasa Indonesia</span>
                      </div>
                    </div> --}}

                  </div>
                </div>
              </div>
            </div>

            {{-- End Line Chart --}}
            @endif
          </div>
        </div><!-- End Left side columns -->

      </div>

      {{-- Modal PPDB --}}
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-exclamation-triangle"></i> Alert!</h1>
              {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
              Silahkan melanjutkan pedaftaran PPDB..
            </div>
            <div class="modal-footer">
              {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
              <a href="/ppdb" class="btn btn-success">Lanjutkan <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>

    </section>

    <input type="hidden" name="level-status" id="level-status" value="{{Auth::user()->status}}">
    <script src="{{asset('Admin/assets/js/dashboard.js')}}"></script>
  </main><!-- End #main -->

  @endsection
