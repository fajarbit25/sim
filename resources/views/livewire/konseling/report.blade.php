<div class="col-sm-12">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title">Laporan Konseling Siswa</h3>
                    </div>
                    <div class="col-sm-6 text-end">
                        <button type="button" class="btn btn-success btn-sm mt-4" wire:click="modalFilter"><i class="bi bi-sort-down"></i> Filter</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> NO. </th>
                                <th> NIS </th>
                                <th> NAMA </th>
                                <th> JK </th>
                                <th> KELAS </th>
                                <th> JUMLAH PELANGGARAN </th>
                                <th> TOTAL POINT </th>
                            </tr>
                        </thead>
                        <tbody class="overflow-y-scroll">
                            @if($dataKonseling)
                            @foreach($dataKonseling->groupBy('userid') as $userid => $items)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> 
                                        <a href="/konseling/{{$userid}}/siswa" class="fw-bold text-success">
                                        {{$items->first()->nis}} 
                                        </a>
                                    </td>
                                    <td> {{$items->first()->first_name}} </td>
                                    <td> {{$items->first()->gender}} </td>
                                    <td> {{$items->first()->tingkat.' '.$items->first()->kode_kelas}} </td>
                                    <td> {{number_format($items->count())}} </td>
                                    <th> <span class="@if($items->sum('point') >= 50) text-danger @endif"> {{number_format($items->sum('point'))}} </span> </th>
                                </tr>
                            @endforeach
                            @endif
                            @if($dataKonseling->count() == 0)
                                <tr>
                                    <td colspan="7">No data!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalFilter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFilterLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFilterLabel">Filter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <select class="form-select" wire:model="campus">
                                <option selected>Pilih Satuan Pendidikan</option>
                                @if($dataCampus)
                                @foreach($dataCampus as $items)
                                <option value="{{$items->idcampus}}">{{$items->campus_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <select class="form-select" wire:model="ta">
                                <option selected>Pilih Tahun Ajaran</option>
                                @if($dataSemester)
                                @foreach($dataSemester as $items)
                                <option value="{{$items->tahun_ajaran}}">{{$items->tahun_ajaran}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <select class="form-select" wire:model="semester">
                                <option selected>Pilih Semester</option>
                                <option value="1">Ganjil</option>
                                <option value="2">Genap</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <select class="form-select" wire:model="kelas">
                                <option value="">Semua Kelas</option>
                                @foreach($dataKelas as $items)
                                <option value="{{$items->idkelas}}">{{$items->tingkat.' '.$items->kode_kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lihat Data</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalFilter', function () {
                $('#modalFilter').modal('show')
            }); //membuka modal


            Livewire.on('closeModal', function () {
                $('#modalFilter').modal('hide')
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
