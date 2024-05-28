@if(count($result) == 0)
    <tr>
        <td colspan="5">
            <span class="fw-bolt fst-italic">Tidak ada data!</span>
        </td>
    </tr>
@else 
    @foreach($result as $r)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$r->jam}}</td>
            <td>{{$r->kode_kelas}}</td>
            <td>{{$r->kegiatan}}</td>
            <td>{{$r->first_name}}</td>
        </tr>
    @endforeach
@endif
<tr>
    <td colspan="5">
        {{$result->links()}}
    </td>
</tr>