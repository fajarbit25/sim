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

    <section class="section profile">
      <div class="row">
        

        <div class="col-xl-4">

          <div class="card col-12">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{asset('storage/document')}}/{{$doc->foto}}" alt="Profile" class="rounded-circle">
              <h2>{{$user->first_name}}</h2>
              <h3>NISN : {{$student->nisn}}</h3>

            </div>
          </div>

          @if($ppdb->status == 1)
          <div class="col-sm-12">
              <div class="card">
                <div class="card-body text-center" id="approval">
                    <h5 class="card-title mb-3">Approval</h5>
                    <form action="{{url('/admin/ppdb/approval')}}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <input type="radio" class="btn-check" name="approved" value="400" id="option5" autocomplete="off" checked>
                          <label class="btn text-success" for="option5"><i class="bi bi-check-circle"></i> Terima</label>

                          <input type="radio" class="btn-check" name="approved" value="500" id="option6" autocomplete="off">
                          <label class="btn text-danger" for="option6"><i class="bi bi-exclamation-circle"></i> Tolak</label>
                      </div>
                      <div class="mb-3">
                          <input type="hidden" value="{{$student->user_id}}" name="user_id" required/>
                          <button class="btn btn-primary w-100" @if(Auth::user()->level == 2)disabled @endif>Submit</button>
                      </div>
                    </form>
                  </div>      
              </div>
          </div>
          @else
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body text-center" id="approval">
                <h5 class="card-title mb-3">Status</h5>
                <form action="{{url('/admin/ppdb/approval')}}" method="POST">
                  @csrf
                  <div class="mb-3">
                      <input type="radio" class="btn-check" name="approved" value="1" id="option5" autocomplete="off" checked>
                      <label class="btn text-success" for="option5"><i class="bi bi-check-circle"></i> Diterima</label>
                  </div>
                  <div class="mb-3">
                      <input type="hidden" value="{{$student->user_id}}" name="user_id" required/>
                      <button class="btn btn-danger w-100" @if(Auth::user()->level == 2)disabled @endif>Batalkan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @endif

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Dokumen</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Orang Tua</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Priodik</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-prestasi">Prestasi</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nomor Pendaftaran</div>
                    <div class="col-lg-9 col-md-8">: <span class="fw-bold">{{$ppdb->nomor_pendaftaran}}</span></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">: <span>{{$user->email}}</span></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Handphone</div>
                    <div class="col-lg-9 col-md-8">: <span>{{$user->phone}}</span></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telephone</div>
                    <div class="col-lg-9 col-md-8">: <span>{{$user->telephone}}</span></div>
                  </div>
                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                      <div class="col-lg-9 col-md-8">: {{$student->gender}}</div>
                  </div>
                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Tempat, Tanggal Lahir</div>
                      <div class="col-lg-9 col-md-8">: {{$student->tempat_lahir.', '.$student->tanggal_lahir}}</div>
                  </div>
                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Sekolah Asal</div>
                      <div class="col-lg-9 col-md-8">: {{$register->sekolah_asal}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">NPSN Sekolah Asal</div>
                    <div class="col-lg-9 col-md-8">: {{$register->npsn_sekolah}}</div>
                  </div>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Agama</div>
                    <div class="col-lg-9 col-md-8">: {{$student->agama}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Kebutuhan Khusus</div>
                    <div class="col-lg-9 col-md-8">:
                      @foreach($specialneeds as $sn)
                        @if($sn->segment == 'siswa')
                          {{$sn->special_needs.', '}}
                        @endif
                      @endforeach
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Penerima KIP</div>
                    <div class="col-lg-9 col-md-8">: {{$student->kip}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">AKan Menerima KIP</div>
                    <div class="col-lg-9 col-md-8">: {{$student->need_kip}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alasan Tidak Menerima PIP</div>
                    <div class="col-lg-9 col-md-8">: {{$student->nook_pip}} </div>
                  </div>

                  <h5 class="card-title">Alamat</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                    <div class="col-lg-9 col-md-8">: {{$alamat->jalan.', '.$alamat->kel.', KEC. '.$alamat->kec.', '.$alamat->kota.', '. $alamat->provinsi.', '.$alamat->kode_pos}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">RT/RW</div>
                    <div class="col-lg-9 col-md-8">: {{$alamat->rt.'/'.$alamat->rw}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Koordinat</div>
                    <div class="col-lg-9 col-md-8">: {{$alamat->lintang.', '.$alamat->bujur}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tempat Tinggal</div>
                    <div class="col-lg-9 col-md-8">: {{$alamat->status_tempat_tinggal}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Moda Transportasi</div>
                    <div class="col-lg-9 col-md-8">: {{$alamat->moda_transportasi}} </div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3 profile-overview" id="profile-edit">
                  <h5 class="card-title">Dokumen</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">No. KK</div>
                    <div class="col-lg-9 col-md-8">: {{$student->kk}} </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">NIK</div>
                    <div class="col-lg-9 col-md-8">: {{$student->nik}} </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Akta Lahir</div>
                    <div class="col-lg-9 col-md-8">: {{$student->akta_lahir}}</div>
                  </div>

                  <h5 class="card-title">File</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Akta Lahir</div>
                    <div class="col-lg-9 col-md-8">: <a href="" class="fw-bold text-success" data-bs-toggle="modal" data-bs-target="#modalAkta">{{$doc->akta_lahir}}</a> </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Kartu Keluarga</div>
                    <div class="col-lg-9 col-md-8">: <a href="" class="fw-bold text-success" data-bs-toggle="modal" data-bs-target="#modalKK">{{$doc->kk}}</a> </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">KTP Orang Tua</div>
                    <div class="col-lg-9 col-md-8">: <a href="" class="fw-bold text-success" data-bs-toggle="modal" data-bs-target="#ktpOrtu">{{$doc->ktp_ortu}}</a> </div>
                  </div>

                </div>

                <div class="tab-pane fade pt-3 profile-overview" id="profile-settings">

                  <h5 class="card-title">Data Ayah</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nama</div>
                    <div class="col-lg-9 col-md-8">: {{$ayah->nama_lengkap}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">NIK</div>
                    <div class="col-lg-9 col-md-8">: {{$ayah->nik}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tahun Lahir</div>
                    <div class="col-lg-9 col-md-8">: {{$ayah->tahun_lahir}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pendidikan</div>
                    <div class="col-lg-9 col-md-8">: {{$ayah->pendidikan}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pekerjaan</div>
                    <div class="col-lg-9 col-md-8">: {{$ayah->pekerjaan}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Penghasilan/bulan</div>
                    <div class="col-lg-9 col-md-8">: {{$ayah->penghasilan}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Kebutuhan Khusus</div>
                    <div class="col-lg-9 col-md-8">:
                      @foreach($specialneeds as $sn)
                        @if($sn->segment == 'ayah')
                          {{$sn->special_needs.', '}}
                        @endif
                      @endforeach
                    </div>
                  </div>
                  
                  <h5 class="card-title">Data Ibu</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nama</div>
                    <div class="col-lg-9 col-md-8">: {{$ibu->nama_lengkap}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">NIK</div>
                    <div class="col-lg-9 col-md-8">: {{$ibu->nik}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tahun Lahir</div>
                    <div class="col-lg-9 col-md-8">: {{$ibu->tahun_lahir}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pendidikan</div>
                    <div class="col-lg-9 col-md-8">: {{$ibu->pendidikan}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pekerjaan</div>
                    <div class="col-lg-9 col-md-8">: {{$ibu->pekerjaan}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Penghasilan/bulan</div>
                    <div class="col-lg-9 col-md-8">: {{$ibu->penghasilan}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Kebutuhan Khusus</div>
                    <div class="col-lg-9 col-md-8">:
                      @foreach($specialneeds as $sn)
                        @if($sn->segment == 'ibu')
                          {{$sn->special_needs.', '}}
                        @endif
                      @endforeach
                    </div>
                  </div>

                  <h5 class="card-title">Data Wali</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nama</div>
                    <div class="col-lg-9 col-md-8">: {{$wali->nama_lengkap}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">NIK</div>
                    <div class="col-lg-9 col-md-8">: {{$wali->nik}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tahun Lahir</div>
                    <div class="col-lg-9 col-md-8">: {{$wali->tahun_lahir}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pendidikan</div>
                    <div class="col-lg-9 col-md-8">: {{$wali->pendidikan}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pekerjaan</div>
                    <div class="col-lg-9 col-md-8">: {{$wali->pekerjaan}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Penghasilan/bulan</div>
                    <div class="col-lg-9 col-md-8">: {{$wali->penghasilan}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Kebutuhan Khusus</div>
                    <div class="col-lg-9 col-md-8">:
                      @foreach($specialneeds as $sn)
                        @if($sn->segment == 'wali')
                          {{$sn->special_needs.', '}}
                        @endif
                      @endforeach
                    </div>
                  </div>

                </div>

                <div class="tab-pane fade pt-3 profile-overview" id="profile-change-password">
                  
                  <h5 class="card-title">Data Priodik</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tinggi Badan</div>
                    <div class="col-lg-9 col-md-8">: {{$priodik->tinggi}} cm</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Berat Badan</div>
                    <div class="col-lg-9 col-md-8">: {{$priodik->berat}} kg</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Lingkar Kepala</div>
                    <div class="col-lg-9 col-md-8">: {{$priodik->lingkar_kepala}} cm</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Jarak Rumah Ke Sekolah</div>
                    <div class="col-lg-9 col-md-8">: {{$priodik->jarak}} km</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Jarak Rumah Ke Sekolah (km)</div>
                    <div class="col-lg-9 col-md-8">: {{$priodik->jarak_per_1km}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Waktu Tempuh Ke Sekolah</div>
                    <div class="col-lg-9 col-md-8">: {{$priodik->jam.' Jam, '.$priodik->menit.' Menit'}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Jumlah Saudara Kandung</div>
                    <div class="col-lg-9 col-md-8">: {{$priodik->saudara}} Orang</div>
                  </div>

                  <h5 class="card-title">Data Registrasi Peserta Didik</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"> Kompetensi Keahlian </div>
                    <div class="col-lg-9 col-md-8">: {{$register->kompetensi}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"> Jenis Pendaftaran </div>
                    <div class="col-lg-9 col-md-8">: {{$register->jenis}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"> NIS/Nomor Induk PD </div>
                    <div class="col-lg-9 col-md-8">: {{$register->nis}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"> Tanggal Masuk Sekolah </div>
                    <div class="col-lg-9 col-md-8">: {{$register->tanggal_masuk}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"> Sekolah Asal </div>
                    <div class="col-lg-9 col-md-8">: {{$register->sekolah_asal}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"> Nomor Peserta UN </div>
                    <div class="col-lg-9 col-md-8">: {{$register->nomor_ujian}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"> No Seri Ijazah </div>
                    <div class="col-lg-9 col-md-8">: {{$register->nomor_ijazah}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"> No. SKHUN </div>
                    <div class="col-lg-9 col-md-8">: {{$register->nomor_skhu}} </div>
                  </div>

                </div>

                <div class="tab-pane fade pt-3 profile-overview" id="profile-prestasi">

                  <h5 class="card-title">Prestasi</h5>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Prestasi</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Tingkat</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Penyelenggara</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($prestasi as $pres)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$pres->nama_prestasi}}</td>
                        <td> {{$pres->jenis}} </td>
                        <td> {{$pres->tingkat}} </td>
                        <td> {{$pres->tahun}} </td>
                        <td> {{$pres->penyelenggara}} </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                  <h5 class="card-title">Beasiswa</h5>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tahun Mulai</th>
                        <th scope="col">Tahun Selesai</th>
                        <th scope="col">Jenis Beasiswa</th>
                        <th scope="col">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($beasiswa as $bea)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td> {{$bea->tahun_mulai}} </td>
                        <td> {{$bea->tahun_selesai}} </td>
                        <td> {{$bea->jenis}} </td>
                        <td> {{$bea->keterangan}} </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                  <h5 class="card-title">Kesejahteraan Peserta Didik</h5>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Nomor Kartu</th>
                        <th scope="col">Nama</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($kesejaheraan as $kes)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td> {{$kes->jenis}} </td>
                        <td> {{$kes->nomor_kartu}} </td>
                        <td> {{$kes->nama}} </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>


      </div>
    </section>



  </main><!-- End #main -->


<!-- Modal -->
<!-- Modal Akta -->
<div class="modal fade" id="modalAkta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-filetype-pdf"></i> Akta Lahir</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <embed type="application/pdf" src="{{asset('storage/document/'.$doc->akta_lahir)}}" width="100%" height="700px"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Akta -->
<div class="modal fade" id="modalKK" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-filetype-pdf"></i> Kartu Keluarga</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <embed type="application/pdf" src="{{asset('storage/document/'.$doc->kk)}}" width="100%" height="700px"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal KTP -->
<div class="modal fade" id="ktpOrtu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-filetype-pdf"></i> KTP Orang Tua</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <embed type="application/pdf" src="{{asset('storage/document/'.$doc->ktp_ortu)}}" width="100%" height="700px"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  
@endsection