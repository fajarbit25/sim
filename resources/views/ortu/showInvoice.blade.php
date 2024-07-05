@extends('template/layout')
@section('main')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/user/invoice">Invoice</a></li>
          <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            {{-- Line Chart --}}

            <div class="col-lg-12">
                <div class="card recent-sales overflow-auto">
    
                    <div class="card-body">
                      <h5 class="card-title">Detail Invoice <span>| {{$title}}</span></h5>

                      <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                <i class="bi bi-receipt"></i> #Lihat Tagihan
                            </button>
                          </h2>
                          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                              <strong>Nomor Invoice : </strong> {{$invoice->nomor_invoice}} <br/>
                              <strong>Kode Transaksi : </strong> {{$invoice->kode_transaksi}} <br/>
                              <strong>Tanggal Invoice : </strong> {{$invoice->invoice_date}} <br/>
                              <strong>Jenis Tagihan : </strong> {{$invoice->jenis_transaksi}} <br/>
                              <strong>Keterangan : </strong> {{$invoice->description}}<br/>
                              <strong>Status :</strong>
                              @if($invoice->invoice_status == 'PAID' || $invoice->invoice_status == 'Paid' )<span class="badge bg-success rounded-pill">{{$invoice->invoice_status}}</span>@endif
                              @if($invoice->invoice_status == 'PENDING' || $invoice->invoice_status == 'Unpaid')<span class="badge bg-warning rounded-pill">{{$invoice->invoice_status}}</span>@endif
                              @if($invoice->invoice_status == 'CANCELLED')<span class="badge bg-danger rounded-pill">{{$invoice->invoice_status}}</span>@endif
                              <hr/>
                              @php
                                  $totalDiscount = $discount->sum('total_discount');
                              @endphp
                              <strong>Jumlah Tagihan : </strong> Rp.{{number_format($invoice->amount+$totalDiscount)}},- <br/>
                              <strong>Potongan : </strong> <br/>
                              @foreach($discount as $disc)
                              {{$disc->jenis_discount}} :  Rp.{{number_format($disc->total_discount)}},- <br/>
                              @endforeach
                              <hr>
                              <strong>Total Tagihan :Rp.{{number_format($invoice->amount)}},-  </strong>
                              <hr/>
                              
                            </div>
                          </div>
                          <div class="col-sm-12">
                            
                          </div>
                          @if($invoice->invoice_status == 'Unpaid')
                            <div class="col-sm-12 m-3">
                                <a href="javascript:void(0)" class="btn btn-success w-100" onclick="confirmPayment()"><i class="bi bi-credit-card"></i> Bayar</a>
                            </div>
                          @endif
                    </div>

                      <a href="/user/invoice/" class="btn btn-secondary my-3 w-100"><i class="bi bi-arrow-left"></i> Kembali</a>
    
                </div>
            </div>

          </div> {{-- Row --}}
        </div><!-- End Left side columns -->

      </div>{{-- Row --}}
    </section>

  <!-- Modal -->
  <div class="modal fade" id="modal-eviden" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img id="img-evidence" alt="img" style="width: 100%;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="confirmPay" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Informasi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @if($invoice->invoice_status == 'Unpaid')
          <div class="col-sm-12 p-3">
              <span class="fw-bold">Informasi.</span><br/>
              <div class="alert alert-info">
                <span class="fw-bold">Pembayaran Instant Via Virtual Account, Merchant & E-Wallet.</span><br/>
                <span class="mb-3" style="font-size: 11px;">
                  -Segera Lakukan Pembayaran setelah memilih metode pembayaran.<br/>
                  -Metode Pembayaran tidak dapat diubah.<br/>
                  -Jika mengalami kendala, Segera hubungi pihak sekolah!.<br/>
                  -Setelah memilih metode pembayaran, Halaman pembayaran tidak dapat diakses kembali <br/>
                  -Harap Simpan/Download Kode Pembayaran anda.
                </span>
              </div>
              <div class="alert alert-info">
                <span class="fw-bold">Pembayaran Manual</span><br/>
                <span class="mb-3" style="font-size: 11px;">
                  -Simpan Bukti Transfer Lalu Upload Pada Form Yang Disediakan.<br/>
                </span>
            </div>
              <form action="{{route('ortu.checkout')}}" method="POST">
                @csrf
                <input type="hidden" name="kode_transaksi" value="{{$invoice->kode_transaksi}}">
                <button type="submit" class="btn btn-success w-100 mt-3"><i class="bi bi-credit-card"></i> Bayar Instant</button>
              </form>
              <a href="/user/invoice/{{$invoice->kode_transaksi}}/manual-payment" class="btn btn-primary w-100 mt-3"><i class="bi bi-credit-card"></i> Bayar Manual</a>
          </div>
          @endif
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>



  </main><!-- End #main -->
 

  <script type="text/javascript">

    function buktiTransfer(id)
    {
        var url = "/user/invoice/" + id + "/evidence";

        $.ajax({
            url:url,
            type:'GET',
            dataType:'json',
            success:function(data){
                console.log(data.evidence)
                $("#img-evidence").attr('src', '/storage/confirm-payment/'+ data.evidence)
            }
        });
        $("#modal-eviden").modal('show');
    }

    function confirmPayment()
    {
      $("#confirmPay").modal('show');
    }
  </script>
  @endsection
