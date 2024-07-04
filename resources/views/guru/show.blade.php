@extends('template.layout')
@section('main')
<main id="main" class="main">
  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">
        <div class="card" id="load-foto">
        </div>
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
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
              @if(Auth::user()->level ==1)
              <li class="nav-item">
                @if(Auth::user()->campus_id == 2)
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-mapel">Sentra</button>
                @else 
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-mapel">Mata Pelajaran</button>
                @endif
              </li>
              @endif
            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form method="" action="" enctype="multipart/form-data" id="photoForm">
                  @csrf
                  <input type="hidden" name="id" id="idusers" value="{{$guru->id}}"/>
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="input-group">
                        <input type="file" name="photo" class="form-control" id="photo" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeImage()" id="btn-upload "><i class="bi bi-upload"></i></button>
                        <button type="button" class="btn btn-secondary" id="btn-loading">Loading <i class="bi bi-three-dots"></i></button>
                      </div>
                    </div>
                  </div>
                </form>
                <form>


                  <div class="row mb-3">
                    <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="first_name" type="text" class="form-control" id="first_name" required autocomplete="off">
                    </div>
                  </div>



                  <div class="row mb-3">
                    <label for="level" class="col-md-4 col-lg-3 col-form-label">Level</label>
                    <div class="col-md-8 col-lg-9">
                      <select name="level" id="level" class="form-control">
                        @foreach($level as $lvl)
                        <option value="{{$lvl->idlevel}}"> {{$lvl->idlevel.'. '.$lvl->kode_level}} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="text" class="form-control" id="email" required autocomplete="off">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="phone" required autocomplete="off">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="button" id="btn-edit" onclick="saveEdit()" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" id="btn-loadEdit">Loading <i class="bi bi-three-dots"></i></button>
                  </div>
                  
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-mapel">

               <button class="btn btn-primary" id="btn-mapel"><i class="bi bi-plus-lg"></i> Tambahkan</button>
               <div class="table-responsive my-3" id="tableMapel">
               </div>

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>



    </div>
  </section>
</main>

<!-- Modal Tabel Mapel -->
<div class="modal fade" id="modalMapel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mata Pelajaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <select name="mapel" id="mapel" class="form-control">
            <optgroup label="Pilih Mata Pelajaran">
              @foreach($mapel as $mp)
              <option value="{{$mp->idmapel}}"> {{$mp->kode_mapel.' | '.$mp->nama_mapel}} </option>
              @endforeach
            </optgroup>
          </select>
          <select name="kelas" id="kelas" class="form-control">
            <optgroup label="Pilih Kelas">
              @foreach($kelas->groupBy('tingkat') as $tingkat => $item)
              <option value="{{$tingkat}}">Kelas {{$tingkat}}</option>
              @endforeach
            </optgroup>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-submit-mapel" onclick="addMapel()"><i class="bi bi-plus-lg"></i> Tambahkan</button>
        <button class="btn btn-primary" type="button" id="btn-loading-mapel" disabled>
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Loading...</span>
      </button>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('Admin/assets/js/guru.js')}}"></script>
<script>
  $(document).ready(function(){
    ladFormEdit()
  });
</script>
@endsection