<div class="card">
    <div class="card-body">
        <h5 class="card-title">Nilai <span>Untuk angka decimal gunakan titik (.)</span></h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="bg-light">No</th>
                        <th class="bg-light">NIS</th>
                        <th class="bg-light">Nama</th>
                        <th class="bg-light">L/P</th>
                        <th class="bg-light">Nilai</th>
                        <th class="bg-light">Deskripsi</th>
                        <th class="bg-light">Lock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilai as $nli)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$nli->nisn}}</td>
                        <td>{{$nli->first_name.' '.$nli->last_name}}</td>
                        <td>{{substr($nli->gender, 0,1)}}</td>
                        <td style="width:100px;">
                            <input type="number" name="score" id="score-{{$nli->idscore}}" value="{{$nli->nilai}}" 
                            class="form-control form-control-sm" @if($nli->tag_lock == 'true') @disabled(true) @endif style="width:80px;">
                        </td>
                        <td>
                            {{-- <input type="text" class="form-control form-control-sm" 
                            id="desc-{{$nli->idscore}}" value="{{$nli->deskripsi}}" @if($nli->tag_lock == 'true') @disabled(true) @endif /> --}}
                            <textarea name="deskripsi" id="desc-{{$nli->idscore}}" class="form-control form-control-sm"  rows="1" @if($nli->tag_lock == 'true') @disabled(true) @endif>{{$nli->deskripsi}}</textarea>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" id="btn-lock-{{$nli->idscore}}" onclick="lockScore({{$nli->idscore}})" @if($nli->tag_lock == 'true') @disabled(true) @endif>
                                @if($nli->tag_lock == 'true')
                                <i class="bi bi-check2-square"></i>
                                @else
                                <i class="bi bi-lock"></i>
                                @endif
                            </button>
                            <button class="btn btn-warning btn-sm" onclick="unlock({{$nli->idscore}})" id="btn-unlock-{{$nli->idscore}}" @if($nli->tag_lock == 'false') @disabled(true) @endif>
                                @if($nli->tag_lock == 'true')
                                <i class="bi bi-unlock"></i>
                                @else
                                <i class="bi bi-unlock-fill"></i>
                                @endif
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-end">
        <a href="/dashboard" class="btn btn-secondary" id="btn-backNilai" ><i class="bi bi-arrow-left"></i> Back</a>
        <button class="btn btn-primary" id="btn-submitNilai" onclick="submitNilai()"><i class="bi bi-check2-square"></i> Submit</button>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn-submitNilai").hide();
    });
</script>