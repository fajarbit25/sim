
<div class="row">

    <div class="col-sm-12 mb-3">
        <button type="button" class="btn btn-primary btn-sm" wire:click="modalFilter()">
            <i class="bi bi-sort-down"></i> Filter
        </button>
        <a href="/absen/guru/{{$mulai}}/{{$sampai}}/excel" class="btn btn-danger btn-sm">
            <i class="bi bi-download"></i> Download
        </a>
    </div>

    <div class="col-sm-12 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Level</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                </tr>
            </thead>
            <tbody>
                @if(count($result) == 0)
                    <tr>
                        <td colspan="7">
                            <span class="fw-bold fst-italic">Tidak ada data!</span>
                        </td>
                    </tr>
                @endif 
                @foreach($result as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->nip}}</td>
                        <td>
                            @if($item->level == 0) Staff Administrasi @endif
                            @if($item->level == 1) Staff Administrasi @endif
                            @if($item->level == 2) Guru PTK @endif
                            @if($item->level == 5) Staff Bendahara @endif
                        </td>
                        <td>{{$item->jam_masuk}}</td>
                        <td>{{$item->jam_pulang}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="7">{{$result->links()}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-calendar-week"></i> Pilih Rentang Tanggal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="mulai">Mulai</label>
                            <input type="date" wire:model="mulai" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="sampai">Sampai</label>
                            <input type="date" wire:model="sampai" class="form-control">
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" data-bs-dismiss="modal">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Selesai
                </button>
            </div>
        </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {

                Livewire.on('openModalFilter', function () {
                    $('#modalFilter').modal('show')
                }); //Membuka modal filter

                Livewire.on('closeModalFilter', function () {
                    $('#modalFilter').modal('hide')
                }); //Menutup modal filter

            });
        </script>
    @endpush

</div>
