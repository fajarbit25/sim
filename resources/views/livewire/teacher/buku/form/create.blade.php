<div class="col-sm-12 row">

    <div class="col-sm-12 my-4">
        <h5 class="text-success">Buku Yang Pernah Ditulis</h5>
        <button type="button" class="btn btn-success btn-sm" wire:click="create">
            <i class="bi bi-plus-lg"></i> Tambah Data
        </button>
    </div>

    <div class="col-sm-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> {{ session('message') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="modalCreateBuku" wire:ignore.self 
    tabindex="-1" aria-labelledby="modalCreateBukuLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form wire:submit.prevent="storeBuku">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateBukuLabel">Tambah Data Buku</h1>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                
                    <div class="form-group mb-3 col-sm-12">
                        <label for="judul"> Judul Buku <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                        name="judul" wire:model="judul">
                        @error('judul')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-12">
                        <label for="tahun"> Tahun <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('tahun') is-invalid @enderror" 
                        name="tahun" wire:model="tahun">
                        @error('tahun')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-12">
                        <label for="penerbit"> Penerbit <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                        name="penerbit" wire:model="penerbit">
                        @error('penerbit')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-12">
                        <label for="isbn"> ISBN <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                        name="isbn" wire:model="isbn">
                        @error('isbn')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">Close</button>

                <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" wire:click="AnimatedButton">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Simpan
                </button>
            </div>
            </form>
        </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {

                Livewire.on('createBuku', function () {
                    $('#modalCreateBuku').modal('show')
                }); //Membuka modal create

                Livewire.on('closeModal', function () {
                    $('#modalCreateBuku').modal('hide')
                }); //Menutup modal create
            });
        </script>
    @endpush


    @if (session()->has('message'))
        <!-- Flash Mesege -->
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: "{{ session('message') }}",
            });
        </script>
        <!--/End Flash Mesege -->
    @endif
</div>

