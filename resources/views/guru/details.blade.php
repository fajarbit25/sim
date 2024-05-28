<h5 class="card-title">
    <i class="bi bi-database"></i> {{$teacher->nip}}<br/>
    <i class="bi bi-person-badge"></i> {{$guru->first_name.' '.$guru->last_name}}
</h5>


<div class="row">
    <div class="col-lg-3 col-md-4 label ">Jabatan</div>
    <div class="col-lg-9 col-md-8">: {{$guru->kode_level.' | '.$guru->nama_level}}</div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
    <div class="col-lg-9 col-md-8">: {{$teacher->jenis_kelamin}} </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 label">NIK/KITAS</div>
    <div class="col-lg-9 col-md-8">: {{$teacher->nik}} </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 label">Tempat & Tanggal Lahir</div>
    <div class="col-lg-9 col-md-8">: {{$teacher->tempat_lahir.', '.$teacher->tanggal_lahir}}</div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 label">Ibu Kandung</div>
    <div class="col-lg-9 col-md-8">: {{$teacher->ibu_kandung}}</div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 label">Email</div>
    <div class="col-lg-9 col-md-8">: {{$guru->email}}</div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-4 label">Phone</div>
    <div class="col-lg-9 col-md-8">: {{$guru->phone}}</div>
</div>