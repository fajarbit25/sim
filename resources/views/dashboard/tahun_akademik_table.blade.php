<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tahun Ajaran</th>
            <th>Semester</th>
            <th>Status</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        @foreach($semester as $sm)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$sm->tahun_ajaran}}</td>
            <td>
                @if($sm->semester_kode == 1) Ganjil @endif
                @if($sm->semester_kode == 2) Genap @endif
            </td>
            <td>
                @if($sm->is_active == 'true')
                    <button class="btn btn-success btn-xs" title="is_active" 
                    onclick="setActive('{{$sm->idsm}}', '{{$sm->tahun_ajaran}}', '{{$sm->semester_kode}}')">
                        <i class="bi bi-check-circle"></i> Aktif
                    </button>
                @endif
                @if($sm->is_active == 'false')
                    <button class="btn btn-secondary btn-xs" title="is_active" 
                    onclick="setActive('{{$sm->idsm}}', '{{$sm->tahun_ajaran}}', '{{$sm->semester_kode}}')">
                        <i class="bi bi-exclamation-circle"></i> Tidak Aktif
                    </button>
                @endif
            </td>
            <td>
                <button class="btn btn-success btn-xs" title="Edit" onclick="editTA('{{$sm->idsm}}', '{{$sm->tahun_ajaran}}', '{{$sm->semester_kode}}')">
                    <i class="bi bi-pencil-square"></i>
                </button>
                @if($sm->is_active == 'false')
                <button class="btn btn-danger btn-xs" title="Delete"
                onclick="confirmDeleteSemester('{{$sm->idsm}}', '{{$sm->tahun_ajaran}}', '{{$sm->semester_kode}}')">
                    <i class="bi bi-trash3"></i>
                </button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>