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
                              <strong>Jenis Tagihan : </strong> {{$invoice->tipe}} <br/>
                              <strong>Jumlah Tagihan : </strong> {{number_format($invoice->amount)}} <br/>
                              <strong>Status : </strong>
                              @if($invoice->invoice_status == 'PAID')<span class="badge bg-success rounded-pill">{{$invoice->invoice_status}}</span>@endif
                              @if($invoice->invoice_status == 'PENDING')<span class="badge bg-warning rounded-pill">{{$invoice->invoice_status}}</span>@endif
                              @if($invoice->invoice_status == 'CANCELLED')<span class="badge bg-danger rounded-pill">{{$invoice->invoice_status}}</span>@endif
                              <br/>
                              <strong>Keterangan : </strong> {{$invoice->description}}
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                @if($invoice->invoice_status == 'PAID')
                                    <i class="bi bi-credit-card"></i> #Lihat Pembayaran
                                @else
                                    <i class="bi bi-credit-card"></i> #Konfirmasi Pembayaran
                                @endif

                            </button>
                          </h2>
                          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="col-sm-12">

                                    @if($invoice->invoice_status != 'PAID')

                                    <form id="formPayment" enctype="multipart/form-data">
                                        @csrf
                                        <div class="for-group mb-3">
                                            <label for="nama">Nama Pengirim <span class="text-danger">*</span> </label>
                                            <input type="text" name="nama" id="nama" class="form-control" required/>
                                        </div>
                                        <div class="for-group mb-3">
                                            <label for="rekening">Nomor Rekening Pengirim <span class="text-danger">*</span> </label>
                                            <input type="text" name="rekening" id="rekening" class="form-control" required/>
                                        </div>
                                        <div class="for-group mb-3">
                                            <label for="jumlah">Nominal <span class="text-danger">*</span> </label>
                                            <input type="number" name="jumlah" id="jumlah" class="form-control" required/>
                                        </div>
                                        <div class="for-group mb-3">
                                            <label for="bank">Bank <span class="text-danger">*</span> </label>
                                            <select name="bank" id="bank" class="form-control">
                                                <optgroup label="Pilih Bank">
                                                    <option value="BRI">BRI</option>
                                                    <option value="BNI">BNI</option>
                                                    <option value="Mandiri">Mandiri</option>
                                                    <option value="BCA">BCA</option>
                                                    <option value="BTN">BTN</option>
                                                    <option value="CIMB Niaga">CIMB Niaga</option>
                                                    <option value="Danamon">Danamon</option>
                                                    <option value="BSI">BSI</option>
                                                    <option value="Permata">Permata</option>
                                                    <option value="OCBC NISP">OCBC NISP</option>
                                                    <option value="Panin">Panin</option>
                                                    <option value="BPD">BPD</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="for-group mb-3">
                                            <label for="bukti">Bukti Transfer <span class="text-danger">*</span> </label>
                                            <input type="file" name="bukti" id="bukti" class="form-control" required/>
                                        </div>
                                        <div class="for-group mb-3">
                                            <button type="button" class="btn btn-success w-100" id="btn-send">Kirim <i class="bi bi-send-check"></i></button>
                                        </div>
                                    </form>

                                    @else

                                    <strong>Nama Pengirim : </strong> {{$confirm->name}} <br/>
                                    <strong>Nomor Rekening : </strong> {{$confirm->account_id}} <br/>
                                    <strong>Nominal : </strong> {{number_format($confirm->amount)}} <br/>
                                    <strong>Bank : </strong> {{$confirm->bank_name}} <br/>
                                    <strong>Bukti Transfer : </strong> 
                                    <a href="#" onclick="buktiTransfer({{$confirm->invoice_id}})" class="fw-bold">{{$confirm->evidence}}</a>

                                    @endif

                                </div>
                            </div>
                          </div>
                        </div>
                    </div>

                      <a href="/user/invoice" class="btn btn-secondary my-3 w-100"><i class="bi bi-arrow-left"></i> Back</a>
    
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
  </script>
  @endsection
