<div class="col-sm-12">
    <div class="row">
        @if($countProsem == 0)
        <div class="col-sm-12">
            <div class="input-group">
                <input type="file" class="form-control" id="inputGroupFileProsem" aria-describedby="inputGroupFileAddonProsem" aria-label="Upload">
                <button class="btn btn-danger" type="button" id="inputGroupFileAddonProsem" onclick="uploadProsem()">
                    <i class="bi bi-upload"></i> Upload
                </button>
            </div>
        </div>
        @else 
        <div class="col-sm-12">
            <img src="{{asset('storage/pb/'.$prosem->file)}}" alt="Img..." style="width: 100%;"/>            
        </div>
        <div class="col-sm-12 my-3 text-end">
            <button type="button" class="btn btn-danger" onclick="confirmDeletePb('{{$prosem->id}}', 'Prosem')">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </div>
        @endif
    </div>
</div>