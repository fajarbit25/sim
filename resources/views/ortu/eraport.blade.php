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
                  <h5 class="card-title">Nilai Ujian Semester</h5>
                  <p>
                    <strong>Semester :</strong>  @if($semester == 1) Ganjil @else Genap @endif <br/>
                    <strong>Tahun Ajaran : </strong> {{$ta}}
                  </p>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                            <th>Predikat</th>
                            <th>Deskripsi</th>
                        </tr>

                        @if(Auth::user()->campus_id == '2' || Auth::user()->campus_id == '3')
                          <tr>
                            <td colspan="5">
                              <i class="fw-bold">
                                Anda tidak dapat melihat nilai realtime, <br/> Silahkan hubungi pihak sekolah!
                              </i>
                            </td>
                          </tr>
                        @else 

                          @if(count($nilai) <= 0)
                            <tr>
                              <td colspan="5">
                                <i class="fw-bold"> Nilai Raport Belum Keluar </i>
                              </td>
                            </tr>
                          @else
                            @foreach($nilai as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama_mapel}}</td>
                                <td>
                                  {{$item->nilai}}
                                </td>
                                <td>
                                  @if($item->nilai >= 90 && $item->nilai <= 100) <span class="fw-bold text-success">A</span>
                                  @elseif($item->nilai >= 80 && $item->nilai <= 89) <span class="fw-bold text-success">B</span>
                                  @elseif($item->nilai >= 70 && $item->nilai <= 79) <span class="fw-bold text-info">C</span>
                                  @elseif($item->nilai >= 60 && $item->nilai <= 69) <span class="fw-bold text-warning">D</span>
                                  @else<span class="fw-bold text-danger">E</span>@endif
                                </td>
                                <td>{{$item->deskripsi}}</td>
                            </tr>
                            @endforeach
                          @endif
                        @endif


                    </table>
                  </div>
    
                </div>
              </div>
            </div>

          </div> {{-- Row --}}
        </div><!-- End Left side columns -->

      </div>{{-- Row --}}
    </section>

  </main><!-- End #main -->
  @endsection
