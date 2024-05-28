<div class="col-sm-12">
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title">Raport Mid Semester</h3>
                        </div>
                        <div class="col-sm-6 text-end pt-4">
                            <a href="/tk/raport-mid-semester/penilaian" class="btn btn-success btn-sm"><i class="bi bi-ui-checks"></i> Form Penilaian <i class="bi bi-chevron-compact-right"></i></a>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="campus"><i class="bi bi-bank2"></i></label>
                                        <select class="form-select" id="campus" wire:model="campus">
                                            <option value="0">Pilih Satuan Pendidikan...</option>
                                            @if($dataCampus)
                                                @foreach($dataCampus as $item)
                                                <option value="{{$item->idcampus}}"> {{$item->campus_name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="ta"><i class="bi bi-calendar-date"></i></label>
                                        <select class="form-select" id="ta" wire:model="ta">
                                            <option value="">Pilih Tahun Ajaran...</option>
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
                                        <label class="input-group-text" for="semester"><i class="bi bi-graph-up-arrow"></i></label>
                                        <select class="form-select" id="semester" wire:model="semester">
                                            <option value="">Pilih Semester...</option>
                                            <option value="1">Ganjil</option>
                                            <option value="2">Genap</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="kelas"><i class="bi bi-house"></i></label>
                                        <select class="form-select" id="kelas" wire:model="kelas" 
                                        @if(!$campus || !$ta || !$semester) disabled @endif wire:change="getDataRaport()">
                                        @if($dataKelas)
                                                <option value="">Pilih Kelas...</option>
                                                @foreach($dataKelas as $item)
                                                <option value="{{$item->id}}"> Kelas {{$item->kode_kelas}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.Col-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Result</h3>
                    <div class="col-sm-12" wire:loading.attr="disabled">
                        <div class="spinner-border text-success" role="status"  wire:loading>
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Induk</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelompok</th>
                                    <th>BSB</th>
                                    <th>BSH</th>
                                    <th>MB</th>
                                    <th>BB</th>
                                    <th>Cetak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($dataRaport) != 0)
                                @foreach($dataRaport as $item)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$item->nis}} </td>
                                    <td> {{$item->first_name}} </td>
                                    <td> {{$item->kode_kelas}} </td>
                                    <td>
                                         {{$item->nilai_bsb.'/'.$item->countRow}} 
                                        @if($item->id_raport)
                                            @php
                                                $jumlah = $item->nilai_bsb/$item->countRow;
                                                $percent = $jumlah*100;
                                            @endphp
                                            ({{number_format($percent, 2)}}%)
                                        @endif

                                    </td>
                                    <td>
                                        {{$item->nilai_bsh.'/'.$item->countRow}} 
                                        @if($item->id_raport)
                                            @php
                                                $jumlah = $item->nilai_bsh/$item->countRow;
                                                $percent = $jumlah*100;
                                            @endphp
                                            ({{number_format($percent, 2)}}%)
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->nilai_mb.'/'.$item->countRow}} 
                                        @if($item->id_raport)
                                            @php
                                                $jumlah = $item->nilai_mb/$item->countRow;
                                                $percent = $jumlah*100;
                                            @endphp
                                            ({{number_format($percent, 2)}}%)
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->nilai_bb.'/'.$item->countRow}} 
                                        @if($item->id_raport)
                                            @php
                                                $jumlah = $item->nilai_bb/$item->countRow;
                                                $percent = $jumlah*100;
                                            @endphp
                                            ({{number_format($percent, 2)}}%)
                                        @endif
                                    </td>
                                    <td> 
                                        @if($item->id_raport)
                                            <a href="/tk/raport-mid-semester/{{$item->id_raport}}/print" class="text-primary" target="_blank"><i class="bi bi-printer-fill"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else 
                                <tr>
                                    <td colspan="9"> <span class="fw-bold fst-italic">Tidak ada data!</span> </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="col-sm-12 text-end">
                            {{$dataRaport->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
       

    </div>
</div>
