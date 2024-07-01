<table class="table table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Kode</th>
        <th scope="col">NPSN</th>
        <th scope="col">Nama Sekolah</th>
        <th scope="col">Tingkat</th>
        <th scope="col">Kontak</th>
        <th scope="col">Email</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($campus as $camp)  
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$camp->campus_initial}}</td>
        <td>{{$camp->npsn}}</td>
        <td>{{$camp->campus_name}}</td>
        <td>{{$camp->jenjang_pendidikan}}</td>
        <td>{{$camp->campus_contact}}</td>
        <td>{{$camp->email_campus}}</td>
        <td>
          @if($camp->idcampus == Auth::user()->campus_id)
            <a href="#" class="text-success" onclick="modalEdit({{$camp->idcampus}})"><i class="bi bi-pencil-square"></i></a>&nbsp;
          @endif
          @if(Auth::user()->level == 0)
            <a href="#" class="text-success" onclick="modalEdit({{$camp->idcampus}})"><i class="bi bi-pencil-square"></i></a>&nbsp;
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <!-- End small tables -->
