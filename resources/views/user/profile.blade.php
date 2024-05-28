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
            <div class="col-sm-8">

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
                                        <input type="password" class="form-control @error('current_pass') is-invalid @enderror" id="current_pass" name="current_pass" autocomplete="off" required>
                                        </div>
                                        @error('current_pass')<div class="form-text">{{$message}}</div>@enderror
                                    </div>
                                    <div class="row mb-3">
                                        <label for="new_pass" class="col-sm-4 col-form-label"><i class="bi bi-check-all"></i> New Password</label>
                                        <div class="col-sm-8">
                                        <input type="password" class="form-control @error('new_pass') is-invalid @enderror" id="new_pass" name="new_pass" autocomplete="off" required>
                                        </div>
                                        @error('new_pass')<div class="form-text">{{$message}}</div>@enderror
                                    </div>
                                    <div class="row mb-3">
                                        <label for="repeat_pass" class="col-sm-4 col-form-label"><i class="bi bi-check-all"></i> Confirm New Password</label>
                                        <div class="col-sm-8">
                                        <input type="password" class="form-control @error('repeat_pass') is-invalid @enderror" id="repeat_pass" name="repeat_pass" autocomplete="off" required>
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

            <div class="col-sm-4">

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

            @if(Auth::user()->level != 4)
            <div class="col-sm-12">

                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Data Dapodik</h5>
      
                    <!-- Accordion without outline borders -->
                    <div class="accordion accordion-flush" id="accordionFlushExample">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseSero" aria-expanded="false" aria-controls="flush-collapseSero">
                                    #0 Identitas Sekolah
                                </button>
                            </h2>
                            <div id="flush-collapseSero" class="accordion-collapse collapse" aria-labelledby="flush-headingSero" 
                            data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @livewire('teacher.sekolah', ['sekolah' => $sekolah])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    #1 Identitas Tenaga Pendidik Dan Tenaga Kependidikan
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" 
                            data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @livewire('teacher.identitas', ['user' => $user])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    #2 Data Pribadi
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" 
                            data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @livewire('teacher.data-pribadi', ['biodata' => $biodata])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    #3 Informasi Alamat
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" 
                            data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @livewire('teacher.teacher-address', ['address' => $address])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    #4 Kepegawaian
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" 
                            data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @livewire('teacher.kepegawaian', ['kepegawaian' => $kepegawaian])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                    #5 Kompetensi Khusus
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" 
                            data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @livewire('teacher.kompetensi-khusus', ['kompetensi' => $kompetensi])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                    #6 Kontak
                                </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" 
                            data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @livewire('teacher.kontak', ['user' => $user])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                    #7 Penugasan
                                </button>
                            </h2>
                            <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" 
                            data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @livewire('teacher.penugasan', ['penugasan' => $penugasan])
                                </div>
                            </div>
                        </div>


                      
                    </div><!-- End Accordion without outline borders -->
      
                  </div>
                </div>

            </div>

            <div class="col-sm-12">

                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Data Rinci</h5>
      
                    <!-- Accordion without outline borders -->
                    <div class="accordion accordion-flush" id="accordionFlushTwo">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingBSero">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseBSero" aria-expanded="false" aria-controls="flush-collapseBSero">
                                    #0 Riwayat Sertifikasi
                                </button>
                            </h2>
                            <div id="flush-collapseBSero" class="accordion-collapse collapse" aria-labelledby="flush-headingBSero" 
                            data-bs-parent="#accordionFlushBSero">
                                <div class="accordion-body">
                                    @livewire('teacher.sertifikasi.form.create', ['user_id' => $user->id])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingBOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseBOne" aria-expanded="false" aria-controls="flush-collapseBOne">
                                    #1 Riwayat Pendidikan Formal
                                </button>
                            </h2>
                            <div id="flush-collapseBOne" class="accordion-collapse collapse" aria-labelledby="flush-headingBOne" 
                            data-bs-parent="#accordionFlushBOne">
                                <div class="accordion-body">
                                    @livewire('teacher.pendidikan.form.data', ['user_id' => $user->id])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingBTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseBTwo" aria-expanded="false" aria-controls="flush-collapseBTwo">
                                    #2 Kompetensi
                                </button>
                            </h2>
                            <div id="flush-collapseBTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingBTwo" 
                            data-bs-parent="#accordionFlushBTwo">
                                <div class="accordion-body">
                                    @livewire('teacher.kompetensi.form.data', ['user_id' => $user->id])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingBThere">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseBThere" aria-expanded="false" aria-controls="flush-collapseBThere">
                                    #3 Anak
                                </button>
                            </h2>
                            <div id="flush-collapseBThere" class="accordion-collapse collapse" aria-labelledby="flush-headingBThere" 
                            data-bs-parent="#accordionFlushBThere">
                                <div class="accordion-body">
                                    @livewire('teacher.anak.form.data', ['user_id' => $user->id])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingBFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseBFour" aria-expanded="false" aria-controls="flush-collapseBFour">
                                    #4 Beasiswa
                                </button>
                            </h2>
                            <div id="flush-collapseBFour" class="accordion-collapse collapse" aria-labelledby="flush-headingBFour" 
                            data-bs-parent="#accordionFlushBFour">
                                <div class="accordion-body">
                                    @livewire('teacher.beasiswa.form.data', ['user_id' => $user->id])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingBFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseBFive" aria-expanded="false" aria-controls="flush-collapseBFive">
                                    #5 Buku Yang Pernah Ditulis
                                </button>
                            </h2>
                            <div id="flush-collapseBFive" class="accordion-collapse collapse" aria-labelledby="flush-headingBFive" 
                            data-bs-parent="#accordionFlushBFive">
                                <div class="accordion-body">
                                    @livewire('teacher.buku.form.data', ['user_id' => $user->id])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingBSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseBSix" aria-expanded="false" aria-controls="flush-collapseBSix">
                                    #6 Diklat
                                </button>
                            </h2>
                            <div id="flush-collapseBSix" class="accordion-collapse collapse" aria-labelledby="flush-headingBSix" 
                            data-bs-parent="#accordionFlushBSix">
                                <div class="accordion-body">
                                    @livewire('teacher.diklat.form.data', ['user_id' => $user->id])
                                </div>
                            </div>
                        </div>

                      
                    </div><!-- End Accordion without outline borders -->
      
                  </div>
                </div>
                
            </div>
            @endif
        </div>

        
    </section>
</main>
<script src="{{asset('Admin/assets/js/profile.js')}}"></script>
@endsection