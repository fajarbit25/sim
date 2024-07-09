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
                        <label for="chat_id_telegram"> Chat_Id Telegram <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('chat_id_telegram') is-invalid @enderror" wire:model.lazy="chat_id_telegram">
                    </div>
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label for="waToken"> WhatsApp Token (By Fonnte) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('waToken') is-invalid @enderror" wire:model.lazy="waToken">
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
            <div class="col-sm-12 my-3">
                <div class="alert alert-info">
                    <span class="fw-bold">Petunjuk Pengisian : </span><br/>

                    <span class="fst-italic">- Pastikan anda telah terdaftar di Midtrans, Jika belum silahakan daftar dan aktivasi account di </span> <a href="https://midtrans.com/" target="_blank" class="fw-bold fst-italic">https://midtrans.com/ </a> <br/>
                    <span class="fst-italic">- Jika telah meiliki Account midtrans silahkan masukkan MERCHANT_ID, SERVER_KEY, dan CLIENT_ID pada kolom diatas.</span>
                    <span class="fw-bold fst-italic">"Login Midtrans > Setting >  Access Keys"</span><br/>
                    <span class="fst-italic"> - Untuk CHAT_ID_TELEGRAM, anda dapat memulai chat dengan telegram bot :</span>  <span class="fst-italic"> - Untuk WHATSAPP_TOKEN, anda harus memiliki account Wa Gateway melalui penyedia layanan WA Gateway </span>> 
                    <span class="fst-italic">untuk mendapatkan chat_id. Jika kesulitan menemukan chat_id, Silahkan hubungi Vendor/Developer.</span><br/>
                    <span class="fst-italic"> - Untuk WHATSAPP_TOKEN, anda harus memiliki account Wa Gateway melalui penyedia layanan WA Gateway </span>  <a href="https://fonnte.com/" target="_blank" class="fst-italic fw-bold">Fonnte</a> <br/>
                    &nbsp; &nbsp; &nbsp; <span class="fst-italic"> 1. Daftar Fonnter menggunakan No HP Aktif.</span><br/>
                    &nbsp; &nbsp; &nbsp; <span class="fst-italic"> 2. Setelah mendaftar, Silahkan Login lalu Pilih</span> <span class="fst-italic fw-bold">Device > Add Device > Masukan Nomor Handphone > Connect > Scan QRQode</span> <br/>
                    &nbsp; &nbsp; &nbsp; <span class="fst-italic"> 3. Setelah perangkat terkoneksi, Pilih </span> <span class="fst-italic fw-bold">Token</span> <span class="fst-italic"> Untuk mengcopy token. Lalu pastekan pada form Api Token pada halaman ini. </span><br/>
                    <span class="fst-italic"> - Biaya Admin adalah biaya yang akan dibebankan pada Orang tua Siswa tiap transaksi jika menggunakan metode pembayaran Payment Gateway. Untuk informasi biaya admin dapat dicek pada </span> 
                    <a href="https://midtrans.com/id/biaya" target="_blank" class="fw-bold fst-italic">Midtrans Pricing</a> <br/>
                    <span class="fst-italic "> - ENVIRONMENT pilih Sandbox untuk testing, pilih Development Untuk Transaksi secara Nyata. </span>
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
