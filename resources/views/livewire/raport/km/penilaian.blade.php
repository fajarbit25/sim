<div class="col-sm-12">
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"> Form Penilaian
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                    </h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="campus">
                                    <i class="bi bi-bank"></i>
                                </label>
                                <select class="form-select" id="campus" class="form-control" wire:model="campus">
                                  <option selected>Satuan Pendidikan...</option>
                                    @foreach($dataCampus as $item)
                                        <option value="{{$item->idcampus}}"> {{$item->campus_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="ta">
                                    <i class="bi bi-calendar3"></i>
                                </label>
                                <select class="form-select" id="ta" class="form-control" wire:model="ta">
                                  <option selected>Tahun Ajaran...</option>
                                    @if($dataTa)
                                        @foreach($dataTa as $item)
                                            <option value="{{$item->tahun_ajaran}}"> {{$item->tahun_ajaran}} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="semester">
                                    <i class="bi bi-calendar4-range"></i>
                                </label>
                                <select class="form-select" id="semester" class="form-control" wire:model="semester">
                                  <option selected>Semester...</option>
                                    @if($dataTa)
                                        <option value="1"> Ganjil </option>
                                        <option value="2"> Genap </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="kelas">
                                    <i class="bi bi-house-check-fill"></i>
                                </label>
                                <select class="form-select" id="kelas" class="form-control" wire:model="kelas">
                                  <option selected>Kelas...</option>
                                    @if($dataKelas)
                                        @foreach($dataKelas as $item)
                                        <option value="{{$item->idkelas}}"> {{$item->tingkat.' '.$item->kode_kelas}} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="mapel">
                                    <i class="bi bi-table"></i>
                                </label>
                                <select class="form-select" id="mapel" class="form-control" wire:model="mapel">
                                  <option selected>Mapel...</option>
                                  @if($dataMapel)
                                    @foreach($dataMapel as $item)
                                    <option value="{{$item->idmapel}}">{{$item->kode_mapel.' '.$item->nama_mapel}}</option>
                                    @endforeach
                                  @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="aspek">
                                    <i class="bi bi-table"></i>
                                </label>
                                <select class="form-select" id="aspek" class="form-control" wire:model="aspek">
                                  <option selected>Aspek...</option>
                                    <option value="Formatif">Formatif</option>
                                    <option value="Sumatif">Sumatif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary btn-sm" 
                            wire:loading.attr="disabled" wire:click="createNilai()"> Buat Form Penilaian
                                <span wire:loading>
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
        </div> <!--col/.-->

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Tabel Penilaian</h3>

                    @if (session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if(count($dataNilai) != 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="3" style="background-color: rgb(117, 161, 96);">No.</th>
                                        <th rowspan="3" style="background-color: rgb(117, 161, 96);"> Nama Siswa </th>
                                        <th rowspan="3" style="background-color: rgb(117, 161, 96);"> Panggilan </th>
                                        <th colspan="{{$dataKd->count()}}" style="background-color: rgb(117, 161, 96);"> Tujuan Pembelajaran </th>
                                        <th rowspan="3" style="background-color: rgb(117, 161, 96); white-space:nowrap;">Deskripsi Capaian Tertinggi</th>
                                        <th rowspan="3" style="background-color: rgb(117, 161, 96); white-space:nowrap;">Deskripsi Capaian Terendah</th>
                                    </tr>
                                    <tr>
                                        @foreach($dataKd as $item)
                                        <th style="background-color: rgb(117, 161, 96);">
                                            <a href="javascipt:void"> TP-{{$item->kode}} </a>
                                        </th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach($dataKd as $item)
                                        <th style="background-color: rgb(117, 161, 96);">KKTP</th>
                                        @endforeach
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($dataNilai->groupBy('idsiswa') as $idSiswa => $items)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$items->first()->first_name}} </td>
                                        <td>
                                            @if($items->first()->nick_names == null)
                                                <a href="javascript:void(0)" class="fw-bold"> 
                                                    <i class="bi bi-pencil"></i> Edit 
                                                </a>
                                            @else 
                                                {{$items->first()->nick_name}}
                                            @endif
                                        </td>

                                        {{-- @foreach($dataNilai->groupBy('idkd') as $nilaiKd => $kd)
                                        <td>
                                            <input type="checkbox" @if($kd->first()->nilai == 1) checked @endif>
                                            <input type="checkbox" wire:klick="lihatKd({{$kd->first()->id_nilai}}}})" @if($items->first()->tampil == 1) checked @endif>
                                            {{$kd->first()->first_name}}
                                        </td>
                                        @endforeach --}}
                                        @foreach($items as $item)
                                        <td>
                                            <input type="checkbox" @if($item->nilai == 1) checked @endif wire:click="updateNilai({{$item->id_nilai}})">
                                            <input type="checkbox" wire:click="lihatKd({{$item->id_nilai}})" @if($item->tampil == 1) checked @endif>
                                        </td>
                                        @endforeach

                                        <td style="font-size: 9px;">
                                            @php
                                                $totalDataZero = $dataKd->filter(function($lower) use ($idSiswa) {
                                                    return $lower->nilai == 0 && $lower->idsiswa == $idSiswa;
                                                })->count();  
                                            @endphp
                                            @if($totalDataZero != 0)
                                                {{$items->first()->nick_name}} menunjukkan pemahaman dalam <br/>
                                                @foreach($dataKd as $deskripsiKd)
                                                    @if($items->first()->tampil == 1)
                                                        -{{$deskripsiKd->deskripsi}} <br/>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td style="font-size: 9px;">
                                            @php
                                                $totalDataZero = $dataKd->filter(function($lower) {
                                                    return $lower->nilai == 0;
                                                })->count();
                                            @endphp
                                            @if($totalDataZero != 0)
                                                {{$items->first()->nick_name}} menunjukkan pemahaman dalam <br/>
                                                @foreach($dataKd as $deskripsiKd)
                                                    @if($items->first()->tampil == 1)
                                                        -{{$deskripsiKd->deskripsi}} <br/>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
