<div class="col-sm-12">
    <div class="modal fade" wire:ignore.self id="modalEditSertifikasi" tabindex="-1" aria-labelledby="modalCreateSertifikasiLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="update">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateSertifikasiLabel">Edit Data Sertifikasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-group mb-3">
                    <label for="jenis"> Jenis Sertifikasi <span class="text-danger">*</span> </label>
                    <input type="text" name="jenis" wire:model="jenis"
                    class="form-control @error('jenis') is-invalid @enderror"/>
                    @error('jenis')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nomor"> Nomor Sertifikasi <span class="text-danger">*</span> </label>
                    <input type="text" name="nomor" wire:model="nomor"
                    class="form-control @error('nomor') is-invalid @enderror"/>
                    @error('nomor')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tahun">Tahun Sertifikasi <span class="text-danger">*</span> </label>
                    <input type="text" name="tahun" wire:model="tahun"
                    class="form-control @error('tahun') is-invalid @enderror"/>
                    @error('tahun')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="bidang_studi"> Bidang Study <span class="text-danger">*</span> </label>
                    <input type="text" name="bidang_studi" wire:model="bidang_studi"
                    class="form-control @error('bidang_studi') is-invalid @enderror"/>
                    @error('bidang_studi')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nrg"> NRG <span class="text-danger">*</span> </label>
                    <input type="text" name="nrg" wire:model="nrg"
                    class="form-control @error('nrg') is-invalid @enderror"/>
                    @error('nrg')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nomor_peserta"> Nomor Peserta <span class="text-danger">*</span> </label>
                    <input type="text" name="nomor_peserta" wire:model="nomor_peserta"
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

    <!--  listener untuk event editSertifikasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('editSertifikasi', function (id) {
                $("#modalEditSertifikasi").modal('show')
                console.log(id)
            });

            Livewire.on('closeModal', function () {
                $('#modalEditSertifikasi').modal('hide')
            });
        });
    </script>

</div>
