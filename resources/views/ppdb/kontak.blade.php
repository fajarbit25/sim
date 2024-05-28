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
              <h5 class="card-title"> 8. Informasi Kontak</h5>

                <form action="{{url('/ppdb/kontak')}}" method="POST" id="formData">
                    @csrf
                    
                    <div class="col-lg-12 my-3 row">
                        <label for="telephone" class="col-sm-2 col-form-label">Nomor Telepon Rumah <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                          <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" id="telephone" value="{{$user->telephone}}" required autocomplete="off">
                          <div class="form-text text-success fw-bold">
                            Nomor telpon rumah (milik pribada, orang tua, atau wali) tanpa tanda baca.
                          </div>
                        </div>
                        @error('telephone')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="phone" class="col-sm-2 col-form-label">Nomor HP <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                          <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{$user->phone}}" required autocomplete="off">
                          <div class="form-text text-success fw-bold">
                            Nomor telpon seluler (milik pribada, orang tua, atau wali) tanpa tanda baca.
                          </div>
                        </div>
                        @error('phone')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Alamat Email <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$user->email}}" required autocomplete="off">
                          <div class="form-text text-success fw-bold">
                            Diisi alamat surat elektronik (surel) peserta didik yang dapat dihubungi (milik pribada, orang tua, atau wali).
                          </div>
                        </div>
                        @error('email')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    
                    <div class="col-lg-12 mt-3 text-end">
                        <button type="submit" class="btn btn-success" id="btn-submit">Simpan dan lanjutkan <i class="bi bi-arrow-right"></i></button>
                    </div>
                </form>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->




{{-- JavaScript --}}
<script src="{{asset('Admin/assets/js/ppdb.js')}}"></script>
<script type="text/javascript">
  $("#formData").submit(function(){
    $("#btn-submit").attr('disabled', true)
    $("#btn-submit").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')
  });
</script>
@endsection