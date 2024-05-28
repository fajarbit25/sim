@extends('template.layoutHome')
@section('main')
<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>PPDB SDIT Ibnul Qayyim</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li><a href="portfolio.html">PPDB</a></li>
            <li>SDIT</li>
          </ol>
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-info">
                <h3>Informasi Pendaftaran Peserta Didik Baru Tahun {{date('Y')}}</h3>
                <ol class="list-group list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto" style="font-size: 13px;">
                        {!!$info->pesan!!}
                      </div>
                    </li>
                </ol>
            </div>
          </div>


          <div class="col-lg-4">
            <div class="portfolio-info login">
              <h3><i class="bi bi-house-lock"></i> Login </h3>

              @if($errors->has('email'))
              <div class="alert alert-danger">{{$errors->first('email');}}</div>
              @endif

              <form action="{{url('/login')}}" method="POST">
                @csrf
                <div class="my-4">
                    <div class="input-group">
                      <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                      <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="Masukan Email.." aria-describedby="basic-addon1" required/>
                    </div>
                </div>

                <div class="my-4">
                    <div class="input-group">
                      <span class="input-group-text" id="basic-addon2"><i class="bi bi-key"></i></span>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password.." aria-describedby="basic-addon2 basic-addon4" required/>
                    </div>
                    <div class="form-text" id="basic-addon4">Masukkan Email dan Password</div>
                </div>

                <div class="my-4">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary" onclick="register()"> <i class="bi bi-person-fill-add"></i> Register</button>
                        </div>
                        <div class="col-6 text-end">
                            <button type="submit" class="btn btn-success">Login <i class="bi bi-box-arrow-in-right"></i></button>
                        </div>
                    </div>
                </div>
              </form>
            </div>

            <div class="portfolio-info register">
                <h3><i class="bi bi-house-lock"></i> Register </h3>
  
                <form action="/smkit/ppdb" method="POST">
                  @csrf
                  
                  <div class="mb-3">
                    <label for="first_name" class="form-label">Nama Depan <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3"><i class="bi bi-person-lines-fill"></i></span>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}" name="first_name" id="first_name" aria-describedby="basic-addon3" required autocomplete="off"/>
                    </div>
                    @error('first_name')
                        <div class="form-text">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3"><i class="bi bi-envelope"></i></span>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" id="emailNew" aria-describedby="basic-addon3" required autocomplete="off"/>
                    </div>
                    @error('email')
                        <div class="form-text">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Handphone / WA <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3"><i class="bi bi-whatsapp"></i></span>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}" name="phone" id="phone" aria-describedby="basic-addon3" required autocomplete="off"/>
                    </div>
                    @error('phone')
                        <div class="form-text">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3"><i class="bi bi-key"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="passwordNew" aria-describedby="basic-addon3" required autocomplete="off"/>
                    </div>
                    @error('password')
                        <div class="form-text">{{ $message }}</div>
                    @enderror
                  </div>

  
                  <div class="my-4">
                      <div class="row">
                          <div class="col-6">
                              <button type="button" class="btn btn-secondary" onclick="login()"> <i class="bi bi-box-arrow-in-right"></i> Login</button>
                          </div>
                          <div class="col-6 text-end">
                              <input type="hidden" name="campus_id" id="campus_id" value="2" required/>
                              <button type="submit" class="btn btn-success">Daftar <i class="bi bi-person-fill-add"></i></button>
                          </div>
                      </div>
                  </div>
                </form>
              </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  {{-- JavaScript --}}
  <script src="{{asset('Home/assets/js/ppdb-smkit.js')}}"></script>
  @endsection