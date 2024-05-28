<div class="col-sm-12">
    <h5 class="my-3 fw-bold">Kepegawaian</h5>

    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <form wire:submit.prevent="UpdateKepegawaianTeacher">
        <input type="hidden" wire:model="user_id"/>

        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label">Status Kepegawaian <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <select wire:model="status" name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="">-Pilih Status-</option>
                    <option value="PNS">PNS</option>
                    <option value="PNS Diperbantukan">PNS Diperbantukan</option>
                    <option value="PNS Depag">PNS Depag</option>
                    <option value="GTY/PTY">GTY/PTY</option>
                    <option value="GTT/PTT Provinsi">GTT/PTT Provinsi</option>
                    <option value="GTT/PTT Kab/Kota">GTT/PTT Kab/Kota</option>
                    <option value="Guru Bantu Pusat">Guru Bantu Pusat</option>
                    <option value="Guru Honor Sekolah">Guru Honor Sekolah</option>
                    <option value="Tenaga Honor">Tenaga Honor</option>
                    <option value="CPNS">CPNS</option>
                    <option value="PPPK">PPPK</option>
                    <option value="PPNPN">PPNPN</option>
                    <option value="Kontrak Kerja WNA">Kontrak Kerja WNA</option>
                </select>
            </div>
            @error('status')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="nip" class="col-sm-2 col-form-label">NIP </label>
            <div class="col-sm-8">
                <input type="text" wire:model="nip" name="nip" class="form-control @error('nip') is-invalid @enderror">
            </div>
            @error('nip')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="niy" class="col-sm-2 col-form-label">NIY </label>
            <div class="col-sm-8">
                <input type="text" wire:model="niy" name="niy" class="form-control @error('niy') is-invalid @enderror">
            </div>
            @error('niy')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="nuptk" class="col-sm-2 col-form-label">NUPTK </label>
            <div class="col-sm-8">
                <input type="text" wire:model="nuptk" name="nuptk" class="form-control @error('nuptk') is-invalid @enderror">
            </div>
            @error('nuptk')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="jenis_ptk" class="col-sm-2 col-form-label">Jenis PTK <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <select wire:model="jenis_ptk" name="jenis_ptk" class="form-control @error('jenis_ptk') is-invalid @enderror">
                    <option value="">-Pilih PTK-</option>
                    <option value="Guru Kelas">Guru Kelas</option>
                    <option value="Guru Mata Pelajaran">Guru Mata Pelajaran</option>
                    <option value="Guru BK">Guru BK</option>
                    <option value="Tenaga Perpustakaan">Tenaga Perpustakaan</option>
                    <option value="Tenaga Administrasi Sekolah">Tenaga Administrasi Sekolah</option>
                    <option value="Guru Pendamping Khusus">Guru Pendamping Khusus</option>
                    <option value="Guru Pengganti">Guru Pengganti</option>
                    <option value="Guru TK">Guru TK</option>
                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                    <option value="Laboran">Laboran</option>
                    <option value="Tukang Kebun">Tukang Kebun</option>
                    <option value="Penjaga Sekolah">Penjaga Sekolah</option>
                    <option value="Petugas Keamanan">Petugas Keamanan</option>
                    <option value="Office Boy">Office Boy</option>
                    <option value="Terapis">Terapis</option>
                    <option value="Academic Advisor">Academic Advisor</option>
                    <option value="Academic Specialist">Academic Specialist</option>
                    <option value="Curriculum Dev. Advisor">Curriculum Dev. Advisor</option>
                    <option value="Kindergarten Teacher">Kindergarten Teacher</option>
                    <option value="Management Advisor">Management Advisor</option>
                    <option value="Play Group Teacher">Play Group Teacher</option>
                    <option value="Principal">Principal</option>
                    <option value="Teaching Assistant">Teaching Assistant</option>
                    <option value="Vice Principal">Vice Principal</option>
                    <option value="Guru Pembimbing Khusus">Guru Pembimbing Khusus</option>
                    <option value="Pengawan PaudDikmas">Pengawan PaudDikmas</option>
                    <option value="Penilik">Penilik</option>
                    <option value="Instruktur">Instruktur</option>
                    <option value="Penguji">Penguji</option>
                    <option value="Master Penguji">Master Penguji</option>
                    <option value="Tutor">Tutor</option>
                    <option value="Pamong Belajar">Pamong Belajar</option>
                    <option value="Instruktur Kejuruan">Instruktur Kejuruan</option>
                </select>
            </div>
            @error('jenis_ptk')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="sk_pengangkatan" class="col-sm-2 col-form-label">SK Pengangkatan <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <input type="text" wire:model="sk_pengangkatan" name="sk_pengangkatan" class="form-control @error('sk_pengangkatan') is-invalid @enderror">
            </div>
            @error('sk_pengangkatan')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="tmt_pengangkatan" class="col-sm-2 col-form-label">TMT Pengangkatan <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <input type="text" wire:model="tmt_pengangkatan" name="tmt_pengankatan" class="form-control @error('tmt_pengangkatan') is-invalid @enderror">
            </div>
            @error('tmt_pengangkatan')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="lembaga_pengankat" class="col-sm-2 col-form-label">Lembaga Pengangkat <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <select wire:model="lembaga_pengankat" name="lembaga_pengankatan" class="form-control @error('lembaga_pengankat') is-invalid @enderror">
                    <option value="">-Pilih Lembaga-</option>
                    <option value="Pemerintah Pusat">Pemerintah Pusat</option>
                    <option value="Pemerintah Provinsi">Pemerintah Provinsi</option>
                    <option value="Pemerintah Kab/Kota">Pemerintah Kab/Kota</option>
                    <option value="Ketua Yayasan">Ketua Yayasan</option>
                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                    <option value="Komite Sekolah">Komite Sekolah</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            @error('lembaga_pengankat')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="sk_cpns" class="col-sm-2 col-form-label">SK CPNS </label>
            <div class="col-sm-8">
                <input type="text" wire:model="sk_cpns" name="sk_cpns" class="form-control @error('sk_cpns') is-invalid @enderror">
            </div>
            @error('sk_cpns')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="tmt_pns" class="col-sm-2 col-form-label">TMT PNS </label>
            <div class="col-sm-8">
                <input type="text" wire:model="tmt_pns" name="tmt_pns" class="form-control @error('tmt_pns') is-invalid @enderror">
            </div>
            @error('tmt_pns')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="golongan" class="col-sm-2 col-form-label">Golongan </label>
            <div class="col-sm-8">
                <input type="text" wire:model="golongan" name="golongan" class="form-control @error('golongan') is-invalid @enderror">
            </div>
            @error('golongan')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="sumber_gaji" class="col-sm-2 col-form-label">Sumber Gaji <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <select wire:model="sumber_gaji" name="sumber_gaji" class="form-control @error('sumber_gaji') is-invalid @enderror">
                    <option value="">-Pilih Sumber Gaji-</option>
                    <option value="APBN">APBN</option>
                    <option value="APBD Provinsi">APBD Provinsi</option>
                    <option value="APBD Kab/Kota">APBD Kab/Kota</option>
                    <option value="Yayasan">Yayasan</option>
                    <option value="Sekolah">Sekolah</option>
                    <option value="Lembaga Donor">Lembaga Donor</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            @error('sumber_gaji')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="kartu_pegawai" class="col-sm-2 col-form-label">Kartu Pegawai </label>
            <div class="col-sm-8">
                <input type="text" wire:model="kartu_pegawai" name="kartu_pegawai" class="form-control @error('kartu_pegawai') is-invalid @enderror">
            </div>
            @error('kartu_pegawai')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="row mb-3">
            <label for="karis_karsu" class="col-sm-2 col-form-label">KARIS/KARSU </label>
            <div class="col-sm-8">
                <input type="text" wire:model="karis_karsu" name="karis_karsu" class="form-control @error('karis_karsu') is-invalid @enderror">
            </div>
            @error('karis_karsu')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3 col-sm-10 text-end">
            <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" id="btnUpdateKepegawaianTeacher" wire:click="AnimatedButton">
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
