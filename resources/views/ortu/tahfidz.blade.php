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
                      <span class="text-success small pt-1 fw-bold">{{$student->nisn}}</span> 
                      <span class="text-muted small pt-2 ps-1">{{Auth::user()->first_name}}</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End  Card -->


            <!-- Reports -->
            <div class="col-12">
                <div class="card">
  
                  <div class="card-body">
                    <h5 class="card-title">Reports <span>/surah</span></h5>
  
                    @livewire('ortu.chart-statistik') 
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
                        <h6>{{$nilai->avg('nilai')}}</h6>
                        <span class="text-success small pt-1 fw-bold">Nilai Rata-Rata</span> 
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
