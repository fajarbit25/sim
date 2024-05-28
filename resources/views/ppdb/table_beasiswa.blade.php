<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Jenis</th>
            <th>Tahun Mulai</th>
            <th>Tahun Selesai</th>
            <th>Keterangan</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        @foreach($beasiswa as $bea)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$bea->jenis}}</td>
            <td>{{$bea->tahun_mulai}}</td>
            <td>{{$bea->tahun_selesai}}</td>
            <td>{{$bea->keterangan}}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteBeasiswa({{$bea->idss}})"><i class="bi bi-trash"></i> Hapus</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>