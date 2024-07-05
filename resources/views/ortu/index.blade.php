@extends('template/layout')
@section('main')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
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
            <div class="col-xxl-12 col-md-12">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">NISN : {{$students->nisn}} </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        {{-- <i class="bi bi-person-bounding-box"></i> --}}
                        <img src="{{Auth::user()->photo}}" alt="profile" style="width: 100%;">
                    </div>
                    <div class="ps-3">
                      <h6>{{Auth::user()->first_name}} </h6>
                      <span class="text-success small pt-1 fw-bold">{{$campus->campus_initial}}</span> <span class="text-muted small pt-2 ps-1">{{$campus->campus_name}}</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->


            {{-- Line Chart --}}

            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Statistik Tahfidz</h5>
    
                  @livewire('ortu.chart-statistik') 
    
                </div>
              </div>
            </div>

            {{-- End Line Chart --}}
    
                </div>
              </div>
            </div>

            {{-- End Bar Chart --}}

            <!-- Table Filter -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Statistik</h5>
        
                      <!-- List group with Advanced Contents -->
                      <div class="list-group">
                        <a href="/user/{{Auth::user()->id}}/tahfidz" class="list-group-item list-group-item-action" aria-current="true">
                          <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-success">50 Surah</h5>
                            <small>Diperbaharui 2023-10-19</small>
                          </div>
                          <p class="mb-1">Tahfidz</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                          <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-success">85/100</h5>
                            <small class="text-muted">Diperbaharui 2023-10-19</small>
                          </div>
                          <p class="mb-1">Bahasa Asing</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                          <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">95/100</h5>
                            <small class="text-muted">Diperbaharui 2023-10-19</small>
                          </div>
                          <p class="mb-1">Ekstrakurikuler</p>
                        </a>
                      </div><!-- End List group Advanced Content -->
        
                    </div>
                </div>
            </div>
            <!-- End Table Filter -->

            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">
                   Rata-Rata Nilai
                  </h3>
                  @livewire('ortu.nilai-siswa')
                </div>
              </div>
            </div>


          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->
  @endsection
