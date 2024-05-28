<!-- Table with stripped rows -->
<table class="table datatable" id="dataTable">
    <thead>
    <tr>
        <th scope="col">NIS</th>
        <th scope="col">Nama</th>
        <th scope="col">Add</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user as $usr)
        <tr>
            <th>{{$usr->nisn}}</th>
            <td>{{$usr->first_name}}</td>
            <td>
                <a href="#" onclick="addToKelas({{$usr->id}})" class="btn btn-success btn-xs"> <i class="bi bi-arrow-right"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<!-- End Table with stripped rows -->