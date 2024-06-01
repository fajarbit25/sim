<div class="col-sm-12">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"> Rapor
                    <span wire:loading> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> 
                </h3>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="ta">Tahun Ajaran / Semester</label>
                            <select class="form-control" wire:model="ta">
                                <option value="">-Pilih Tahun Ajaran dan Semester</option>
                                @foreach($dataTa as $item)
                                <option value="{{$item->idsm}}"> {{'TA.'.$item->tahun_ajaran}} | @if($item->semester_kode == 1) Ganjil @else Genap @endif </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="form-control @error('kelas') is-invalid @enderror" 
                            wire:model="kelas" @if(count($dataKelas) == 0) disabled @endif>
                                @if(count($dataKelas) != 0)
                                <option value="0">Pilih Kelas--</option>
                                @foreach($dataKelas as $item)
                                <option value="{{$item->idkelas}}">Kelas {{$item->tingkat. ' '.$item->kode_kelas}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <div class="form-group">
                            <label for="siswa">Siswa</label>
                            <select class="form-control @error('siswa') is-invalid @enderror" 
                            wire:model="siswa" @if(count($dataSiswa) == 0) disabled @endif>
                                @if(count($dataSiswa) != 0)
                                <option value="0">Pilih Siswa--</option>
                                @foreach($dataSiswa as $item)
                                <option value="{{$item->id}}">{{$item->nis.' | '.$item->first_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.col-->

    @if($siswa)
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Rapor Dan Profil Peserta Didik</h3>
                <div class="row">
                    <div class="col-2">
                        <span class="fw-bold">Nama Peserta Didik :</span> <br/>
                        <span class="fw-bold">NIS :</span> <br/>
                        <span class="fw-bold">Nama Sekolah </span> <br/>
                        <span class="fw-bold">Alamat Sekolah </span> 
                    </div>
                    <div class="col-4">
                        : {{$detailSiswa->first_name}}<br>
                        : {{$detailSiswa->nis}}<br>
                        : {{$dataCampus->campus_name}}<br>
                        :   {{$dataCampus->campus_alamat}}
                    </div>
                    <div class="col-2">
                        <span class="fw-bold">Kelas </span> <br/>
                        <span class="fw-bold">Semester </span> <br/>
                        <span class="fw-bold">Tahun Pelajaran </span> 
                    </div>
                    <div class="col-4">
                        : {{$detailSiswa->tingkat}} {{$detailSiswa->kode_kelas}} <br/>
                        : @if($detailSemester->semester_kode == 1) Ganjil @else Genap @endif <br/>
                        : {{$detailSemester->tahun_ajaran}}
                        <br/>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <span class="fw-bold">A. Kompetensi Sikap</span>
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="3" class="bg-light text-center">Deskripsi</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sikap Spiritual</td>
                                <td>Deskripsi</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sikap Sosial</td>
                                <td>Deskripsi</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-sm-12 mb-3">
                        <span class="fw-bold">B. Kompetensi Pengetahuan dan Keterampilan</span>
                        <table class="table table-bordered">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Muatan Pelajaran</th>
                                <th colspan="3">Pengetahuan</th>
                                <th colspan="3">Keterampilan</th>
                            </tr>
                            <tr>
                                <th>Nilai</th>
                                <th>Predikat</th>
                                <th>Deskripsi</th>
                                <th>Nilai</th>
                                <th>Predikat</th>
                                <th>Deskripsi</th>
                            </tr>
                            @foreach($dataNilai->groupBy('nama_mapel') as $namaMapel => $items)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$namaMapel}}</td>
                                @php
                                    $avgPengetahuan = $items->where('aspek', 'Pengetahuan');
                                    $avgKeterampilan = $items->where('aspek', 'Keterampilan');
                                @endphp
                                <td>{{$avgPengetahuan->avg('nilai')}}</td>
                                <td>
                                    @foreach($dataPredikat->where('jenis', 'Predikat') as $predikat)
                                    @if($predikat->nilai_min <= $avgPengetahuan->avg('nilai') && $predikat->nilai_max >= $avgPengetahuan->avg('nilai'))
                                       {{$predikat->deskripsi}}
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    <span>{{$detailSiswa->nick_name}}</span>

                                    @foreach($dataPredikat->where('jenis', 'Capaian') as $predikat)
                                        @if($predikat->nilai_min <= $avgKeterampilan->max('nilai') && $predikat->nilai_max >= $avgKeterampilan->max('nilai'))
                                        <span class="fw-bold">{{$predikat->deskripsi}}</span>
                                        @endif
                                    @endforeach

                                    <span>dalam </span>

                                    @foreach ($dataKd as $kd)
                                        @if($kd->id == $avgPengetahuan->where('nilai', $avgPengetahuan->max('nilai'))->first()->idkd)
                                        <span class="fw-bold">{{$kd->deskripsi}}, </span>
                                        @endif
                                    @endforeach


                                </td>
                                <td>{{$avgKeterampilan->avg('nilai')}}</td>
                                <td>
                                    @foreach($dataPredikat->where('jenis', 'Predikat') as $predikat)
                                    @if($predikat->nilai_min <= $avgKeterampilan->avg('nilai') && $predikat->nilai_max >= $avgKeterampilan->avg('nilai'))
                                       {{$predikat->deskripsi}}
                                    @endif
                                    @endforeach
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif

</div>
