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
              <h5 class="card-title"> {{$title}} </h5>
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-dark  alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">INVOICE ID #{{$verif->nomor_invoice}} </h4>
                        
                        <p>
                            <span class="fw-bold">Transfer Dari : </span> {{$verif->name}} <br/>
                            <span class="fw-bold">Nomor Rekening : </span> {{$verif->account_id}} <br/>
                            <span class="fw-bold">Nama Bank : </span> {{$verif->bank_name}} <br/>
                        </p>
                        <hr>
                        <span class="fw-bold"> Untuk Pembayaran : </span> {{$verif->description}} <br/>
                        <span class="fw-bold"> Jumlah Uang : </span>
                        <h4 class="alert-heading">Rp.{{number_format($verif->amount)}}</h4>
                        <hr>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaVerify">
                          <i class="bi bi-check-circle"></i> Verifkasi
                        </button>
                        <button type="button" class="btn btn-info" onclick="loadEvidence()">
                          <i class="bi bi-image"></i> Lihat Bukti Transfer
                      </button>
                    </div>
                </div>

                <div class="col-md-12" id="evidence">
                  <h4 class="card-title">Bukti Transaksi</h4>
                  <hr>
                  <img src="{{asset('storage/confirm-payment/'.$verif->evidence)}}" alt="foto-bukti" style="max-width: 100%;">
                  <hr>
                </div>

              </div>
              

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="modaVerify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Verifikasi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{url('/finance/verify/confirm')}}">
          @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="status">Pilih Aksi</label>
            <select name="status" id="status" class="form-control">
                <optgroup label="Pilih Status">
                    <option value="PAID">Terima Pembayaran</option>
                    <option value="CANCELLED">Tolak Pembayaran</option>
                </optgroup>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="hidden" name="kode_transaksi" value="{{$verif->kode_transaksi}}" required/>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>



{{-- JavaScript --}}

<script type="text/javascript">
  $(document).ready(function(){
    $("#evidence").hide();
  });

  function disabled()
  {
    Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Pembayaran belum dikonfirmasi!',
            });
  }

  function loadEvidence()
  {
    $("#evidence").show();
  }

</script>

@endsection