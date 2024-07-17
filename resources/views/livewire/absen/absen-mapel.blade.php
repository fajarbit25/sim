<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                        Form Absensi Mata Pelajaran
                    </h3>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="input-group mb-3">
                                <select class="form-select" id="inputGroupSelect02" wire:model="kelas">
                                    <option value="">Pilih Kelas...</option>
                                    @if($dataKelas)
                                        @foreach ($dataKelas as $item)     
                                            <option value="{{$item->idkelas}}">Kelas {{$item->tingkat.' '.$item->kode_kelas}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <select class="form-select" id="inputGroupSelect02" wire:model="mapel">
                                    <option value="">Pilih Mata Pelajaran...</option>
                                    @if($dataMapel)
                                        @foreach ($dataMapel as $item)     
                                            <option value="{{$item->idmapel}}">{{$item->kode_mapel.' - '.$item->nama_mapel}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-success" wire:click="generateAbsensi()">
                                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                                Generate
                            </button>
                            <button type="button" class="btn @if($sendAbsensiCount == 0) btn-secondary @else btn-primary @endif" wire:click="kirimNotifikasi()">
                                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                                    @if($sendAbsensiCount == 0)
                                    <i class="bi bi-bell-fill"></i> Notifikasi Terkirm
                                    @else
                                    <i class="bi bi-bell-fill"></i> ({{$sendAbsensiCount}}) Kirim Notifikasi 
                                    @endif
                            </button>

                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        Daftar Hadir
                                    </h3>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                            <input type="search" class="form-control" placeholder="Cari siswa" wire:model="search"  aria-describedby="basic-addon1">
                                            <span class="input-group-text bg-success text-light" id="basic-addon1"><i class="bi bi-search"></i></span>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIS/NISN</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Kehadiran</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($dataAbsen)
                                                @foreach($dataAbsen as $items)
                                                <tr>
                                                    <td> {{$loop->iteration}} </td>
                                                    <td> <span class="fw-bold"> {{$items->nis.' / '.$items->nisn}} </span> </td>
                                                    <td> {{$items->first_name}} </td>
                                                    <td> {{$items->gender}} </td>
                                                    <td> 
                                                        @if($items->absensi == "Hadir")
                                                            <button type="button" class="btn btn-primary btn-xs" wire:click="modalPresensi({{$items->idabsen}})"> 
                                                                @if($items->status == 1) <i class="bi bi-bell-fill"></i> @else <i class="bi bi-bell-slash-fill"></i> @endif  {{$items->absensi}}
                                                            </button>
                                                        @elseif($items->absensi == "Sakit")
                                                            <button type="button" class="btn btn-success btn-xs" wire:click="modalPresensi({{$items->idabsen}})">
                                                                @if($items->status == 1) <i class="bi bi-bell-fill"></i> @else <i class="bi bi-bell-slash-fill"></i> @endif  {{$items->absensi}}
                                                            </button>
                                                        @elseif($items->absensi == "Izin")
                                                            <button type="button" class="btn btn-warning btn-xs" wire:click="modalPresensi({{$items->idabsen}})">
                                                                @if($items->status == 1) <i class="bi bi-bell-fill"></i> @else <i class="bi bi-bell-slash-fill"></i> @endif  {{$items->absensi}}
                                                            </button>
                                                        @elseif($items->absensi == "Alfa")
                                                            <button type="button" class="btn btn-danger btn-xs" wire:click="modalPresensi({{$items->idabsen}})">
                                                                @if($items->status == 1) <i class="bi bi-bell-fill"></i> @else <i class="bi bi-bell-slash-fill"></i> @endif  Tanpa Keterangan
                                                            </button>
                                                        @else 
                                                            <button type="button" class="btn btn-secondary btn-xs" wire:click="modalPresensi({{$items->idabsen}})">
                                                                @if($items->status == 1) <i class="bi bi-bell-fill"></i> @else <i class="bi bi-bell-slash-fill"></i> @endif  {{$items->absensi}}
                                                            </button>
                                                        @endif
                                                     </td>
                                                    <td> {{$items->keterangan}} </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        Presensi 
                                    </h3>
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                          <div class="ms-2 me-auto">
                                            <div class="fw-bold">Hadir</div>
                                          </div>
                                          <span class="badge text-bg-primary rounded-pill">{{$hadir}} Orang</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                          <div class="ms-2 me-auto">
                                            <div class="fw-bold">Sakit</div>
                                          </div>
                                          <span class="badge text-bg-success rounded-pill">{{$sakit}} Orang</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                          <div class="ms-2 me-auto">
                                            <div class="fw-bold">Izin</div>
                                          </div>
                                          <span class="badge text-bg-warning rounded-pill">{{$izin}} Orang</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                              <div class="fw-bold">Tanpa Keterangan</div>
                                            </div>
                                            <span class="badge text-bg-danger rounded-pill">{{$alfa}} Orang</span>
                                          </li>
                                      </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalPresensi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Kehadiran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="form-group mb-3">
                        <label for="presensi"></label>
                        <select class="form-select @error('presensi') is-invalid @enderror" id="inputGroupSelect04" aria-label="Example select with button addon" wire:model="presensi">
                            <option value="">-Pilih Presensi</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Alfa">Alfa</option>
                        </select>
                    </div>
                </div>
                @if($presensi == "Izin")
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="keterangan">Keterangan <span class="text-danger">*</span> </label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" wire:model="keterangan"></textarea>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button class="btn btn-success" type="button" wire:click="updatePresensi">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                    Simpan
                </button>
            </div>
        </div>
        </div>
    </div>


    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalPresensi', function () {
                $('#modalPresensi').modal('show')
            }); //membuka modal


            Livewire.on('closeModal', function () {
                $('#modalPresensi').modal('hide')
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


</div>