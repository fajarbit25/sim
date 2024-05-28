<div class="col-sm-12 row">

    <div class="col-sm-12 my-4">
        <h5 class="text-success">Anak</h5>
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
    <div class="modal fade" id="modalCreateAnak" wire:ignore.self 
    tabindex="-1" aria-labelledby="modalCreateAnakLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="createAnak">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateAnakLabel">Tambah Data Anak</h1>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                
                    <div class="form-group mb-3 col-sm-6">
                        <label for="nama"> Nama <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                        name="nama" wire:model="nama">
                        @error('nama')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="status"> Status <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('status') is-invalid @enderror" 
                        name="status" wire:model="status">
                        @error('status')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="jenjang_pendidikan"> Jenjang Pendidikan  </label>
                        <input type="text" class="form-control @error('jenjang_pendidikan') is-invalid @enderror" 
                        name="jenjang_pendidikan" wire:model="jenjang_pendidikan">
                        @error('jenjang_pendidikan')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="nisn"> NISN  </label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" 
                        name="nisn" wire:model="nisn">
                        @error('nisn')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="gender"> Jenis Kelamin <span class="text-danger">*</span> </label>
                        <select name="gender" class="form-control @error('gender') is-invalid @enderror"
                        wire:model="gender">
                            <option value="">--Pilih--</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="tempat_lahir"> Tempat Lahir <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                        name="tempat_lahir" wire:model="tempat_lahir">
                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="tanggal_lahir"> Tanggal Lahir <span class="text-danger">*</span> </label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                        name="tanggal_lahir" wire:model="tanggal_lahir">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="tahun_masuk"> Tahun Masuk <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('tahun_masuk') is-invalid @enderror" 
                        name="tahun_masuk" wire:model="tahun_masuk">
                        @error('tahun_masuk')
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

                Livewire.on('createAnak', function () {
                    $('#modalCreateAnak').modal('show')
                }); //Membuka modal create

                Livewire.on('closeModal', function () {
                    $('#modalCreateAnak').modal('hide')
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

