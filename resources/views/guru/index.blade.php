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
        <span class="fw-bold fst-italic">Opps., Terjadi kesalahan pada penginputan data, silahkan diulangi!</span>
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
              <h5 class="card-title">Data Staff Dan Guru</h5>
                <div class="col-lg-12 mb-3">
                  <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <i class="bi bi-plus-lg"></i> New
                    </button>
                    <a href="/teacher/excel" class="btn btn-outline-primary btn-sm">
                      <i class="bi bi-file-earmark-excel"></i> Export
                    </a>
                    <a href="/teacher/excel/import" class="btn btn-outline-primary btn-sm">
                      <i class="bi bi-file-earmark-excel"></i> Import
                    </a>
                    <button type="button" class="btn btn-outline-primary btn-sm">
                      <i class="bi bi-printer"></i> Print
                    </button>
                  </div>
                </div>
                <div class="" id="tableLevel">
                    <!-- Table with stripped rows -->
                  <table class="table datatable" style="font-size: 12.5px">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Level</th>
                        <th scope="col">Sekolah</th>
                        <th scope="col">Nomor Handphone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($guru as $guru)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$guru->first_name}}</td>
                        <td>{{$guru->nama_level}}</td>
                        <td>{{$guru->campus_initial}}</td>
                        <td>{{$guru->phone}}</td>
                        <td>{{$guru->email}}</td>
                        <td>
                          <a href="/guru/{{$guru->id}}/show" class="btn btn-outline-success btn-xs">Manage <i class="bi bi-arrow-right"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <!-- End Table with stripped rows -->
                </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <!-- Modal Delete -->
  <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{url('/guru/delete')}}" method="POST">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel"><i class="bi bi-exclamation-triangle"></i> Alert!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h5>Yakin ingin menghapus data?</h5>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="id" required/>
            <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i> Ya</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Tidak</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  
    <!-- Modal New -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="POST" action="{{url('/guru')}}">
              @csrf
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus-lg"></i> Data Guru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">

                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="first_name">Nama Lengkap <span class="text-danger">*</span></label>
                      <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}" autocomplete="off"/>
                      <div id="validationServer03Feedback" class="invalid-feedback">
                        @error('first_name')
                          {{$message }}
                        @enderror
                      </div>                  
                    </div>
                  </div> 
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="nik">NIK/KITAS <span class="text-danger">*</span></label>
                      <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{old('nik')}}" autocomplete="off"/>
                      <div id="validationServer03Feedback" class="invalid-feedback">
                        @error('nik')
                          {{$message }}
                        @enderror
                      </div>                  
                    </div>
                  </div> 
                  @if(Auth::user()->level == 0)
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="campus_id">Sekolah <span class="text-danger">*</span></label>
                      <select name="campus_id" id="campus_id" class="form-control">
                        <optgroup label="Pilih Sekolah">
                          @foreach($campus as $cam)
                          <option value="{{$cam->idcampus}}">{{$loop->iteration.'. '.$cam->campus_name}}</option>
                          @endforeach
                        </optgroup>
                      </select>
                      <div id="validationServer03Feedback" class="invalid-feedback">
                        @error('first_name')
                          {{$message }}
                        @enderror
                      </div>                  
                    </div>
                  </div> 
                  @endif
                  @if(Auth::user()->level == 1 || Auth::user()->level == 0)
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="level">Level User <span class="text-danger">*</span></label>
                      <select name="level" id="level" class="form-control">
                        <optgroup label="Pilih Level">
                          @foreach($level as $lvl)
                          <option value="{{$lvl->idlevel}}">{{$loop->iteration.'. '.$lvl->kode_level}}</option>
                          @endforeach
                        </optgroup>
                      </select>
                      <div id="validationServer03Feedback" class="invalid-feedback">
                        @error('first_name')
                          {{$message }}
                        @enderror
                      </div>                  
                    </div>
                  </div> 
                  @endif
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="phone">Nomor Handphone <span class="text-danger">*</span></label>
                      <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}" autocomplete="off"/>
                      <div id="validationServer03Feedback" class="invalid-feedback">
                        @error('phone')
                          {{$message }}
                        @enderror
                      </div>                  
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                      <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{old('tempat_lahir')}}" autocomplete="off"/>
                      <div id="validationServer03Feedback" class="invalid-feedback">
                        @error('tempat_lahir')
                          {{$message }}
                        @enderror
                      </div>                  
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                      <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{old('tanggal_lahir')}}" autocomplete="off"/>
                      <div id="validationServer03Feedback" class="invalid-feedback">
                        @error('tanggal_lahir')
                          {{$message }}
                        @enderror
                      </div>                  
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="email">Alamat Email <span class="text-danger">*</span></label>
                      <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" autocomplete="off"/>
                      <div id="validationServer03Feedback" class="invalid-feedback">
                        @error('email')
                          {{$message }}
                        @enderror
                      </div>                  
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                      <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" value="{{old('gender')}}">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                      <div id="validationServer03Feedback" class="invalid-feedback">
                        @error('gender')
                          {{$message }}
                        @enderror
                      </div>                  
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label for="ibu">Ibu Kandung </label>
                      <input type="text" name="ibu" class="form-control @error('ibu') is-invalid @enderror" value="{{old('ibu')}}" autocomplete="off"/>
                      <div id="validationServer03Feedback" class="invalid-feedback">
                        @error('ibu')
                          {{$message }}
                        @enderror
                      </div>                  
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="alert alert-success">
                      <span class="fw-bold fst-italic">Noted :</span><br/>
                      <span class="fst-italic">Untuk informasi login Guru/Staff gunakan detail sbb:</span> <br/>
                      <span class="fw-bold fst-italic">Username :</span><span class="fst-italic">"Alamat Email"</span> <br/>
                      <span class="fw-bold fst-italic">Password :</span><span class="fst-italic">"Tanggal Lahir"</span><br/>
                    </div>
                  </div>
                  

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-save-teacher">Save</button>
              </div>
            </form>
        </div>
      </div>
    </div>
    <script src="{{asset('Admin/assets/js/guru.js')}}"></script>
    <script>
      $(document).ready(function(){
        $("#btn-save-teacher").click(function(){
          $("#btn-save-teacher").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> loading..')
        });
      });
    </script>
@endsection