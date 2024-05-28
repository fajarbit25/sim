<div class="col-sm-12 row">

    <div class="col-sm-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> {{ session('message') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="modalEditBuku" wire:ignore.self 
    tabindex="-1" aria-labelledby="modalEditBukuLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form wire:submit.prevent="updateBuku">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditBukuLabel">Edit Data Buku</h1>
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

                Livewire.on('editBuku', function () {
                    $('#modalEditBuku').modal('show')
                }); //Membuka modal Edit

                Livewire.on('closeModal', function () {
                    $('#modalEditBuku').modal('hide')
                }); //Menutup modal Edit
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

