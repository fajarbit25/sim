<div class="col-sm-12">
    <div class="modal fade" wire:ignore.self id="modalDeleteSertifikasi" tabindex="-1" aria-labelledby="modalCreateSertifikasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateSertifikasiLabel">Confirm!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">Tidak</button>

                <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" wire:click="AnimatedButton()">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Ya
                </button>
            </div>
        </div>
        </div>
    </div>

    <!--  listener untuk event deleteSertifikasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('deleteSertifikasi', function (id) {
                $("#modalDeleteSertifikasi").modal('show')
            });

            Livewire.on('closeModal', function () {
                $('#modalDeleteSertifikasi').modal('hide')
            });
        });
    </script>

</div>
