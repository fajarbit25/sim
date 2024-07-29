<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Form Pelanggaran</h3>
                    <div class="col-sm-8 m-5">
                        <form wire:submit.prevent="saveData">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="campus">Satuan Pendidikan <span class="text-danger">*</span> </label>
                                        <select class="form-select" wire:model.lazy="campus">
                                            <option selected>Pilih Satuan Pendidikan..</option>
                                            @foreach($dataCampus as $item)
                                            <option value="{{$item->idcampus}}">{{$item->campus_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            @error('campus') {{$message}} @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="siswa">Nama Peserta Didik <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" wire:model="siswa" wire:click="modalSiswa" @if(!$campus) disabled @else readonly @endif>
                                        <div class="invalid-feedback">
                                            @error('siswa') {{$message}} @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label for="nis">No. Induk <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" wire:model="nis" disabled>
                                        <div class="invalid-feedback">
                                            @error('nis') {{$message}} @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label for="gender">Jenis Kelamin <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" wire:model="gender" disabled>
                                        <div class="invalid-feedback">
                                            @error('gender') {{$message}} @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label for="kelas">Kelas <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" wire:model="kelas" disabled>
                                        <div class="invalid-feedback">
                                            @error('kelas') {{$message}} @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="pelanggaran">Jenis Pelanggaran <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" wire:model="pelanggaran" wire:click="modalPelanggaran" @if(!$siswa) disabled @else readonly @endif>
                                        <div class="invalid-feedback">
                                            @error('pelanggaran') {{$message}} @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan <span class="text-danger">*</span> </label>
                                        <textarea class="form-control" rows="3" wire:model.lazy="keterangan"></textarea>
                                        <div class="invalid-feedback">
                                            @error('keterangan') {{$message}} @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="foto">Foto <span class="text-danger">*</span> </label>
                                        <input type="file" class="form-control" wire:model="foto">
                                        <div class="invalid-feedback">
                                            @error('foto') {{$message}} @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-end">
                                    <button class="btn btn-primary" type="submit"><span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Scrollable modal -->
    <!-- Modal -->
    <div class="modal fade" id="modalSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Siswa </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 mb-4">
                        <input type="search" class="form-control" placeholder="Cari siswa.." wire:model="keysiswa">
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th colspan="2">Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($dataSiswa)
                                @foreach($dataSiswa as $items)
                                <tr>
                                    <td> {{$items->nis}} </td>
                                    <td> {{$items->first_name}} </td>
                                    <td> {{$items->gender}} </td>
                                    <td> {{$items->tingkat.' '.$items->kode_kelas}} </td>
                                    <td> <a href="javascript:void(0)" class="font-bold" wire:click="addSiswa({{$items->id}})"> <i class="bi bi-chevron-compact-right"></i> </a> </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPelanggaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Pelanggaran </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 mb-4">
                        <input type="search" class="form-control" placeholder="Cari siswa.." wire:model="keypelanggaran">
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th colspan="2">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($dataPelanggaran)
                                @foreach($dataPelanggaran as $items)
                                <tr>
                                    <td> {{$items->kode}} </td>
                                    <td> {{$items->pelanggaran}} </td>
                                    <td> {{$items->point}} </td>
                                    <td> <a href="javascript:void(0)" class="font-bold" wire:click="addPelanggaran({{$items->id}})"> <i class="bi bi-chevron-compact-right"></i> </a> </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalPelanggaran', function () {
                $('#modalPelanggaran').modal('show')
            }); //membuka modal

            Livewire.on('modalSiswa', function () {
                $('#modalSiswa').modal('show')
            }); //membuka modal


            Livewire.on('closeModal', function () {
                $('#modalPelanggaran').modal('hide')
                $('#modalSiswa').modal('hide')
            }); //menutup modal

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
