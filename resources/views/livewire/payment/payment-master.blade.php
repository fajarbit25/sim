<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                        Data Tagihan Siswa
                    </h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="jenis">
                                    <a href="javascript:void(0)" wire:click="modalJenis()"><i class="bi bi-plus-lg"></i></a>
                                </label>
                                <select class="form-select" id="jenis" wire:model="jenis">
                                    <option value="">Jenis Tagihan...</option>
                                    @foreach($dataJenisTagihan as $item)
                                    <option value="{{$item->id}}"> {{$item->jenis}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-toggles2"></i></label>
                                <select class="form-select" id="inputGroupSelect01" wire:model="kelas">
                                    <option value="">Kelas...</option>
                                    @if($dataKelas)
                                        @foreach ($dataKelas->groupBy('tingkat') as $tingkat => $items)
                                            <option value="{{$tingkat}}">Kelas {{$tingkat}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if($dataTagihan)
                            @if(count($dataTagihan) == 0)
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon2">Total Tagihan :</span>
                                    <input type="number" class="form-control @error('totalPrice') is-invalid @enderror" wire:model="totalPrice" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Rp.{{number_format((float)$totalPrice)}},-</span>
                                    <div id="basic-addon2" class="form-text">
                                        Dapat diisikan tagihan pokok (Sebelum Potongan)
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary" wire:click="createInvoice()">
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                                    Buat Tagihan
                                </button>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                        Tabel Tagihan Siswa
                    </h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Siswa </th>
                                    <th> NIS/NISN </th>
                                    <th> Jenis Tagihan </th>
                                    <th> Tagihan </th>
                                    <th> Potongan </th>
                                    <th> Total Tagihan </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($dataTagihan)
                                @foreach ($dataTagihan as $items)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$items->first_name}} </td>
                                    <td> {{$items->nis.'/'.$items->nisn}} </td>
                                    <td> {{$items->jenis}} </td>
                                    <td> Rp.{{number_format($items->total_price+$items->potongan)}},- </td>
                                    <td> 
                                        <a href="javascript:void(0)" class="text-success" wire:click="modalPotongan({{$items->user_id}})">
                                        Rp.{{number_format($items->potongan)}} 
                                        </a>
                                    </td>
                                    <th> Rp.{{number_format($items->total_price)}},- </th>
                                </tr>
                                @endforeach
        
                                @if(count($dataTagihan) == 0) 
                                <tr>
                                    <td colspan="8" class="fst-italic">Tidak ada data!</td>
                                </tr>
                                @else 
                                <tr>
                                    <td colspan="8">{{$dataTagihan->links()}}</td>
                                </tr>
                                @endif
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalPotongan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">List Potongan Tagihan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 mb-5">
                    <div class="input-group">
                        <select class="form-select" id="inputGroupSelect04" wire:model="discount">
                          <option value="">Pilih Jenis Potongan...</option>
                          @foreach ($paymentDiscount as $item)    
                          <option value="{{$item->id}}">{{$item->jenis_discount}}</option>
                          @endforeach
                        </select>
                        <button class="btn btn-outline-secondary" type="button" wire:click="addDiscount()">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                            Tambahkan
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($userIdDiscount)
                            @foreach ($dataDiscount as $item)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->jenis_discount}} </td>
                                <td> Rp.{{number_format($item->total_discount)}},- </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-danger" wire:click="removeDiscount({{$item->idDiscountUser}})"><i class="bi bi-x-lg"></i> Remove</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($dataDiscount) == 0)
                            <tr>
                                <td colspan="4" class="fst-italic">Tidak ada data!</td>
                            </tr>
                            @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalJenis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Jenis Tagihan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control @error('inputJenis') is-invalid @enderror" wire:model="inputJenis">
                        <button class="btn btn-outline-secondary" type="button" wire:click="addJenis()">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                            Tambahkan
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($dataJenisTagihan)
                            @foreach ($dataJenisTagihan as $item)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->jenis}} </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-danger" wire:click="removeJenis({{$item->id}})"><i class="bi bi-x-lg"></i> Remove</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($dataJenisTagihan) == 0)
                            <tr>
                                <td colspan="4" class="fst-italic">Tidak ada data!</td>
                            </tr>
                            @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalPotongan', function () {
                $('#modalPotongan').modal('show')
            }); //membuka modal
            Livewire.on('modalJenis', function () {
                $('#modalJenis').modal('show')
            }); //membuka modal

            // Livewire.on('closeModal', function () {
            //     $('#modalAdd').modal('hide')
            //     $('#modalDelete').modal('hide')
            // }); //membuka modal

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