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
              <h5 class="card-title"> 8. Jawablah Pertanyaan Berikut</h5>

                {{-- Form Upload Akta Lahir --}}
                <form action="" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label for="qs-1" class="fw-bold">
                            1. Dari Mana Anda mendapatkan informasi tentang Ibnul Qayyim.? 
                        <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            {{-- <input type="file" class="form-control @error('akta_lahir') is-invalid @enderror" name="akta_lahir" id="akta_lahir" aria-describedby="akta_lahir" aria-label="Upload" required/> --}}
                            <textarea name="qs-1" id="qs-1"  rows="2" class="form-control @error('qs-1') is-invalid @enderror"></textarea>
                        </div>
                        @error('qs-1')<div class="form-text text-danger fw-bold">{{$messege}}</div>@enderror
                    </div>

                    <div class="mb-5">
                        <label for="qs-2" class="fw-bold">
                            2. Alasan Anda Memasukkan Anak Anda Di Ibnul Qayyim.? 
                        <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            {{-- <input type="file" class="form-control @error('akta_lahir') is-invalid @enderror" name="akta_lahir" id="akta_lahir" aria-describedby="akta_lahir" aria-label="Upload" required/> --}}
                            <textarea name="qs-2" id="qs-2"  rows="2" class="form-control @error('qs-2') is-invalid @enderror"></textarea>
                        </div>
                        @error('qs-2')<div class="form-text text-danger fw-bold">{{$messege}}</div>@enderror
                    </div>

                    <div class="mb-5">
                        <label for="qs-3" class="fw-bold">
                            3. Apa Harapan Anda Terhadap Ibnul Qayyim.?
                        <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            {{-- <input type="file" class="form-control @error('akta_lahir') is-invalid @enderror" name="akta_lahir" id="akta_lahir" aria-describedby="akta_lahir" aria-label="Upload" required/> --}}
                            <textarea name="qs-3" id="qs-3"  rows="2" class="form-control @error('qs-3') is-invalid @enderror"></textarea>
                        </div>
                        @error('qs-3')<div class="form-text text-danger fw-bold">{{$messege}}</div>@enderror
                    </div>

                </form>


                <div class="mb-3 text-end">
                    {{-- <button type="submit" class="btn btn-success">Konfirmasi Pembayaran <i class="bi bi-arrow-right"></i></button> --}}
                    <a href="/ppdb/pernyataan" class="btn btn-success">Selanjutnya <i class="bi bi-arrow-right"></i></a>
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