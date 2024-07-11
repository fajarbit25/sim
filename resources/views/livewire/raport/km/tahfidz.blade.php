<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h3 class="card-title"> Penilaian Tahfidz </h3>

                        <div class="col-sm-12">
                            <div class="input-group">
                                <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" wire:model="kelas">
                                  <option value="">Pilih Kelas...</option>
                                  @if($dataKelas)
                                  @foreach($dataKelas as $item)
                                    <option value="{{$item->idkelas}}"> {{$item->tingkat.' '.$item->kode_kelas}} </option>
                                  @endforeach
                                  @endif
                                </select>
                                <button class="btn btn-primary" type="button" wire:click="generate" > <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>  Generate</button>
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
                        <div class="col-sm-8">
                            <h3 class="card-title"> Tabel Penilaian </h3>
                        </div>
                        <div class="col-sm-4 p-3 text-end">
                            @if($kelas)
                            <button type="button" class="btn btn-success btn-sm" wire:click="modalSurah"><i class="bi bi-plus"></i> Objek Penilaian </button>
                            @endif
                            <a href="/raport/tahfidz/database" class="text-primary"> <i class="bi bi-database-fill-add"></i> Database Surah </a>
                        </div>

                        @if($dataNilai)
                            @if($dataNilai->count() == 0)
                                <div class="col-sm-12">
                                    <span class="fw-bold fst-italic"> Belum ada data penilaian silahkan <a href="javascript:void(0)" class="text-success" wire:click="generate"> <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Generate <span wire:loading>....</span>,</a> untuk membuat form  </span>
                                </div>
                            @else
                                <div class="col-sm-12 table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="text-center bg-light pb-4">No</th>
                                                <th rowspan="2" class="text-center bg-light pb-4">NISN</th>
                                                <th rowspan="2" class="bg-light pb-4">Nama Lengkap</th>
                                                <th rowspan="2" class="bg-light pb-4">Panggilan</th>
                                                <th colspan="{{$dataNilai->groupBy('bahasa')->count()}}" class="bg-light">Surah</th>
                                                <th rowspan="2" class="text-center bg-light pb-4">Rata-Rata</th>
                                                <th rowspan="2" class="bg-light pb-4">Saran</th>
                                                <th rowspan="2" class="bg-light pb-4"> Cetak </th>
                                            </tr>
                                            <tr>
                                                @foreach($dataNilai->groupBy('arab') as $arab => $item)
                                                    <th class="bg-light"> {{$arab}} </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dataNilai->groupBy('user_id') as $iduser => $items)
                                            <tr>
                                                <th class="text-center"> {{$loop->iteration}} </th>
                                                <th class="text-center"> {{$items->first()->nisn}} </th>
                                                <td> {{$items->first()->name}} </td>
                                                <td>
                                                    @if($items->first()->nick_name == null)
                                                    <a href="javascript:void(0)" class="text-success fst-italic" wire:click="modalNickName({{$iduser}})">
                                                        <i class="bi bi-pencil"></i> Input Nama
                                                    </a>
                                                    @else 
                                                    <a href="javascript:void(0)"  wire:click="modalNickName({{$iduser}})">
                                                        {{$items->first()->nick_name}} 
                                                    </a>
                                                    @endif
                                                </td>

                                                @foreach($items as $item)
                                                    <td class="text-center">
                                                        <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                                            {{$item->nilai}}
                                                         </a>
                                                         <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                             <div class="col-sm-12" style="padding-left: 10px; padding-right:10px; max-width:200px;">
                                                                 <div class="input-group">
                                                                     <input type="text" class="form-control @error('nilai') is-invalid @endif" aria-describedby="button-addon2" wire:model.lazy="nilai">
                                                                     <button class="btn btn-outline-secondary" type="button" id="button-addon2" wire:loading.attr="disabled" wire:click="updateNilai('{{$item->id}}')">
                                                                         <i class="bi bi-check"></i>
                                                                     </button>
                                                                 </div>
                                                             </div>
                                                         </ul>
                                                    </td>
                                                @endforeach

                                                <th class="text-center bg-light">
                                                    {{number_format($items->avg('nilai'))}}
                                                </th>
                                                <td style="white-space: nowrap;">
                                                    <span class="fst-italic" style="font-size: 12px;">
                                                        @foreach($dataSaran->where('user_id', $iduser) as $saran)
                                                            <a href="javascript:void(0)" wire:click="modalSaran({{$saran->id}})">
                                                                {{substr($saran->catatan, 0, 20)}}...
                                                            </a>
                                                        @endforeach
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-warning"><i class="bi bi-printer-fill"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endif

                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalSurah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Surah Untuk Kelas {{$tingkat}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="d-inline-flex gap-1">
                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="bi bi-plus-lg"></i> Tambah Surah
                            </button>
                        </p>
                        <div class="collapse p-3" id="collapseExample" wire:ignore.self>
                            <div class="card card-body">
                                <div class="col-sm-12 my-3">
                                    <input type="search" class="form-control" placeholder="Cari nama surah.." wire:model="key">
                                </div>
                                <div class="col-sm-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Surah</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($dataSurah)
                                            @foreach($dataSurah as $item)
                                            <tr>
                                                <td> {{$item->kode}} </td>
                                                <td> {{$item->bahasa.' / '.$item->arab}} </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs" wire:click="addSurah({{$item->id}})"><i class="bi bi-arrow-right"></i></button>
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
                    <div class="col-sm-6">
                        <span class="fw-bold mb-3">Surah Aktif</span>
                        <div class="row">
                            @if($dataObject)
                                @foreach($dataObject as $item)
                                <div class="col-sm-3">
                                    <div class="alert alert-secondary alert-dismissible fade show p-1" role="alert">
                                        <span>{{$item->bahasa}}</span>
                                        <button type="button" class="btn-close p-2" wire:click="deleteOject({{$item->id}})"
                                        style="margin-top:0;" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalNickName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nama Panggilan Untuk {{$namaLengkap}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="nickName">Masukan Nama Penggilan <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('nickName') is-invalid @enderror" wire:model="nickName">
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" wire:click="updateNickName">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                    Simpan
                </button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalSaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Catatan Guru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="saran">Masukan Catatan <span class="text-danger">*</span> </label>
                    <textarea class="form-control @error('saran') is-invalid @enderror" rows="5" wire:model="saran"></textarea>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" wire:click="updateSaran">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                    Simpan
                </button>
            </div>
        </div>
        </div>
    </div>


  @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalSurah', function () {
                $('#modalSurah').modal('show')
            });

            Livewire.on('modalNickName', function () {
                $("#modalNickName").modal('show')
            });

            Livewire.on('modalSaran', function () {
                $("#modalSaran").modal('show')
            });

            Livewire.on('closeModal', function () {
                $('#modalSurah').modal('hide')
                $("#modalNickName").modal('hide')
                $("#modalSaran").modal('hide')
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
