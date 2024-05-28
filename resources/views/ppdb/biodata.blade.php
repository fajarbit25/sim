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
              <h5 class="card-title"> 3. Formulir Peserta Didik</h5>

                <form action="{{url('/ppdb/submit_biodata')}}" method="POST" id="formData">
                    @csrf
                    <div class="col-lg-12 my-3 row">
                        <label for="phone" class="col-sm-4 col-form-label">Nomor Handphone</label>
                        <div class="col-sm-8">
                          <input type="text" readonly class="form-control-plaintext" id="phone" value="081243553079">
                        </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                          <input type="text" readonly class="form-control-plaintext" id="email" value="rd@gmail.com">
                        </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="name" class="col-sm-4 col-form-label">Nama Lengkap <span class="text-danger">*</span> </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$user->first_name}}" required autocomplete="off">
                        <div class="form-text text-success">
                          Nama peserta didik sesuai dokumen resmi yang berlaku (Akta atau Ijazah sebelumnya ). Hanya bisa diubah melalui
                          http://vervalpd.data.kemdikbud.go.id.
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="radio" class="btn-check" name="gender" id="Laki-laki" value="Laki-laki" autocomplete="off" @if($student->gender == 'Laki-laki') checked @endif>
                        <label class="btn btn-outline-secondary" for="Laki-laki"><i class="bi bi-gender-male"></i> Laki-laki</label>

                        <input type="radio" class="btn-check" name="gender" id="Perempuan" value="Perempuan" autocomplete="off" @if($student->gender == 'Perempuan') checked @endif>
                        <label class="btn btn-outline-secondary" for="Perempuan"><i class="bi bi-gender-female"></i> Perempuan</label>

                      </div>
                      @error('gender')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="nisn" class="col-sm-4 col-form-label">NISN<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control 
                          @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="@if($student->nisn == NULL){{old('nisn')}}@else{{$student->nisn}}@endif" required autocomplete="off"/>
                          <div class="form-text text-success">
                            Nomor Induk Siswa Nasional peserta didik (jika memiliki). Jika belum memiliki, maka wajib dikosongkan. NISN memiliki format 10 digit angka.
                            Contoh: 0009321234. Untuk memeriksa NISN, dapat mengunjungi laman http://nisn.data.kemdikbud.go.id/page/data
                          </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 my-3 row">
                        <label for="nik" class="col-sm-4 col-form-label">NIK/ No. KITAS (Untuk WNA) <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" value="@if($student->nik == NULL){{old('nik')}}@else{{$student->nik}}@endif" required autocomplete="off">
                          <div class="form-text text-success">
                            Nomor Induk Kependudukan yang tercantum pada Kartu Keluarga, Kartu Identitas Anak, atau KTP (jika sudah memiliki) bagi WNI. NIK memiliki
                            format 16 digit angka. Contoh: 6112090906021104.<br/>
                            Pastikan NIK tidak tertukar dengan No. Kartu Keluarga, karena keduanya memiliki format yang sama. Bagi WNA, diisi dengan nomor Kartu Izin
                            Tinggal Terbatas (KITAS)
                          </div>
                        </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="kk" class="col-sm-4 col-form-label">Nomor Kartu Keluarga<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control @error('kk') is-invalid @enderror" name="kk" id="kk" value="@if($student->kk == NULL){{old('kk')}}@else{{$student->kk}}@endif" required autocomplete="off">
                          <div class="form-text text-success">
                            Nomor Kaktu Keluarga 16 digit.
                          </div>
                        </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="tempat_lahir" class="col-sm-4 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" id="tempat_lahir" value="@if($student->tempat_lahir == NULL){{old('tempat_lahir')}}@else{{$student->tempat_lahir}}@endif" required autocomplete="off">
                          <div class="form-text text-success">
                            Tempat lahir peserta didik sesuai dokumen resmi yang berlaku
                          </div>
                        </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="tanggal_lahir" class="col-sm-4 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" value="@if($student->tanggal_lahir == NULL){{old('tanggal_lahir')}} @else{{$student->tanggal_lahir}}@endif" required autocomplete="off">
                          <div class="form-text text-success">
                            Tanggal lahir peserta didik sesuai dokumen resmi yang berlaku. Hanya bisa diubah melalui http://vervalpd.data.kemdikbud.go.id.
                          </div>
                        </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                        <label for="akta_lahir" class="col-sm-4 col-form-label">No Registasi Akta Lahir <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control @error('akta_lahir') is-invalid @enderror" name="akta_lahir" id="akta_lahir" value="@if($student->akta_lahir == NULL){{old('akta_lahir')}}@else{{$student->akta_lahir}}@endif" required autocomplete="off">
                            <div class="form-text text-success">
                              Nomor registrasi Akta Kelahiran. Nomor registrasi yang dimaksud umumnya tercantum pada bagian tengah atas lembar kutipan akta kelahiran
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="agama" class="col-sm-4 col-form-label">Agama & Kepercayaan <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                          <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                              @if($student->agama != NULL)
                              <option value="{{$student->agama}}"> {{$student->agama}} </option>
                              <option value="{{$student->agama}}"> ==Change== </option>
                              @endif
                              <option value="Islam">Islam</option>
                              <option value="Kristen/Protestan">Kristen/Protestan</option>
                              <option value="Katholik">Katholik </option>
                              <option value="Hindu">Hindu</option>
                              <option value="Budha">Budha</option>
                              <option value="Khonghucu">Khonghucu </option>
                              <option value="Kepercayaan Kepada Tuhan YME">Kepercayaan Kepada Tuhan YME</option>
                          </select>
                          <div class="form-text text-success fw-bold">
                            Agama atau kepercayaan yang dianut oleh peserta didik. Apabila peserta didik adalah penghayat kepercayaan (misalnya pada daerah tertentu yang
                            masih memiliki penganut kepercayaan), dapat memilih opsi  Kepercayaan kpd Tuhan YME
                          </div>
                      </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="kewarganegaraan" class="col-sm-4 col-form-label">Kewarganegaran<span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <select name="kewarganegaraan" id="kewarganegaraan" class="form-control @error('kewarganegaraan') is-invalid @enderror">
                          @if($student->kewarganegaraan != NULL)
                          <option value="{{$student->kewarganegaraan}}">{{$student->kewarganegaraan}}</option>
                          <option value="{{$student->kewarganegaraan}}"> == Change ==</option>
                          @endif
                          <option value="WNI" selected>Indonesia (WNI)</option>
                          <option value="WNA">Asing (WNA)</option>
                        </select>
                        <div class="form-text text-success fw-bold">
                          Kewarganegaraan peserta didik
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12 my-3 row" id="negaraRow">
                      <label for="negara" class="col-sm-4 col-form-label">Nama Negara<span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('negara') is-invalid @enderror" value="Indonesia" name="negara" id="negara" value="@if($student->negara == NULL){{old('negara')}}@else{{$student->negara}}@endif" required autocomplete="off">
                        <div class="form-text text-success fw-bold">
                          Masukan nama Negara untuk WNA
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12 my-3 row" id="keb-khusus">    
                    </div>


                    <div class="col-lg-12 my-3 row">
                        <label for="anak_ke" class="col-sm-4 col-form-label">Anak Ke Berapa<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control @error('anak_ke') is-invalid @enderror" id="anak_ke" name="anak_ke" 
                          value="@if($student->anak_ke == NULL){{old('anak_ke')}} @else{{$student->anak_ke}}@endif" required autocomplete="off">
                          <div class="form-text text-success fw-bold">
                            Sesuaikan dengan urutan pada Kartu Keluarga
                          </div>
                        </div>
                        @error('anak_ke')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 row my-3">
                      <label for="no_kks" class="col-sm-4 col-form-label">Nomor KKS</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('no_kks') is-invalid @enderror" id="no_kks" name="no_kks"
                        value="@if($student->no_kks == NULL){{old('no_kks')}} @else {{$student->no_kks}} @endif" autocomplete="off"/>
                        <div class="form-text text-success fw-bold">
                          Nomor Kartu Keluarga Sejahtera
                        </div>
                      </div>
                      @error('no_kks')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="penerima_kip" class="col-sm-4 col-form-label">Penerima KIP <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="radio" class="btn-check" value="Ya" name="penerima_kip" id="Ya_kip" autocomplete="off" @if($student->penerima_kip == 'Ya') checked @endif>
                        <label class="btn btn-outline-secondary" for="Ya_kip"><i class="bi bi-check-lg"></i> Ya</label>

                        <input type="radio" class="btn-check" value="Tidak" name="penerima_kip" id="Tidak_kip" autocomplete="off" @if($student->penerima_kip == 'Tidak') checked @endif>
                        <label class="btn btn-outline-secondary" for="Tidak_kip"><i class="bi bi-x-lg"></i> Tidak</label>

                        <div class="form-text text-success fw-bold">
                          Pilih Ya apabila peserta didik adalah penerima Kartu Indonesia Pintar (Penerima KIP). Pilih Tidak jika tidak memiliki.
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12 row my-3">
                      <label for="no_kip" class="col-sm-4 col-form-label">Nomor KIP</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('no_kip') is-invalid @enderror" name="no_kip" id="no_kip"
                        value="@if($student->no_kip == NULL){{old('no_kip')}}@else{{$student->no_kip}}@endif" autocomplete="off"/>
                        <div class="form-text text-success fw-bold">
                          Masukan Nomor Kartu Indonesia Pintar (Jika ada).
                        </div>
                      </div>
                      @error('no_kip')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 row my-3">
                      <label for="nama_kip" class="col-sm-4 col-form-label">Nama Tertera di KIP</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama_kip') is-invalid @enderror" name="nama_kip" id="nama_kip"
                        value="@if($student->nama_kip == NULL){{old('nama_kip')}}@else{{$student->nama_kip}}@endif" autocomplete="off"/>
                        <div class="form-text text-success fw-bold">
                          Masukan Nama yang yang Tertera di Kartu Indonesia Pintar, Jika Memiliki Kartu KIP.
                        </div>
                      </div>
                      @error('nama_kip')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="col-lg-12 row my-3">
                      <label for="alasan_menolak_kip" class="col-sm-4 col-form-label">Alasan Menolak KIP</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('alasan_menolak_kip') is-invalid @enderror" name="alasan_menolak_kip" id="alasan_menolak_kip"
                        value="@if($student->alasan_menolak_kip == NULL){{old('alasan_menolak_kip')}}@else{{$studen->alasan_menolak_kip}}@endif" autocomplete="off"/>
                        <div class="form-text text-success fw-bold">
                          Alasan menolak Kartu Indonesia Pintar, Jika Tidak Memiliki Kartu KIP.
                        </div>
                      </div>
                      @error('alasan_menolak_kip')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>


                    <div class="col-lg-12 my-3 row">
                      <label for="penerima_kps" class="col-sm-4 col-form-label">Penerima KPS? <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="radio" class="btn-check" value="Ya" name="penerima_kps" id="Ya_kps" autocomplete="off" @if($student->penerima_kps == 'Ya') checked @endif>
                        <label class="btn btn-outline-secondary" for="Ya_kps"><i class="bi bi-check-lg"></i> Ya</label>

                        <input type="radio" class="btn-check" value="Tidak" name="penerima_kps" id="Tidak_kps" autocomplete="off" @if($student->penerima_kps == 'Tidak') checked @endif>
                        <label class="btn btn-outline-secondary" for="Tidak_kps"><i class="bi bi-x-lg"></i> Tidak</label>

                        <div class="form-text text-success fw-bold">
                          Pilih Ya apabila peserta didik adalah penerima Kartu Perlindungan Sosial (Penerima KPS). Pilih Tidak jika tidak memiliki.
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12 row mb-3">
                      <label for="nomor_kps" class="col-sm-4 col-form-label">Nomor KPS</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('nomor_kps') is-invalid @enderror" name="nomor_kps" id="nomor_kps"
                        value="@if($student->nomor_kps == NULL){{old('nomor_kps')}}@else{{$studen->nomor_kps}}@endif"/>
                        <div class="form-text text-success fw-bold">
                          Masukan Nomor Kartu Perlindungan Sosial, Jika memiliki KPS.
                        </div>
                      </div>
                      @error('nomor_kps')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    {{-- <div class="col-lg-12 my-3 row">
                      <label for="pekerjaan_pelajar" class="col-sm-4 col-form-label">Pekerjaan (diperuntukan untuk warga belajar) <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                          <select name="pekerjaan_pelajar" id="pekerjaan_pelajar" class="form-control @error('pekerjaan_pelajar') is-invalid @enderror">
                            @if($student->pekerjaan_pelajar != NULL)
                              <option value="{{$student->pekerjaan_pelajar}}">{{$student->pekerjaan_pelajar}}</option>
                              <option value="{{$student->pekerjaan_pelajar}}">== Change ==</option>
                            @endif
                              <option value="Tidak bekerja">1. Tidak bekerja</option>
                              <option value="Nelayan ">2. Nelayan</option>
                              <option value="Petani">3. Petani </option>
                              <option value="Peternak">4. Peternak</option>
                              <option value="Budha">5. Budha</option>
                              <option value="PNS/TNI/POLRI">6. PNS/TNI/POLRI </option>
                              <option value="Karyawan Swasta">7. Karyawan Swasta</option>
                              <option value="Pedagang Kecil">8. Pedagang Kecil</option>
                              <option value="Pedagang Besar">9. Pedagang Besar</option>
                              <option value="Wiraswasta">10. Wiraswasta</option>
                              <option value="Buruh">11. Buruh</option>
                              <option value="Pensiunan">12. Pensiunan</option>
                          </select>
                          <div class="form-text text-success fw-bold">
                            Diperuntukan untuk warga belajar
                          </div>
                      </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="kip" class="col-sm-4 col-form-label">Apakah punya KIP <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="radio" class="btn-check" value="Ya" name="kip" id="Ya" autocomplete="off" @if($student->kip == 'Ya') checked @endif>
                        <label class="btn btn-outline-secondary" for="Ya"><i class="bi bi-check-lg"></i> Ya</label>

                        <input type="radio" class="btn-check" value="Tidak" name="kip" id="Tidak" autocomplete="off" @if($student->kip == 'Tidak') checked @endif>
                        <label class="btn btn-outline-secondary" for="Tidak"><i class="bi bi-x-lg"></i> Tidak</label>

                        <div class="form-text text-success fw-bold">
                          Pilih Ya apabila peserta didik memiliki Kartu Indonesia Pintar (KIP). Pilih Tidak jika tidak memiliki.
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="need_kip" class="col-sm-4 col-form-label">Apakah peserta didik tersebut tetap akan menerima KIP <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="radio" class="btn-check" value="Ya" name="need_kip" id="Ya_need" autocomplete="off" @if($student->need_kip == 'Ya') checked @endif>
                        <label class="btn btn-outline-secondary" for="Ya_need"><i class="bi bi-check-lg"></i> Ya</label>

                        <input type="radio" class="btn-check" value="Tidak" name="need_kip" id="no_Need" autocomplete="off" @if($student->need_kip == 'Tidak') checked @endif>
                        <label class="btn btn-outline-secondary" for="no_Need"><i class="bi bi-x-lg"></i> Tidak</label>

                        <div class="form-text text-success fw-bold">
                          Status bahwa peserta didik sudah menerima atau belum menerima Kartu Indonesia Pintar secara fisik.
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12 my-3 row">
                      <label for="nook_pip" class="col-sm-4 col-form-label">Alasan menolak PIP <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                          <select name="nook_pip" id="nook_pip" class="form-control @error('nook_pip') is-invalid @enderror">
                            @if($student->nook_pip != NULL)
                              <option value="{{$student->nook_pip}}">{{$student->nook_pip}}</option>
                              <option value="{{$student->nook_pip}}">== Change ==</option>
                            @endif
                              <option value="Dilarang pemda karena menerima bantuan serupa">1. Dilarang pemda karena menerima bantuan serupa</option>
                              <option value="Menolak ">2. Menolak</option>
                              <option value="Sudah mampu">3. Sudah mampu</option>
                          </select>
                          <div class="form-text text-success fw-bold">
                            Alasan utama peserta didik jika layak menerima manfaat PIP.
                          </div>
                      </div>
                    </div> --}}
                    
                    <div class="col-lg-12 mt-3 text-end">
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