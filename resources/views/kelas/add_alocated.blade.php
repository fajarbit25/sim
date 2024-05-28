<!-- Table with stripped rows -->
<table class="table datatable" id="dataTable">
    <thead>
    <tr>
        <th scope="col">Return</th>
        <th scope="col">NIS</th>
        <th scope="col">Nama</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user as $usr)
        <tr>
            <td>
                <a href="#" onclick="returnKelas({{$usr->id}})" class="btn btn-secondary btn-xs"> <i class="bi bi-arrow-left"></i> </a>
            </td>
            <th>{{$usr->nisn}}</th>
            <td>{{$usr->first_name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<!-- End Table with stripped rows -->