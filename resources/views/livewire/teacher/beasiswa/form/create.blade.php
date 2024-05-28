<div class="col-sm-12 row">

    <div class="col-sm-12 my-4">
        <h5 class="text-success">Beasiswa</h5>
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
    <div class="modal fade" id="modalCreateBeasiswa" wire:ignore.self 
    tabindex="-1" aria-labelledby="modalCreateBeasiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="storeBeasiswa">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateBeasiswaLabel">Tambah Data Beasiswa</h1>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                
                    <div class="form-group mb-3 col-sm-6">
                        <label for="jenis"> Jenis Beasiswa <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" 
                        name="jenis" wire:model="jenis">
                        @error('jenis')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="keterangan"> Keterangan <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                        name="keterangan" wire:model="keterangan">
                        @error('keterangan')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="tahun_mulai"> Tahun Mulai <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('tahun_mulai') is-invalid @enderror" 
                        name="tahun_mulai" wire:model="tahun_mulai">
                        @error('tahun_mulai')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="tahun_akhir"> Tahun Berakhir <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('tahun_akhir') is-invalid @enderror" 
                        name="tahun_akhir" wire:model="tahun_akhir">
                        @error('tahun_akhir')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="masih_menerima"> Masih Menerima <span class="text-danger">*</span> </label>
                        <select name="masih_menerima" class="form-control @error('masih_menerima') is-invalid @enderror"
                        wire:model="masih_menerima">
                            <option value="">--Pilih--</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                            <option value="Tidak Dapat Dipastikan">Tidak Dapat Dipastikan</option>
                        </select>
                        @error('masih_menerima')
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

                Livewire.on('createBeasiswa', function () {
                    $('#modalCreateBeasiswa').modal('show')
                }); //Membuka modal create

                Livewire.on('closeModal', function () {
                    $('#modalCreateBeasiswa').modal('hide')
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

