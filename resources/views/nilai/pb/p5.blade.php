<div class="col-sm-12">
    <div class="row">
        @if($countP5 == 0)
        <div class="col-sm-12">
            <div class="input-group">
                <input type="file" class="form-control" id="inputGroupFileP5" aria-describedby="inputGroupFileAddonP5" aria-label="Upload">
                <button class="btn btn-danger" type="button" id="inputGroupFileAddonP5" onclick="uploadP5()">
                    <i class="bi bi-upload"></i> Upload
                </button>
            </div>
        </div>
        @else 
        <div class="col-sm-12">
            <object data="{{asset('storage/pb/'.$p5->file)}}" width="800" height="800"></object>
        </div>
        <div class="col-sm-12 my-3 text-end">
            <button type="button" class="btn btn-danger" onclick="confirmDeletePb('{{$p5->id}}', 'p5')">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </div>
        @endif
    </div>
</div>