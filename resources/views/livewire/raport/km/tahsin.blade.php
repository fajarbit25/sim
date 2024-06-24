<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                        Raport Tahsin
                    </h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="input-1"><i class="bi bi-calendar2-date"></i></label>
                                <select class="form-select" id="input-1" wire:model="ta">
                                  <option value="">-Pilih Tahun Ajaran...</option>
                                  @foreach ($dataSemester as $item)   
                                    <option value="{{$item->tahun_ajaran}}">{{$item->tahun_ajaran}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="input-1"><i class="bi bi-graph-up-arrow"></i></label>
                                <select class="form-select" id="input-1" wire:model="semester">
                                  <option value="">-Pilih Semester...</option>
                                  <option value="1">Ganjil</option>
                                  <option value="2">Genap</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="input-1"><i class="bi bi-option"></i></label>
                                <select class="form-select" id="input-1" wire:model="jenis">
                                  <option value="">-Pilih Jenis Penilaian...</option>
                                  <option value="PH">PH</option>
                                  <option value="PTS">PTS</option>
                                  <option value="PAS">PAS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="input-1"><i class="bi bi-house-door"></i></label>
                                <select class="form-select" id="input-1" wire:model="kelas">
                                  <option value="">-Pilih Kelas...</option>
                                  @foreach($dataKelas as $item)
                                    <option value="{{$item->idkelas}}">{{'Kelas '.$item->tingkat. ' '.$item->kode_kelas}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        @if($ta && $semester && $kelas)
                        <div class="col-sm-12 text-end mb-3">
                            @if($dataNilai)
                            @if($dataNilai->count() == 0)
                            <button type="button" class="btn btn-primary btn-sm" wire:click="modalKd()"><i class="bi bi-clipboard-data-fill"></i> Kompetensi Dasar</button>
                            <button type="button" class="btn btn-success btn-sm" wire:click="createForm()"><i class="bi bi-clipboard2-plus-fill"></i> Buat Form Penilaian</button>
                            @endif
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        Tabel Penilaian
                    </h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Nama</th>
                                    @if($dataNilai)
                                    <th colspan="{{$dataKd->count()}}" class="text-center">
                                        @if($jenis == 'PH') PENILAIAN HARIAN (PH)
                                        @elseif($jenis == 'PTS') PENILAIAN TENGAH SEMESTER (PTS)
                                        @elseif($jenis == 'PAS') PENILAIAN AKHIR SEMESTER (PAS)
                                        @endif
                                    </th>
                                    @endif
                                    <th rowspan="2" class="text-center">Rata-Rata <br/> (PH)</th>
                                    <th rowspan="2" class="text-center bg-light">NA</th>
                                    <th rowspan="2" class="text-center">Cetak</th>

                                </tr>
                                <tr>
                                    @if($dataNilai)
                                    @foreach($dataNilai->groupBy('kd_id') as $kd_id => $items)
                                    <th> {{$items->first()->arabic}} </th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if($dataNilai)
                                @foreach($dataNilai->groupBy('id') as $userid => $items)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$items->first()->first_name}} </td>
                                    @foreach($items as $item)
                                    <td>
                                        <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                            {{$item->nilai}}
                                         </a>
                                         <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                             <div class="col-sm-12" style="padding-left: 10px; padding-right:10px; max-width:200px;">
                                                 <div class="input-group">
                                                     <input type="text" class="form-control @error('nilai') is-invalid @endif" aria-describedby="button-addon2" wire:model.lazy="nilai">
                                                     <button class="btn btn-outline-secondary" type="button" id="button-addon2" wire:loading.attr="disabled" wire:click="updateNilai('{{$item->id_nilai}}')">
                                                         <i class="bi bi-check"></i>
                                                     </button>
                                                 </div>
                                             </div>
                                         </ul>
                                    </td>
                                    @endforeach
                                    <th class="text-center"> {{number_format($items->avg('nilai'))}} </th>
                                    <th class="text-center bg-light">
                                        @php
                                            $na = $dataNilaiAkhir->where('id', $userid)->avg('nilai');
                                        @endphp
                                        {{number_format($na)}}
                                    </th>
                                    <td class="text-center">
                                        <a href="" class="text-warning" target="_blank"><i class="bi bi-printer-fill"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                <td colspan="5">Belum Ada Data!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($ta && $semester && $kelas)
    <!-- Modal -->
    <div class="modal fade" id="modalKd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kompetensi Dasar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="kode">Kode <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control @error('kode') is-invalid @enderror" wire:model="kode">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="bahasa"> KD - Bahasa <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control @error('bahasa') is-invalid @enderror" wire:model="bahasa">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="arabic">KD - Arabic <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control @error('arabic') is-invalid @enderror" wire:model="arabic">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <br/>
                                    @if($idEditKd == '0')
                                   <button type="button" class="btn btn-primary" wire:click="saveKd">
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                                    Simpan
                                   </button>
                                   @else
                                   <button type="button" class="btn btn-success" wire:click="updateKd">
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                                    Update
                                   </button>
                                   @endif
                                </div>
                            </div>
                            @if($idDeleteKd != '0')
                                <div class="col-sm-12 mt-3">
                                    <div class="alert alert-secondary">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <span class="fw-bold">Alert!. </span>
                                                <span>Yakin ingin menghapus KD "{{$kode.' - '.$bahasa.' / '.$arabic}}"</span>
                                            </div>
                                            <div class="col-sm-2 text-end">
                                                <button type="button" class="btn btn-danger btn-sm" wire:click="destroyKd()">
                                                    Hapus
                                                </button>
                                                <button type="button" class="btn btn-secondary btn-sm" wire:click="cancelDestroyKd()">
                                                    Batal
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-5">
                        <hr/>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>KD - Bahasa</th>
                                    <th>KD - Arabic</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($dataKd)
                                @foreach($dataKd as $item)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$item->kode}} </td>
                                    <td> {{$item->bahasa}} </td>
                                    <td> {{$item->arabic}} </td>
                                    <td>
                                        <a href="javascript:void(0)" class="text-danger" wire:click="confirmDeleteKd({{$item->id}})"> <i class="bi bi-x-lg"></i> </a>
                                        &nbsp;
                                        <a href="javascript:void(0)" class="text-success" wire:click="editKd({{$item->id}})"> <i class="bi bi-pencil-square"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
        </div>
    </div>
    @endif

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalKd', function () {
                $('#modalKd').modal('show')
            }); //membuka modal

            Livewire.on('closeModal', function () {
                $('#modalKd').modal('hide')
            }); //menutup modal

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