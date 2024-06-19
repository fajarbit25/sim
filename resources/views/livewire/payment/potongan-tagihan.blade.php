<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                <a href="javascript:void(0)" wire:click="modalAdd"><i class="bi bi-plus"></i></a>
                Data Potongan Tagihan
            </h3>

            <div class="col-sm-12 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis</th>
                            <th>Total Potongan</th>
                            <th>Keterangan</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($result)
                        @foreach ($result as $item)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$item->jenis_discount}} </td>
                            <td> Rp.{{number_format($item->total_discount)}},- </td>
                            <td> {{$item->deskripsi}} </td>
                            <td>
                                <a href="javascript:void(0)" class="text-danger" wire:click="modalDelete({{$item->id}})"><i class="bi bi-trash"></i></a>
                                <a href="javascript:void(0)" class="text-success" wire:click="editData({{$item->id}})"><i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">{{$result->links()}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group mb-3">
                            <label for="jenis">Jenis Potongan <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control @error('jenis') is-invalid @enderror" wire:model="jenis">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group mb-3">
                            <label for="totalDiscount">Total Potongan<span class="text-danger">*</span> </label>
                            {{-- <input type="number" class="form-control @error('totalDiscount') is-invalid @enderror" wire:model="totalDiscount"> --}}
                            <div class="input-group mb-3">
                                <input type="number" class="form-control @error('totalDiscount') is-invalid @enderror" wire:model="totalDiscount" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"> Rp.{{number_format((float)$totalDiscount)}},- </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group mb-3">
                            <label for="deskripsi">Keterangan </label>
                            <textarea rows="2" class="form-control @error('deskripsi') is-invalid @enderror" wire:model="deskripsi"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                @if($idEdit == "")
                <button type="button" class="btn btn-primary" wire:click="saveDiscount()">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                    Simpan
                </button>
                @else 
                <button type="button" class="btn btn-primary" wire:click="update()">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                    Simpan
                </button>
                @endif
            </div>
        </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-7">
                        Yakin ingin menghapus?
                    </div>
                    <div class="col-5">
                        <button type="button" class="btn btn-danger" wire:click="delete()">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                            Hapus
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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