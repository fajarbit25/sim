<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Prestasi</th>
            <th>Jenis</th>
            <th>Tingkat</th>
            <th>Tahun</th>
            <th>Penyelenggara</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prestasi as $pres)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$pres->nama_prestasi}}</td>
            <td>{{$pres->jenis}}</td>
            <td>{{$pres->tingkat}}</td>
            <td>{{$pres->tahun}}</td>
            <td>{{$pres->penyelenggara}}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deletePrestasi({{$pres->idprestasi}})"><i class="bi bi-trash"></i> Hapus</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>