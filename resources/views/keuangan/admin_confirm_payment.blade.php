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
              <h5 class="card-title"> {{$title}}</h5>

                    <table class="table datatable" style="font-size: 13px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nomor Invoice</th>
                                <th>Nama Pengirim</th>
                                <th>Nomor Rekening</th>
                                <th>Bank</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($confirm as $con)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> 
                                  <a href="/finance/{{$con->kode_transaksi}}/verify">
                                  <span class="fw-bold text-success">{{'#'.$con->nomor_invoice}}</span> 
                                  </a>
                                </td>
                                <td> {{$con->name}} </td>
                                <td> {{$con->account_id}} </td>
                                <td> {{$con->bank_name}} </td>
                                <td> <span class="fw-bold">{{'Rp.'.number_format($con->amount)}}</span> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  


{{-- JavaScript 
<script src="{{asset('Admin/assets/js/ppdb.js')}}"></script>--}}
<script type="text/javascript">
  function disabled()
  {
    Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Pembayaran belum dikonfirmasi!',
            });
  }
</script>

@endsection