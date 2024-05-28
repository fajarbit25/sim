@foreach($result as $item)
<div class="col-sm-4">
    <div class="alert text-light border-0 alert-dismissible fade show" role="alert" style="background-color: {{$item->color}};">
      <a href="javascript:void(0)" class="text-light" onclick="modalUpdateKeterangan('{{$item->id}}', '{{$item->tag_name}}', '{{$item->color}}')"><i class="bi bi-pencil-square"></i></a>
      {{$item->tag_name}}
      <button type="button" class="btn-close btn-close-white" onclick="deleteKeterangan({{$item->id}})"></button>
    </div>
</div>
@endforeach