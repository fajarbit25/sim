<div class="col-sm-12">
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title">Form Penilaian Raport Mid Semester</h3>
                        </div>
                        <div class="col-sm-6 text-end pt-4">
                            <a href="/tk/raport-mid-semester/form" class="btn btn-info btn-sm"><i class="bi bi-ui-checks"></i> Format Raport <i class="bi bi-chevron-compact-right"></i></a>
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
                                        <label class="input-group-text" for="kelas"><i class="bi bi-house"></i></label>
                                        <select class="form-select" id="kelas" wire:model="kelas" @if(!$campus) disabled @endif>
                                            <option value="">Pilih Kelas...</option>
                                            @if($dataKelas)
                                                @foreach($dataKelas as $item)
                                                <option value="{{$item->id}}"> Kelas {{$item->kode_kelas}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="ta"><i class="bi bi-calendar-date"></i></label>
                                        <select class="form-select" id="ta" wire:model="ta" wire:change="getDataRaport()">
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
                                        <select class="form-select" id="semester" wire:model="semester" wire:change="getDataRaport()">
                                            <option value="">Pilih Semester...</option>
                                            <option value="1">Ganjil</option>
                                            <option value="2">Genap</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="siswa"><i class="bi bi-person-bounding-box"></i></label>
                                        <select class="form-select" id="siswa" wire:model="siswa" @if(!$kelas) disabled @endif wire:change="getDataRaport()">
                                            <option value="">Pilih Siswa...</option>
                                            @if($dataSiswa)
                                                @foreach($dataSiswa as $item)
                                                    <option value="{{$item->id}}">{{$item->nis}} | {{$item->first_name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="tanggal"><i class="bi bi-calendar-event"></i></label>
                                        <input type="date" class="form-control" wire:model="tanggal"/>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-end">
                                    @if(!$dataRaport)
                                    <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04" wire:loading.attr="disabled" wire:click="createRaport()">
                                        <span wire:loading.remove>
                                             Buat Raport
                                        </span>
                                        <span wire:loading>
                                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...
                                        </span>
                                    </button>
                                    @else
                                    <button class="btn btn-success" type="submit" id="inputGroupFileAddon04" wire:loading.attr="disabled" wire:click="updateDataRaport()">
                                        <span wire:loading.remove>
                                             Update Data
                                        </span>
                                        <span wire:loading>
                                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...
                                        </span>
                                    </button>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.Col-->
        @if($dataRaport)
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Tabel Penilaian</h3>

                    <table class="table table-bordered">
                        <body>
                            <tr>
                                <th class="bg-light" rowspan="2">No</th>
                                <th class="bg-light" rowspan="2">ASPEK PERKEMBANGAN</th>
                                <th class="bg-light" rowspan="2">INDIKATOR DAN TINGKAT PERKEMBANGAN</th>
                                <th class="bg-light" colspan="4">HASIL PENILAIAN</th>
                            </tr>
                            <tr>
                                <th class="bg-light">BSB</th>
                                <th class="bg-light">BSH</th>
                                <th class="bg-light">MB</th>
                                <th class="bg-light">BB</th>
                            </tr>

                            <tr>
                                <th>I</th>
                                <th colspan="2">NILAI-NILAI AGAMA DAN MORAL</th>
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @php
                                $letters = range('A', 'Z');
                            @endphp
                            @foreach($dataAgama->groupBy('subkategori') as $subkategori => $items)
                            <tr>
                                <td></td>
                                <td></td>
                                <th> {{$letters[$loop->iteration-1]}}. {{$subkategori}}</th>
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($items as $item)
                            <tr>
                                <td></td>
                                <td>
                                    @if($item->tujuan)
                                        {{$loop->iteration. ' '.$item->tujuan}}
                                    @endif
                                </td>
                                <td>{{$loop->iteration.' '.$item->materi}}</td>
                                <th>
                                    <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                        @if($item->bsb == '-')
                                            <i class="bi bi-three-dots"></i>
                                        @elseif($item->bsb == 'true')
                                            <i class="bi bi-check-lg"></i>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="prosesPenilaian('{{$item->id}}', 'bsb')"> <i class="bi bi-check-lg"></i> Check</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="resetNilai({{$item->id}})"> <i class="bi bi-arrow-repeat"></i> Reset</a></li>
                                    </ul>
                                </th>
                                <th>
                                    <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                        @if($item->bsh == '-')
                                            <i class="bi bi-three-dots"></i>
                                        @elseif($item->bsh == 'true')
                                            <i class="bi bi-check-lg"></i>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="prosesPenilaian('{{$item->id}}', 'bsh')"> <i class="bi bi-check-lg"></i> Check</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="resetNilai({{$item->id}})"> <i class="bi bi-arrow-repeat"></i> Reset</a></li>
                                    </ul>
                                </th>
                                <th>
                                    <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                        @if($item->mb == '-')
                                            <i class="bi bi-three-dots"></i>
                                        @elseif($item->mb == 'true')
                                            <i class="bi bi-check-lg"></i>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="prosesPenilaian('{{$item->id}}', 'mb')"> <i class="bi bi-check-lg"></i> Check</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="resetNilai({{$item->id}})"> <i class="bi bi-arrow-repeat"></i> Reset</a></li>
                                    </ul>
                                </th>
                                <th>
                                    <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                        @if($item->bb == '-')
                                            <i class="bi bi-three-dots"></i>
                                        @elseif($item->bb == 'true')
                                            <i class="bi bi-check-lg"></i>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="prosesPenilaian('{{$item->id}}', 'bb')"> <i class="bi bi-check-lg"></i> Check</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="resetNilai({{$item->id}})"> <i class="bi bi-arrow-repeat"></i> Reset</a></li>
                                    </ul>
                                </th>
                            </tr>
                            @endforeach
                            @endforeach
                            @foreach($dataAll->groupBy('kategori') as $kategori => $subs)
                            <tr>
                                <th class="fw-bold">
                                    @if($loop->iteration == 1) II
                                    @elseif($loop->iteration == 2) III
                                    @elseif($loop->iteration == 3) IV
                                    @elseif($loop->iteration == 4) V
                                    @elseif($loop->iteration == 5) VI
                                    @elseif($loop->iteration == 6) VII
                                    @elseif($loop->iteration == 7) VIII
                                    @elseif($loop->iteration == 8) IX
                                    @elseif($loop->iteration == 9) X
                                    @elseif($loop->iteration == 10) XI
                                    @endif
                                </th>
                                <th colspan="2">{{strtoupper($kategori)}}</th>
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($subs->groupBy('subkategori') as $subkategori => $items)
                            <tr>
                                <td></td>
                                <td colspan="2">{{$loop->iteration.'. '.$subkategori}}</td>
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach ($items as $item)
                            <tr>
                                <td></td>
                                <td>
                                    <div class="row"> <!-- Membuat baris Bootstrap -->
                                        <div class="col-md-1 text-end"><i class="bi bi-dash-lg"></i></div> <!-- Grid kosong untuk offset -->
                                        <div class="col-md-11"> <!-- Kolom utama untuk $item->materi -->
                                            {{$item->materi}}
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <th>
                                    <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                        @if($item->bsb == '-')
                                            <i class="bi bi-three-dots"></i>
                                        @elseif($item->bsb == 'true')
                                            <i class="bi bi-check-lg"></i>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="prosesPenilaian('{{$item->id}}', 'bsb')"> <i class="bi bi-check-lg"></i> Check</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="resetNilai({{$item->id}})"> <i class="bi bi-arrow-repeat"></i> Reset</a></li>
                                    </ul>
                                </th>
                                <th>
                                    <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                        @if($item->bsh == '-')
                                            <i class="bi bi-three-dots"></i>
                                        @elseif($item->bsh == 'true')
                                            <i class="bi bi-check-lg"></i>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="prosesPenilaian('{{$item->id}}', 'bsh')"> <i class="bi bi-check-lg"></i> Check</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="resetNilai({{$item->id}})"> <i class="bi bi-arrow-repeat"></i> Reset</a></li>
                                    </ul>
                                </th>
                                <th>
                                    <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                        @if($item->mb == '-')
                                            <i class="bi bi-three-dots"></i>
                                        @elseif($item->mb == 'true')
                                            <i class="bi bi-check-lg"></i>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="prosesPenilaian('{{$item->id}}', 'mb')"> <i class="bi bi-check-lg"></i> Check</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="resetNilai({{$item->id}})"> <i class="bi bi-arrow-repeat"></i> Reset</a></li>
                                    </ul>
                                </th>
                                <th>
                                    <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                        @if($item->bb == '-')
                                            <i class="bi bi-three-dots"></i>
                                        @elseif($item->bb == 'true')
                                            <i class="bi bi-check-lg"></i>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="prosesPenilaian('{{$item->id}}', 'bb')"> <i class="bi bi-check-lg"></i> Check</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" wire:click="resetNilai({{$item->id}})"> <i class="bi bi-arrow-repeat"></i> Reset</a></li>
                                    </ul>
                                </th>
                            </tr>
                            @endforeach
                            @endforeach
                            @endforeach
                            @php
                                $countAgama = $dataAgama->count();
                                $countNonAgama = $dataAll->count();
                                $totalData = $countAgama+$countNonAgama;
                            @endphp
                            <tr>
                                <td rowspan="4"></td>
                                <td colspan="2">- Tingkat Pencapaian Perkembangan: Berkembang Sangat Baik (BSB)</td>
                                <td colspan="2" class="fw-bold">
                                    @php
                                        $countBsb = $dataAll->filter(function ($data) {
                                            return $data->bsb == 'true';
                                        } )->count();

                                        $countAgamaBsb = $dataAgama->filter(function ($data) {
                                            return $data->bsb == 'true';
                                        } )->count();

                                    @endphp
                                    {{$countBsb+$countAgamaBsb.'/'.$totalData}}
                                </td>
                                <td colspan="2" class="fw-bold">
                                    @php
                                        $penjumlahan =$countBsb+$countAgamaBsb;
                                        $pembagian = $penjumlahan/$totalData;
                                        $hasil = $pembagian*100;
                                    @endphp
                                    ({{number_format($hasil, 2)}}%)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">- Tingkat Pencapaian Perkembangan: Berkembang Sesuai Harapan (BSH)</td>
                                <td colspan="2" class="fw-bold">
                                    @php
                                        $countBsh = $dataAll->filter(function ($data) {
                                            return $data->bsh == 'true';
                                        } )->count();

                                        $countAgamaBsh = $dataAgama->filter(function ($data) {
                                            return $data->bsh == 'true';
                                        } )->count();

                                    @endphp
                                    {{$countBsh+$countAgamaBsh.'/'.$totalData}}
                                </td>
                                <td colspan="2" class="fw-bold">
                                    @php
                                        $penjumlahan =$countBsh+$countAgamaBsh;
                                        $pembagian = $penjumlahan/$totalData;
                                        $hasil = $pembagian*100;
                                    @endphp
                                    ({{number_format($hasil, 2)}}%)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">- Tingkat Pencapaian Perkembangan: Mulai Berkembang (MB)</td>
                                <td colspan="2" class="fw-bold">
                                    @php
                                        $countMb = $dataAll->filter(function ($data) {
                                            return $data->mb == 'true';
                                        } )->count();

                                        $countAgamaMb = $dataAgama->filter(function ($data) {
                                            return $data->mb == 'true';
                                        } )->count();

                                    @endphp
                                    {{$countMb+$countAgamaMb.'/'.$totalData}}
                                </td>
                                <td colspan="2" class="fw-bold">
                                    @php
                                        $penjumlahan =$countMb+$countAgamaMb;
                                        $pembagian = $penjumlahan/$totalData;
                                        $hasil = $pembagian*100;
                                    @endphp
                                    ({{number_format($hasil, 2)}}%)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">- Tingkat Pencapaian Perkembangan: Belum Berkembang (BB)</td>
                                <td colspan="2" class="fw-bold">
                                    @php
                                        $countBb = $dataAll->filter(function ($data) {
                                            return $data->bb == 'true';
                                        } )->count();

                                        $countAgamaBb = $dataAgama->filter(function ($data) {
                                            return $data->bb == 'true';
                                        } )->count();

                                    @endphp
                                    {{$countBb+$countAgamaBb.'/'.$totalData}}
                                </td>
                                <td colspan="2" class="fw-bold">
                                    @php
                                        $penjumlahan =$countBb+$countAgamaBb;
                                        $pembagian = $penjumlahan/$totalData;
                                        $hasil = $pembagian*100;
                                    @endphp
                                    ({{number_format($hasil, 2)}}%)
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold"></td>
                                <td colspan="2">
                                    <span>Deskripsi :</span> <br/>
                                    <span class="text-center">
                                        {{$deskripsi}}
                                    </span>
                                </td>
                                <td colspan="4">
                                    <button type="button" class="btn btn-success btn-sm" wire:click="modalDeskripsi('deskripsi')">
                                        <i class="bi bi-pencil-square"></i> Edit Deskipsi
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="fw-bold">VIII</td>
                                <td class="fw-bold" colspan="6"> CATATAN DAN REKOMENDASI WALI KELAS</td>
                            </tr>
                            <tr>
                                <td class="fw-bold"></td>
                                <td colspan="2" class="text-center">
                                    {{$catatan}}
                                </td>
                                <td colspan="4">
                                    <button type="button" class="btn btn-success btn-sm" wire:click="modalCatatan('catatan')">
                                        <i class="bi bi-pencil-square"></i> Edit Catatan
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="7" class="text-end">
                                    <a href="/tk/raport-mid-semester/{{$idRaport}}/print" target="_blank" class="btn btn-danger btn-sm">
                                        <i class="bi bi-printer-fill"></i> Cetak Rapor Siswa
                                    </a>
                                </th>
                            </tr>

                        </body>
                    </table>

                </div>
            </div>
        </div><!--/.Col-->
        @endif

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDeskripsi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pencil-square"></i>  Edit {{$kolomEdit}} </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea class="form-control" rows="10" wire:model="deskripsi"></textarea>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success" type="submit" id="inputGroupFileAddon04" wire:loading.attr="disabled" wire:click="updateDeskripsi()">
                <span wire:loading.remove>
                     Update {{$kolomEdit}}
                </span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...
                </span>
            </button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCatatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pencil-square"></i>  Edit {{$kolomEdit}} </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea class="form-control" rows="10" wire:model="catatan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success" type="submit" id="inputGroupFileAddon04" wire:loading.attr="disabled" wire:click="updateCatatan()">
                <span wire:loading.remove>
                     Update {{$kolomEdit}}
                </span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...
                </span>
            </button>
            </div>
        </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalCreate', function () {
                $('#modalCreate').modal('show')
            }); //membuka modal

            Livewire.on('modalDeskripsi', function () {
                $('#modalDeskripsi').modal('show')
            }); //membuka modal

            Livewire.on('closeModalDeskripsi', function () {
                $("#modalDeskripsi").modal('hide');
            } );

            Livewire.on('modalCatatan', function () {
                $('#modalCatatan').modal('show')
            }); //membuka modal

            Livewire.on('closeModalCatatan', function () {
                $("#modalCatatan").modal('hide');
            } );


            Livewire.on('showAlert', function (data) {
                if(data.type === 200){
                    var icons = 'success'
                }else{
                    var icons = 'danger'
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
