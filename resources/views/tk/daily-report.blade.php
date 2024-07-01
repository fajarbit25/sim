@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>SIMS</h1>
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
      @livewire('tk.report.today-activity-teacher')
    </section>
</main>


<div class="modal fade" id="modalAddKeterangan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-plus"></i> Tema</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" name="idhari" id="idhari">
          
          <div class="form-group mb-3">
            <label for="tag">Masukna Tema <span class="text-danger">*</span> </label>
            <input type="text" name="keterangan" id="keterangan" class="form-control">
            </select>   
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnAddKeterangan" onclick="addKeterangan()"><i class="bi bi-plus"></i> Tambahkan</button>
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->

<div class="modal fade" id="modalUploadFoto" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-plus"></i> Upload Foto Kegiatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" name="idhari" id="idhari">
          
          <div class="form-group mb-3">
            <div class="input-group">
              <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
              <button class="btn btn-danger" type="button" onclick="UploadFoto()" id="inputGroupFileAddon04">Upload</button>
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->

<div class="modal fade" id="modalDeleteKeterangan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-exclamation-circle"></i> Confirm!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" name="idKeterangan" id="idKeterangan">
          <div class="col-6 mb-3">
              <span class="fw-bold fst-italic">Hapus Keterangan?</span>
          </div>
          
          <div class="col-6 text-end">
            <button type="button" class="btn btn-danger" id="btnDeleteKeteranganTanggal" 
            onclick="deleteKeteranganTanggal()"><i class="bi bi-trash"></i> Hapus</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
          </div>

        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->



<script>
  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  });
</script>
@endsection
