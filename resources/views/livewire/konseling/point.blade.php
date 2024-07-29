<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title">Point Tata Tertib</h3>
                        </div>
                        <div class="col-sm-6 pt-3 text-end">
                            @if($campus)
                            <button class="btn btn-success btn-sm" type="button" wire:click="modalAdd()"><i class="bi bi-plus-lg"></i> Tambah Data</button>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group">
                                <select class="form-select" wire:model="campus">
                                <option selected>Pilih Satuan Pendidikan...</option>
                                @foreach($dataCampus as $item)
                                <option value="{{$item->idcampus}}">{{$item->campus_name}}</option>
                                @endforeach
                                </select>
                                <button class="btn btn-primary" type="button"><span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Tampilkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Tabel Pelanggaran</div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th colspan="2">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($dataPelanggaran)
                                @foreach($dataPelanggaran as $items)
                                <tr>
                                    <td> {{$items->kode}} </td>
                                    <td> {{$items->pelanggaran}} </td>
                                    <td> {{$items->point}} </td>
                                    <td>
                                        <a href="javascript:void(0)" class="text-success" wire:click="edit({{$items->id}})"> <i class="bi bi-pencil-fill"></i> </a>
                                        <a href="javascript:void(0)" class="text-danger" wire:click="modalDelete({{$items->id}})"> <i class="bi bi-trash"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else 
                                <tr>
                                    <td colspan="4">Belum ada data!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 text-end">
                        @if($dataPelanggaran)
                        {{$dataPelanggaran->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">@if($idEdit) Edit @else Tambah @endif Tata Tertib</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="kode">Kode <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" wire:model.lazy="kode">
                    <div class="invalid-feedback">
                        @error('kode') {{$message}} @enderror
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="pelanggaran">Pelanggaran <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('pelanggaran') is-invalid @enderror" wire:model.lazy="pelanggaran">
                    <div class="invalid-feedback">
                        @error('pelanggaran') {{$message}} @enderror
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="point">Point <span class="text-danger">*</span> </label>
                    <input type="number" class="form-control @error('point') is-invalid @enderror" wire:model.lazy="point">
                    <div class="invalid-feedback">
                        @error('point') {{$message}} @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                @if($idEdit)
                <button type="button" class="btn btn-success" wire:click="update"><span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Update</button>
                @else
                <button type="button" class="btn btn-primary" wire:click="save"><span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Simpan</button>
                @endif
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        Yakin ingin menghapus?
                    </div>
                    <div class="col-sm-6 text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" wire:click="delete"><span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Hapus</button>
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

            Livewire.on('modalAdd', function () {
                $('#modalAdd').modal('show')
            }); //membuka modal

            Livewire.on('modalDelete', function () {
                $('#modalDelete').modal('show')
            }); //membuka modal


            Livewire.on('closeModal', function () {
                $('#modalAdd').modal('hide')
                $('#modalDelete').modal('hide')
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
