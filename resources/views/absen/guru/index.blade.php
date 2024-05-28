@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>SIMS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        
        <div class="col-sm-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><i class="bi bi-table"></i> {{$title}}</h5>
  
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" 
                    type="button" role="tab" aria-controls="home" aria-selected="true">
                      <i class="bi bi-alarm"></i> Today
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" 
                    type="button" role="tab" aria-controls="profile" aria-selected="false">
                      <i class="bi bi-table"></i> Report
                    </button>
                  </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                  <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-sm-12" id="tableAbsenGuruToday">
                    </div>
                  </div>
                  <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                    @livewire('teacher-attendance.data')
                  </div>
                </div><!-- End Bordered Tabs -->
  
              </div>
            </div>



        </div><!--Col-->
        
      </div> <!--End Row-->
    </section>
</main>
<script src="{{asset('Admin/assets/js/v1/absen_guru.js')}}"></script>
@endsection
