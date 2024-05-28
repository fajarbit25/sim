@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>PPDB</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> Progres Pendaftaran </h5>
              <!-- Progress Bars with labels-->
              <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{$percent}}%" aria-valuenow="{{$valueNow}}" aria-valuemin="0" aria-valuemax="$valueMax">{{$percent}}%</div>
              </div>
              <!-- End Progress Bars with labels-->
            </div>
          </div>
        </div>
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> 9. Pernyataan</h5>
                <p>
                  Dengan mengklik tombol <strong>setuju</strong> dibawah, 
                  saya menyatakan bahwa data yang saya masukan adalah data yang benar dan dapat dipertanggung jawabkan.
                </p>
                {{-- Form Upload Akta Lahir --}}
                <form action="" enctype="multipart/form-data">

                    <div class="mb-5">
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="setuju" id="setuju1" autocomplete="off" checked>
                            <label class="btn btn-outline-success" for="setuju1">Setuju</label>
                          
                            <input type="radio" class="btn-check" name="tidaksetuju" id="tidaksetuju2" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="tidaksetuju2">Tidak Setuju</label>
                          </div>
                    </div>

                </form>


                <div class="mb-3 text-end">
                    {{-- <button type="submit" class="btn btn-success">Konfirmasi Pembayaran <i class="bi bi-arrow-right"></i></button> --}}
                    <a href="/ppdb/selesai" class="btn btn-success">Selanjutnya <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

{{-- JavaScript --}}
<script src="{{asset('Admin/assets/js/guru.js')}}"></script>

@endsection