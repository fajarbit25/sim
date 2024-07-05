<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Database RPPM Diniyah</h3>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><a href="javascript:void(0)" wire:click="modalMateri"> <i class="bi bi-plus-lg"></i> </a> Materi</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th colspan="2">Materi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dataMateri as $item)
                                                @if($item->id == $isActive)
                                                <tr>
                                                    <th> {{$loop->iteration}} </th>
                                                    <th> {{$item->materi}} </th>
                                                    <th>
                                                        <a href="javascript:void(0)" class="fw-bold" wire:click="selectedMateri({{$item->id}})">
                                                            <i class="bi bi-chevron-compact-right"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td> {{$loop->iteration}} </td>
                                                    <td> {{$item->materi}} </td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="fw-bold" wire:click="selectedMateri({{$item->id}})">
                                                            <i class="bi bi-chevron-compact-right"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"> <a href="javascript:void(0)" wire:click="modalKegiatan"> <i class="bi bi-plus-lg"></i> </a> Kegiatan</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Materi</th>
                                                    <th>Kegiatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($isActive != 0)
                                                @foreach($dataKegiatan as $item)
                                                <tr>
                                                    <td> {{$loop->iteration}} </td>
                                                    <td> {{$item->materi}} </td>
                                                    <td> {{$item->kegiatan}} </td>
                                                </tr>
                                                @endforeach
                                                @else 
                                                <tr>
                                                    <td colspan="3"> Pilih salah satu materi disamping! </td>
                                                </tr>
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
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalMateri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Materi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputMateri">Materi <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('inputMateri') is-invalid @enderror" wire:model="inputMateri"/>
                    @error('inputMateri') <div class="error text-danger"> <span class="fw-bold text-danger">{{$message}}</span></div> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click="saveMateri">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                    Simpan
                </button>
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
                    <label for="inputKegiatan">Kegiatan <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('inputKegiatan') is-invalid @enderror" wire:model="inputKegiatan"/>
                    @error('inputKegiatan') <div class="error text-danger"> <span class="fw-bold text-danger">{{$message}}</span></div> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click="saveKegiatan">
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

                Livewire.on('modalMateri', function () {
                    $('#modalMateri').modal('show')
                }); //Membuka modal Edit
                Livewire.on('modalKegiatan', function () {
                    $('#modalKegiatan').modal('show')
                }); //Membuka modal Edit

                Livewire.on('closeModal', function () {
                    $("#modalMateri").modal('hide')
                    $('#modalKegiatan').modal('hide')
                } );

            });
        </script>
    @endpush

</div>
