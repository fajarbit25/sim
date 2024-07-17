<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                        Laporan Absensi Mata Pelajaran
                    </h3>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-bank2"></i></label>
                                <select class="form-select" id="inputGroupSelect01" wire:model="campus">
                                <option selected>Pilih Satuan Pendidikan...</option>
                                @foreach ($dataCampus as $item) 
                                    <option value="{{$item->idcampus}}"> {{$item->idcampus.'. '.$item->campus_name}} </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-house" wire:model="kelas"></i></label>
                                <select class="form-select" id="inputGroupSelect01" wire:model="kelas">
                                    <option selected>Pilih Kelas...</option>
                                    @if($campus)
                                    @foreach($dataKelas as $item)
                                    <option value="{{$item->idkelas}}">Kelas {{$item->tingkat.$item->kode_kelas}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">           
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-calendar4-week"></i></label>
                                <select class="form-select" id="inputGroupSelect01" wire:model="ta">
                                    <option selected>Pilih Tahun Ajaran...</option>
                                    @foreach ($dataTa as $item)    
                                        <option value="{{$item->tahun_ajaran}}">{{$item->tahun_ajaran}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-graph-up-arrow"></i></label>
                                <select class="form-select" id="inputGroupSelect01" wire:model="semester">
                                    <option selected>Pilih Semester...</option>
                                    <option value="1">Ganjil</option>
                                    <option value="2">Genap</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-graph-up-arrow"></i></label>
                                <select class="form-select" id="inputGroupSelect01" wire:model="mapel">
                                    <option selected>Pilih Mata Pelajaran...</option>
                                    @if($dataMapel)
                                    @foreach($dataMapel as $item)
                                    <option value="{{$item->idmapel}}">{{$item->kode_mapel.' - '.$item->nama_mapel}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title">Tabel Absensi</h3>
                        </div>
                        <div class="col-sm-6 text-end">
                            @if($hide == 0)
                                <button type="button" class="btn btn-primary btn-sm m-3" wire:click="hideData()"><span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Sembunyikan</button>
                            @endif
                            @if($hide == 1)
                                <button type="button" class="btn btn-primary btn-sm m-3" wire:click="unhideData()"><span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Tampilkan</button>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center bg-light"> No </th>
                                            <th rowspan="2" class="text-center bg-light"> NIS </th>
                                            <th rowspan="2" class="text-center bg-light"> Nama Siswa </th>
                                            <th rowspan="2" class="text-center bg-light"> JK </th>
                                            @if($hide == 0)
                                            <th colspan="{{$dataAbsen->groupBy('tanggal_absen')->count()}}" class="text-center bg-light"> Tanggal Absensi </th>
                                            @endif
                                            <th colspan="4" class="text-center bg-light"> Total </th>
                                        </tr>
                                        <tr>

                                            @if($hide == 0)
                                            @foreach($dataAbsen->groupBy('tanggal_absen') as $tanggal => $item)
                                            <th class="text-center bg-light"> {{substr($tanggal, 8, 2)}}/{{substr($tanggal, 5, 2)}} </th>
                                            @endforeach
                                            @endif

                                            <th class="text-center bg-light"> H </th>
                                            <th class="text-center bg-light"> S </th>
                                            <th class="text-center bg-light"> I </th>
                                            <th class="text-center bg-light"> A </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($mapel)
                                        @foreach($dataAbsen->groupBy('user_id') as $user_id => $items)
                                        <tr>
                                            <td class="text-center fw-bold"> {{$loop->iteration}} </td>
                                            <td class="text-center fw-bold"> {{$items->first()->nis.' / '.$items->first()->nis}} </td>
                                            <td> {{$items->first()->first_name}} </td>
                                            <td class="text-center fw-bold">
                                                @if($items->first()->gender == 'Laki-laki')
                                                    L
                                                @elseif($items->first()->gender == 'Perempuan') 
                                                    P
                                                @else 
                                                    N/A
                                                @endif
                                            </td>

                                            @php
                                                $dataAbsensi = $dataAbsen->where('user_id', $user_id);
                                            @endphp
                                            
                                            @if($hide == 0)
                                            @foreach($dataAbsensi as $item)
                                            <td class="text-center">
                                                @if($item->absensi == 'Hadir')  <span><i class="bi bi-check"></i></span>
                                                @elseif($item->absensi == 'Sakit') <span class="fw-bold text-success">S</span>
                                                @elseif($item->absensi == 'Izin') <span class="fw-bold text-info">I</span>
                                                @elseif($item->absensi == 'Alfa') <span class="fw-bold text-danger">A</span>
                                                @endif
                                            </td>
                                            @endforeach
                                            @endif

                                            <td class="text-center fw-bold"> {{$dataAbsen->where('user_id', $user_id)->where('absensi', 'Hadir')->count();}} </td>
                                            <td class="text-center fw-bold"> {{$dataAbsen->where('user_id', $user_id)->where('absensi', 'Sakit')->count();}} </td>
                                            <td class="text-center fw-bold"> {{$dataAbsen->where('user_id', $user_id)->where('absensi', 'Izin')->count();}} </td>
                                            <td class="text-center fw-bold"> {{$dataAbsen->where('user_id', $user_id)->where('absensi', 'Alfa')->count();}} </td>
                                        </tr>
                                        @endforeach
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
