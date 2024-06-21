@extends('template/layout')
@section('main')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-sm-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Detail Transaksi</h5>

                <div class="row">
                    <div class="col-sm-2 fw-bold"> Nomor Transaksi </div>
                    <div class="col-sm-10 fw-bold text-success">:  {{$invoice->kode_transaksi}} </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 fw-bold"> Tipe Transaksi </div>
                    <div class="col-sm-10">:  {{$invoice->jenis_transaksi}} </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 fw-bold"> Jenis Transaksi </div>
                    <div class="col-sm-10">:  {{$invoice->tipe_transaksi}} </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 fw-bold"> Tanggal Transaksi </div>
                    <div class="col-sm-10">:  {{$invoice->invoice_date}} </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 fw-bold"> Status Pembayaran </div>
                    <div class="col-sm-10 fw-bold">:  {{$invoice->invoice_status}} </div>
                </div>
                <div class="row">
                  <div class="col-sm-2 fw-bold"> Tagihan </div>
                  @php
                      $totalDiscount = $discount->sum('total_discount');
                  @endphp
                  <div class="col-sm-10 fw-bold">:  Rp.{{number_format($invoice->amount+$totalDiscount)}},- </div>
                </div>
                <div class="row">
                  <div class="col-sm-2 fw-bold"> Total Potongan </div>
                  <div class="col-sm-10">: <br/>
                    @foreach($discount as $item)
                       <span class="fw-bold">-Rp.{{number_format($item->total_discount)}},-</span> <span>{{$item->jenis_discount}}</span><br/>
                    @endforeach
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2 fw-bold"> Total Tagihan </div>

                  <div class="col-sm-10 fw-bold">:  Rp.{{number_format($invoice->amount)}},- </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 fw-bold"> Keterangan </div>
                    <div class="col-sm-10">:  {{$invoice->description}} </div>
                </div>

                <div class="row">
                  <div class="col-sm-12 my-3">
                    <a href="javascript:history.back()" class="btn btn-secondary"><i class="bi bi-arrow-left-short"></i> Kembali</a>
                  </div>
                </div>
                

              </div>
            </div>
  
          </div>
        </div>
      </section>

  </main><!-- End #main -->
  <script src="{{asset('Admin/assets/js/transaksi.js')}}"></script>
  @endsection
