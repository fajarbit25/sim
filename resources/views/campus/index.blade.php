@extends('template/layout')
@section('main')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>SIMS</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item">{{$title}}</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->

  <div class="row">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Kampus <span>Yayasan Ibnul Qayyim Makassar</span></h5>
          <div class="row">
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <button class="btn btn-outline-success" type="button"  data-bs-toggle="modal" data-bs-target="#addCampus"><i class="bi bi-plus-lg"></i> New</button>
                <input type="text" class="form-control" placeholder="Search..." onkeyup="search()" id="key" aria-label="Example text with button addon" aria-describedby="button-addon1">
              </div>              
            </div>
          </div>
          <div class="tabel-responsive" id="tableCampus"></div>
        </div>
      </div>
  </div>
</main>


<!-- Modal Create -->
<div class="modal fade" id="addCampus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="{{url('/campus')}}">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus-lg"></i> Kampus Baru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="campus_initial">Kode Kampus <span class="text-danger">*</span></label>
            <input type="text" name="campus_initial" id="campus_initial" value="{{old('campus_initial')}}" class="form-control @error('campus_initial') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="campus_name">Nama Kampus <span class="text-danger">*</span></label>
            <input type="text" name="campus_name" id="campus_name" value="{{old('campus_name')}}" class="form-control @error('campus_name') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="campus_tingkat">Jenjang <span class="text-danger">*</span></label>
            <select name="campus_tingkat" id="campus_tingkat" class="form-control @error('campus_tingkat') is-invalid @enderror" required>
                <option value="1">TK</option>
                <option value="2">SD</option>
                <option value="3">SMP</option>
                <option value="4">SMA/SMK</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="campus_kepsek">Kepala Sekolah <span class="text-danger">*</span></label>
            <input type="text" name="campus_kepsek" id="campus_kepsek" value="{{old('campus_kepsek')}}" class="form-control @error('campus_kepsek') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="campus_contact">Kontak <span class="text-danger">*</span></label>
            <input type="text" name="campus_contact" id="campus_contact" value="{{old('campus_kepsek')}}" class="form-control @error('campus_contact') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="email_campus">Email <span class="text-danger">*</span></label>
            <input type="text" name="email_campus" id="email_campus" value="{{old('email_campus')}}" class="form-control @error('email_campus') is-invalid @enderror" required autocomplete="off">
          </div>

          <div class="form-group mb-3 row">
            <label>Social Media</label>
            
            <div class="col-sm-6 mb-3">
              <div class="input-group">
                <div class="input-group-text"><i class="bi bi-youtube"></i></div>
                <input type="text" class="form-control" id="yt" name="yt" placeholder="www.youtube.com/username..">
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <div class="input-group">
                <div class="input-group-text"><i class="bi bi-facebook"></i></div>
                <input type="text" class="form-control" id="fb" name="fb" placeholder="www.facebook.com/username..">
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <div class="input-group">
                <div class="input-group-text"><i class="bi bi-instagram"></i></div>
                <input type="text" class="form-control" id="ig" name="ig" placeholder="www.instagram.com/username..">
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <div class="input-group">
                <div class="input-group-text"><i class="bi bi-telegram"></i></div>
                <input type="text" class="form-control" id="tele" name="tele" placeholder="t.me/username..">
              </div>
            </div>
          
          </div>
          <div class="form-group mb-3">
            <label for="campus_alamat">Alamat <span class="text-danger">*</span></label>
            <textarea name="campus_alamat" id="campus_alamat" class="form-control @error('campus_alamat') is-invalid @enderror" rows="4" required>{{old('campus_alamat')}}</textarea>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editCampus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pencil"></i> Edit Kampus</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="campus_initial_edit">Kode Kampus <span class="text-danger">*</span></label>
            <input type="text" name="campus_initial_edit" id="campus_initial_edit" class="form-control @error('campus_initial_edit') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="campus_name_edit">Nama Kampus <span class="text-danger">*</span></label>
            <input type="text" name="campus_name_edit" id="campus_name_edit" class="form-control @error('campus_name_edit') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="campus_tingkat_edit">Jenjang <span class="text-danger">*</span></label>
            <select name="campus_tingkat_edit" id="campus_tingkat_edit" class="form-control @error('campus_tingkat_edit') is-invalid @enderror" required>
               @foreach ($jenjang as $jj)                   
                <option value="{{$jj->idjenjang}}">{{$jj->jenjang_pendidikan}}</option>
               @endforeach
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="campus_kepsek_edit">Kepala Sekolah <span class="text-danger">*</span></label>
            <input type="text" name="campus_kepsek_edit" id="campus_kepsek_edit" class="form-control @error('campus_kepsek_edit') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="niy_kepsek_edit">NIY Kepala Sekolah <span class="text-danger">*</span></label>
            <input type="text" name="niy_kepsek_edit" id="niy_kepsek_edit" class="form-control @error('niy_kepsek_edit') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="campus_contact_edit">Kontak <span class="text-danger">*</span></label>
            <input type="text" name="campus_contact_edit" id="campus_contact_edit" class="form-control @error('campus_contact_edit') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="email_campus_edit">Email <span class="text-danger">*</span></label>
            <input type="text" name="email_campus_edit" id="email_campus_edit"  class="form-control @error('email_campus_edit') is-invalid @enderror" required autocomplete="off">
          </div>
          <div class="form-group mb-3 row">
            <label>Social Media</label>
            
            <div class="col-sm-6 mb-3">
              <div class="input-group">
                <div class="input-group-text"><i class="bi bi-youtube"></i></div>
                <input type="text" class="form-control" id="ytEdit" name="ytEdit" placeholder="www.youtube.com/username..">
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <div class="input-group">
                <div class="input-group-text"><i class="bi bi-facebook"></i></div>
                <input type="text" class="form-control" id="fbEdit" name="fbEdit" placeholder="www.facebook.com/username..">
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <div class="input-group">
                <div class="input-group-text"><i class="bi bi-instagram"></i></div>
                <input type="text" class="form-control" id="igEdit" name="igEdit" placeholder="www.instagram.com/username..">
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <div class="input-group">
                <div class="input-group-text"><i class="bi bi-telegram"></i></div>
                <input type="text" class="form-control" id="teleEdit" name="teleEdit" placeholder="t.me/username..">
              </div>
            </div>
          
          </div>
          <div class="form-group mb-3">
            <label for="campus_alamat_edit">Alamat <span class="text-danger">*</span></label>
            <textarea name="campus_alamat_edit" id="campus_alamat_edit" class="form-control @error('campus_alamat_edit') is-invalid @enderror" rows="4" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="idcampus" id="idcampus" required/>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="updateCampus()" class="btn btn-success">Update </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="{{url('Admin/assets/js/campus.js')}}"></script>
@endsection