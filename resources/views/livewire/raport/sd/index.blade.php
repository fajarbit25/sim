<div class="col-sm-12">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"> Rapor
                    <span wire:loading> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> 
                </h3>
                <div class="row">
                    <div class="col-sm-4">
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
                    <div class="col-sm-4 mb-3">
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
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label for="jenis"> Jenis Penilaian <span class="text-danger">*</span> </label>
                            <select class="form-control" wire:model="jenis">
                                <option value="">-Pilih Jenis Penilaian</option>
                                <option value="PH">PH</option>
                                <option value="PTS">PTS</option>
                                <option value="PAS">PAS</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.col-->

    @if($kelas && $ta)
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Rapor Peserta Didik Kelas {{$detailKelas->tingkat}} {{$detailKelas->kode_kelas}}</h3>
                <div class="row">
                    <div class="col-2">
                        <span class="fw-bold">Semester :</span> <br/>
                        <span class="fw-bold">Tahun Ajaran :</span> <br/>
                        <span class="fw-bold">Nama Sekolah </span> <br/>
                        <span class="fw-bold">Alamat Sekolah </span> 
                    </div>
                    <div class="col-8">
                        : @if($detailSemester->semester_kode == 1) Ganjil @else Genap @endif <br/>
                        : {{$detailSemester->tahun_ajaran}} <br/>
                        : {{$dataCampus->campus_name}}<br>
                        :  {{$dataCampus->campus_alamat}}
                    </div>
                    @if($kelas)
                    <div class="col-12 mt-3">
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Tanggal Raport :  @if($dataTanggalraport) {{$dataTanggalraport}} @else - @endif</span>
                                <input type="date" class="form-control @error('tanggalRaport') is-invalid @enderror" aria-describedby="button-addon2" wire:model="tanggalRaport" wire:change="updateTanggalRaport()">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">
                                        Update
                                        <span wire:loading> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> 
                                    </span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(count($dataNilai) != 0)
                    <div class="col-sm-12 py-3">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="bg-light">No.</th>
                                        <th rowspan="2" class="bg-light">Nama Siswa</th>
                                        <th rowspan="2" class="bg-light">Panggilan</th>
                                        <th colspan="{{count($dataMapel)}}" class="bg-light text-center">Nilai Akhir</th>
                                        <th rowspan="2" class="bg-light text-center">Rata-Rata<br/>({{$jenis}})</th>
                                        <th rowspan="2" class="bg-light text-center">NA</th>
                                        <th rowspan="2" class="bg-light text-center">Jumlah</th>
                                        <th rowspan="2" class="bg-light text-center">Rank</th>
                                        <th rowspan="2" class="bg-light text-center">Kriteria</th>
                                        @if(Auth::user()->level <= 1)
                                        <th rowspan="2" class="bg-light">Cetak</th>
                                        @endif
                                    </tr>
                                    <tr>
                                        @foreach($dataMapel as $item)
                                        <th class="text-center"> {{$item->kode_mapel}} </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataNilai->groupBy('iduser') as $iduser => $items)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$items->first()->first_name}} </td>
                                        <td> {{$items->first()->nick_name}} </td>
                                        @foreach($dataMapel as $item)
                                        <td class="text-center">
                                            {{-- NA Mapel --}}
                                            @php
                                                $avgNilai = $items->where('mapel_id', $item->idmapel)->avg('nilai');
                                            @endphp
                                            @if($avgNilai <= 0)
                                                <span class="text-danger fw-bold">{{number_format($avgNilai, 2)}}</span>
                                            @else 
                                                <span>{{number_format($avgNilai, 2)}}</span>
                                            @endif
                                        </td>
                                        @endforeach
                                        <td class="text-center">
                                            {{-- Rata-rata --}}
                                            {{number_format($dataNilai->where('iduser', $items->first()->iduser)->avg('nilai'), 2)}}
                                        </td>
                                        <td class="text-center">
                                            {{-- jumlah --}}
                                            {{number_format($dataNilai->where('iduser', $items->first()->iduser)->avg('nilai'), 2)}} 
                                        </td>
                                        <td class="text-center">
                                            {{-- jumlah --}}
                                            {{$dataNilai->where('iduser', $items->first()->iduser)->sum('nilai')}} 
                                        </td>
                                        <td class="text-center"> 

                                            @php
                                                // Mengelompokkan dataNilai berdasarkan iduser
                                                $groupedData = $dataNilai->groupBy('iduser');
                                            
                                                // Menghitung nilai rata-rata untuk setiap iduser
                                                $averages = $groupedData->map(function($items) {
                                                    return $items->avg('nilai');
                                                });
                                            
                                                // Mengurutkan iduser berdasarkan nilai rata-rata secara menurun
                                                $sortedIds = $averages->sortDesc()->keys()->toArray();
                                            
                                                // Membuat array asosiatif yang berisi peringkat untuk setiap iduser
                                                $rankedUsers = array_combine($sortedIds, range(1, $averages->count()));
                                            @endphp
                                            
                                            @foreach($groupedData as $userId => $ranks)
                                                @php
                                                    $avgNilai = $averages[$userId];
                                                    $userRank = $rankedUsers[$userId];
                                                @endphp
                                            
                                                <!-- Tampilkan data jika user_id sama dengan user_id yang pertama -->
                                                @if($userId == $items->first()->iduser)
                                                <span class="fw-bold">{{ $userRank }}</span>
                                                @endif
                                            @endforeach

                                        </td>
                                        <td class="text-center">
                                            @php
                                                $avgKriteria = $dataNilai->where('iduser', $items->first()->iduser)->avg('nilai');
                                            @endphp

                                            @if($avgKriteria > 0 && $avgKriteria < 80)
                                                <span>Cukup Memuaskan</span>
                                            @elseif($avgKriteria >= 80 && $avgKriteria < 90)
                                                <span>Memuaskan</span>
                                            @elseif($avgKriteria >= 90 && $avgKriteria < 100)
                                                <span>Sangat Memuaskan</span>
                                            @endif
                                        </td>
                                        @if(Auth::user()->level <= 1)
                                        <td class="bg-light" style="white-space: nowrap;">
                                            @if($jenis == 'PAS')
                                            <a href="/raport/sd/{{$items->first()->idraport}}/cetak" class="btn btn-warning btn-xs" target="_blank">
                                                <i class="bi bi-printer-fill"></i> PAS
                                            </a>
                                            @else
                                            <a href="/raport/sd/{{$items->first()->idraport}}/cetak-pts" class="btn btn-info btn-xs" target="_blank">
                                                <i class="bi bi-printer-fill"></i> PTS
                                            </a>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif


    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('showAlert', function (data) {
                if(data.type === 200){
                    var icons = 'success'
                }else if(data.type === 500){
                    var icons = 'warning'
                }
                Swal.fire({
                    icon: icons,
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    </script>
    @endpush

</div>
