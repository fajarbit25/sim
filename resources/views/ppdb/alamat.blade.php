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
              <h5 class="card-title"> 4. Informasi Tempat Tinggal</h5>

                <form action="{{url('/ppdb/alamat')}}" method="post" id="formData">
                    @csrf
                    
                    <div class="col-lg-12 my-3 row">
                        <label for="provinsi" class="col-sm-2 col-form-label">Provinsi<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="provinsi" id="provinsi" class="form-control @error('provinsi') is-invalid @enderror">
                              @if($alamat->provinsi != NULL)
                              <option value="{{$alamat->idprovinsi}}" selected>{{$alamat->provinsi}}</option>
                              @endif
                              <optgroup label="Pilih Provinsi" id="provinsiList">
                              </optgroup>
                            </select>
                            <div class="form-text text-success fw-bold">
                              Provinsi tempat tinggal peserta didik saat ini.
                            </div>
                          </div>
                          @error('provinsi')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten/Kota<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="kabupaten" id="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror">
                              @if($alamat->kota != NULL)
                              <option value="{{$alamat->idkota}}" selected>{{$alamat->kota}}</option>
                              @endif
                            </select>
                            <div class="form-text text-success fw-bold">
                              Kabupaten tempat tinggal peserta didik saat ini
                            </div>
                        </div>
                        @error('kabupaten')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="kecamatan" id="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror">
                              @if($alamat->kec != NULL)
                              <option value="{{$alamat->idkec}}">{{$alamat->kec}}</option>
                              @endif
                            </select>
                            <div class="form-text text-success fw-bold">
                              Kecamatan tempat tinggal peserta didik saat ini
                            </div>
                        </div>
                        @error('kecamatan')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="kelurahan" class="col-sm-2 col-form-label">Desa/Kelurahan<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="kelurahan" id="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror">
                              @if($alamat->kel != NULL)
                              <option value="{{$alamat->idkel}}">{{$alamat->kel}}</option>
                              @endif
                            </select>
                            <div class="form-text text-success fw-bold">
                              Desa/Kelurahan tempat tinggal peserta didik saat ini
                            </div>
                        </div>
                        @error('kelurahan')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>


                    <div class="col-lg-12 my-3 row">
                        <label for="rt" class="col-sm-2 col-form-label">RT <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                          <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror" id="rt" value="@if($alamat->rt == NULL){{old('rt')}}@else{{$alamat->rt}}@endif" required autocomplete="off">
                          <div class="form-text text-success fw-bold">
                            Nomor RT tempat tinggal peserta didik saat ini. Dari contoh di atas, misalnya dapat diisi dengan angka 5.
                          </div>
                        </div>
                        @error('rt')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="rw" class="col-sm-2 col-form-label">RW <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                          <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror" id="rw" value="@if($alamat->rw == NULL){{old('rw')}}@else{{$alamat->rw}}@endif" required autocomplete="off">
                          <div class="form-text text-success fw-bold">
                            Nomor RW tempat tinggal peserta didik saat ini. Dari contoh di atas, misalnya dapat diisi dengan angka 11.
                          </div>
                        </div>
                        @error('rw')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="kode_pos" class="col-sm-2 col-form-label">Kode POS <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                          <input type="text" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" value="@if($alamat->kode_pos == NULL){{old('kode_pos')}}@else{{$alamat->kode_pos}}@endif" required autocomplete="off">
                          <div class="form-text text-success fw-bold">
                              Kode pos tempat tinggal peserta didik saat ini.
                          </div>
                        </div>
                        @error('kode_pos')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="jalan" class="col-sm-2 col-form-label">Nama Jalan <span class="text-danger">*</span> </label>
                      <div class="col-sm-10">
                        {{-- <input type="text" name="jalan" class="form-control @error('jalan') is-invalid @enderror" id="jalan" value="{{old('jalan')}}" required autocomplete="off"> --}}
                        <textarea name="jalan" id="jalan" class="form-control @error('jalan') is-invalid @enderror" id="jalan" cols="" rows="3" required>@if($alamat->jalan == NULL){{old('jalan')}}@else{{$alamat->jalan}}@endif</textarea>
                        <div class="form-text text-success fw-bold">
                          Jalur tempat tinggal peserta didik, terdiri atas gang, kompleks, blok, nomor rumah, dan sebagainya selain informasi yang diminta oleh kolom-kolom
                          yang lain pada bagian ini. Sebagai contoh, peserta didik tinggal di sebuah kompleks perumahan Griya Adam yang berada pada Jalan Kemanggisan,
                          dengan nomor rumah 4-C, di lingkungan RT 005 dan RW 011, Dusun Cempaka, Desa Salatiga. Maka dapat diisi dengan Jl. Kemanggisan, Komp.
                          Griya Adam, No. 4-C.
                        </div>
                      </div>
                      @error('jalan')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>


                    <div class="col-lg-12 my-3 row">
                      <label for="lintang" class="col-sm-2 col-form-label">Lintang </label>
                      <div class="col-sm-10">
                        <input type="text" name="lintang" class="form-control @error('lintang') is-invalid @enderror" id="lintang" 
                        value="@if($alamat->lintang == NULL){{old('lintang')}}@else{{$alamat->lintang}}@endif" autocomplete="off">
                        <div class="form-text text-success fw-bold">
                          Titik koordinat tempat tinggal siswa.
                        </div>
                      </div>
                      @error('lintang')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="bujur" class="col-sm-2 col-form-label">Bujur </label>
                      <div class="col-sm-10">
                        <input type="text" name="bujur" class="form-control @error('bujur') is-invalid @enderror" id="bujur" 
                        value="@if($alamat->bujur == NULL){{old('bujur')}}@else{{$alamat->bujur}}@endif" autocomplete="off">
                        <div class="form-text text-success fw-bold">
                          Titik koordinat tempat tinggal siswa.
                        </div>
                      </div>
                      @error('bujur')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="status_tempat_tinggal" class="col-sm-2 col-form-label">Status Tempat Tinggal<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="status_tempat_tinggal" id="status_tempat_tinggal" class="form-control @error('status_tempat_tinggal') is-invalid @enderror">
                              @if($alamat->status_tempat_tinggal != NULL)
                                <option value="{{$alamat->status_tempat_tinggal}}">{{$alamat->status_tempat_tinggal}}</option>
                                <option value="{{$alamat->status_tempat_tinggal}}">== Change ==</option>
                              @endif
                                <option value="Bersama orang tua">1. Bersama orang tua</option>
                                <option value="Wali">2. Wali</option>
                                <option value="Kos">3. Kos</option>
                                <option value="Asrama">4. Asrama</option>
                                <option value="Panti Asuhan">5. Panti Asuhan</option>
                            </select>
                            <div class="form-text text-success fw-bold">
                              Kepemilikan tempat tinggal peserta didik saat ini (yang telah diisikan pada kolom-kolom sebelumnya di atas).
                            </div>
                        </div>
                        @error('status_tempat_tinggal')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>
                    
                    <div class="col-lg-12 my-3 row">
                        <label for="moda_transportasi" class="col-sm-2 col-form-label">Moda Transportasi<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="moda_transportasi" id="moda_transportasi" class="form-control @error('moda_transportasi') is-invalid @enderror">
                              @if($alamat->moda_transportasi != NULL)
                                <option value="{{$alamat->moda_transportasi}}">{{$alamat->moda_transportasi}}</option>
                                <option value="{{$alamat->moda_transportasi}}">== Change ==</option>
                              @endif
                                <option value="Jalan Kaki">1. Jalan Kaki</option>
                                <option value="Kendaraan Pribadi">2. Kendaraan Pribadi</option>
                                <option value="Transportasi Umum">3. Transportasi Umum/angkot/Pete-pete</option>
                                <option value="Jemputan Sekolah">4. Jemputan Sekolah</option>
                                <option value="Kereta Api">5. Kereta Api</option>
                                <option value="Ojek">6. Ojek</option>
                                <option value="Andong/Bendi/Sado/ Dokar/Delman/Beca">7. Andong/Bendi/Sado/ Dokar/Delman/Beca</option>
                                <option value="Perahu penyebrangan/Rakit/Getek">8. Perahu penyebrangan/Rakit/Getek</option>
                                <option value="Lainnya">99. Lainnya</option>
                            </select>
                            <div class="form-text text-success fw-bold">
                              Jenis transportasi utama atau yang paling sering digunakan peserta didik untuk berangkat ke sekolah.
                            </div>
                        </div>
                        @error('moda_transportasi')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>
                    
                    <div class="col-lg-12 mt-3 text-end">
                        {{-- Save value input --}}
                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" required/>
                        <input type="hidden" name="daPro" id="daPro" required/>
                        <input type="hidden" name="daKab" id="daKab" required/>
                        <input type="hidden" name="daKec" id="daKec" required/>
                        <input type="hidden" name="daKel" id="daKel" required/>
                        {{-- End Save value input --}}

                        {{-- <button type="submit" class="btn btn-success">Konfirmasi Pembayaran <i class="bi bi-arrow-right"></i></button> --}}
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
<script src="{{asset('Admin/assets/js/location.js')}}"></script>
<script type="text/javascript">
  $("#formData").submit(function(){
    $("#btn-submit").attr('disabled', true)
    $("#btn-submit").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')
  });
</script>
@endsection