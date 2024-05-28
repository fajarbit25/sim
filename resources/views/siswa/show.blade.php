@extends('template/layout')
@section('main')
<!-- Id User Definition -->
<input type="hidden" name="user_id" id="user_id" value="{{$siswa->id}}"/>

<main id="main" class="main">
  <div class="row">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-person-bounding-box"></i> Detail Siswa</h5>

          <!-- Default Accordion -->
          <div class="accordion" id="accordionExample">
            {{-- Informasi --}}
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="bi bi-person-vcard"></i>&nbsp; Informasi Siswa
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form>
                    <div class="row mb-3">
                      <label for="nisn" class="col-sm-4 col-form-label col-form-label-sm">NISN</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nisn" readonly disabled/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="kelas" class="col-sm-4 col-form-label col-form-label-sm">Kelas</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="kelas" readonly disabled/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="first_name" class="col-sm-4 col-form-label col-form-label-sm">Nama Depan</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="first_name">
                      </div>
                    </div> 
                    <div class="row mb-3">
                      <label for="gender" class="col-sm-4 col-form-label col-form-label-sm">Jenis Kelamin</label>
                      <div class="col-sm-8">
                        <select name="gender" id="gender" class="form-control form-control-sm">
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="tempat_lahir" class="col-sm-4 col-form-label col-form-label-sm">Tempat Lahir</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="tempat_lahir">
                      </div>
                    </div> 
                    <div class="row mb-3">
                      <label for="tanggal_lahir" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Lahir</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control form-control-sm" id="tanggal_lahir">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="phone" class="col-sm-4 col-form-label col-form-label-sm">Nomor Handphone</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="phone" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="email" class="col-sm-4 col-form-label col-form-label-sm">Alamat Email</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control form-control-sm" id="email" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="telephone" class="col-sm-4 col-form-label col-form-label-sm">Nomor Telephone</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="telephone" required/>
                      </div>
                    </div>
                    <div class="row mb-3 text-end">
                      <div class="col-lg-12">
                        <button type="button" id="btn-edit-biodata" onclick="editInformasi()" class="btn btn-success btn-sm">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" id="btn-loading-biodata">Loading <i class="bi bi-three-dots"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            {{-- Biodata --}}
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <i class="bi bi-fingerprint"></i>&nbsp; Biodata Siswa
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">


                  <div class="row mb-3">
                    <label for="nik" class="col-sm-4 col-form-label col-form-label-sm">NIK</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="nik" required/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="kk" class="col-sm-4 col-form-label col-form-label-sm">KK</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="kk" required/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="akta_lahir" class="col-sm-4 col-form-label col-form-label-sm">Akta Lahir</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="akta_lahir" required/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="agama" class="col-sm-4 col-form-label col-form-label-sm">Agama</label>
                    <div class="col-sm-8">
                      <select name="agama" id="agama" class="form-control form-control-sm">
                        <optgroup label="Pilih Agama">
                          <option value="Islam">Islam</option>
                          <option value="Kristen/Protestan">Kristen/Protestan</option>
                          <option value="Katholik">Katohlik</option>
                          <option value="Hindu">Hindu</option>
                          <option value="Budha">Budha</option>
                          <option value="Khong Hu Chu">Khong Hu Chu</option>
                          <option value="Kepercayaan Kepada Tuhan YME">Kepercayaan Kepada Tuhan YME</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="no_kks" class="col-sm-4 col-form-label col-form-label-sm">Nomor KKS</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="no_kks"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="penerima_kip" class="col-sm-4 col-form-label col-form-label-sm">Penerima penerima_kip</label>
                    <div class="col-sm-8">
                      <select name="penerima_kip" id="penerima_kip" class="form-control form-control-sm">
                        <optgroup label="Pilih">
                          <option value="Ya">1. Ya</option>
                          <option value="Tidak">2. Tidak</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="no_kip" class="col-sm-4 col-form-label col-form-label-sm">Nomor KIP</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="no_kip"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="nama_kip" class="col-sm-4 col-form-label col-form-label-sm">Nama Tertera di KIP</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="nama_kip"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="alasan_menolak_kip" class="col-sm-4 col-form-label col-form-label-sm">Alasan Menolak KIP</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="alasan_menolak_kip"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="penerima_kps" class="col-sm-4 col-form-label col-form-label-sm">Penerima KPS</label>
                    <div class="col-sm-8">
                      <select name="penerima_kps" id="penerima_kps" class="form-control form-control-sm">
                        <optgroup label="Pilih">
                            <option value="Ya">1. Ya</option>
                            <option value="Tidak">2. Tidak</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="nomor_kps" class="col-sm-4 col-form-label col-form-label-sm">Nomor KPS</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="nomor_kps"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="layak_pip" class="col-sm-4 col-form-label col-form-label-sm">Layak PIP?</label>
                    <div class="col-sm-8">
                      <select name="layak_pip" id="layak_pip" class="form-control form-control-sm">
                        <optgroup label="Pilih">
                            <option value="Ya">1. Ya</option>
                            <option value="Tidak">2. Tidak</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="alasan_layak_pip" class="col-sm-4 col-form-label col-form-label-sm">Alasan Layak PIP</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="alasan_layak_pip"/>
                    </div>
                  </div>

                  <div class="row mb-3 text-end">
                    <div class="col-lg-12">
                      <button type="button" id="btn-edit-informasi" onclick="editInformasi()" class="btn btn-success btn-sm">Update</button>
                      <button type="button" class="btn btn-secondary btn-sm" id="btn-loading-informasi">Loading <i class="bi bi-three-dots"></i></button>
                    </div>
                  </div>


                </div>
              </div>
            </div>
            {{-- Data Priodik --}}
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePriodik" aria-expanded="false" aria-controls="collapsePriodik">
                  <i class="bi bi-rulers"></i>&nbsp; Data Prioduk
                </button>
              </h2>
              <div id="collapsePriodik" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                  <div class="row mb-3">
                    <label for="tinggi" class="col-sm-4 col-form-label col-form-label-sm">Tinggi Badan (cm)</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="tinggi" required/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="berat" class="col-sm-4 col-form-label col-form-label-sm">Berat Badan (kg)</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="berat" required/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="lingkar_kepala" class="col-sm-4 col-form-label col-form-label-sm">Lingkar Kepala (cm)</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="lingkar_kepala" required/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="jarak_per_1km" class="col-sm-4 col-form-label col-form-label-sm">Jarak Rumah Ke Sekolah (km)</label>
                    <div class="col-sm-8">
                      {{-- <input type="text" class="form-control form-control-sm" id="jarak_per_1km" required/> --}}
                      <select name="jarak_per_1km" id="jarak_per_1km" class="form-control form-control-sm">
                        <optgroup label="Pilih">
                          <option value="< 1 KM">Kurang dari 1 km</option>
                          <option value="> 1 KM">Lebih dari 1 km</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="jarak" class="col-sm-4 col-form-label col-form-label-sm">Jarak Rumah Ke Sekolah (m)</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="jarak" required/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="jam" class="col-sm-4 col-form-label col-form-label-sm">Waktu Tempuh Ke Sekolah (Jam)</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="jam" required/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="menit" class="col-sm-4 col-form-label col-form-label-sm">Waktu Tempuh Ke Sekolah (Menit)</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="menit" required/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="saudara" class="col-sm-4 col-form-label col-form-label-sm">Jumlah Saudara</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="saudara" required/>
                    </div>
                  </div>
                  <div class="row mb-3 text-end">
                    <div class="col-lg-12">
                      <button type="button" id="btn-edit-priodik" onclick="updatePriodik()" class="btn btn-success btn-sm">Update</button>
                      <button type="button" class="btn btn-secondary btn-sm" id="btn-loading-priodik">Loading <i class="bi bi-three-dots"></i></button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            {{-- Alamat --}}
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <i class="bi bi-geo-alt-fill"></i>&nbsp; Alamat
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form>
                    @csrf
                    <div class="row mb-3">
                      <label for="provinsi" class="col-sm-4 col-form-label col-form-label-sm">Provinsi</label>
                      <div class="col-sm-8">
                        <select name="provinsi" id="provinsi" class="form-control form-control-sm @error('provinsi') is-invalid @enderror">
                          @if($alamat->provinsi != NULL)
                          <option value="{{$alamat->idprovinsi}}" selected>{{$alamat->provinsi}}</option>
                          @endif
                          <optgroup label="Pilih Provinsi" id="provinsiList">
                          </optgroup>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="kabupaten" class="col-sm-4 col-form-label col-form-label-sm">Kabupaten/Kota</label>
                      <div class="col-sm-8">
                          <select name="kabupaten" id="kabupaten" class="form-control form-control-sm @error('kabupaten') is-invalid @enderror">
                            @if($alamat->kota != NULL)
                            <option value="{{$alamat->idkota}}" selected>{{$alamat->kota}}</option>
                            @endif
                          </select>
                      </div>
                      @error('kabupaten')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>
                    <div class="row mb-3">
                      <label for="kecamatan" class="col-sm-4 col-form-label col-form-label-sm">Kecamatan</label>
                      <div class="col-sm-8">
                          <select name="kecamatan" id="kecamatan" class="form-control form-control-sm @error('kecamatan') is-invalid @enderror">
                            @if($alamat->kec != NULL)
                            <option value="{{$alamat->idkec}}">{{$alamat->kec}}</option>
                            @endif
                          </select>
                      </div>
                      @error('kecamatan')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>
                    <div class="mb-3 row">
                      <label for="kelurahan" class="col-sm-4 col-form-label col-form-label-sm">Desa/Kelurahan</label>
                      <div class="col-sm-8">
                          <select name="kelurahan" id="kelurahan" class="form-control form-control-sm @error('kelurahan') is-invalid @enderror">
                            @if($alamat->kel != NULL)
                            <option value="{{$alamat->idkel}}">{{$alamat->kel}}</option>
                            @endif
                          </select>
                      </div>
                      @error('kelurahan')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>
                    <div class="mb-3 row">
                      <label for="rt" class="col-sm-4 col-form-label col-form-label-sm">RT <span class="text-danger">*</span> </label>
                      <div class="col-sm-8">
                        <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror" id="rt" value="@if($alamat->rt == NULL){{old('rt')}}@else{{$alamat->rt}}@endif" required autocomplete="off">
                      </div>
                      @error('rt')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="rw" class="col-sm-4 col-form-label col-form-label-sm">RW <span class="text-danger">*</span> </label>
                        <div class="col-sm-8">
                          <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror" id="rw" value="@if($alamat->rw == NULL){{old('rw')}}@else{{$alamat->rw}}@endif" required autocomplete="off">
                        </div>
                        @error('rw')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="kode_pos" class="col-sm-4 col-form-label col-form-label-sm">Kode POS <span class="text-danger">*</span> </label>
                        <div class="col-sm-8">
                          <input type="text" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" value="@if($alamat->kode_pos == NULL){{old('kode_pos')}}@else{{$alamat->kode_pos}}@endif" required autocomplete="off">
                        </div>
                        @error('kode_pos')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="mb-3 row">
                      <label for="jalan" class="col-sm-4 col-form-label col-form-label-sm">Nama Jalan <span class="text-danger">*</span> </label>
                      <div class="col-sm-8">
                        <textarea name="jalan" id="jalan" class="form-control @error('jalan') is-invalid @enderror" id="jalan" cols="" rows="3" required>@if($alamat->jalan == NULL){{old('jalan')}}@else{{$alamat->jalan}}@endif</textarea>
                      </div>
                      @error('jalan')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>


                    <div class="mb-3 row">
                      <label for="lintang" class="col-sm-4 col-form-label col-form-label-sm">Lintang <span class="text-danger">*</span> </label>
                      <div class="col-sm-8">
                        <input type="text" name="lintang" class="form-control @error('lintang') is-invalid @enderror" id="lintang" value="@if($alamat->lintang == NULL){{old('lintang')}}@else{{$alamat->lintang}}@endif" required autocomplete="off">
                      </div>
                      @error('lintang')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="mb-3 row">
                      <label for="bujur" class="col-sm-4 col-form-label col-form-label-sm">Bujur <span class="text-danger">*</span> </label>
                      <div class="col-sm-8">
                        <input type="text" name="bujur" class="form-control @error('bujur') is-invalid @enderror" id="bujur" value="@if($alamat->bujur == NULL){{old('bujur')}}@else{{$alamat->bujur}}@endif" required autocomplete="off">
                      </div>
                      @error('bujur')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="status_tempat_tinggal" class="col-sm-4 col-form-label col-form-label-sm">Status Tempat Tinggal<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
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
                        </div>
                        @error('status_tempat_tinggal')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="moda_transportasi" class="col-sm-4 col-form-label col-form-label-sm">Moda Transportasi<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
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
                        </div>
                        @error('moda_transportasi')<div class="form-text text-danger fw-bold">{{$message}}</div>@enderror
                    </div>
  
                    <div class="row mb-3 text-end">
                      <div class="col-lg-12">
                        <button type="button" id="btn-edit-alamat" onclick="updateAlamat()" class="btn btn-success btn-sm">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" id="btn-loading-alamat">Loading <i class="bi bi-three-dots"></i></button>
                      </div>
                    </div>

                    </form>
                </div>
              </div>
            </div>
            {{-- Data Registrasi --}}
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDataRegistrasi" aria-expanded="false" aria-controls="collapseDataRegistrasi">
                  <i class="bi bi-person-plus"></i>&nbsp; Data Regsitrasi
                </button>
              </h2>
              <div id="collapseDataRegistrasi" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form>
                    @csrf
                    <div class="row mb-3">
                      <label for="kompetensi" class="col-sm-4 col-form-label col-form-label-sm">Kompetensi</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="kompetensi" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="jenis" class="col-sm-4 col-form-label col-form-label-sm">Jenis Pendaftaran</label>
                      <div class="col-sm-8">
                        <select name="jenis" id="jenis" class="form-control form-control-sm">
                          <optgroup label="Pilih Jenis Pendaftaran">
                              <option value="Siswa Baru">1. Siswa Baru</option>
                              <option value="Pindahan">2. Pindahan</option>
                              <option value="Kembali Sekolah">3. Kembali Sekolah</option>
                          </optgroup>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="nis" class="col-sm-4 col-form-label col-form-label-sm">Nomor Induk</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nis" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="tanggal_masuk" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Masuk</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control form-control-sm" id="tanggal_masuk" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="sekolah_asal" class="col-sm-4 col-form-label col-form-label-sm">Sekolah Asal</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="sekolah_asal" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="nomor_ujian" class="col-sm-4 col-form-label col-form-label-sm">Nomor Ujian Nasional</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nomor_ujian" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="nomor_ijazah" class="col-sm-4 col-form-label col-form-label-sm">Nomor Ijazah</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nomor_ijazah" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="nomor_skhu" class="col-sm-4 col-form-label col-form-label-sm">Nomor SKHU</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nomor_skhu" required/>
                      </div>
                    </div>
                    <div class="row mb-3 text-end">
                      <div class="col-lg-12">
                        <button type="button" id="btn-edit-registrasi" onclick="updateRegistrasi()" class="btn btn-success btn-sm">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" id="btn-loading-registrasi">Loading <i class="bi bi-three-dots"></i></button>
                      </div>
                    </div>

                    </form>
                </div>
              </div>
            </div>
            {{-- Orang Tua/Wali --}}
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  <i class="bi bi-person-hearts"></i>&nbsp; Orang Tua / Wali
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <h2 class="card-title">Ayah</h2>
                  <form>
                    <div class="row mb-3">
                      <label for="ayahNama" class="col-sm-4 col-form-label col-form-label-sm">Nama Ayah</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="ayahNama" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ayahNik" class="col-sm-4 col-form-label col-form-label-sm">NIK</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="ayahNik" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ayahTahunLahir" class="col-sm-4 col-form-label col-form-label-sm">Tahun Lahir</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="ayahTahunLahir" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ayahPendidikan" class="col-sm-4 col-form-label col-form-label-sm">Pendidikan</label>
                      <div class="col-sm-8">
                        <select name="ayahPendidikan" id="ayahPendidikan" class="form-control form-control-sm ">
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
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ayahPekerjaan" class="col-sm-4 col-form-label col-form-label-sm">Pekerjaan</label>
                      <div class="col-sm-8">
                        {{-- <input type="text" class="form-control form-control-sm" id="ayahPekerjaan" required/> --}}
                        <select name="ayahPekerjaan" id="ayahPekerjaan" class="form-control form-control-sm">
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
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ayahPenghasilan" class="col-sm-4 col-form-label col-form-label-sm">Penghasilan</label>
                      <div class="col-sm-8">
                        <select name="ayahPenghasilan" id="ayahPenghasilan" class="form-control form-control-sm">
                          <option value="< Rp.500.000"> <  Rp.500.000</option>
                          <option value="Rp.5.00.000 - Rp.999.999">Rp.500.000 - Rp.999.999</option>
                          <option value="Rp.1.000.000 - Rp.1.999.999">Rp.1.000.000 - Rp.1.999.999</option>
                          <option value="Rp.2.000.000 - Rp.4.999.999">Rp.2.000.000 - Rp.4.999.999</option>
                          <option value="Rp.5.000.000 - Rp.20.000.000">Rp.5.000.000 - Rp.20.000.000</option>
                          <option value="< Rp.20.000.000"> >  Rp.20.000.000</option>
                          <option value="Lainnya">Lainnya</option>
                      </select>
                      </div>
                    </div>
                    <div class="row mb-3 text-end">
                      <div class="col-lg-12">
                        <button type="button" id="btn-edit-ayah" onclick="updateAyah()" class="btn btn-success btn-sm">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" id="btn-loading-ayah">Loading <i class="bi bi-three-dots"></i></button>
                      </div>
                    </div>
                  </form>

                  <h2 class="card-title">Ibu</h2>
                  <form>
                    <div class="row mb-3">
                      <label for="ibuNama" class="col-sm-4 col-form-label col-form-label-sm">Nama Ibu</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="ibuNama" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ibuNik" class="col-sm-4 col-form-label col-form-label-sm">NIK</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="ibuNik" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ibuTahunLahir" class="col-sm-4 col-form-label col-form-label-sm">Tahun Lahir</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="ibuTahunLahir" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ibuPendidikan" class="col-sm-4 col-form-label col-form-label-sm">Pendidikan</label>
                      <div class="col-sm-8">
                        <select name="ibuPendidikan" id="ibuPendidikan" class="form-control form-control-sm ">
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
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ibuPekerjaan" class="col-sm-4 col-form-label col-form-label-sm">Pekerjaan</label>
                      <div class="col-sm-8">
                        {{-- <input type="text" class="form-control form-control-sm" id="ibuPekerjaan" required/> --}}
                        <select name="ibuPekerjaan" id="ibuPekerjaan" class="form-control form-control-sm">
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
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ibuPenghasilan" class="col-sm-4 col-form-label col-form-label-sm">Penghasilan</label>
                      <div class="col-sm-8">
                        <select name="ibuPenghasilan" id="ibuPenghasilan" class="form-control form-control-sm">
                          <option value="< Rp.500.000"> <  Rp.500.000</option>
                          <option value="Rp.500.000 - Rp.999.999">Rp.500.000 - Rp.999.999</option>
                          <option value="Rp.1.000.000 - Rp.1.999.999">Rp.1.000.000 - Rp.1.999.999</option>
                          <option value="Rp.2.000.000 - Rp.4.999.999">Rp.2.000.000 - Rp.4.999.999</option>
                          <option value="Rp.5.000.000 - Rp.20.000.000">Rp.5.000.000 - Rp.20.000.000</option>
                          <option value="< Rp.20.000.000"> >  Rp.20.000.000</option>
                          <option value="Lainnya">Lainnya</option>
                      </select>
                      </div>
                    </div>
                    <div class="row mb-3 text-end">
                      <div class="col-lg-12">
                        <button type="button" id="btn-edit-ibu" onclick="updateIbu()" class="btn btn-success btn-sm">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" id="btn-loading-ibu">Loading <i class="bi bi-three-dots"></i></button>
                      </div>
                    </div>
                  </form>

                  <h2 class="card-title">Wali</h2>
                  <form>
                    <div class="row mb-3">
                      <label for="waliNama" class="col-sm-4 col-form-label col-form-label-sm">Nama wali</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="waliNama" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="waliNik" class="col-sm-4 col-form-label col-form-label-sm">NIK</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="waliNik" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="waliTahunLahir" class="col-sm-4 col-form-label col-form-label-sm">Tahun Lahir</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="waliTahunLahir" required/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="waliPendidikan" class="col-sm-4 col-form-label col-form-label-sm">Pendidikan</label>
                      <div class="col-sm-8">
                        <select name="waliPendidikan" id="waliPendidikan" class="form-control form-control-sm ">
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
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="waliPekerjaan" class="col-sm-4 col-form-label col-form-label-sm">Pekerjaan</label>
                      <div class="col-sm-8">
                        <select name="waliPekerjaan" id="waliPekerjaan" class="form-control form-control-sm">
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
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="waliPenghasilan" class="col-sm-4 col-form-label col-form-label-sm">Penghasilan</label>
                      <div class="col-sm-8">
                        <select name="waliPenghasilan" id="waliPenghasilan" class="form-control form-control-sm">
                          <option value="< Rp.500.000"> <  Rp.500.000</option>
                          <option value="Rp.500.000 - Rp.999.999">Rp.500.000 - Rp.999.999</option>
                          <option value="Rp.1.000.000 - Rp.1.999.999">Rp.1.000.000 - Rp.1.999.999</option>
                          <option value="Rp.2.000.000 - Rp.4.999.999">Rp.2.000.000 - Rp.4.999.999</option>
                          <option value="Rp.5.000.000 - Rp.20.000.000">Rp.5.000.000 - Rp.20.000.000</option>
                          <option value="< Rp.20.000.000"> >  Rp.20.000.000</option>
                          <option value="Lainnya">Lainnya</option>
                      </select>
                      </div>
                    </div>
                    <div class="row mb-3 text-end">
                      <div class="col-lg-12">
                        <button type="button" id="btn-edit-wali" onclick="updateWali()" class="btn btn-success btn-sm">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" id="btn-loading-wali">Loading <i class="bi bi-three-dots"></i></button>
                      </div>
                    </div>
                  </form>


                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                  <i class="bi bi-file-earmark-richtext"></i>&nbsp; Dokumen
                </button>
              </h2>
              <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Jenis Dokumen</th>
                        <th scope="col">File</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Akta Kelahiran</td>
                        <td><a href="{{$doc->akta_lahir}}" target="_blank" class="text-primary fw-bold"><i class="bi bi-box-arrow-up-right"></i> {{substr($doc->akta_lahir, 0, 50)}}...</a></td>
                      </tr>
                      <tr>
                        <td>Kartu Keluarga</td>
                        <td><a href="{{$doc->kk}}" target="_blank" class="text-primary fw-bold"><i class="bi bi-box-arrow-up-right"></i> {{substr($doc->kk, 0, 50)}}...</a></td>
                      </tr>
                      <tr>
                        <td>KTP Orang Tua</td>
                        <td><a href="{{$doc->ktp_ortu}}" target="_blank" class="text-primary fw-bold"><i class="bi bi-box-arrow-up-right"></i> {{substr($doc->ktp_ortu, 0, 50)}}...</a></td>
                      </tr>
                      <tr>
                        <td>Foto Siswa</td>
                        <td><a href="{{$doc->foto}}" target="_blank" class="text-primary fw-bold"><i class="bi bi-box-arrow-up-right"></i> {{substr($doc->foto, 0, 50)}}...</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                  <i class="bi bi-image"></i>&nbsp; Ganti Foto Siswa
                </button>
              </h2>
              <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form method="" action="" enctype="multipart/form-data" id="photoForm">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$siswa->id}}"/>
                    <div class="input-group">
                      <input type="file" class="form-control" name="photo" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                      <button class="btn btn-outline-success" onclick="changeImage()" type="button" id="inputGroupFileAddon04"><i class="bi bi-upload"></i></button>
                      <button type="button" class="btn btn-secondary btn-sm" id="btn-loadUpload">Loading <i class="bi bi-three-dots"></i></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div><!-- End Default Accordion Example -->
          
          <!--Btn Delete Siswa -->
          <button type="button" class="btn btn-danger btn-sm my-3" onclick="modaldeleteSiswa({{$siswa->id}})">
            <i class="bi bi-trash3"></i> Hapus Siswa
          </button>
          <!--End Btn Delete Siswa -->

        </div>
      </div>

    </div>

    <div class="col-lg-4">
      <!-- Card with an image on top -->
      <div class="card" id="detail-siswa">    
      </div><!-- End Card with an image on top -->
    </div>

  </div>
</main>

<!-- Modal Delete -->
<div class="modal fade" id="modalDeleteSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">
          <i class="bi bi-exclamation-circle-fill"></i> Confirm
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span class="fw-bold">Yakin ingin menghapus siswa?</span>
        <div class="col-sm-12 text-end">
          <button type="button" class="btn btn-danger" id="btnDeleteSiswa" onclick="deleteSiswa()">Hapus</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
          <input type="hidden" id="idDeleteSiswa">
        </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
<!-- Modal Delete -->

{{-- Save value input --}}
<input type="hidden" name="daPro" id="daPro" required/>
<input type="hidden" name="daKab" id="daKab" required/>
<input type="hidden" name="daKec" id="daKec" required/>
<input type="hidden" name="daKel" id="daKel" required/>
{{-- End Save value input --}}
<!-- Load Js Siswa -->
<script src="{{asset('Admin/assets/js/siswa.js')}}"></script>
<script src="{{asset('Admin/assets/js/location.js')}}"></script>
@endsection