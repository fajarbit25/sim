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
                <div class="progress-bar bg-success" role="progressbar" style="width: {{$progresBar['percent']}}%" aria-valuenow="{{$progresBar['valueNow']}}" aria-valuemin="0" aria-valuemax="$valueMax">{{$progresBar['percent']}}%</div>
              </div>
              <!-- End Progress Bars with labels-->
            </div>
          </div>
        </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> 2. Upload Dokumen</h5>
                <div class="alert alert-info">
                    <p>
                        <strong>Catatan.</strong><br/>
                        1. Untuk Dokumen Format File dalam bentuk <strong>PDF</strong>.<br/>
                        2. Untuk Pas Foto Format File <strong>JPG, JPEG, & PNG</strong>.<br/> 
                        3. Pastikan Hasil Scan Terlihat Jelas. <br/>
                      </p>
                      
                </div>
                {{-- Loading Animasi --}}
                <div class="progress mb-3" id="animation" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                    <div class="bg-success progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div>
                </div>
                <div class="col-lg-12" id="formUploadDoc"></div>


                <div class="mb-3 text-end">
                    {{-- <button type="submit" class="btn btn-success">Konfirmasi Pembayaran <i class="bi bi-arrow-right"></i></button> --}}
                    <input type="hidden" name="iduser" id="iduser" value="{{Auth::user()->id}}" required/>
                    <a href="/ppdb/biodata" class="btn btn-success" id="linkNext">Selanjutnya <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

{{-- JavaScript --}}
<script src="{{asset('Admin/assets/js/ppdb.js')}}"></script>
<script type="text/javascript">
  $("#linkNext").click(function(){
    $(this).attr('disabled', true)
    $(this).html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')
  });
</script>
@endsection