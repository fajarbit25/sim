<table class="table table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Jenis</th>
        <th scope="col">Kode</th>
        @if(Auth::user()->campus_id == 2)
        <th scope="col">Sentra</th>
        @else 
        <th scope="col">Mata Pelajaran</th>
        @endif
        <th scope="col">KKM</th>
        <th scope="col">Manage</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($mapel as $mp) 
        @if($mp->mapel_campus == Auth::user()->campus_id)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$mp->jenis}}</td>
          <td>{{$mp->kode_mapel}}</td>
          <td>{{$mp->nama_mapel}}</td>
          <td>{{$mp->kkm}}</td>
          <td>
            <a href="#" class="text-success" onclick="modalUpdate({{$mp->idmapel}})"><i class="bi bi-pencil-square"></i></a>&nbsp;
            <a href="#" class="text-danger" onclick="modalDelete({{$mp->idmapel}})"><i class="bi bi-trash"></i></a>
          </td>
        </tr>
        @endif
      @endforeach
    </tbody>
  </table>
  {{ $mapel->links() }}
  <!-- End small tables -->
