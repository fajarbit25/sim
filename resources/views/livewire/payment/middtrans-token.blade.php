<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                Api Settings
            </h3>

            <div class="row">
                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label for="merchant"> Merchant ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('merchant') is-invalid @enderror" wire:model.lazy="merchant">
                    </div>
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label for="client"> Client Key <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('client') is-invalid @enderror" wire:model.lazy="client">
                    </div>
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label for="server"> Server Key <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('server') is-invalid @enderror" wire:model.lazy="server">
                    </div>
                </div>
                <div class="col-sm-12 text-end">
                    <button type="button" class="btn btn-primary" wire:click="submitToken()">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

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
