@if($count != 0)
<ul class="list-group list-group-flush mb-3">
    <li class="list-group-item"> <span class="fw-bold"> <i class="bi bi-house"></i> Kelas :</span> {{$nilai->kode_kelas}}</li>
    <li class="list-group-item"> <span class="fw-bold"> <i class="bi bi-book-half"></i> Mata Pelajaran : </span>{{$nilai->kode_mapel.' - '.$nilai->nama_mapel}}</li>
    <li class="list-group-item"> <span class="fw-bold"> <i class="bi bi-clock-history"></i> Semester :  </span>@if($nilai->semester == 1) Ganjil @else Genap @endif</li>
    <li class="list-group-item"> <span class="fw-bold"> <i class="bi bi-calendar-week"></i> Tahun Ajaran : </span>{{$nilai->ta}}</li>
</ul>
<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>NISN</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Nilai</th>
            <th>Predikat</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->nisn}}</td>
            <td>{{$item->first_name}}</td>
            <td>{{$item->gender}}</td>
            <td>
                @if($item->nilai <= 65)
                <span class="fw-bold text-danger">{{$item->nilai}}</span>
                @else
                <span class="fw-bold">{{$item->nilai}}</span>
                @endif
            </td>
            <td>
                @if($item->nilai >= 90 && $item->nilai <= 100) <span class="fw-bold text-success">A</span>
                @elseif($item->nilai >= 80 && $item->nilai <= 89) <span class="fw-bold text-success">B</span>
                @elseif($item->nilai >= 70 && $item->nilai <= 79) <span class="fw-bold text-info">C</span>
                @elseif($item->nilai >= 60 && $item->nilai <= 69) <span class="fw-bold text-warning">D</span>
                @else<span class="fw-bold text-danger">E</span>@endif
            </td>
            <td>
                {{$item->deskripsi}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table> 
<div class="col-sm-12 text-end">
    <button class="btn btn-primary"><i class="bi bi-file-earmark-spreadsheet"></i> Export Excel</button>
    <a href="{{url('/nilai_per_kelas/'.$nilai->ta.'/'.$nilai->semester.'/'.$nilai->mapel.'/'.$nilai->kelas)}}" class="btn btn-danger"><i class="bi bi-filetype-pdf"></i> Download PDF</a>
    <a href="#" class="btn btn-warning"><i class="bi bi-printer"></i> Print Laporan</a>
</div>
@else
  <span class="fw-bold fst-italic"><i class="bi bi-exclamation-triangle"></i> Data tidak ditemukan!</span>
@endif