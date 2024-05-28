
{{-- Form Upload Akta Lahir --}}
<form action="" id="formAktaLahir" enctype="multipart/form-data">
    @csrf
    <div class="mb-5">
        <label for="akta_lahir">Akta Lahir <span class="text-danger">*</span> </label>
        <div class="input-group">
            @if($doc->akta_lahir == NULL)
            <input type="file" class="form-control @error('akta_lahir') is-invalid @enderror" name="akta_lahir" id="akta_lahir" aria-describedby="akta_lahir" aria-label="Upload" required/>
            <button class="btn btn-outline-secondary" type="button" id="akta_lahir" onclick="upload_aktaLahir()"><i class="bi bi-upload"></i> Upload</button>
            @else
            <div class="form-control">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalAkta">
                    <strong> <i class="bi bi-filetype-pdf"></i> {{$doc->akta_lahir}} </strong>
                </a>
            </div>
            <button class="btn btn-outline-danger" onclick="delete_document('akta_lahir')" type="button"><i class="bi bi-trash"></i> Hapus</button>
            @endif
        </div>
        @error('akta_lahir')<div class="form-text text-danger fw-bold">{{$messege}}</div>@enderror
    </div>
</form>

{{-- Form Upload Kartu Keluarga --}}
<form action="" id="formKK" enctype="multipart/form-data">
    @csrf
    <div class="mb-5">
        <label for="kartu_keluarga">Kartu Keluarga <span class="text-danger">*</span> </label>
        <div class="input-group">
            @if($doc->kk == NULL)
            <input type="file" class="form-control @error('kartu_keluarga') is-invalid @enderror" name="kartu_keluarga" id="kartu_keluarga" aria-describedby="kartu_keluarga" aria-label="Upload" required/>
            <button class="btn btn-outline-secondary" type="button" onclick="uploadKK()" id="kartu_keluarga"><i class="bi bi-upload"></i> Upload</button>
            @else
            <div class="form-control">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalKK">
                    <strong> <i class="bi bi-filetype-pdf"></i> {{$doc->kk}} </strong>
                </a>
            </div>
            <button class="btn btn-outline-danger" onclick="delete_document('kk')" type="button"><i class="bi bi-trash"></i> Hapus</button>
            @endif
        </div>
        @error('kartu_keluarga')<div class="form-text text-danger fw-bold">{{$messege}}</div>@enderror
    </div>
</form>

{{-- Form Upload KTP Orang Tua --}}
<form action="" id="formKTP" enctype="multipart/form-data">
    @csrf
    <div class="mb-5">
        <label for="ktp_ortu">KTP Orang Tua <span class="text-danger">*</span> </label>
        <div class="input-group">
            @if($doc->ktp_ortu == NULL)
            <input type="file" class="form-control @error('ktp_ortu') is-invalid @enderror" name="ktp_ortu" id="ktp_ortu" aria-describedby="ktp_ortu" aria-label="Upload" required/>
            <button class="btn btn-outline-secondary" type="button" onclick="upload_ktp()" id="ktp_ortu"><i class="bi bi-upload"></i> Upload</button>
            @else
            <div class="form-control">
                <a href="#" data-bs-toggle="modal" data-bs-target="#ktpOrtu">
                    <strong> <i class="bi bi-filetype-pdf"></i> {{$doc->ktp_ortu}} </strong>
                </a>
            </div>
            <button class="btn btn-outline-danger" onclick="delete_document('ktp_ortu')" type="button"><i class="bi bi-trash"></i> Hapus</button>
            @endif
        </div>
        @error('ktp_ortu')<div class="form-text text-danger fw-bold">{{$messege}}</div>@enderror
    </div>
</form>

{{-- Form Upload Pas Foto --}}
<form action="" id="formFoto" enctype="multipart/form-data">
    @csrf
    <div class="mb-5">
        <label for="foto">Pas Foto Calon Peserta Didik <span class="text-danger">*</span> </label>
        <div class="input-group">
            @if($doc->foto == NULL)
            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto" aria-describedby="foto" aria-label="Upload" required/>
            <button class="btn btn-outline-secondary" type="button" onclick="uploadFoto()" id="foto"><i class="bi bi-upload"></i> Upload</button>
            @else
            <div class="form-control">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalFoto">
                    <strong> <i class="bi bi-filetype-pdf"></i> {{$doc->foto}} </strong>
                </a>
            </div>
            <button class="btn btn-outline-danger" onclick="delete_document('foto')" type="button"><i class="bi bi-trash"></i> Hapus</button>
            @endif
        </div>
        @error('foto')<div class="form-text text-danger fw-bold">{{$messege}}</div>@enderror
    </div>
</form>


{{-- Modal --}}
<!-- Modal Akta -->
<div class="modal fade" id="modalAkta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-filetype-pdf"></i> Akta Lahir</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <embed type="application/pdf" src="{{asset('storage/document/'.$doc->akta_lahir)}}" width="100%" height="700px"></embed>
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
          <embed type="application/pdf" src="{{asset('storage/document/'.$doc->kk)}}" width="100%" height="700px"></embed>
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
          <embed type="application/pdf" src="{{asset('storage/document/'.$doc->ktp_ortu)}}" width="100%" height="700px"></embed>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<!-- Pas Foto -->
<div class="modal fade" id="modalFoto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-filetype-pdf"></i> Pas Foto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img type="application/pdf" src="{{asset('storage/document/'.$doc->foto)}}" width="100%" height="auto"></img>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>