<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
            <h3 class="card-title"> <a href="javascript:void(0)" wire:click="modalPredikat()"><i class="bi bi-plus"></i></a> PREDIKAT CAPAIAN KOMPETENSI</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Rentang</th>
                    <th>Deskripsi</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @if($dataCapaian)
                @foreach ($dataCapaian as $item)
                <tr>
                    <td> {{$loop->iteration}} </td>
                    <th> {{$item->nilai_min. ' - '.$item->nilai_max}} </th>
                    <td> {{$item->deskripsi}} </td>
                    <td>
                        <a href="javascript:void(0)" class="text-danger" wire:click="confirmDelete({{$item->id}})"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
            <h3 class="card-title"> <a href="javascript:void(0)" wire:click="modalPredikatNilai()"><i class="bi bi-plus"></i></a> PREDIKAT NILAI </h3>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Rentang</th>
                    <th>Deskripsi</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @if($dataPredikat)
                @foreach($dataPredikat as $item)
                <tr>
                    <td> {{$loop->iteration}} </td>
                    <th> {{$item->nilai_min.' - '.$item->nilai_max}} </th>
                    <td> {{$item->deskripsi}} </td>
                    <td>
                        <a href="javascript:void(0)" class="text-danger" wire:click="confirmDelete({{$item->id}})"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalPredikat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Predikat Capaian Kompetensi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="min">Nilai Minimal <span class="text-danger">*</span> </label>
                            <input type="number" name="min" id="min" class="form-control" wire:model="min"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="max">Nilai Maksimal <span class="text-danger">*</span> </label>
                            <input type="number" name="max" id="max" class="form-control" wire:model="max"/>
                        </div>
                    </div>
                    <div class="col-sm-12 my-3">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi <span class="text-danger">*</span> </label>
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control" wire:model="deskripsi"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click="savePredikatCapaian()">
                   <span wire:loading><span class="spinner-border spinner-border-sm" aria-hidden="true"></span></span> 
                    Simpan
                </button>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modalPredikatNilai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Predikat Nilai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="min_nilai">Nilai min_nilaiimal <span class="text-danger">*</span> </label>
                            <input type="number" name="min_nilai" id="min_nilai" class="form-control" wire:model="min_nilai"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="max_nilai">Nilai Maksimal <span class="text-danger">*</span> </label>
                            <input type="number" name="max_nilai" id="max_nilai" class="form-control" wire:model="max_nilai"/>
                        </div>
                    </div>
                    <div class="col-sm-12 my-3">
                        <div class="form-group">
                            <label for="predikat">Predikat <span class="text-danger">*</span> </label>
                            <select name="predikat" id="predikat" class="form-control" wire:model="predikat">
                                <option value="A">-Pilih Predikat..</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click="savePredikatNilai()">
                    <span wire:loading><span class="spinner-border spinner-border-sm" aria-hidden="true"></span></span>
                    Simpan
                </button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-7">
                        <span class="fw-bold fst-italic">Yakin ingin menghapus?</span>
                    </div>
                   <div class="col-sm-5">
                    <button type="button" class="btn btn-danger" wire:loading.attr="disabled" wire:click="delete()">
                        <span wire:loading><span class="spinner-border spinner-border-sm" aria-hidden="true"></span></span>
                        Hapus
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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

            Livewire.on('modalPredikat', function () {
                $('#modalPredikat').modal('show')
            }); //membuka modal

            Livewire.on('closeModalPredikat', function () {
                $("#modalPredikat").modal('hide');
            });

            Livewire.on('closeModalNilai', function () {
                $("#modalPredikatNilai").modal('hide');
            });

            Livewire.on('modalPredikatNilai', function () {
                $('#modalPredikatNilai').modal('show')
            }); //membuka modal

            Livewire.on('modalDelete', function () {
                $("#modalDelete").modal('show');
            });

            Livewire.on('closeModalDelete', function () {
                $("#modalDelete").modal('hide');
            });


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
