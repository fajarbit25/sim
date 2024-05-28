
@foreach($result as $item)

    <tr>
        <td>
            <i class="bi bi-flower2"></i>
        </td>
        <td>{{$item->keterangan}}</td>
        <td>
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <div class="filter">
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li><a class="dropdown-item" href="javascript:void(0)" onclick="subTema({{$item->id}})"><i class="bi bi-arrow-return-right"></i> Sub Tema</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)" onclick="deleteKeterangan({{$item->id}})"><i class="bi bi-x-lg"></i> Remove</a></li>
                </ul>
            </div>
        </td>
    </tr>
    @if($item->tab_submenu == 1)
        @foreach($sub as $subitem)
            @if($item->id ==  $subitem->id_daily_report)
                <tr>
                    <td></td>
                    <td colspan="2"> <i class="bi bi-dot"></i> {{$subitem->subketerangan}} </td>
                    <td>
                        <a href="javascript:void(0)" class="fw-bold text-danger"  onclick="deleteSubTema({{$subitem->subid}})"> &times; </a>
                    </td>
                </tr>
            @endif
        @endforeach
        <tr>
            <td></td>
            <td colspan="2">
                <div class="input-group" id="formSubTema">
                    <input type="text" class="form-control form-control-sm" id="inputSubTema-{{$item->id}}" placeholder="Sub Tema">
                    <button class="btn btn-primary btn-sm" id="btnAddSubTema-{{$item->id}}" onclick="addSubTema({{$item->id}})" type="button">
                        <i class="bi bi-check-circle-fill"></i> Simpan
                    </button>
                </div>
            </td>
        </tr>
    @endif

@endforeach
