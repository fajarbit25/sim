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
            <div class="col-xxl-12 col-md-12">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">NISN : {{$students->nisn}} </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        {{-- <i class="bi bi-person-bounding-box"></i> --}}
                        <img src="{{asset('/storage/photo-users/'.Auth::user()->photo)}}" alt="profile" style="width: 100%;">
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
                  <h5 class="card-title">Statistik Nilai Siswa</h5>
    
                  <!-- Line Chart -->
                  <div id="lineChart"></div>
    
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#lineChart"), {
                        series: [{
                          name: "Taffidz",
                          data: [10, 41, 35, 51, 49, 62, 69, 91, 95]
                        },
                        {
                          name: "Bahasa Asing",
                          data: [10, 40, 30, 43, 40, 60, 60, 90, 70]
                        },
                        {
                          name: "Ekstra Kulikuler",
                          data: [10, 51, 43, 44, 50, 70, 78, 90, 100]
                        },
                      ],
                        chart: {
                          height: 350,
                          type: 'line',
                          zoom: {
                            enabled: false
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'straight'
                        },
                        grid: {
                          row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                          },
                        },
                        xaxis: {
                          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->
    
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
                            <h5 class="mb-1 text-success">50 Ayat</h5>
                            <small>Diperbahaui 2023-10-19</small>
                          </div>
                          <p class="mb-1">Tahfidz</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                          <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-success">85/100</h5>
                            <small class="text-muted">Diperbahaui 2023-10-19</small>
                          </div>
                          <p class="mb-1">Bahasa Asing</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                          <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">95/100</h5>
                            <small class="text-muted">Diperbahaui 2023-10-19</small>
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
                    Rata-Rata Nilai Siswa
                  </h3>
                  <p>
                    <strong class="fst-italic">
                      Rata-rata nilai semua semester yang telah diselesaikan.
                    </strong>
                  </p>
                </div>
              </div>
            </div>
            @foreach ($nilai as $item)

            <!-- Study Card -->
            <div class="col-xxl-12 col-md-12">
              <div class="card info-card sales-card">

                <div class="card-body">

                  <div class="d-flex align-items-center mt-3">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-mortarboard"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        {{$item->nilai}}/100 
                        @if($item->nilai >= 90 && $item->nilai <= 100) <span class="fw-bold text-success">(A)</span>
                        @elseif($item->nilai >= 80 && $item->nilai <= 89) <span class="fw-bold text-success">(B)</span>
                        @elseif($item->nilai >= 70 && $item->nilai <= 79) <span class="fw-bold text-info">(C)</span>
                        @elseif($item->nilai >= 60 && $item->nilai <= 69) <span class="fw-bold text-warning">(D)</span>
                        @else<span class="fw-bold text-danger">(E)</span>@endif
                      </h6>
                      <span class="text-success small pt-1 fw-bold"> {{$item->nama_mapel}} </span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Study Card -->

            @endforeach

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->
  @endsection
