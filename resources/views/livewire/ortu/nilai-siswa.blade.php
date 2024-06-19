<div class="col-12">
    <div class="row">
        <div class="col-12">
            <div class="input-group mb-3">
                <select class="form-select" id="inputGroupSelect02" wire:model="semester">
                  <option value="0">Pilih Semester...</option>
                  @foreach($dataSemester as $items)
                  <option value="{{$items->idsm}}"> {{$items->tahun_ajaran}} @if($items->semester_kode == 1) Ganjil @elseif($items->semester_kode == 2) Genap @endif</option>
                  @endforeach
                </select>
            </div>
        </div>

        <div class="col-12" wire:loading>
            <div class="d-flex align-items-center">
                <strong role="status">Loading...</strong>
                <div class="spinner-border ms-auto" aria-hidden="true"></div>
              </div>
        </div>

        <div class="col-12">
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai Akhir</th>
                            <th>Predikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($dataNilai)
                            @if(count($dataNilai) <= 1)
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="fw-bold fst-italic">Belum ada data!</span>
                                </td>
                            </tr>
                            @else
                                @foreach($dataNilai->groupBy('mapel_id') as $idmapel => $items)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$items->first()->nama_mapel}} </td>
                                    @php
                                        $avgSumatif = $items->avg('nilai');
                                        $sumTes = $items->sum('test');
                                        $sumNonTes = $items->sum('non_test');
                                        $total = $avgSumatif+$sumTes+$sumNonTes;
                                        $nilaiAkhir = $total/3;
                                    @endphp
                                    <td> {{number_format($nilaiAkhir)}} </td>
                                    <td>
                                        @if($nilaiAkhir < 60) <span class="fw-bold text-danger">E</span>
                                        @elseif($nilaiAkhir > 60 && $nilaiAkhir < 70) <span class="fw-bold text-warning">D</span>
                                        @elseif($nilaiAkhir > 70 && $nilaiAkhir < 80) <span class="fw-bold text-info">C</span>
                                        @elseif($nilaiAkhir > 80 && $nilaiAkhir < 90) <span class="fw-bold text-primary">B</span>
                                        @elseif($nilaiAkhir > 90 && $nilaiAkhir < 100) <span class="fw-bold text-success">A</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
