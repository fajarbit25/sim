@if($count != 0)
  <div class="col-sm-12">
    <img src="{{asset('storage/tk/kaldik/'.$item->files)}}" alt="Files" style="width: 100%;"/>
  </div>
  <div class="col-sm-12 text-end">
    <button type="button" class="btn btn-primary btn-sm" id="btnRefreshKaldikTK" onclick="resfreshKaldikTK()"><i class="bi bi-arrow-repeat"></i> Refresh</button>
    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteKaldikTK({{$item->id}})"><i class="bi bi-trash"></i> Delete</button>
  </div>
@else 
  <div class="col-sm-5">
    <input type="file" name="files" id="files" class="form-control mb-3" >
  </div>
  <div class="col-sm-5">
    <input type="text" name="file_name" id="file_name" class="form-control mb-3" placeholder="Nama File">
  </div>
  <div class="col-sm-2 text-end">
    <button type="button" class="btn btn-danger w-100 btn-sm" id="btnUploadKaldikTK" onclick="uploadKaldikTK()"><i class="bi bi-upload"></i> Upload</button>
  </div>
@endif