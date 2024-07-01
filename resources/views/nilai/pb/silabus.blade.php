<div class="col-sm-12">
    <div class="row">
        @if($countSilabus == 0)
        <div class="col-sm-12">
            <div class="input-group">
                <input type="file" class="form-control" id="inputGroupFileSilabus" aria-describedby="inputGroupFileAddonSilabus" aria-label="Upload">
                <button class="btn btn-danger" type="button" id="inputGroupFileAddonSilabus" onclick="uploadSilabus()">
                    <i class="bi bi-upload"></i> Upload
                </button>
            </div>
        </div>
        @else 
        <div class="col-sm-12">
            <object data="{{asset('storage/pb/'.$silabus->file)}}" width="800" height="800"></object>
        </div>
        <div class="col-sm-12 my-3 text-end">
            <button type="button" class="btn btn-danger" onclick="confirmDeletePb('{{$silabus->id}}', 'Silabus')">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </div>
        @endif
    </div>
</div>