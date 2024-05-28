<div class="card">
    <div class="card-body">
      <h5 class="card-title">Laporan Absensi <br/>
         Mata Pelajaran <span> {{$mapel_head->nama_mapel}} </span> </h5>
      <form method="GET" action="/absen/pdf">
        @csrf
        <input type="hidden" name="rkelas" id="rkelas" value="{{$kelas}}" required/>
        <input type="hidden" name="rmapel" id="rmapel" value="{{$mapel}}" required/>
        <input type="hidden" name="rcampus" id="rcampus" value="{{$campus}}" required/>
        <input type="hidden" name="rtanggal" id="rtanggal" value="{{$tanggal}}" required/>

        <div class="btn-group" role="group" aria-label="Basic outlined example">
          <a href="/absen/excel/{{$kelas}}/{{$mapel}}/{{$tanggal}}" class="btn btn-outline-success btn-sm">
            <i class="bi bi-file-earmark-excel"></i> Excel
          </a>
          <button type="submit" class="btn btn-outline-success btn-sm">
            <i class="bi bi-printer"></i> Print
          </button>
        </div>
      </form> 
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">NIS</th>
              <th scope="col">Nama</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">Absensi</th>
            </tr>
          </thead>
          <tbody>

            @foreach($result as $rs)
            <tr>
              <td> {{$loop->iteration}} </td>
              <th scope="row"><a href="/acc_siswa/{{$rs->id}}/show"> {{$rs->nisn}} </a></th>
              <td> {{$rs->first_name.' '.$rs->last_name}} </td>
              <td> {{$rs->gender}} </td>
              <td>
                @if($rs->absensi == 'Hadir') <span class="badge bg-success">{{$rs->absensi}}</span>
                @elseif($rs->absensi == 'Sakit') <span class="badge bg-warning">{{$rs->absensi}}</span>
                @elseif($rs->absensi == 'Alfa') <span class="badge bg-danger">{{$rs->absensi}}</span>
                @elseif($rs->absensi == 'Izin') <span class="badge bg-danger">{{$rs->absensi}}</span>
                @else <span class="badge bg-primary">{{$rs->absensi}}</span> @endif
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>

    </div>
  </div>