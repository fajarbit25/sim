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
                <div class="progress-bar bg-success" role="progressbar" style="width: {{$percent}}%" aria-valuenow="{{$valueNow}}" aria-valuemin="0" aria-valuemax="{{$valueMax}}">{{$percent}}%</div>
              </div>
              <!-- End Progress Bars with labels-->
            </div>
          </div>
        </div>
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> 1. Pembayaran Uang Pendaftaran</h5>
                <div class="alert alert-info">
                  <p>
                    Sebelum mengisi formulir pendaftaran, Silakan konfirmasi pembayaran biaya pendaftaran<br/><br/>

                    Biaya pendaftaran sebesar:<br/>
                    <strong>Rp. 350.000,-</strong>
                    <strong>
                        Dapat ditransfer ke rekening<br/>
                        Bank Syariah Indonesia (BSI)<br/>
                        No. Rekening : 7211484343<br/>
                        An. PPDB SMKIT Ibnul Qayyim Makassar<br/>
                    </strong>
                  </p>
                </div>
                <h5 class="card-title">Konfirmasi Pembayaran</h5>
                <form action="{{url('/ppdb/payment_confirm')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file"> Upload Bukti Pembayaran <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <input type="file" name="file" class="form-control" id="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                        @error('file')
                            <div class="form-text text-danger fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_pengirim">Nama Pengirim <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pengirim" id="nama_pengirim" value="{{old('nama_pengirim')}}" class="form-control @error('nama_pengirim') is-invalid @enderror" required autocomplete="off"/>
                        @error('nama_pengirim')
                            <div class="form-text text-danger fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="rek_pengirim">Nomor Rekening Pengirim <span class="text-danger">*</span></label>
                        <input type="text" name="rek_pengirim" id="rek_pengirim" value="{{old('rek_pengirim')}}" class="form-control @error('rek_pengirim') is-invalid @enderror" required autocomplete="off"/>
                        @error('rek_pengirim')
                            <div class="form-text text-danger fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="bank">Nama Bank <span class="text-danger">*</span></label>
                        <select name="bank" id="bank" class="form-control">
                            <option value="BSI">PT BANK SYARIAH INDONESIA Tbk *</option>
                            <option value="BRI">PT BANK RAKYAT INDONESIA (PERSERO) Tbk</option>
                            <option value="Mandiri">PT BANK MANDIRI (PERSERO) Tbk</option>
                            <option value="BNI">PT BANK NEGARA INDONESIA (PERSERO) Tbk</option>
                            <option value="BTN">PT BANK TABUNGAN NEGARA (PERSERO) Tbk</option>
                            <option value="BCA">PT BANK CENTRAL ASIA Tbk</option>
                            <option value="BPD">PT BPD SULAWESI SELATAN DAN SULAWESI BARAT</option>
                            <option value="OTHERS">Lainnya</option>
                        </select>
                        @error('bank')
                            <div class="form-text text-danger fw-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-end">
                        <input type="hidden" name="invoice_id" value="{{$invoice->idiv}}" id="invoice_id" required/>
                        <input type="hidden" name="campus_id" value="{{Auth::user()->id}}" id="campus_id" required/>
                        <button type="submit" class="btn btn-success">Konfirmasi Pembayaran <i class="bi bi-arrow-right"></i></button>
                    </div>
                </form>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  
  {{-- JavaScript --}}
<script src="{{asset('Admin/assets/js/guru.js')}}"></script>

@endsection