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
              <h5 class="card-title"> Progres Pendaftaran </h5>
              <!-- Progress Bars with labels-->
              <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{$percent}}%" aria-valuenow="{{$valueNow}}" aria-valuemin="0" aria-valuemax="$valueMax">{{$percent}}%</div>
              </div>
              <!-- End Progress Bars with labels-->
            </div>
          </div>
        </div>
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> 9. Data Priodik</h5>

                <form action="{{url('/ppdb/priodik')}}" method="POST" id="formData">
                    @csrf
                    
                    <div class="col-lg-12 my-3 row">
                        <label for="tinggi" class="col-sm-2 col-form-label">Tinggi Badan <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="number" name="tinggi" class="form-control @error('tinggi') is-invalid @enderror" placeholder="Tinggi Badan" id="tinggi" value="@if($priodik->tinggi == NULL){{old('tinggi')}}@else{{$priodik->tinggi}}@endif" required autocomplete="off" aria-label="Recipient's username" aria-describedby="tinggi-badan">
                                <span class="input-group-text" id="tinggi-badan">Centimeter</span>
                            </div>
                            <div class="form-text text-success fw-bold">
                                Tinggi badan peserta didik dalam satuan Centimeter.
                            </div>
                        </div>
                        @error('tinggi')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="berat" class="col-sm-2 col-form-label">Berat Badan <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="number" name="berat" class="form-control @error('berat') is-invalid @enderror" placeholder="Berat Badan" id="berat" value="@if($priodik->berat == NULL){{old('berat')}}@else{{$priodik->berat}}@endif" required autocomplete="off" aria-label="Recipient's username" aria-describedby="berat-badan">
                                <span class="input-group-text" id="berat-badan">Kilogram</span>
                            </div>
                            <div class="form-text text-success fw-bold">
                                Tinggi badan peserta didik dalam satuan Kilogram.
                            </div>
                        </div>
                        @error('berat')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="lingkar_kepala" class="col-sm-2 col-form-label">Lingkar Kepala <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="number" name="lingkar_kepala" class="form-control @error('lingkar_kepala') is-invalid @enderror" placeholder="Lingkar Kepada" id="lingkar_kepala" value="@if($priodik->lingkar_kepala == NULL){{old('lingkar_kepala')}}@else{{$priodik->lingkar_kepala}}@endif" required autocomplete="off" aria-label="Recipient's username" aria-describedby="lingkar_kepala">
                                <span class="input-group-text" id="lingkar_kepala">Centimeter</span>
                            </div>
                            <div class="form-text text-success fw-bold">
                                Lingkar kepala peserta didik dalam satuan Centimeter.
                            </div>
                        </div>
                        @error('lingkar_kepala')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="jarak_per_1km" class="col-sm-2 col-form-label">Jarak Tempat Tinggal Ke Sekolah<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="radio" class="btn-check" name="jarak_per_1km" id="kurang" onclick="AutoJarak()" value="< 1 KM" @if($priodik->jarak_per_1km == '< 1 KM') checked @endif>
                            <label class="btn btn-outline-secondary" for="kurang"><i class="bi bi-align-end"></i> Kurang Dari 1 km</label>

                            <input type="radio" class="btn-check" name="jarak_per_1km" id="lebih" onclick="AutoJarakReset()" value="> 1 KM" @if($priodik->jarak_per_1km == '> 1 KM') checked @endif>
                            <label class="btn btn-outline-secondary" for="lebih"><i class="bi bi-align-start"></i> Lebih Dari 1 km</label>
                            
                            <div class="form-text text-success fw-bold">
                                Jarak rumah peserta didik ke sekolah, kurang dari 1 kilometer atau lebih dari 1 kilometer.
                            </div>
                        </div>
                        @error('jarak_per_1km')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="jarak" class="col-sm-2 col-form-label">Sebutkan dalam satuan kilometer <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="number" name="jarak" class="form-control @error('jarak') is-invalid @enderror" placeholder="Jarak dari rumah ke sekolah" id="jarak" value="@if($priodik->jarak == NULL){{old('jarak')}}@else{{$priodik->jarak}}@endif" required autocomplete="off" aria-label="Recipient's username" aria-describedby="jarak">
                                <span class="input-group-text" id="jarak">kilometer</span>
                            </div>
                            <div class="form-text text-success fw-bold">
                                Apabila jarak rumah peserta didik ke sekolah lebih dari 1 km, isikan dengan angka jarak yang sebenarnya pada kolom ini dalam satuan kilometer. Diisi
                                dengan bilangan bulat (bukan pecahan)
                            </div>
                        </div>
                        @error('jarak')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="" class="col-sm-2 col-form-label">Waktu Tempuh Ke Sekolah (Jam/Menit) <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="number" name="jam" class="form-control @error('jam') is-invalid @enderror" value="@if($priodik->jam == NULL){{old('jam')}}@else{{$priodik->jam}}@endif" aria-label="Jam" placeholder="Jam" required autocomplete="off">
                                <span class="input-group-text">Jam</span>
                                <input type="number" name="menit" class="form-control @error('menit') is-invalid @enderror" value="@if($priodik->menit == NULL){{old('menit')}}@else{{$priodik->menit}}@endif" aria-label="Menit" placeholder="Menit" required autocomplete="off">
                                <span class="input-group-text">Menit</span>
                            </div>
                            <div class="form-text text-success fw-bold">
                                Lama tempuh peserta didik ke sekolah. Kolom kiri adalah jam, kolom kanan adalah menit. Misalnya, peserta didik memerlukan waktu tempuh 1 jam
                                15 menit, maka kotak kiri diisi 1 sedangkan kanan diisi 15. Apabila memerlukan waktu 25 menit, maka kotak kiri diisi 0 sedangkan kanan diisi 25
                            </div>
                        </div>
                        @error('jarak')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="saudara" class="col-sm-2 col-form-label">Jumlah Saudara Kandung <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="number" name="saudara" class="form-control @error('saudara') is-invalid @enderror" placeholder="Jumlah Saudara Kandung" id="saudara" value="@if($priodik->saudara == NULL){{old('saudara')}}@else{{$priodik->saudara}}@endif" required autocomplete="off" aria-label="Recipient's username" aria-describedby="saudara">
                                <span class="input-group-text" id="saudara">Orang</span>
                            </div>
                            <div class="form-text text-success fw-bold">
                                Jumlah saudara kandung yang dimiliki peserta didik. Jumlah saudara kandung dihitung tanpa menyertakan peserta didik, dengan rumus jumlah kakak
                                ditambah jumlah adik. Isikan 0 apabila anak tunggal.
                            </div>
                        </div>
                        @error('saudara')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>                    

                    
                    <div class="col-lg-12 mt-3 text-end">
                        <button type="submit" class="btn btn-success" id="btn-submit">Simpan dan lanjutkan <i class="bi bi-arrow-right"></i></button>
                    </div>
                </form>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->




{{-- JavaScript --}}
<script src="{{asset('Admin/assets/js/ppdb.js')}}"></script>
<script type="text/javascript">
    $("#formData").submit(function(){
      $("#btn-submit").attr('disabled', true)
      $("#btn-submit").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')
    });
</script>
@endsection