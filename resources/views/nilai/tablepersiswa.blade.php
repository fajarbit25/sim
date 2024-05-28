
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6">
            <li class="list-group-item"> <span class="fw-bold"> 
                <i class="bi bi-person-vcard"></i> Nama Lengkap :</span> {{$user->name}}
            </li>
            <li class="list-group-item"> <span class="fw-bold"> 
                <i class="bi bi-key-fill"></i> NISN : </span>{{$student->nisn}}
            </li>
            <li class="list-group-item"> <span class="fw-bold"> 
                <i class="bi bi-house"></i> Kelas : </span> {{$kelas->kode_kelas}}
            </li>
        </div>
        <div class="col-sm-6">
            <li class="list-group-item"> <span class="fw-bold"> 
                <i class="bi bi-calendar-week"></i> Tahun Ajaran :</span> {{$nilai->ta}}
            </li>
            <li class="list-group-item"> <span class="fw-bold"> 
                <i class="bi bi-clock-history"></i> Semester : </span>@if($nilai->semester == 1) Ganjil @else Genap @endif
            </li>
            <li class="list-group-item"> <span class="fw-bold"> 
                <i class="bi bi-building"></i> Sekolah : </span> {{$campus->campus_name}}
            </li>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode</th>
                <th>Mata Pelajaran</th>
                <th>Angka</th>
                <th>Predikat</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->kode}}</td>
                <td>{{$item->mapel}}</td>
                <td>
                    @if($item->nilai <= 60)
                    <span class="fw-bold text-danger">{{$item->nilai}}</span>
                    @else
                    <span class="fw-bold">{{$item->nilai}}</span>
                    @endif
                </td>
                <td>
                    @if($item->nilai >= 90 && $item->nilai <= 100) <span class="fw-bold text-success">A</span>
                    @elseif($item->nilai >= 80 && $item->nilai <= 89) <span class="fw-bold text-success">B</span>
                    @elseif($item->nilai >= 70 && $item->nilai <= 79) <span class="fw-bold text-success">C</span>
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
        <a href="{{url('/nilai/'.$nilai->ta.'/'.$nilai->semester.'/'.$nilai->kelas.'/'.$nilai->siswa_id.'/pdf')}}" class="btn btn-danger"><i class="bi bi-filetype-pdf"></i> Download PDF</a>
        <a href="#" class="btn btn-warning"><i class="bi bi-printer"></i> Print Laporan</a>
    </div>
</div>
