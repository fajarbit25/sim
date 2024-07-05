<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        Pembayaran Manual
                    </h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info">
                                <span class="fw-bold fst-italic">Petunjuk Pembayaran : </span><br/>
                                <span class="fst-italic">
                                    Silahkan transfer ke Rekening Berikut
                                </span><br/><br/>
                                <span class="fst-italic fw-bold"> -Bank : </span> <span class="fst-italic"> Bank Syariah Indonesia</span> <br/>
                                <span class="fst-italic fw-bold"> -Nama : </span> <span class="fst-italic"> SDIT Ibnul Qayyim Makassar</span> <br/>
                                <span class="fst-italic fw-bold"> -Nomor Rekening : </span> <span class="fst-italic"> 12345-12345-1234 </span> <br/>
                                <span class="fst-italic fw-bold"> -Jumlah : </span> <span class="fst-italic">  Rp.500.000,- </span> <br/>
                                <br/>
                                <span class="fst-italic">
                                    Selanjutnya Konfirmasi Pembayaran Melalui Form Dibawah:
                                </span><br/>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <form wire:submit.prevent="submitKonfirmasi">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama Bank <span class="text-danger"><i class="bi bi-asterisk"></i></span> </label>
                                    <select wire:model.lazy="bank" class="form-control @error('bank') is-invalid @enderror">
                                        <option value="">-Pilih Bank</option>
                                        <option value="BSI">BSI</option>
                                        <option value="BRI">BRI</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BTN">BTN</option>
                                        <option value="BCA">BCA</option>
                                        <option value="BPD">BPD</option>
                                        <option value="Panin Bank">Panin Bank</option>
                                        <option value="Danamon">Danamon</option>
                                        <option value="Permata">Permata</option>
                                        <option value="MAYBANK">MAYBANK</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    @error('bank') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama">Nama Di Rekening Pengirim <span class="text-danger"><i class="bi bi-asterisk"></i></span> </label>
                                    <input type="text" wire:model.lazy="nama" class="form-control @error('nama') is-invalid @enderror"/>
                                    @error('nama') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="norek">Nomor Rekening Pengirim <span class="text-danger"><i class="bi bi-asterisk"></i></span> </label>
                                    <input type="text" wire:model.lazy="norek" class="form-control @error('norek') is-invalid @enderror"/>
                                    @error('norek') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="amount">Jumlah Transfer (IDR-Rupiah) <span class="text-danger"><i class="bi bi-asterisk"></i></span> </label>
                                    <input type="number" wire:model.lazy="amount" class="form-control @error('amount') is-invalid @enderror"/>
                                    @error('amount') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="evidence">Bukti Pengiriman / Bukti Transfer <span class="text-danger"><i class="bi bi-asterisk"></i></span> </label>
                                    <input type="file" wire:model.lazy="evidence" class="form-control @error('evidence') is-invalid @enderror"/>
                                    @error('evidence') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3">
                                    @if($btnBack == 0)
                                    <button type="submit" class="btn btn-success w-100"> <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Kirim </button>
                                    @endif
                                    @if($btnBack == 1)
                                    <a href="/user/invoice" class="btn btn-secondary w-100"><i class="bi bi-arrow-left"></i> Kembali </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
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