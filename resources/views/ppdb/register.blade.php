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
              <h5 class="card-title"> 13. Registrasi Peserta Didik Baru</h5> 
                    <form action="{{url('/ppdb/registrasi')}}" method="POST">
                        @csrf
                        {{-- <div class="row mb-3">
                            <label for="kompetensi" class="col-sm-4 col-form-label">1. Kompetensi keahlian</label>
                            <div class="col-sm-8">
                              <input type="text" name="kompetensi" id="kompetensi" class="form-control @error('kompetensi') is-invalid @enderror " value="@if($register->kompetensi == NULL){{old('kompetensi')}}@else{{$register->kompetensi}}@endif" required/>
                              <div class="form-text text-success fw-bold">
                                  Kompentensi keahlian yang dipilih oleh peserta didik saat diterima di sekolah ini (khusus SMK).
                                </div>
                            </div>
                            @error('kompetensi')<div class="form-text text-danger">{{$message}}</div>@enderror
                        </div> --}}

                        <div class="row mb-3">
                            <label for="jenis" class="col-sm-4 col-form-label">1. Jenis Pendaftaran <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <select name="jenis" id="jenis" class="form-control" required/>
                                <optgroup label="Pilih Jenis Pendaftaran">
                                    <option value="Siswa Baru">1. Siswa Baru</option>
                                    <option value="Pindahan">2. Pindahan</option>
                                    <option value="Kembali Sekolah">3. Kembali Sekolah</option>
                                </optgroup>
                              </select>
                              <div class="form-text text-success fw-bold">
                                Nomor induk peserta didik sesuai yang tercantum pada buku induk.
                               </div>
                            </div>
                            @error('jenis')<div class="form-text text-danger">{{$message}}</div>@enderror
                        </div>

                        <hr/>
                        <span class="text-success fw-bold">Untuk tingkat Pendidikan TK/PAUD Kosongkan form dibawah, Untuk tingkat pendidikan SD, SMP, SMK wajib untuk mengisi form dibawah</span>
                        <br/>
                        <br/>
                        <div class="row mb-3">
                            <label for="nis" class="col-sm-4 col-form-label">2. NIS/NIPD </label>
                            <div class="col-sm-8">
                              <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror" value="@if($register->nis == NULL){{old('nis')}}@else{{$register->nis}}@endif"/>
                              <div class="form-text text-success fw-bold">
                                Nomor induk peserta didik sesuai yang tercantum pada buku induk.
                               </div>
                            </div>
                            @error('nis')<div class="form-text text-danger">{{$message}}</div>@enderror
                        </div>

                      

                        <div class="row mb-3">
                            <label for="sekolah_asal" class="col-sm-4 col-form-label">3. Sekolah Asal </label>
                            <div class="col-sm-8">
                              <input type="text" name="sekolah_asal" id="sekolah_asal" class="form-control @error('sekolah_asal') is-invalid @enderror " value="@if($register->sekolah_asal == NULL){{old('sekolah_asal')}}@else{{$register->sekolah_asal}}@endif"/>
                              <div class="form-text text-success fw-bold">
                                Nama sekolah peserta didik sebelumnya. Untuk peserta didik baru, isikan nama sekolah pada jenjang sebelumnya. Sedangkan bagi peserta didik
                                mutasi/pindahan, diisi dengan nama sekolah sebelum pindah ke sekolah saat ini..
                                </div>
                            </div>
                            @error('sekolah_asal')<div class="form-text text-danger">{{$message}}</div>@enderror
                        </div>

                        <div class="row mb-3">
                          <label for="npsn_sekolah_asal" class="col-sm-4 col-form-label">4. NPSN Sekolah Asal</label>
                          <div class="col-sm-8">
                            <input type="text" name="npsn_sekolah_asal" id="npsn_sekolah_asal" class="form-control @error('npsn_sekolah_asal') is-invalid @enderror " value="@if($register->npsn_sekolah_asal == NULL){{old('npsn_sekolah_asal')}}@else{{$register->sekolah_asal}}@endif"/>
                            <div class="form-text text-success fw-bold">
                               NPSN "Nomor Pokok Sekolah Nasional" sekolah peserta didik sebelumnya. Untuk peserta didik baru, isikan nama sekolah pada jenjang sebelumnya. Sedangkan bagi peserta didik
                              mutasi/pindahan, diisi dengan nama sekolah sebelum pindah ke sekolah saat ini..
                              </div>
                          </div>
                          @error('sekolah_asal')<div class="form-text text-danger">{{$message}}</div>@enderror
                        </div>

                        <div class="row mb-3">
                            <label for="nomor_ujian" class="col-sm-4 col-form-label">5. Nomor Peserta UN </label>
                            <div class="col-sm-8">
                              <input type="text" name="nomor_ujian" id="nomor_ujian" class="form-control @error('nomor_ujian') is-invalid @enderror " value="@if($register->nomor_ujian == NULL){{old('nomor_ujian')}}@else{{$register->nomor_ujian}}@endif"/>
                              <div class="form-text text-success fw-bold">
                                Nomor peserta Ujian adalah 20 Digit yang tertera dalam SKHU (Format Baku 2-12-02-01-001-002-7), diisi bagi peserta didik jenjang SMP<br/>
                                Nomor peserta ujian saat peserta didik masih di jenjang sebelumnya. Formatnya adalah x-xx-xx-xx-xxx-xxx-x (20 digit). Untuk Peserta Didik WNA,
                                diisi dengan Luar Negeri.
                                </div>
                            </div>
                            @error('nomor_ujian')<div class="form-text text-danger">{{$message}}</div>@enderror
                        </div>

                        <div class="row mb-3">
                            <label for="nomor_ijazah" class="col-sm-4 col-form-label">6. No. Seri Ijazah</label>
                            <div class="col-sm-8">
                              <input type="text" name="nomor_ijazah" id="nomor_ijazah" class="form-control @error('nomor_ijazah') is-invalid @enderror " value="@if($register->nomor_ijazah == NULL){{old('nomor_ijazah')}}@else{{$register->nomor_ijazah}}@endif"/>
                              <div class="form-text text-success fw-bold">
                                Nomor seri ijazah peserta didik pada jenjang sebelumnya.
                                </div>
                            </div>
                            @error('nomor_ijazah')<div class="form-text text-danger">{{$message}}</div>@enderror
                        </div>

                        <div class="row mb-3">
                            <label for="nomor_skhu" class="col-sm-4 col-form-label">7. No. SKHUN</label>
                            <div class="col-sm-8">
                              <input type="text" name="nomor_skhu" id="nomor_skhu" class="form-control @error('nomor_skhu') is-invalid @enderror " value="@if($register->nomor_skhu == NULL){{old('nomor_skhu')}}@else{{$register->nomor_skhu}}@endif"/>
                              <div class="form-text text-success fw-bold">
                                Nomor seri SKHUN/SHUN peserta didik pada jenjang sebelumnya (jika memiliki).
                            </div>
                            </div>
                            @error('nomor_skhu')<div class="form-text text-danger">{{$message}}</div>@enderror
                        </div>

                        <div class="col-lg-12 mt-3 text-end">
                            <button type="submit" class="btn btn-success">Simpan dan lanjutkan <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </form>
            </div>
          </div>

        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Petunjuk Pengisian</h2>
                    <div class="alert alert-info">
                        <p>
                            Contoh Format Baku<br/>
                            <strong>DN-01/D-SD/K13/23/0000001</strong><br/>
                            <strong>LN-01/M-SMA/KM/23/0000001</strong><br/>
                            Keterangan
                            <br/><i class="bi bi-check2-square"></i>  <strong>DN/LN</strong>  : Kode Penerbitan (LN = Luar Negeri, DN = Dalam Negeri).
                            <br/><i class="bi bi-check2-square"></i>  <strong>01</strong>  : Kode Provinsi.
                            <br/><i class="bi bi-check2-square"></i>  <strong>D</strong>  : Kode Jenjang (D = pendidikan dasar, M = pendidikan menengah, PA = paket A, PB = paket B, PC = paket C).
                            <br/><i class="bi bi-check2-square"></i>  <strong>SD</strong>  : Kode Satuan Pendidikan.
                            <br/><i class="bi bi-check2-square"></i>  <strong>K13/KM</strong>  : Kode Kurikulum (K13 = Kurikulum 2013, KM = Kurikulum Merdeka).
                            <br/><i class="bi bi-check2-square"></i>  <strong>23</strong>  : Kode Tahun.
                            <br/><i class="bi bi-check2-square"></i>  <strong>0000001</strong>  : Nomor Seri (nomorator).
                        </p>
                        <p>pedoman pengelolaan blangko ijazah bisa di lihat pada Peraturan Kepala Badan Standar, Kurikulum, dan Asesmen Pendidikan Nomor 004/H/EP/2023</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->


<!-- Modal Tambah -->
{{-- <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus-lg"></i> Tambah Prestasi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formPrestasi">
            <div class="row mb-3">
                <label for="jenis" class="col-sm-4 col-form-label">1. Jenis Prestasi</label>
                <div class="col-sm-8">
                  <select name="jenis" id="jenis" class="form-control" required>
                    <optgroup label="Pilih Jenis Prestasi">
                        <option value="Sains">1. Sains</option>
                        <option value="Seni">2. Seni</option>
                        <option value="Olahraga">3. Olahraga</option>
                        <option value="Lain-lain">4. Lain-lain</option>
                    </optgroup>
                  </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tingkat" class="col-sm-4 col-form-label">2. Tingkat</label>
                <div class="col-sm-8">
                  <select name="tingkat" id="tingkat" class="form-control" required>
                    <optgroup label="Pilih Tingkat">
                        <option value="Sekolah">1.Sekolah</option>
                        <option value="Kecamatan">2. Kecamatan</option>
                        <option value="Kabupaten">3. Kabupaten</option>
                        <option value="Provinsi">4. Provinsi</option>
                        <option value="Nasional">5. Nasional</option>
                        <option value="Internasional">6. Internasional</option>
                    </optgroup>
                  </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama_prestasi" class="col-sm-4 col-form-label">3. Nama Prestasi</label>
                <div class="col-sm-8">
                  <input type="text" name="nama_prestasi" id="nama_prestasi" class="form-control" required/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tahun" class="col-sm-4 col-form-label">4. Tahun</label>
                <div class="col-sm-8">
                  <input type="text" name="tahun" id="tahun" class="form-control" required/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="penyelenggara" class="col-sm-4 col-form-label">5. Penyelenggara</label>
                <div class="col-sm-8">
                  <input type="text" name="penyelenggara" id="penyelenggara" class="form-control" required/>
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="btnSavePrestasi" onclick="savePrestasi()">Simpan</button>
          <button type="button" class="btn btn-secondary" id="btnLoadingPrestasi" onclick="savePrestasi()"><i class="bi bi-arrow-clockwise"></i> Loading...</button>
        </div>
      </div>
    </div>
  </div> --}}
  


{{-- JavaScript --}}
<script src="{{asset('Admin/assets/js/ppdb.js')}}"></script>

@endsection