<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $rs)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>Kelas {{$rs->kelas_mapel}}</td>
            <td>{{$rs->kode_mapel.' - '.$rs->nama_mapel}}</td>
            <td>
                <button type="button" class="btn btn-danger btn-xs" id="btn-remove-{{$rs->idmg}}" onclick="removeMapel({{$rs->idmg}})"><i class="bi bi-trash3"></i></button>
                {{-- <button class="btn btn-danger btn-xs" type="button" id="btn-loading-remove" disabled>
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span class="visually-hidden" role="status">Loading...</span>
                </button> --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>