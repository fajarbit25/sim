<div class="col-sm-12">
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"> Form Penilaian
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                    </h3>
                    <div class="row">
                        <div class="col-sm-4">
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
                        <div class="col-sm-4">
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
                        <div class="col-sm-4">
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
                        <div class="col-sm-4">
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
                        <div class="col-sm-4">
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
                        <div class="col-sm-4">
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
                        @if(count($dataNilai) == 0)
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary btn-sm" 
                            wire:loading.attr="disabled" wire:click="createNilai()"> Buat Form Penilaian
                                <span wire:loading>
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                </span>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div> 
        </div> <!--col/.-->

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Tabel Penilaian 
                        <span title="info" wire:click="updateInfo()"><i class="bi bi-question-circle"></i></span>
                    </h3>

                    @if (session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if(count($dataNilai) != 0)

                        @if($info == 'true')
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <span class="fst-italic">
                                @if($aspek == 'Formatif')
                                -Tiap TP Memiliki 2 Kolom Checklist, Checklist Pertama untuk menilai, Checklist Kedua untuk menampilkan di raport. <br/>
                                @endif

                                @if($aspek == 'Sumatif')
                                - Rentang nilai yang dapat diinput adalah 60-99. <br/>
                                @endif

                                -Jika masih terdapat siswa yang belum masuk pada form dibawah, Silahkan klik  
                                <span wire:loading>
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                </span> 
                                <a href="javascript:void(0)" class="text-success fw-bold" wire:click="generateNewStudents()">Generate </a>
                                agar Siswa dapat dimasukan ke dalam Form.
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" wire:click="updateInfo()"></button>
                        </div>
                        @endif

                        @if($aspek == 'Formatif')
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
                                            <a href="javascipt:void" wire:click="modalTp({{$item->id}})"> TP-{{$item->kode}} </a>
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
                                            @if($items->first()->nick_name == null)
                                                <a href="javascript:void(0)" class="fw-bold" wire:click="modalNickName({{$idSiswa}})"> 
                                                    <i class="bi bi-pencil"></i> Edit 
                                                </a>
                                            @else 
                                                {{$items->first()->nick_name}}
                                            @endif
                                        </td>

                                        @foreach($items as $item)
                                        <td>
                                            <input type="checkbox" @if($item->nilai == 1) checked @endif wire:click="updateNilai('{{$item->id_nilai}}')">
                                            <input type="checkbox" wire:click="lihatKd('{{$item->id_nilai}}')" @if($item->tampil == 1) checked @endif>
                                        </td>
                                        @endforeach

                                        <td style="font-size: 9px;">
                                            @php
                                                $totalDataZeroUpper = $dataNilai->filter(function($lower) use ($idSiswa) {
                                                    return $lower->nilai == 1 && $lower->idsiswa == $idSiswa;
                                                })->count();  
                                            @endphp
                                            @if($totalDataZeroUpper != 0)
                                                {{$items->first()->nick_name}} menunjukkan pemahaman dalam <br/>
                                               @foreach($items as $item)
                                                 @if($item->nilai == 1 && $item->tampil == 1)
                                                    {{$item->deskripsi.', '}}
                                                 @endif
                                               @endforeach
                                            @endif
                                        </td>
                                        <td style="font-size: 9px;">
                                            @php
                                                $totalDataZeroLower = $dataNilai->filter(function($lower) use ($idSiswa) {
                                                    return $lower->nilai == 0 && $lower->idsiswa == $idSiswa && $lower->tampil != 0;
                                                })->count();  
                                            @endphp
                                            @if($totalDataZeroLower != 0)
                                                {{$items->first()->nick_name}} membutuhkan bimbingan dalam <br/>
                                               @foreach($items as $item)
                                                 @if($item->nilai == 0 && $item->tampil == 1)
                                                    {{$item->deskripsi.', '}}
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
                        @if($aspek == 'Sumatif')
                        <div class="table-responsive">
                            <table class="table table-bordered" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="background-color: rgb(117, 161, 96);">No.</th>
                                        <th rowspan="2" style="background-color: rgb(117, 161, 96);"> Nama Siswa </th>
                                        <th rowspan="2" style="background-color: rgb(117, 161, 96);"> Panggilan </th>
                                        <th colspan="{{$dataKd->count()+1}}" style="background-color: rgb(117, 161, 96);"> Sumatif Akhir Lingkup Materi (Wajib) </th>
                                        <th rowspan="2" style="background-color: rgb(117, 161, 96);">
                                            Non Test
                                        </th>
                                        <th rowspan="2" style="background-color: rgb(117, 161, 96);">
                                            Test
                                        </th>
                                        <th rowspan="2" style="background-color: rgb(117, 161, 96);">
                                            NA Semester <br/> (Tidak Wajib)
                                        </th>
                                        <th rowspan="2" style="background-color: rgb(117, 161, 96); white-space:nowrap;">Nilai Raport</th>
                                    </tr>
                                    <tr>
                                        @foreach($dataKd as $item)
                                        <th style="background-color: rgb(117, 161, 96);">
                                            <a href="javascript:void(0)" wire:click="modalTp('{{$item->id}}')"> LM-{{$item->kode}} </a>
                                        </th>
                                        @endforeach
                                        <th style="background-color: rgb(117, 161, 96);">
                                            Nilai <br/>
                                            Akhir
                                        </th>
                                        
                                    </tr>

                                    <tbody>
                                        @foreach($dataNilai->groupBy('idsiswa') as $idSiswa => $items)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$items->first()->first_name}}</td>
                                            <td>
                                                @if($items->first()->nick_name == null)
                                                <a href="javascript:void(0)" class="fw-bold" wire:click="modalNickName('{{$idSiswa}}')"> 
                                                    <i class="bi bi-pencil"></i> Edit 
                                                </a>
                                                @else 
                                                    {{$items->first()->nick_name}}
                                                @endif
                                            </td>
                                            @foreach($items as $item)
                                            <td>
                                                <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                                    {{$item->nilai}}
                                                 </a>
                                                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                     <div class="col-sm-12" style="padding-left: 10px; padding-right:10px; max-width:200px;">
                                                         <div class="input-group">
                                                             <input type="text" class="form-control @error('nilai') is-invalid @endif" aria-describedby="button-addon2" wire:model.lazy="nilai">
                                                             <button class="btn btn-outline-secondary" type="button" id="button-addon2" wire:loading.attr="disabled" wire:click="updateNilaiKd('{{$item->id_nilai}}')">
                                                                 <i class="bi bi-check"></i>
                                                             </button>
                                                         </div>
                                                     </div>
                                                 </ul>
                                            </td>
                                            @endforeach
                                            <td class="bg-light">
                                                {{number_format($items->avg('nilai'), 2)}}
                                            </td>
                                            <td>
                                                <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                                    {{$items->sum('non_test')}}
                                                 </a>
                                                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                     <div class="col-sm-12" style="padding-left: 10px; padding-right:10px; max-width:200px;">
                                                         <div class="input-group">
                                                             <input type="text" class="form-control @error('nilai') is-invalid @endif" aria-describedby="button-addon2" wire:model.lazy="nilai">
                                                             <button class="btn btn-outline-secondary" type="button" id="button-addon2" wire:loading.attr="disabled" wire:click="updateNonTes('{{$items->first()->id_nilai}}')">
                                                                 <i class="bi bi-check"></i>
                                                             </button>
                                                         </div>
                                                     </div>
                                                 </ul>
                                            </td>
                                            <td>
                                                <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                                    {{$items->sum('test')}}
                                                 </a>
                                                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                     <div class="col-sm-12" style="padding-left: 10px; padding-right:10px; max-width:200px;">
                                                         <div class="input-group">
                                                             <input type="text" class="form-control @error('nilai') is-invalid @endif" aria-describedby="button-addon2" wire:model.lazy="nilai">
                                                             <button class="btn btn-outline-secondary" type="button" id="button-addon2" wire:loading.attr="disabled" wire:click="updateTes('{{$items->first()->id_nilai}}')">
                                                                 <i class="bi bi-check"></i>
                                                             </button>
                                                         </div>
                                                     </div>
                                                 </ul>
                                            </td>
                                            <td class="bg-light">
                                                @php
                                                    $na_semester = $items->sum('test')+$items->sum('non_test');
                                                @endphp
                                                {{number_format($na_semester/2, 2)}}
                                            </td>
                                            <th class="bg-light">
                                                @php
                                                    $na = $items->avg('nilai');
                                                    $naSemester = $items->sum('test')+$items->sum('non_test');
                                                    $naSemesterAvg = $naSemester/2;

                                                    $nilaiRaport = $na+$naSemesterAvg;
                                                    $nilaiRaportFinal = $nilaiRaport/2;
                                                @endphp
                                                {{number_format($nilaiRaportFinal, 2)}}
                                            </th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </thead>
                            </table>
                        </div>
                        @endif

                    @endif

                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail TP</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="fst-italic">{{$detailTp}}</span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalNickName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nama Panggilan {{$nickName}} </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-describedby="button-addon2" wire:model.lazy="name">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" wire:click="changeNickName()">
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            </span>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalTp', function () {
                $('#modalTp').modal('show')
            }); //membuka modal
            Livewire.on('modaNickName', function () {
                $('#modaNickName').modal('show')
            }); //membuka modal
            Livewire.on('modalNickName', function () {
                $('#modalNickName').modal('show')
            }); //membuka modal

            Livewire.on('closeModal', function () {
                $('#modalNickName').modal('hide')
            }); //membuka modal


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


