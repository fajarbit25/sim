<div class="col-sm-12">
    <h5 class="my-3 fw-bold">Biodata Pribadi</h5>
    <form wire:submit.prevent="updateBiodataGuru">
        <input type="hidden" name="userid_biodata_guru" id="userid_biodata_guru" wire:model="user_id">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="row mb-3">
            <label for="kk" class="col-sm-2 col-form-label">Kartu Keluarga <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
              <input type="text" wire:model="kk" name="kk" id="kk" 
              class="form-control @error('kk') is-invalid @enderror">
              @error('kk')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>

        </div>

        <div class="row mb-3">
            <label for="agama" class="col-sm-2 col-form-label">Agama <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
              <select name="agama" id="agama" wire:model="agama"
              class="form-control @error('agama') is-invalid @enderror">
                <optgroup label="Agama">
                    @if($agama == NULL)
                        <option value="">-Pilih Agama-</option>
                    @endif
                    <option value="Islam">Islam</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Katholik">Katholik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                    <option value="Khong Hu Chu">Khong Hu Chu</option>
                    <option value="Kepercayaan Kepada Tuhan YME">Kepercayaan Kepada Tuhan YME.</option>
                </optgroup>
              </select>
              @error('agama')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="npwp" class="col-sm-2 col-form-label">Nomor NPWP <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
              <input type="text" wire:model="npwp" name="npwp" id="npwp" 
              class="form-control @error('npwp') is-invalid @enderror">
              @error('npwp')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="nama_npwp" class="col-sm-2 col-form-label">Nama Wajib Pajak <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
              <input type="text" wire:model="nama_npwp" name="nama_npwp" id="nama_npwp" 
              class="form-control @error('nama_npwp') is-invalid @enderror">
              @error('nama_npwp')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
              <select name="kewarganegaraan" id="kewarganegaraan" wire:model="kewarganegaraan"
              class="form-control @error('kewarganegaraan') is-invalid @enderror">
                <optgroup label="Kewarganegaraan">
                    @if($kewarganegaraan == NULL)
                        <option value="">-Pilih Kewarganegaraan-</option>
                    @endif
                    <option value="WNI">WNI</option>
                    <option value="WNA">WNA</option>
                </optgroup>
              </select>
              @error('kewarganegaraan')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="negara" class="col-sm-2 col-form-label">Negara <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
              <input type="text" wire:model="negara" name="negara" id="negara" 
              class="form-control @error('negara') is-invalid @enderror">
              @error('negara')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="status_perkawinan" class="col-sm-2 col-form-label">Status Perkawinan <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
              <select name="status_perkawinan" id="status_perkawinan" wire:model="status_perkawinan"
              class="form-control @error('status_perkawinan') is-invalid @enderror">
                <optgroup label="Status Perkawinan">
                    @if($status_perkawinan == NULL)
                        <option value="">-Pilih Status-</option>
                    @endif
                    <option value="Kawin">Kawin</option>
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Janda/Duda">Janda/Duda</option>
                </optgroup>
              </select>
              @error('status_perkawinan')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="nama_pasangan" class="col-sm-2 col-form-label">Nama Suami/Istri <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
              <input type="text" wire:model="nama_pasangan" name="nama_pasangan" id="nama_pasangan" 
              class="form-control @error('nama_pasangan') is-invalid @enderror">
              @error('nama_pasangan')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="nip_pasangan" class="col-sm-2 col-form-label">NIP Suami/Istri <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
              <input type="text" wire:model="nip_pasangan" name="nip_pasangan" id="nip_pasangan" 
              class="form-control @error('nip_pasangan') is-invalid @enderror">
              @error('nip_pasangan')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="pekerjaan_pasangan" class="col-sm-2 col-form-label">Pekerjaan Suami/Istri <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
              <select name="pekerjaan_pasangan" id="pekerjaan_pasangan" wire:model="pekerjaan_pasangan"
              class="form-control @error('pekerjaan_pasangan') is-invalid @enderror">
                <optgroup label="Pekerjaan">
                    @if($pekerjaan_pasangan == NULL)
                        <option value="">-Pilih Kepekrjaan-</option>
                    @endif
                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                    <option value="Nelayan">Nelayan</option>
                    <option value="Petani">Petani</option>
                    <option value="Peternak">Peternak</option>
                    <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                    <option value="GTT/PTT">GTT/PTT</option>
                    <option value="Pedagang Kecil">Pedagang Kecil</option>
                    <option value="Pedagan Besar">Pedagan Besar</option>
                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                    <option value="Wirausaha">Wirausaha</option>
                    <option value="Pensuinan">Pensuinan</option>
                    <option value="Buruh">Buruh</option>
                    <option value="Sudah Meninggal">Sudah Meninggal</option>
                    <option value="TKI">TKI</option>
                    <option value="Tidak Dapat Diterapkan">Tidak Dapat Diterapkan</option>
                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                </optgroup>
              </select>
              @error('pekerjaan_pasangan')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
        </div>
        

        <div class="mb-3 col-sm-10 text-end">
            <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" id="btn-update-biodata" wire:click="AnimatedButton">
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