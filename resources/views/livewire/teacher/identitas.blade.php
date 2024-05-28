<div class="col-sm-12">
    <h5 class="my-3 fw-bold">Identitas Tenaga Pendidikan</h5>
    <form wire:submit.prevent="UpdateTeacher">
        <input type="hidden" name="userId" id="userId" wire:model="userId">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-8">
              <input type="text" wire:model="nama" name="nama" id="nama" 
              class="form-control @error('nama') is-invalid @enderror">
              @error('nama')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="nik" class="col-sm-2 col-form-label">NIK/KITAS</label>
            <div class="col-sm-8">
              <input type="text" wire:model="nik" name="nik" id="nik" 
              class="form-control @error('nik') is-invalid @enderror">
              @error('nik')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
              <select name="jenis_kelamin" id="jenis_kelamin" wire:model='jenis_kelamin'
              class="form-control @error('jenis_kelamin') is-invalid @enderror">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
              @error('jenis_kelamin')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
            <div class="col-sm-8">
              <input type="text" wire:model="tempat_lahir" name="tempat_lahir" id="tempat_lahir" 
              class="form-control @error('tempat_lahir') is-invalid @enderror">
              @error('tempat_lahir')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8">
              <input type="date" wire:model="tanggal_lahir" name="tanggal_lahir" id="tanggal_lahir" 
              class="form-control @error('tanggal_lahir') is-invalid @enderror">
              @error('tanggal_lahir')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="ibu_kandung" class="col-sm-2 col-form-label">Nama Ibu Kandung</label>
            <div class="col-sm-8">
              <input type="text" wire:model="ibu_kandung" name="ibu_kandung" id="ibu_kandung" 
              class="form-control @error('ibu_kandung') is-invalid @enderror">
              @error('ibu_kandung')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="mb-3 col-sm-10 text-end">
            <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" id="btn-update-teacher" wire:click="AnimatedButton">
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
