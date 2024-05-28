@extends('template.blank')
@section('main')
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="{{url('Admin/assets/img/logo.png')}}" alt="">
                  <span class="d-none d-lg-block">SIMS</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('user.store')}}">
                    @csrf
                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="yourName" value="{{old('name')}}" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourEmail" value="{{old('email')}}" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                        <label for="yourName" class="form-label">Your Phone</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="yourPhone" value="{{old('phone')}}" required>
                        <div class="invalid-feedback">Please, enter your phone number!</div>
                    </div>

                    <div class="col-12 mb-3">
                      <label for="yourPass" class="form-label">Password</label>
                      <input type="password" name="pass" class="form-control" id="yourPass">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="{{route('login')}}">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                Designed by <a href="">Purnama Sinar Gemilang</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
  @endsection
