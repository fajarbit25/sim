
    <!-- Table with stripped rows -->
    <table class="table datatable" id="tabel-data">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Level</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result as $level)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$level->kode_level}}</td>
            <td>{{$level->nama_level}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>