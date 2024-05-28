@extends('template.layout')
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

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Banner Website</h5>

                    <!-- Slides with indicators -->
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    </div><!-- End Slides with indicators -->

                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Banner Active</h5>
                    <button type="button" class="btn btn-success btn-sm" onclick="modalupdate(1)"> <i class="bi bi-upload"></i> Upload</button>
                    <div class="table-responsive" id="table-banner"> 
                    </div>

                </div>
            </div>
        </div>

    </div>
    
    {{-- Modal Upload --}}
    <div class="modal" id="modalupdate" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="bi bi-card-image"></i> Ganti Banner</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="fotoForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Keterangan</span>
                            <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" aria-label="Keterangan" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="file" name="foto" class="form-control" id="foto" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            <button class="btn btn-outline-success" onclick="uploadFoto()" type="button" title="Upload" id="inputGroupFileAddon04"><i class="bi bi-upload"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

</main>
<script src="{{url('Admin/assets/js/banner.js')}}"></script>
@endsection


