<div class="col-sm-12">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <form wire:submit.prevent="updateSchoolTeacher">
        <input type="hidden" name="idSchoolTeacher" id="idSchoolTeacher" wire:model="user_id">

        <h5 class="my-3 fw-bold">Identitas Sekolah</h5>

        <div class="row mb-3">
            <label for="nama_sekolah" class="col-sm-2 col-form-label">Nama Sekolah <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <input type="text" name="nama_sekolah" id="nama_sekolah" wire:model="nama"
                class="form-control @error('nama') is-invalid @enderror" />
                @error('nama')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="npsn_sekolah" class="col-sm-2 col-form-label">NPSN Sekolah <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <input type="text" name="npsn_sekolah" id="npsn_sekolah" wire:model="npsn"
                class="form-control @error('npsn') is-invalid @enderror" />
                @error('npsn')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="alamat_sekolah" class="col-sm-2 col-form-label">Alamat Sekolah <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <textarea name="alamat_sekolah" id="alamat_sekolah" rows="2" wire:model="alamat"
                class="form-control @error('alamat') is-invalid @enderror"></textarea>
                @error('alamat')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="mb-3 col-sm-10 text-end">
            <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" id="update-sekolah-teacher" wire:click="AnimatedButton">
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
