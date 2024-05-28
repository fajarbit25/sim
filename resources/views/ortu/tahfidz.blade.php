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

            <!--  Card -->
            <div class="col-xxl-12 col-md-12">
              <div class="card info-card sales-card">

                <div class="card-body mt-3">

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-book-half"></i>
                    </div>
                    <div class="ps-3">
                      <h6>Tahfidz</h6>
                      <span class="text-success small pt-1 fw-bold">2012104481</span> 
                      <span class="text-muted small pt-2 ps-1">Muhammad Albi</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End  Card -->


            <!-- Reports -->
            <div class="col-12">
                <div class="card">
  
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
  
                      <li><a class="dropdown-item" href="#">Today</a></li>
                      <li><a class="dropdown-item" href="#">This Month</a></li>
                      <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>
  
                  <div class="card-body">
                    <h5 class="card-title">Reports <span>/day</span></h5>
  
                    <!-- Line Chart -->
                    <div id="reportsChart"></div>
  
                    <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#reportsChart"), {
                          series: [{
                            name: 'Tahfidz',
                            data: [10, 5, 20, 25, 30, 24, 25, 20],
                          }],
                          chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                              show: false
                            },
                          },
                          markers: {
                            size: 4
                          },
                          colors: ['#4154f1'],
                          fill: {
                            type: "gradient",
                            gradient: {
                              shadeIntensity: 1,
                              opacityFrom: 0.3,
                              opacityTo: 0.4,
                              stops: [0, 90, 100]
                            }
                          },
                          dataLabels: {
                            enabled: false
                          },
                          stroke: {
                            curve: 'smooth',
                            width: 2
                          },
                        //   xaxis: {
                        //     type: 'datetime',
                        //     categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        //   },
                        xaxis: {
                            type: 'day',
                            categories: ["Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Senin", "Selasa"]
                          },

                          tooltip: {
                            x: {
                              format: 'dd/MM/yy HH:mm'
                            },
                          }
                        }).render();
                      });
                    </script>
                    <!-- End Line Chart -->
  
                  </div>
  
                </div>
              </div><!-- End Reports -->


            <!--  Card -->
            <div class="col-xxl-12 col-md-12">
                <div class="card info-card sales-card">
  
                  <div class="card-body mt-3">
  
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-book-half"></i>
                      </div>
                      <div class="ps-3">
                        <h6>340 / 6.214 Ayat</h6>
                        <span class="text-success small pt-1 fw-bold">Proses/Target</span> 
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End  Card -->

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->
  @endsection
