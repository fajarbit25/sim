<div class="row">
    <div class="col-sm-8 mb-3">
        <button type="button" class="btn btn-success" wire:click="modalTahunAngkatan()">
            <i class="bi bi-calendar-check"></i> Tahun Angkatan
        </button>
    </div>
    <div class="col-sm-4 mb-3">
        <input type="search" class="form-control" wire:model="search" 
        placeholder="Cari..."  aria-label="search"/>
    </div>

    @livewire('tracert-study.add-ijazah')

    <hr/>
    <div class="col-sm-12">

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>NIS/NISN</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th>Angkatan</th>
                        <th>Kelas Terakhir</th>
                        <th>Nomor Ijazah</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($userData) == 0)
                        <tr>
                            <td colspan="8">
                                <span class="fw-bold fst-italic">
                                    Data tidak ditemukan!
                                </span>
                            </td>
                        </tr>
                    @endif
                    @foreach($userData as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->nis}} / {{$user->nisn}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->angkatan}}</td>
                            <td>Kelas {{$user->kelas}}</td>
                            <td style="white-space: nowrap">
                                @if($user->nomor_jazah == null)
                                    <button type="button" class="btn btn-danger btn-xs" wire:click="addIjazah('{{$user->id}}')">
                                        + Add
                                    </button>
                                @else 
                                    <button type="button" class="btn btn-success btn-xs" wire:click="addIjazah('{{$user->id}}')">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    {{$user->nomor_jazah}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$userData->links()}}
        </div>

    </div>

    <!-- Modal Tahun Angkatan -->
    <div class="modal fade" id="modalTahunAngkatan" tabindex="-1" wire:ignore.self 
    aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-calendar-check"></i> Pilih Tahun Angkatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row"> 
                        <div class="form-group col-sm-6">
                            <label for="start">Mulai <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" wire:model="start">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="end">Sampai <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" wire:model="end">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Selesai</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {

                Livewire.on('modalTahunAngkatan', function () {
                    $('#modalTahunAngkatan').modal('show')
                }); //Membuka modal tahun angkatan

                Livewire.on('closeModalTahunAngkatan', function () {
                    $('#modalTahunAngkatan').modal('hide')
                }); //Menutup modal tahun angkatan

            });
        </script>
    @endpush

</div>


