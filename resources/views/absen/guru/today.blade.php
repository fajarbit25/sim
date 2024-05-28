<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
          <tr>
            <th scope="col">Preview</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama</th>
            <th scope="col">Jabatan</th>
            <th scope="col">Jam Masuk</th>
            <th scope="col">Keterangan</th>
          </tr>
        </thead>
        <tbody>
            @foreach($result as $item)
          <tr>
            <th scope="row"><a href="#"><img src="{{$item->photo}}" alt="" style="max-width: 50px;"></a></th>
            <td><a href="javascript:void(0)" class="text-primary fw-bold">{{$item->nip}}</a></td>
            <td>{{$item->name}}</td>
            <td>
                @if($item->level == 0) Staff Administrasi @endif
                @if($item->level == 1) Staff Administrasi @endif
                @if($item->level == 2) Guru PTK @endif
                @if($item->level == 5) Staff Bendahara @endif
            </td>
            <td class="fw-bold">{{$item->jam_masuk}}</td>
            <td>
                @if($item->jam_masuk >= '07:30') <span class="fw-bold text-success">On Time<span> @endif
                @if($item->jam_masuk <= '07:30') <span class="fw-bold text-warning">To Late<span> @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>