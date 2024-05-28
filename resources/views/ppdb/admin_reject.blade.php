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
              <h5 class="card-title">{{$title}}</h5>

                    <table class="table datatable" style="font-size: 13px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nomor Registrasi</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Sekolah Asal</th>
                                <th>Pembayaran</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ppdb as $p)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$p->nomor_pendaftaran}}</td>
                                <td>{{$p->first_name}}</td>
                                <td>{{$p->gender}}</td>
                                <td>{{$p->sekolah_asal}}</td>
                                <td>
                                    @if($p->invoice_status == 'UNPAID')<span class="fw-bold text-secondary">{{$p->invoice_status}}</span>@endif
                                    @if($p->invoice_status == 'PENDING')<span class="fw-bold text-warning">{{$p->invoice_status}}</span>@endif
                                    @if($p->invoice_status == 'PAID')<span class="fw-bold text-success">{{$p->invoice_status}}</span>@endif
                                    @if($p->invoice_status == 'CANCELLED')<span class="fw-bold text-danger">{{$p->invoice_status}}</span>@endif
                                </td>
                                <td>
                                  @if($p->invoice_status == 'PAID')
                                    <a href="/admin/{{$p->id}}/ppdb_review" class="badge text-success"> VERIFIKASI <i class="bi bi-arrow-right-circle"></i></a>
                                  @else
                                    <a href="#" class="badge text-success" onclick="disabled()"> VERIFIKASI <i class="bi bi-arrow-right-circle"></i></a>
                                  @endif
                                  </td>
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


<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus-lg"></i> Tambah Prestasi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formPrestasi">
            <div class="row mb-3">
                <label for="jenis" class="col-sm-4 col-form-label">1. Jenis Prestasi</label>
                <div class="col-sm-8">
                  <select name="jenis" id="jenis" class="form-control" required>
                    <optgroup label="Pilih Jenis Prestasi">
                        <option value="Sains">1. Sains</option>
                        <option value="Seni">2. Seni</option>
                        <option value="Olahraga">3. Olahraga</option>
                        <option value="Lain-lain">4. Lain-lain</option>
                    </optgroup>
                  </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tingkat" class="col-sm-4 col-form-label">2. Tingkat</label>
                <div class="col-sm-8">
                  <select name="tingkat" id="tingkat" class="form-control" required>
                    <optgroup label="Pilih Tingkat">
                        <option value="Sekolah">1.Sekolah</option>
                        <option value="Kecamatan">2. Kecamatan</option>
                        <option value="Kabupaten">3. Kabupaten</option>
                        <option value="Provinsi">4. Provinsi</option>
                        <option value="Nasional">5. Nasional</option>
                        <option value="Internasional">6. Internasional</option>
                    </optgroup>
                  </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama_prestasi" class="col-sm-4 col-form-label">3. Nama Prestasi</label>
                <div class="col-sm-8">
                  <input type="text" name="nama_prestasi" id="nama_prestasi" class="form-control" required/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tahun" class="col-sm-4 col-form-label">4. Tahun</label>
                <div class="col-sm-8">
                  <input type="text" name="tahun" id="tahun" class="form-control" required/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="penyelenggara" class="col-sm-4 col-form-label">5. Penyelenggara</label>
                <div class="col-sm-8">
                  <input type="text" name="penyelenggara" id="penyelenggara" class="form-control" required/>
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="btnSavePrestasi" onclick="savePrestasi()">Simpan</button>
          <button type="button" class="btn btn-secondary" id="btnLoadingPrestasi" onclick="savePrestasi()"><i class="bi bi-arrow-clockwise"></i> Loading...</button>
        </div>
      </div>
    </div>
  </div>
  


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