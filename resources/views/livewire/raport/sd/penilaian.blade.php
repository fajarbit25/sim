<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Form Penilaian</h3>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="ta">Tahun Ajaran</label>
                                <input type="text" class="form-control" disabled wire:model="ta"/>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input type="text" class="form-control" value="@if($semester == 1) Ganjil @elseif($semester == 2) Genap @endif" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control" wire:model="kelas" @if(count($dataKelas) == 0) disabled @endif>
                                    @if(count($dataKelas) != 0)
                                    <option value="0">Pilih Kelas--</option>
                                    @foreach($dataKelas as $item)
                                    <option value="{{$item->idkelas}}">Kelas {{$item->tingkat. ' '.$item->kode_kelas}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran</label>
                                <select class="form-control" wire:model="mapel" @if(count($dataMapel) == 0) disabled @endif>
                                    @if(count($dataMapel) != 0)
                                    <option value="0">Pilih Mapel--</option>
                                    @foreach($dataMapel as $item)
                                    <option value="{{$item->mapel_id}}">{{$item->kode_mapel. ' - '.$item->nama_mapel}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="aspek">Aspek Penilaian</label>
                                <select name="aspek" id="aspek" class="form-control" wire:model="aspek" @if(count($dataMapel) == 0) disabled @endif>
                                    <option value="0">-Pilih Aspek Penilaian--</option>
                                    <option value="Pengetahuan">Pengetahuan</option>
                                    <option value="Keterampilan">Keterampilan</option>
                                </select>
                            </div>
                        </div>
                        @if(count($dataNilai) == 0)
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary btn-sm" wire:loading.attr="disabled" wire:click="createFormNilai()">
                                <span wire:loading> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> </span> 
                                <span wire:loading.remove><i class="bi bi-plus"></i></span>
                                Buat Form Penilaian
                            </button>
                            <br/>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div><!--/.col-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Daftar Nilai SDIT Ibnul Qayyim Makassar</h3>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIS/NISN</th>
                                    <th>Nama</th>
                                    <th style="white-space: nowrap;">Nama Panggilan</th>
                                    @foreach ($dataKd as $item)
                                        <th>{{$item->kode}}</th>
                                    @endforeach
                                    <th>HPA</th>
                                    <th>Predikat</th>
                                    <th>Max</th>
                                    <th>Min</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataNilai->groupBy('first_name') as $namaSiswa => $items)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$items->first()->nis}} </td>
                                    <td style="white-space: nowrap;"> {{$namaSiswa}} </td>
                                    <td> {{$items->first()->nick_name}} </td>

                                    @foreach($items as $item)
                                    <td>
                                        <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                           {{$item->nilai}}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <div class="col-sm-12" style="padding-left: 10px; padding-right:10px; max-width:200px;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('nilai') is-invalid @endif" aria-describedby="button-addon2" wire:model.lazy="nilai">
                                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" wire:loading.attr="disabled" wire:click="updateNilaiKd({{$item->id_nilai}})">
                                                        <i class="bi bi-check"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </ul>
                                    </td>
                                    @endforeach
                                    <th class="bg-light">
                                        <span class="@if($items->avg('nilai') <= $kkm) text-danger @endif"> 
                                            {{ $items->avg('nilai') }}
                                        </span>
                                    </th>
                                    <th class="bg-light">
                                        @foreach($dataPredikat as $predikat)
                                            @if($predikat->nilai_min <= $items->avg('nilai') && $predikat->nilai_max >= $items->avg('nilai'))
                                                {{$predikat->deskripsi}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="bg-light">{{ $items->max('nilai') }}</td>
                                    <td class="bg-light">{{ $items->min('nilai') }}</td>
                                    <td>
                                        <span>Ananda </span>

                                        <span>{{$items->first()->nick_name}} </span>

                                        @foreach($dataCapaian as $capaian)
                                        @if($capaian->nilai_min <= $items->max('nilai') && $capaian->nilai_max >= $items->max('nilai'))
                                        <span class="fw-bold"> {{$capaian->deskripsi}} </span>
                                        @endif
                                        @endforeach

                                        <span>dalam </span>

                                        @foreach ($dataKd as $kd)
                                            @if($kd->id == $items->where('nilai', $items->max('nilai'))->first()->idkd)
                                            <span class="fw-bold">{{$kd->deskripsi}}, </span>
                                            @endif
                                        @endforeach

                                        <span>dan </span>
                                        
                                        @foreach($dataCapaian as $capaian)
                                        @if($capaian->nilai_min <= $items->min('nilai') && $capaian->nilai_max >= $items->min('nilai'))
                                        <span class="fw-bold"> {{$capaian->deskripsi}} </span>
                                        @endif
                                        @endforeach

                                        <span>dalam </span>

                                        @foreach ($dataKd as $kd)
                                            @if($kd->id == $items->where('nilai', $items->min('nilai'))->first()->idkd)
                                            <span class="fw-bold">{{$kd->deskripsi}}, </span>
                                            @endif
                                        @endforeach

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
