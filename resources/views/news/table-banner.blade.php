<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama File</th>
            <th>Updated By</th>
            <th>Keterangan</th>
            <th>Tanggal Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($banner as $bnr)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$bnr->foto}}</td>
            <td>{{$bnr->first_name}}</td>
            <td>{{$bnr->keterangan}}</td>
            <td>{{$bnr->updated_at}}</td>
            <td>
                <button type="button" onclick="deleteModal({{$bnr->idbanner}})" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>