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
    <div class="modal fade" id="modalEditDiklat" wire:ignore.self 
    tabindex="-1" aria-labelledby="modalEditDiklatLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="updateDiklat">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditDiklatLabel">Edit Diklat</h1>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                
                    <div class="form-group mb-3 col-sm-6">
                        <label for="jenis"> Jenis Diklat <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" 
                        name="jenis" wire:model="jenis">
                        @error('jenis')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="nama"> Nama Diklat <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                        name="nama" wire:model="nama">
                        @error('nama')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="penyelenggara"> Penyelenggara <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" 
                        name="penyelenggara" wire:model="penyelenggara">
                        @error('penyelenggara')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="tahun"> Tahun <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('tahun') is-invalid @enderror" 
                        name="tahun" wire:model="tahun">
                        @error('tahun')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="peran"> Peran <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('peran') is-invalid @enderror" 
                        name="peran" wire:model="peran">
                        @error('peran')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="tingkat"> Tingkat <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('tingkat') is-invalid @enderror" 
                        name="tingkat" wire:model="tingkat">
                        @error('tingkat')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="berapa_jam"> Berapa Jam <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('berapa_jam') is-invalid @enderror" 
                        name="berapa_jam" wire:model="berapa_jam">
                        @error('berapa_jam')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="sertifikat_diklat"> Sertifikat Diklat <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('sertifikat_diklat') is-invalid @enderror" 
                        name="sertifikat_diklat" wire:model="sertifikat_diklat">
                        @error('sertifikat_diklat')
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

                Livewire.on('editDiklat', function () {
                    $('#modalEditDiklat').modal('show')
                }); //Membuka modal Edit

                Livewire.on('closeModal', function () {
                    $('#modalEditDiklat').modal('hide')
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



