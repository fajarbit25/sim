@foreach($absen as $ab)
<tr>
    <td>{{$loop->iteration}}</td>
    <td class="fw-bold">{{$ab->nisn}}</td>
    <td>{{$ab->first_name}}</td>
    <td>{{$ab->gender}}</td>
    <td>
        @if($ab->absensi == 'Hadir')
            <span class="badge bg-success">{{$ab->absensi}}</span>
        @elseif($ab->absensi == 'Sakit')
            <span class="badge bg-warning">{{$ab->absensi}}</span>
        @elseif($ab->absensi == 'Alfa')
            <span class="badge bg-danger">{{$ab->absensi}}</span>
        @elseif($ab->absensi == 'Izin')
            <span class="badge bg-info">{{$ab->absensi}}</span>
        @else
            <span class="badge bg-success">Hadir</span>
        @endif
    </td>
    <td>
        <button type="button" class="btn btn-primary btn-xs" onclick="modalAbsen('{{$ab->mapel}}', '{{$ab->idabsen}}')">
            <i class="bi bi-arrow-repeat"></i> Ubah
        </button>
    </td>
</tr>
@endforeach