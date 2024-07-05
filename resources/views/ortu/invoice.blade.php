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

            {{-- Line Chart --}}

            <div class="col-lg-12">
                <div class="card recent-sales overflow-auto">
    
                    <div class="card-body">
                      <h5 class="card-title">Your Invoice <span>| All</span></h5>

                      <ol class="list-group list-group-numbered">

                        @foreach($invoice as $inv)
                        <a href="/user/invoice/{{$inv->kode_transaksi}}/show">
                          <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                              <div class="fw-bold">Rp.{{number_format($inv->amount)}}</div>
                              <span class="fw-bold text-success">#{{$inv->nomor_invoice}}</span> <br/>
                              Pembayaran {{$inv->jenis_transaksi}}
                            </div>
                            <span class="badge bg-secondary rounded-pill">{{$inv->invoice_date}}</span>
                              @if($inv->invoice_status == 'Paid')<span class="badge bg-success rounded-pill">{{$inv->invoice_status}}</span>@endif
                              @if($inv->invoice_status == 'Pending')<span class="badge bg-warning rounded-pill">{{$inv->invoice_status}}</span>@endif
                              @if($inv->invoice_status == 'Unpaid')<span class="badge bg-danger rounded-pill">Unpaid</span>@endif
                          </li>
                        </a>
                        @endforeach
                      </ol>
    
                    </div>
    
                </div>
            </div>

          </div> {{-- Row --}}
        </div><!-- End Left side columns -->

      </div>{{-- Row --}}
    </section>

  </main><!-- End #main -->
  @endsection
