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
                  <img src="{{asset('Home/assets/img/favicon-iqis.png')}}" alt="">
                  <span class="d-none d-lg-block">SIMS</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Silahkan Login</h5>
                    <p class="text-center small">Masukan Email dan Password untuk login!</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="{{route('authenticate')}}" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" id="yourEmail" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" id="btn-submit" type="submit">Login</button>
                      <button class="btn btn-primary w-100" type="button" id="btn-loading" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                      </button>
                    </div>
                  </form>


                </div>
              </div>

              <div class="credits">
                Designed by <a href="https://purnamasinargemilang.co.id/" target="_blank">Purnama Sinar Gemilang</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
  <script>
    $(document).ready(function(){
      $("#btn-loading").hide();
    });
    $("#btn-submit").click(function(){
      $("#btn-submit").hide();
      $("#btn-loading").show();
    });
  </script>
  @endsection
