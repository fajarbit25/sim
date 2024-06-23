<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
             <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                        Riwayat Pembayaran Siswa
                     </h3>
                     <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        <input type="date" class="form-control" wire:model="start">
                        <input type="date" class="form-control" wire:model="end">
                    </div>
                     <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-funnel"></i></span>
                        <select aria-label="Filter" class="form-control" wire:model="jenis">
                            <option value="All">Semua</option>
                            @foreach ($dataJenis as $item)
                                <option value="{{$item->jenis}}">{{$item->jenis}}</option>
                            @endforeach
                        </select>
                        <select aria-label="Filter" class="form-control" wire:model="kelas">
                            <option value="All">Semua</option>
                            @foreach ($dataKelas->groupBy('tingkat') as $tingkat => $item)
                                <option value="{{$tingkat}}">Kelas {{$tingkat}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
             </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Table Tagihan</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Periode</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataTagihan as $items)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> 
                                        <a href="javascript:void(0)" class="fw-bold" wire:click="infoTransaksi('{{$items->kode_transaksi}}')">
                                            {{substr($items->nomor_invoice, 0, 30)}} 
                                        </a>
                                    </td>
                                    <td> 
                                        {{$items->periode}} </td>
                                    <td> {{$items->nis}} </td>
                                    <td> {{$items->first_name}} </td>
                                    <td> {{$items->tingkat.' '.$items->kode_kelas}} </td>
                                    <td> {{$items->jenis_transaksi}} </td>
                                    <td> Rp.{{number_format($items->amount)}},- </td>
                                    <td>{{$items->payment_type}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($dataTagihan)
                        <div class="col-sm-12 text-end">
                            {{$dataTagihan->links()}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($detailTransaksi)
    <!-- Modal -->
    <div class="modal fade" id="modalDetailTransaksi" tabindex="-1" aria-labelledby="modalDetailTransaksiLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalDetailTransaksiLabel">Detail Transaksi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless">
                    <tr>
                        <th>ID Transaksi</th>
                        <td>: {{$detailTransaksi->kode_transaksi}}</td>
                    </tr>
                    <tr>
                        <th>Nomor Invoice</th>
                        <td>: {{$detailTransaksi->nomor_invoice}}</td>
                    </tr>
                    <tr>
                        <th>Nama Siswa</th>
                        <td>: {{$detailTransaksi->first_name}}</td>
                    </tr>
                    <tr>
                        <th style="white-space: nowrap;">Nomor Induk Siswa</th>
                        <td>: {{$detailTransaksi->nis}}</td>
                    </tr>
                    <tr>
                        <th>Alamat Email</th>
                        <td>: {{$detailTransaksi->email}}</td>
                    </tr>
                    <tr>
                        <th style="white-space: nowrap;">Nomor Handphone</th>
                        <td>: {{$detailTransaksi->phone}}</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>: {{$detailTransaksi->tingkat.' '.$detailTransaksi->kode_kelas}}</td>
                    </tr>
                    <tr>
                        <th>Total Tagihan</th>
                        <td>: Rp.{{number_format($detailTransaksi->amount)}},-</td>
                    </tr>
                    <tr>
                        <th>Jenis Tagihan</th>
                        <td>: {{$detailTransaksi->jenis_transaksi}}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>: {{$detailTransaksi->description}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: {{$detailTransaksi->invoice_status}}</td>
                    </tr>
                    <tr>
                        <th style="white-space: nowrap;">Metode Pembayaran</th>
                        <td>: {{$detailTransaksi->payment_type}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
        </div>
    </div>
    @endif


    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalDetailTransaksi', function () {
                $('#modalDetailTransaksi').modal('show')
            }); //membuka modal


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