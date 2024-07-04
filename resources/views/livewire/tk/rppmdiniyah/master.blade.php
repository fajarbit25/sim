<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Database RPPM Diniyah</h3>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Materi</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th colspan="2">Materi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dataMateri as $item)
                                                @if($item->id == $isActive)
                                                <tr>
                                                    <th> {{$loop->iteration}} </th>
                                                    <th> {{$item->materi}} </th>
                                                    <th>
                                                        <a href="javascript:void(0)" class="fw-bold" wire:click="selectedMateri({{$item->id}})">
                                                            <i class="bi bi-chevron-compact-right"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td> {{$loop->iteration}} </td>
                                                    <td> {{$item->materi}} </td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="fw-bold" wire:click="selectedMateri({{$item->id}})">
                                                            <i class="bi bi-chevron-compact-right"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Materi</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Materi</th>
                                                    <th>Kegiatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($isActive != 0)
                                                @foreach($dataKegiatan as $item)
                                                <tr>
                                                    <td> {{$loop->iteration}} </td>
                                                    <td> {{$item->materi}} </td>
                                                    <td> {{$item->kegiatan}} </td>
                                                </tr>
                                                @endforeach
                                                @else 
                                                <tr>
                                                    <td colspan="3"> Pilih salah satu materi disamping! </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
