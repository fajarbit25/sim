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
                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label for="server"> Chat_Id Telegram <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('chat_id_telegram') is-invalid @enderror" wire:model.lazy="chat_id_telegram">
                    </div>
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label for="server"> Biaya Admin <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('admin_fee') is-invalid @enderror" wire:model.lazy="admin_fee">
                        <div class="form-text">
                            Biaya yang akan kenakan oleh Siswa, Setiap Transaksi.
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label for="server"> Environment <span class="text-danger">*</span></label>
                        <select class="form-control @error('midtransEnvironment') is-invalid @enderror" wire:model="midtransEnvironment">
                            <option value="">Pilih Environment</option>
                            <option value="Sandbox">Sandbox</option>
                            <option value="Production">Production</option>
                        </select>
                        <div class="form-text">
                            Pilih Sandbox untuk Testing Payment <br/>
                            Pilih Production untuk Real Transaction
                        </div>
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
