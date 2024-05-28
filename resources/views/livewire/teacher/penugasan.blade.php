<div class="col-sm-12">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <form wire:submit.prevent="updatePenugasanTeacher">
        <input type="hidden" name="idPenugasanTeacher" id="idPenugasanTeacher" wire:model="user_id">

        <h5 class="my-3 fw-bold">Penugasan</h5>

        <div class="row mb-3">
            <label for="nomor_surat_tugas" class="col-sm-2 col-form-label">Nomor Surat Tugas <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <input type="text" name="nomor_surat_tugas" id="nomor_surat_tugas" wire:model="nomor_surat_tugas"
                class="form-control @error('nomor_surat_tugas') is-invalid @enderror" />
                @error('nomor_surat_tugas')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tanggal_surat_tugas" class="col-sm-2 col-form-label">Tanggal Surat Tugas <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <input type="date" name="tanggal_surat_tugas" id="tanggal_surat_tugas" wire:model="tanggal_surat_tugas"
                class="form-control @error('tanggal_surat_tugas') is-invalid @enderror" />
                @error('tanggal_surat_tugas')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tmt_tugas" class="col-sm-2 col-form-label">TMT Tugas <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <input type="text" name="tmt_tugas" id="tmt_tugas" wire:model="tmt_tugas"
                class="form-control @error('tmt_tugas') is-invalid @enderror" />
                @error('tmt_tugas')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="sekolah_induk" class="col-sm-2 col-form-label">Sekolah Induk <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <select name="sekolah_induk" id="sekolah_induk" wire:model="sekolah_induk"
                class="form-control @error('sekolah_induk') is-invalid @enderror">
                    <option value="">--Pilih--</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
                @error('sekolah_induk')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <h5 class="my-5 fw-bold">Diisi Saat Keluar</h5>

        <div class="row mb-3">
            <label for="keluar_karena" class="col-sm-2 col-form-label">Keluar Karena </label>
            <div class="col-sm-8">
                <select name="keluar_karena" id="keluar_karena" wire:model="keluar_karena"
                class="form-control @error('keluar_karena') is-invalid @enderror">
                    <option value="">--Pilih Alasan--</option>
                    <option value="Mutasi">Mutasi</option>
                    <option value="Dikeluarkan" class="text-danger fw-bold">Dikeluarkan</option>
                    <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                    <option value="Wafat">Wafat</option>
                    <option value="Hilang">Hilang</option>
                    <option value="Alih Fungsi">Alih Fungsi</option>
                    <option value="Pensiun">Pensiun</option>
                </select>
                @error('keluar_karena')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tanggal_keluar" class="col-sm-2 col-form-label">Tanggal Keluar </label>
            <div class="col-sm-8">
                <input type="date" name="tanggal_keluar" id="tanggal_keluar" wire:model="tanggal_keluar"
                class="form-control @error('tanggal_keluar') is-invalid @enderror" />
                @error('tanggal_keluar')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <h5 class="my-5 fw-bold">Akun PTK</h5>

        <div class="row mb-3">
            <label for="uname_akun_ptk" class="col-sm-2 col-form-label">Username </label>
            <div class="col-sm-8">
                <input type="text" name="uname_akun_ptk" id="uname_akun_ptk" wire:model="uname_akun_ptk"
                class="form-control @error('uname_akun_ptk') is-invalid @enderror" />
                @error('uname_akun_ptk')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="pass_akun_ptk" class="col-sm-2 col-form-label">Password </label>
            <div class="col-sm-8">
                <input type="text" name="pass_akun_ptk" id="pass_akun_ptk" wire:model="pass_akun_ptk"
                class="form-control @error('pass_akun_ptk') is-invalid @enderror" />
                @error('pass_akun_ptk')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        

        <div class="mb-3 col-sm-10 text-end">
            <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" id="btnUpdatePenugasanTeacher" wire:click="AnimatedButton">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Update
            </button>
        </div>

    </form>

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
