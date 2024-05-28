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
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="bi bi-person-vcard"></i>&nbsp; Informasi Siswa
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form action="">

                    <div class="row mb-3">
                      <label for="nip" class="col-sm-4 col-form-label col-form-label-sm">Nomor Induk</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nip" value="{{$siswa->nip}}" disabled/>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="first_name" class="col-sm-4 col-form-label col-form-label-sm">Nama Depan</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="first_name" value="{{$siswa->first_name}}" disabled/>
                      </div>
                    </div> 

                    <div class="row mb-3">
                      <label for="last_name" class="col-sm-4 col-form-label col-form-label-sm">Nama Belakang</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="last_name" value="{{$siswa->last_name}}" disabled/>
                      </div>
                    </div> 

                    <div class="row mb-3">
                      <label for="gender" class="col-sm-4 col-form-label col-form-label-sm">Jenis Kelamin</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="gender" value="{{$siswa->gender}}" disabled/>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="tempat_lahir" class="col-sm-4 col-form-label col-form-label-sm">Tempat Lahir</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="tempat_lahir" value="{{$siswa->tempat_lahir}}" disabled>
                      </div>
                    </div> 

                    <div class="row mb-3">
                      <label for="tanggal_lahir" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Lahir</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control form-control-sm" id="tanggal_lahir" value="{{$siswa->tanggal_lahir}}" disabled>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="address" class="col-sm-4 col-form-label col-form-label-sm">Alamat</label>
                      <div class="col-sm-8">
                        <textarea name="address" id="address" class="form-control form-control-sm"  rows="4" disabled>{{$siswa->address}}</textarea>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <i class="bi bi-telephone-forward"></i>&nbsp; Informasi Kontak
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                  <form>

                  <div class="row mb-3">
                    <label for="kelas" class="col-sm-4 col-form-label col-form-label-sm">Kelas</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="kelas" value="{{$siswa->kode_kelas}}" disabled>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="phone" class="col-sm-4 col-form-label col-form-label-sm">Nomor Telephone</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="phone" value="{{$siswa->phone}}" disabled/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-sm-4 col-form-label col-form-label-sm">Alamat Email</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control form-control-sm" id="email" value="{{$siswa->email}}" disabled/>
                    </div>
                  </div>

                  </form>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <i class="bi bi-person-hearts"></i>&nbsp; Orang Tua / Wali
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form>

                    <div class="row mb-3">
                      <label for="nama_wali" class="col-sm-4 col-form-label col-form-label-sm">Nama Orang Tua</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nama_wali" value="{{$student->nama_wali}}" disabled/>
                      </div>
                    </div>
  
                    <div class="row mb-3">
                      <label for="kontak_wali" class="col-sm-4 col-form-label col-form-label-sm">No. Hp Orang Tua</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="kontak_wali" value="{{$student->kontak_wali}}"  disabled/>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="pekerjaan_wali" class="col-sm-4 col-form-label col-form-label-sm">Pekerjaan Wali</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="pekerjaan_wali" value="{{$student->pekerjaan_wali}}" disabled/>
                      </div>
                    </div>

                    </form>
                </div>
              </div>
            </div>

          </div><!-- End Default Accordion Example -->

        </div>
      </div>

    </div>

    <div class="col-lg-4">
      <!-- Card with an image on top -->
      <div class="card" id="detail-siswa">
        <img src="{{asset('storage/photo-users').'/'.$siswa->photo}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-database"></i> {{$siswa->nip}}</h5>
            <p class="card-text">
                <i class="bi bi-person-badge"></i> {{$siswa->first_name. ' '.$siswa->last_name}}
            </p>
        </div>  
      </div><!-- End Card with an image on top -->
    </div>

  </div>
</main>

@endsection