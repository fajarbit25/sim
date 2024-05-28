<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Jenis</th>
            <th>Nomor Kartu</th>
            <th>Nama</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kesejahteraan as $kes)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$kes->jenis}}</td>
            <td>{{$kes->nomor_kartu}}</td>
            <td>{{$kes->nama}}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteKes({{$kes->idks}})"><i class="bi bi-trash"></i> Hapus</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>