<div class="card">
    <div class="card-body">
        <h5 class="card-title">List Absensi</h5>

        <ol class="list-group list-group-numbered">
            @foreach($result as $item)
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">{{$item->kode_mapel}}  | {{$item->first_name}}</div>
                {{$item->nama_mapel}}
              </div>
              <button class="btn btn-success btn-sm btn-search" onclick="showAbsen({{$item->mapel}})" id="btn-cari-{{$item->mapel}}"><i class="bi bi-search"></i></button>
            </li>
            @endforeach
        </ol>

    </div>
</div>