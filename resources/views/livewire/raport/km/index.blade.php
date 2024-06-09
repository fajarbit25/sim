<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        </span>
                        Rapor Kurikulum Merdeka
                    </h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="semester">
                                    <i class="bi bi-bank2"></i>
                                </label>
                                <select class="form-select" id="semester" wire:model="semester">
                                  <option selected>TA - Semester...</option>
                                  @foreach($dataSemester as $semester)
                                    <option value="{{$semester['idsm']}}"> Tahun Ajaran {{$semester['tahun_ajaran']}} - Semester @if($semester['semester_kode'] == 1) Ganjil @else Genap @endif </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="kelas">
                                    <i class="bi bi-house-check"></i>
                                </label>
                                <select class="form-select" id="kelas" wire:model="kelas" @if(!$dataKelas) disabled @endif>
                                  <option selected>Kelas...</option>
                                    @if($dataKelas)
                                        @foreach($dataKelas as $kelas)
                                            <option value="{{$kelas->idkelas}}">{{$kelas->tingkat.' '.$kelas->kode_kelas}}</option>>
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
                    <h3 class="card-title">
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        </span>
                        Nilai Akhir Asesmen Sumatif
                    </h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-light">No</th>
                                    <th class="bg-light">Nama</th>
                                    @if($dataNilai)
                                        @foreach($dataNilai->groupBy('kode_mapel') as $kodeMapel => $filteredItems)
                                                <th> {{$kodeMapel}} </th>
                                        @endforeach
                                    @endif
                                    <th class="bg-light">Rata-Rata</th>
                                    <th class="bg-light">Rank</th>
                                    <th class="bg-light">Cetak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($dataNilai)
                                    @foreach($dataNilai->groupBy('iduser') as  $iduser => $items)
                                        <tr>
                                            <td> {{$loop->iteration}} </td>
                                            <td> {{$items->first()->first_name}} </td>
                                            @foreach($items->groupBy('mapel_id') as $idmapel => $filteredItems)
                                                    <td> {{$filteredItems->avg('nilai')}} </td>
                                            @endforeach
                                            <td> {{number_format($items->avg('nilai'), 2)}} </td>
                                            <td>
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
                                            <td>
                                                <a href="javascript:void(0)" class="text-warning">
                                                    <i class="bi bi-printer-fill"></i>
                                                </a>
                                            </td>
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
