<div class="col-sm-12">
    <div class="col-sm-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> {{ session('message') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="col-sm-12 mt-3">
        <h5 class="text-success">Sertifikasi</h5>
        <button type="button" class="btn btn-success btn-sm" wire:click="create">
            <i class="bi bi-plus-lg"></i> Tambah Data
        </button>
    </div>

    <div class="col sm-12">
        @livewire('teacher.sertifikasi', ['user_id' => $user_id])
    </div>

  
    <!-- Modal Store -->
    <div class="modal fade" wire:ignore.self id="modalCreateSertifikasi" tabindex="-1" aria-labelledby="modalCreateSertifikasiLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="store">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateSertifikasiLabel">Tambah Data Sertifikasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-group mb-3">
                    <label for="jenis"> Jenis Sertifikasi <span class="text-danger">*</span> </label>
                    <input type="text" name="jenis" id="jenis" wire:model="jenis"
                    class="form-control @error('jenis') is-invalid @enderror"/>
                    @error('jenis')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nomor"> Nomor Sertifikasi <span class="text-danger">*</span> </label>
                    <input type="text" name="nomor" id="nomor" wire:model="nomor"
                    class="form-control @error('nomor') is-invalid @enderror"/>
                    @error('nomor')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tahun">Tahun Sertifikasi <span class="text-danger">*</span> </label>
                    <input type="text" name="tahun" id="tahun" wire:model="tahun"
                    class="form-control @error('tahun') is-invalid @enderror"/>
                    @error('tahun')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="bidang_studi"> Bidang Study <span class="text-danger">*</span> </label>
                    <input type="text" name="bidang_studi" id="bidang_studi" wire:model="bidang_studi"
                    class="form-control @error('bidang_studi') is-invalid @enderror"/>
                    @error('bidang_studi')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nrg"> NRG <span class="text-danger">*</span> </label>
                    <input type="text" name="nrg" id="nrg" wire:model="nrg"
                    class="form-control @error('nrg') is-invalid @enderror"/>
                    @error('nrg')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nomor_peserta"> Nomor Peserta <span class="text-danger">*</span> </label>
                    <input type="text" name="nomor_peserta" id="nomor_peserta" wire:model="nomor_peserta"
                    class="form-control @error('nomor_peserta') is-invalid @enderror"/>
                    @error('nomor_peserta')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
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

    

  <script>
    document.addEventListener('livewire:load', function () {

        Livewire.on('openModal', function () {
            $('#modalCreateSertifikasi').modal('show')
        });

        Livewire.on('closeModal', function () {
            $('#modalCreateSertifikasi').modal('hide')
        });

    });
</script>




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

