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
              <h5 class="card-title"> 6. Informasi Ibu Kandung</h5>

                <form action="{{url('/ppdb/wali')}}" method="POST" id="formData">
                    @csrf
                    
                    <div class="col-lg-12 my-3 row">
                        <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                          <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" value="@if($wali->nama_lengkap == NULL){{old('nama_lengkap')}}@else{{$wali->nama_lengkap}}@endif" required autocomplete="off">
                          <div class="form-text text-success fw-bold">
                            Nama ibu kandung peserta didik sesuai dokumen resmi yang berlaku. Hindari penggunaan gelar akademik atau sosial
                            (seperti Alm., Dr., Drs., S.Pd, dan H.)
                          </div>
                        </div>
                        @error('nama_lengkap')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="nik" class="col-sm-2 col-form-label">Nomor Induk Keluarga <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                          <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="@if($wali->nik == NULL){{old('nik')}}@else{{$wali->nik}}@endif" required autocomplete="off">
                          <div class="form-text text-success fw-bold">
                            Nomor Induk Kependudukan yang tercantum pada Kartu Keluarga atau KTP ibu kandung peserta didik.
                          </div>
                        </div>
                        @error('nik')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="tahun_lahir" class="col-sm-2 col-form-label">Tahun Lahir <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                          <input type="text" name="tahun_lahir" class="form-control @error('tahun_lahir') is-invalid @enderror" id="tahun_lahir" value="@if($wali->tahun_lahir == NULL){{old('tahun_lahir')}}@else{{$wali->tahun_lahir}}@endif" required autocomplete="off">
                          <div class="form-text text-success fw-bold">
                            Tahun lahir ayah kandung peserta didik.
                          </div>
                        </div>
                        @error('tahun_lahir')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror">
                                <optgroup label="Pilih Pendidikan">
                                  <option value="Tidak Sekolah">1. Tidak Sekolah</option>
                                  <option value="Putus SD">2. Putus SD</option>
                                  <option value="SD Sederajat">3. SD Sederajat</option>
                                  <option value="SMP Sederajat">4. SMP Sederajat</option>
                                  <option value="SMA Sederajat">5. SMA Sederajat</option>
                                  <option value="D1">6. D1</option>
                                  <option value="D2">7. D2</option>
                                  <option value="D3">8. D3</option>
                                  <option value="D4/S1">9. D4/S1</option>
                                  <option value="S2">10. S2</option>
                                  <option value="S3">11. S3</option>
                                </optgroup>
                            </select>
                            <div class="form-text text-success fw-bold">
                              Pendidikan terakhir ibu kandung peserta didik.
                            </div>
                        </div>
                        @error('pendidikan')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                          <select name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror">
                            <optgroup label="Pilih Pekerjaan">
                              <option value="Tidak Bekerja">1. Tidak Bekerja</option>
                              <option value="Nelayan">2. Nelayan</option>
                              <option value="Petani">3. Petani</option>
                              <option value="Peternak">4. Peternak</option>
                              <option value="PNS/TNI/POLRI">5. PNS/TNI/POLRI</option>
                              <option value="Karyawan Swasta">6. Karyawan Swasta</option>
                              <option value="Pedagang Kecil">7. Pedagang Kecil</option>
                              <option value="Pedagang Besar">8. Pedagang Besar</option>
                              <option value="Wiraswasta">9. Wiraswasta</option>
                              <option value="Wirausaha">10. Wirausaha</option>
                              <option value="Buruh">11. Buruh</option>
                              <option value="Pensiunan">12. Pensiunan</option>
                              <option value="Meninggal Dunia">13. Meninggal Dunia</option>
                            </optgroup>
                        </select>
                        <div class="form-text text-success fw-bold">
                          Pekerjaan utama ibu kandung peserta didik. Pilih Meninggal Dunia apabila ayah kandung peserta didik telah meninggal dunia.
                        </div>
                        </div>
                        @error('pekerjaan')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="penghasilan" class="col-sm-2 col-form-label">Penghasilan<span class="text-danger">*</span></label>
                      <div class="col-sm-10">
                          <select name="penghasilan" id="penghasilan" class="form-control @error('penghasilan') is-invalid @enderror">
                              <option value="< Rp.5.000.000"> <  Rp.5.000.000</option>
                              <option value="Rp.500.000 - Rp.999.999">Rp.500.000 - Rp.999.999</option>
                              <option value="Rp.1.000.000 - Rp.1.999.999">Rp.1.000.000 - Rp.1.999.999</option>
                              <option value="Rp.2.000.000 - Rp.4.999.999">Rp.2.000.000 - Rp.4.999.999</option>
                              <option value="Rp.5.000.000 - Rp.20.000.000">Rp.5.000.000 - Rp.20.000.000</option>
                              <option value="< Rp.20.000.000"> >  Rp.20.000.000</option>
                              <option value="Lainnya">Lainnya</option>
                          </select>
                      </div>
                      @error('penghasilan')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                  </div>

                  <div class="col-lg-12 my-3 row" id="keb-khususWali">    
                  </div>
                    
                    <div class="col-lg-12 mt-3 text-end">
                        <input type="hidden" name="segment" id="segment" value="ibu" required/>
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
<script src="{{asset('Admin/assets/js/ppdb.js')}}"></script>
<script type="text/javascript">
  $("#formData").submit(function(){
    $("#btn-submit").attr('disabled', true)
    $("#btn-submit").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')
  });
</script>
@endsection