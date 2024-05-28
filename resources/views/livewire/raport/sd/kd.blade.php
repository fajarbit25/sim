<div class="col-sm-12">
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kompetensi Dasar</h3>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran</label>
                                <select name="mapel" id="mapel" class="form-control" wire:model="mapel">
                                    <option value="0">Pilih Mapel--</option>
                                    @foreach ($dataMapel as $item)
                                    <option value="{{$item->idmapel}}">{{$item->kode_mapel.' - '.$item->nama_mapel}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mb3">
                            <div class="form-group">
                                <label for="mapel">Kelas / Tingkat</label>
                                <select name="mapel" id="mapel" class="form-control" wire:model="kelas">
                                    <option value="0">Pilih Kelas--</option>
                                    @foreach ($dataKelas->groupBy('tingkat') as $tingkat => $item)
                                    <option value="{{$tingkat}}">Kelas {{$tingkat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!--/.col-->

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <a href="javascript:void(0)" class="text-success" wire:click="modalKd('Pengetahuan')"> <i class="bi bi-plus"></i> </a> 
                        Aspek Pengetahuan
                    </h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Ringkasan KD/Materi PENGETAHUAN yang di Nilai</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($dataPengetahuan)
                            @foreach($dataPengetahuan as $item)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->kode}} </td>
                                <td> {{$item->deskripsi}} </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-success" wire:click="modalEdit({{$item->id}})"> <i class="bi bi-pencil-square"></i> </a>
                                    <a href="javascript:void(0)" class="text-danger" wire:click="modalDelete({{$item->id}})"> <i class="bi bi-trash"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @if(count($dataPengetahuan) == 0)
                            <tr>
                                <td colspan="4">
                                    <span class="fw-bold fst-italic">Tidak ada data!</span>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--/.col-->

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <a href="javascript:void(0)" class="text-success" wire:click="modalKd('Keterampilan')"> <i class="bi bi-plus"></i> </a> 
                        Aspek Keterampilan
                    </h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>KD atau kinerja KETERAMPILAN yang dinilai</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($dataKeterampilan)
                            @foreach($dataKeterampilan as $item)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->kode}} </td>
                                <td> {{$item->deskripsi}} </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-success" wire:click="modalEdit({{$item->id}})"> <i class="bi bi-pencil-square"></i> </a>
                                    <a href="javascript:void(0)" class="text-danger" wire:click="modalDelete({{$item->id}})"> <i class="bi bi-trash"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @if(count($dataKeterampilan) == 0)
                            <tr>
                                <td colspan="4">
                                    <span class="fw-bold fst-italic">Tidak ada data!</span>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--/.col-->

        <!-- Modal -->
        <div class="modal fade" id="modalKd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Tambahkan Aspek {{$aspek}} </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="kode"> Kode <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" wire:model="kode">
                    </div>
                    <div class="form-group">
                        <label for="ringkasan"> Ringkasan <span class="text-danger">*</span> </label>
                        <textarea class="form-control @error('ringkasan') is-invalid @enderror" rows="3" wire:model="ringkasan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" wire:click="saveKd()" wire:loading.attr="disabled">
                        <span wire:loading> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> </span> Simpan
                    </button>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Edit Aspek {{$aspek}} </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="kode"> Kode <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" wire:model="kode">
                    </div>
                    <div class="form-group">
                        <label for="ringkasan"> Ringkasan <span class="text-danger">*</span> </label>
                        <textarea class="form-control @error('ringkasan') is-invalid @enderror" rows="3" wire:model="ringkasan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" wire:click="updateKd()" wire:loading.attr="disabled">
                        <span wire:loading> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> </span> Perbaharui
                    </button>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Confim? </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <span class="fw-bold fst-italic">Yakin ingin menghapus KD?</span>
                        </div>
                        <div class="col-sm-5">
                            <button type="button" class="btn btn-danger" wire:click="deleteKd()" wire:loading.attr="disabled">
                                <span wire:loading> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> </span> Hapus
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
            </div>
        </div>


    </div><!--/.row-->

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalKd', function () {
                $('#modalKd').modal('show')
            }); //membuka modal
            Livewire.on('modalDelete', function () {
                $('#modalDelete').modal('show')
            }); //membuka modal
            Livewire.on('modalEdit', function () {
                $('#modalEdit').modal('show')
            }); //membuka modal


            Livewire.on('closeModal', function () {
                $('#modalKd').modal('hide')
                $("#modalDelete").modal('hide');
                $('#modalEdit').modal('hide');
            }); //menutup semua modal


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
