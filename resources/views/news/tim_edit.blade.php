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
      <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Foto</h5>
                    <div class="col-sm-12 mb-3" id="fotoTim">
                    </div>
                    <form action="/tim/update/foto" method="POST" enctype="multipart/form-data" id="formFoto">
                        <div class="input-group">
                            @csrf
                            <input type="hidden" name="idteam" id="idteam" value="{{$tim->idteam}}" required/>
                            <input type="file" class="form-control" id="foto" name="foto" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            <button class="btn btn-outline-success" type="button" onclick="updateFoto()" id="inputGroupFileAddon04">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><span>Edit |</span> Our Team</h5>
                

                <form>
                    @csrf

                    <div class="row mb-3">
                      <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{$tim->nama}}" required autocomplete="off">
                        @error('nama')<div class="text-form text-danger fw-bold">{{$message}}</div>@enderror
                      </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jabatan" class="col-md-4 col-lg-3 col-form-label">Jabatan</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" value="{{$tim->jabatan}}" required autocomplete="off">
                          @error('jabatan')<div class="text-form text-danger fw-bold">{{$message}}</div>@enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="twitter" class="col-md-4 col-lg-3 col-form-label">Twitter</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter" value="{{$tim->twitter}}" required autocomplete="off">
                          @error('twitter')<div class="text-form text-danger fw-bold">{{$message}}</div>@enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="fb" class="col-md-4 col-lg-3 col-form-label">Facebook</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="fb" type="text" class="form-control @error('fb') is-invalid @enderror" id="fb" value="{{$tim->fb}}" required autocomplete="off">
                          @error('fb')<div class="text-form text-danger fw-bold">{{$message}}</div>@enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ig" class="col-md-4 col-lg-3 col-form-label">Instagram</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="ig" type="text" class="form-control @error('ig') is-invalid @enderror" id="ig" value="{{$tim->ig}}" required autocomplete="off">
                          @error('ig')<div class="text-form text-danger fw-bold">{{$message}}</div>@enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="linked" class="col-md-4 col-lg-3 col-form-label">Linked In</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="linked" type="text" class="form-control @error('linked') is-invalid @enderror" id="linked" value="{{$tim->linked}}" required autocomplete="off">
                          @error('linked')<div class="text-form text-danger fw-bold">{{$message}}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-3 text-end">
                        <input type="hidden" name="idteams" id="idteams" value="{{$tim->idteam}}" required/>
                        <a href="{{url('/tim')}}" class="btn btn-info text-light fst-italic" id="btnBack" ><i class="bi bi-arrow-90deg-left"></i> Back to our team </a>
                        <button type="button" class="btn btn-danger" id="btnDelete" onclick="timDelete()"> <i class="bi bi-trash"></i> Delete </button>
                        <button type="button" class="btn btn-secondary" id="btnLoading" onclick="addTim()" disabled> Loading... </button>
                        <button type="button" class="btn btn-success" id="btnSubmit" onclick="editTim()"> <i class="bi bi-pencil-square"></i> Update </button>
                    </div>
                    


                </form>
                <div class="alert alert-info">
                    <p class="fst-italic">
                        <span class="fw-bold">Catatan.</span><br/> 
                        Data ini hanya tampil di halaman depan website.<br/>
                        Jika sosial media kosong maka isikan '<span class="fw-bold">#</span>' pada form isian.<br/>
                        Untuk link social media gunakan <span class="fw-bold">https://</span>

                    </p>
                </div>
  
              </div>
            </div>
        </div>
      </div>
    </section>

    <script src="{{url('Admin/assets/js/tim.js')}}"></script>
    @endsection