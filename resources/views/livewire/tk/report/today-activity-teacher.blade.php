<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Laporan Harian | <span>{{date('d-M-Y')}}</span> </h3>

                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Kelompok</label>
                                <select class="form-select @error('kelas') is-invalid @enderror" id="inputGroupSelect01" wire:model="kelas" wire:change="loadAll">
                                  <option value="">Pilik Kelompok...</option>
                                  @foreach($dataKelas as $item)
                                  <option value="{{$item->idkelas}}">{{$item->tingkat.' '.$item->kode_kelas}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        @if($kelas)
                        <div class="col-sm-12">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" wire:model="mode" value="1" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="btnradio1"><i class="bi bi-eye"></i> View</label>
                              
                                <input type="radio" class="btn-check" wire:model="mode" value="2" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2"><i class="bi bi-pencil-square"></i> Form</label>

                                <input type="radio" class="btn-check" wire:model="mode" value="3" id="btnradio3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio3"><i class="bi bi-card-image"></i> Foto</label>
                              </div>
                        </div>
                        @endif
                    </div>
                    @if($mode == 2)
                    <div class="row">

                        <div class="col-sm-12 mt-3">
                            <span class="fw-bold">Laporan</span>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="topik">Topik <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('topik') is-invalid @enderror" wire:model.lazy="topik">
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="subtopik">Sub Topik <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('subtopik') is-invalid @enderror" wire:model.lazy="subtopik">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="menghafal">Menghafal Surah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('menghafal') is-invalid @enderror" wire:model.lazy="menghafal">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="menulis">Menulis Huruf Latin <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('menulis') is-invalid @enderror" wire:model.lazy="menulis">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="murojaah">Murojaah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('murojaah') is-invalid @enderror" wire:model.lazy="murojaah">
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="sentra">Sentra <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('sentra') is-invalid @enderror" wire:model.lazy="sentra">
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="subsentra">Sub Sentra <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('subsentra') is-invalid @enderror" wire:model.lazy="subsentra">
                            </div>
                        </div>

                        <div class="col-sm-12 mb-3">
                            <button type="button" class="btn btn-warning btn-sm" wire:click="modalKegiatan"><i class="bi bi-clipboard-plus"></i> Kegiatan</button>
                            <br/>
                            @foreach($dataKegiatan as $item)
                            <span class="fw-bold fst-italic text-success">- {{$item->deskripsi}}</span> 
                            <a href="javascript:void(0)" class="text-danger" wire:click="removeKegiatan({{$item->id}})"> 
                                &nbsp; &nbsp;<i class="bi bi-x-lg"></i> Remove
                            </a> <br/>
                            @endforeach
                        </div>

                        <div class="col-sm-12">
                            <span class="fw-bold">Kota Kata</span>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="bahasa">Bahasa Indonesia : <span class="text-danger">*</span> {{$bahasa}} </label>
                                <input type="text" class="form-control @error('bahasa') is-invalid @enderror" wire:model.lazy="bahasa">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="inggris">Bahasa Inggris : <span class="text-danger">*</span> {{$inggris}}</label>
                                <input type="text" class="form-control @error('inggris') is-invalid @enderror" wire:model.lazy="inggris">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="arab">Bahasa Arab <span class="text-danger">*</span> {{$arab}}</label>
                                <input type="text" class="form-control @error('arab') is-invalid @enderror" wire:model.lazy="arab">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <input type="checkbox" value="1" name="check" wire:model="check"> <span class="">Simpan semua perubahan</span>
                        </div>
                        <div class="col-sm-6 text-end">
                            <button type="button" class="btn btn-primary" wire:click="simpanReport">
                                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                                Simpan
                            </button>
                        </div>
                    </div>
                    @endif
                    @if($kelas)
                        @if($mode == 1)
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="row">
                                    @foreach($dataFoto as $item)
                                    <div class="col-sm-3 mb-2">
                                        <img src="{{asset('/storage/tk-daily/'.$item->foto)}}" alt="foto" style="width: 100%; height:150px;">
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <span class="fw-bold">Topik :</span> <span>{{$topik}}</span>
                            </div>
                            <div class="col-sm-12">
                                <span class="fw-bold">Sub Topik :</span> <span>{{$subtopik}}</span>
                            </div>
                            <div class="col-sm-12">
                                <span>-Menghafal Surah {{$menghafal}}</span>
                            </div>
                            <div class="col-sm-12">
                                <span>-Menulis Huruf Latin {{$menulis}}</span>
                            </div>
                            <div class="col-sm-12">
                                <span>-Murojaah {{$murojaah}}</span>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <span class="fw-bold">Sentra :</span> <span>{{$sentra}}</span>
                            </div>
                            <div class="col-sm-12">
                                <span class="fw-bold">Sub Sentra :</span> <span>{{$subsentra}}</span>
                            </div>
                            <div class="col-sm-12">
                                <span class="fw-bold">Kegiatan :</span>
                            </div>
                            @foreach($dataKegiatan as $item)
                            <div class="col-sm-12">
                                <span>- {{$item->deskripsi}}</span>
                            </div>
                            @endforeach
                            <div class="col-sm-12 mt-3">
                                <span class="fw-bold">Kosa Kata :</span>
                            </div>
                            <div class="col-sm-12">
                                <span>- Bahasa Indonesia : {{$bahasa}} </span>
                            </div>
                            <div class="col-sm-12">
                                <span>- Bahasa Inggris : {{$inggris}}</span>
                            </div>
                            <div class="col-sm-12">
                                <span>- Bahasa Arab :  {{$arab}} </span>
                            </div>
                        </div>    
                        @endif
                    @endif

                    @if($kelas)
                        @if($mode == 3)
                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <span class="fw-bold">Foto Kegiatan</span>
                                </div>
                                @error('photo')
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger">
                                            <div class="error">{{ $message }}</div>
                                        </div>
                                    </div>
                                @enderror
                                <div class="col-sm-12">
                                    <form wire:submit.prevent="savePhoto">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" wire:model="photo">
                                            <button class="btn btn-danger" type="submit" id="button-addon2">
                                                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                                                Upload
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12">
                                    @foreach($dataFoto as $item)
                                    <a href="javascript:void(0)">
                                        <i class="bi bi-card-image"></i> <span class="fw-bold fst-italic">{{$item->foto}}</span>
                                    </a>
                                    <a href="javascript:void(0)" class="text-danger" wire:click="deletePhoto({{$item->id}})"> <i class="bi bi-x-lg"></i> Hapus </a>
                                    <br/>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif

                </div>
            </div>    
        </div> 

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Riwayat Laporan</span> </h3>

                    <ol class="list-group list-group-numbered">

                        @foreach($history as $item)
                        <a href="javascript:void(0)" wire:click="detailHistory({{$item->id}})">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{$loop->iteration}}. Kelompok: {{$item->tingkat.' '.$item->kode_kelas}}</div>
                                </div>
                                <span class="badge text-bg-secondary rounded-pill">
                                    {{$item->tanggal}}
                                </span>
                            </li>
                        </a>
                        @endforeach

                    </ol>

                </div>
            </div>    
        </div> 
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalKegiatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kegiatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kegiatan"> Kegiatan <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" wire:model="kegiatan">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" wire:click="saveKegiatan">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                    Tambahkan
                </button>
            </div>
        </div>
        </div>
    </div>

    @if($detailHistory)
    <!-- Modal -->
    <div class="modal fade" id="modalHistory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Riwayat Kegiatan Tanggal {{$detailHistory->tanggal}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($subRaportFoto as $item)
                    <div class="col-3 mb-3">
                        <img src="{{asset('/storage/tk-daily/'.$item->foto)}}" alt="foto" style="width: 100%; height:150px;">
                    </div>
                    @endforeach
                    <div class="col-sm-12">
                        <span class="fw-bold">Topik : </span> <span>{{$detailHistory->topik}}</span><br/>
                        <span class="fw-bold">Sub Topik : </span> <span>{{$detailHistory->subtopik}}</span><br/>
                        <span>- Menghafal Surah {{$detailHistory->menghafal}}</span><br/>
                        <span>- Menulis Huruf Latin {{$detailHistory->menulis}}</span><br/>
                        <span>- Murojaah {{$detailHistory->murojaah}}</span><br/> 
                        <br/>
                        <span class="fw-bold">Sentra : </span> <span>{{$detailHistory->sentra}}</span><br/>
                        <span class="fw-bold">Sub Sentra : </span> <span>{{$detailHistory->subsentra}}</span><br/>
                        <span class="fw-bold">Kegiatan : </span><br/>
                        @foreach($subRaportKegiatan as $item)
                            <div class="col-sm-12">
                                <span>- {{$item->deskripsi}}</span>
                            </div>
                        @endforeach
                        <br/>
                        <span class="fw-bold">Kosa Kata : </span><br/>
                        <span>- Bahasa Indonesia : {{$detailHistory->bahasa}}</span><br/>
                        <span>- Bahasa Inggris :  {{$detailHistory->menulis}}</span><br/>
                        <span>- Bahasa Arab : {{$detailHistory->arab}}</span><br/>
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

            Livewire.on('modalKegiatan', function () {
                $('#modalKegiatan').modal('show')
            }); //membuka modal
            Livewire.on('openModalHistory', function () {
                $("#modalHistory").modal('show');
            } );

            Livewire.on('closeModal', function () {
                $('#modalKegiatan').modal('hide')
                $("#modalHistory").modal('hide');
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
