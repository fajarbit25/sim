@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">User</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
        <div class="col-lg-8">

            <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Data</h5>

                <!-- Default Accordion -->
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            #Informasi Akun
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="md-3" id="formAkun">
                                {{-- Form here --}}
                            </div>
                            <div class="text-end mb-3">
                                <button type="submit" id="btnSubmitAkun" onclick="updateAkun()" class="btn btn-success btn-sm"><i class="bi bi-floppy"></i> Simpan</button>
                                <button type="submit" id="btnLoadingAkun" class="btn btn-secondary btn-sm" disabled> Loading...</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            #Password 
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <form action="/profle/change/password" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="current_pass" class="col-sm-4 col-form-label"><i class="bi bi-check-all"></i> Current Password</label>
                                <div class="col-sm-8">
                                  <input type="password" class="form-control @error('current_pass') is-invalid @enderror" id="current_pass" autocomplete="off" required>
                                </div>
                                @error('current_pass')<div class="form-text">{{$message}}</div>@enderror
                            </div>
                            <div class="row mb-3">
                                <label for="new_pass" class="col-sm-4 col-form-label"><i class="bi bi-check-all"></i> New Password</label>
                                <div class="col-sm-8">
                                  <input type="password" class="form-control @error('new_pass') is-invalid @enderror" id="new_pass" autocomplete="off" required>
                                </div>
                                @error('new_pass')<div class="form-text">{{$message}}</div>@enderror
                            </div>
                            <div class="row mb-3">
                                <label for="repeat_pass" class="col-sm-4 col-form-label"><i class="bi bi-check-all"></i> Confirm New Password</label>
                                <div class="col-sm-8">
                                  <input type="password" class="form-control @error('repeat_pass') is-invalid @enderror" id="repeat_pass" autocomplete="off" required>
                                </div>
                                @error('repeat_pass')<div class="form-text">{{$message}}</div>@enderror
                            </div>
                            <div class="text-end mb-3">
                                <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-floppy"></i> Save Changes</button>
                            </div>
                            </form>

                        </div>
                        </div>
                    </div>
                </div><!-- End Default Accordion Example -->

            </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card">
                <div class="md-3" id="foto-user">
                </div>
            
                <div class="card-body my-3">
                    <form enctype="multipart/form-data" id="FormFoto" method="POST">
                        @csrf
                        <input type="hidden" value="{{Auth::user()->id}}" id="id" name="id" required/>
                        <div class="input-group">
                            <input type="file" class="form-control" name="photo" id="photo" aria-describedby="btnSubmitFoto" aria-label="Upload">
                            <button class="btn btn-outline-secondary" type="button" id="btnLoadingFoto" disabled> Loading...</button>
                            <button class="btn btn-outline-success" type="button" onclick="uploadFoto()" id="btnSubmitFoto"><i class="bi bi-upload"></i> Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
    </section>
</main>
<script src="{{asset('Admin/assets/js/profileSiswa.js')}}"></script>
@endsection