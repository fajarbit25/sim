<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title"> Database Surah </h3>
                        </div>
                        <div class="col-sm-6 p-3 text-end">
                            <a href="/raport/raport-tahfidz" class="btn btn-secondary btn-sm" wire:click="modalAdd"><i class="bi bi-arrow-left-short"></i> Kembali </a>
                            <button type="button" class="btn btn-success btn-sm" wire:click="modalAdd"><i class="bi bi-plus"></i> New Surah </button>
                        </div>
                        <div class="col-sm-12 my-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Bahasa</th>
                                        <th>Arabic</th>
                                        <th>Jumlah Ayat</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($data)
                                    @foreach($data as $item)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$item->kode}} </td>
                                        <td> {{$item->bahasa}} </td>
                                        <td> {{$item->arab}} </td>
                                        <td> {{$item->ayat}} </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-xs" wire:click="modalEdit({{$item->id}})"> <i class="bi bi-pencil-square"></i> </button>
                                            <button type="button" class="btn btn-danger btn-xs" wire:click="modalDelete({{$item->id}})"> <i class="bi bi-trash"></i> </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6">{{$data->links()}}</td>
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


    <!-- Modal -->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Surah</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="kode"> Kode <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control @error('kode') is-invalid @enderror" wire:model="kode">
                            @error('kode')<div class="error text-danger">{{$message}}</div>@enderror
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="ayat"> Jumlah Ayat <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control @error('ayat') is-invalid @enderror" wire:model="ayat">
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="bahasa"> Bahasa Indonesia <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control @error('bahasa') is-invalid @enderror" wire:model="bahasa">
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="arabic"> Bahasa Arab <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control @error('arabic') is-invalid @enderror" wire:model="arabic">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

            @if($idEdit == 0)
            <button type="button" class="btn btn-primary" wire:click="create">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                Simpan
            </button> 
            @else
            <button type="button" class="btn btn-success" wire:click="update">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                Update
            </button> 
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="row">
                    <div class="col-8">
                        <span class="fw-bold fst-italic">Yakin ingin menghapus?</span>
                    </div>
               
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-danger" wire:click="delete">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
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