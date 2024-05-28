<div class="col-sm-12">
    <div class="row">

        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                            <h3 class="card-title">Form Raport</h3>
                            <div class="col-sm-12">
                                {{-- <div class="col-sm-12">
                                    <button type="button" class="btn btn-success btn-sm mb-3" wire:click="createForm()">
                                        <i class="bi bi-plus-lg"></i> Tambah Data Baru 
                                    </button>
                                </div> --}}
                            </div>
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="font-size: 12px;">
                                        <tbody>
                                            <tr>
                                                <th class="bg-light" rowspan="2">NO</th>
                                                <th class="bg-light" rowspan="2">ASPEK PERKEMBANGAN</th>
                                                <th class="bg-light" rowspan="2">INDIKATOR DAN TINGKAT PERKEMBANGAN</th>
                                                <th class="bg-light" colspan="4">HASIL PENILAIAN</th>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">BSB</th>
                                                <th class="bg-light">BSH</th>
                                                <th class="bg-light">MB</th>
                                                <th class="bg-light">BB</th>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">I</td>
                                                <td class="fw-bold" colspan="2">NILAI-NILAI AGAMA DAN MORAL</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @php
                                                $letters = range('A', 'Z');
                                            @endphp
                                            @foreach($dataAgama->groupBy('subkategori') as $subkategori => $items)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="fw-bold">{{$letters[$loop->iteration - 1]}}. {{$subkategori}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                                @foreach($items as $item)
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            @if($item->tujuan)
                                                            {{$loop->iteration}}. 
                                                            @endif

                                                            {{$item->tujuan}}
                                                        </td>
                                                        <td>{{$loop->iteration}}. {{$item->materi}}</td>
                                                        <td><i class="bi bi-check-lg"></i></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                           
                                            @foreach($dataAll->groupBy('kategori') as $kategori => $subs)
                                            <tr>
                                                <td class="fw-bold">
                                                    @if($loop->iteration == 1) II
                                                    @elseif($loop->iteration == 2) III
                                                    @elseif($loop->iteration == 3) IV
                                                    @elseif($loop->iteration == 4) V
                                                    @elseif($loop->iteration == 5) VI
                                                    @elseif($loop->iteration == 6) VII
                                                    @elseif($loop->iteration == 7) VIII
                                                    @elseif($loop->iteration == 8) IX
                                                    @elseif($loop->iteration == 9) X
                                                    @elseif($loop->iteration == 10) XI
                                                    @endif
                                                </td>
                                                <td class="fw-bold" colspan="2">{{strtoupper($kategori)}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                                @foreach($subs->groupBy('subkategori') as $subkategory => $items)
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2">{{$loop->iteration}}. {{$subkategory}}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                    @foreach($items as $item)
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                        
                                                            <div class="row"> <!-- Membuat baris Bootstrap -->
                                                                <div class="col-md-1 text-end"><i class="bi bi-dash-lg"></i></div> <!-- Grid kosong untuk offset -->
                                                                <div class="col-md-11"> <!-- Kolom utama untuk $item->materi -->
                                                                    {{$item->materi}}
                                                                </div>
                                                            </div>

                                                        </td>
                                                        <td></td>
                                                        <td><i class="bi bi-check-lg"></i></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @endforeach
                                                @endforeach
                                            @endforeach

                                            <tr>
                                                <td class="fw-bold">VII</td>
                                                <td class="fw-bold" colspan="2">KESIMPULAN PERKEMBANGAN ANAK</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td colspan="2">- Tingkat Pencapaian Perkembangan: Berkembang Sangat Baik (BSB)</td>
                                                <td colspan="2" class="fw-bold">67/127</td>
                                                <td colspan="2" class="fw-bold">(52.76%)</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="2">- Tingkat Pencapaian Perkembangan: Berkembang Sesuai Harapan (BSH)</td>
                                                <td colspan="2" class="fw-bold">67/127</td>
                                                <td colspan="2" class="fw-bold">(52.76%)</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="2">- Tingkat Pencapaian Perkembangan: Mulai Berkembang (MB)</td>
                                                <td colspan="2" class="fw-bold">67/127</td>
                                                <td colspan="2" class="fw-bold">(52.76%)</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="2">- Tingkat Pencapaian Perkembangan: Belum Berkembang (BB)</td>
                                                <td colspan="2" class="fw-bold">67/127</td>
                                                <td colspan="2" class="fw-bold">(52.76%)</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold"></td>
                                                <td colspan="6">
                                                    <span>Deskripsi :</span> <br/>
                                                    <span class="text-center">
                                                        Terimakasih atas kerjasama Abu dan Ummu dalam membimbing ananda memuroja'ah materi ketika belajar di rumah. 
                                                        Selanjutnya kami merekomendasikan untuk senantiasa membimbing dan menemani ananda dalam hal berlatih menulis, 
                                                        berhitung dan membaca Iqro'. Barakallahu Fiik. (Example)
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="fw-bold">VIII</td>
                                                <td class="fw-bold" colspan="6"> CATATAN DAN REKOMENDASI WALI KELAS</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold"></td>
                                                <td colspan="6" class="text-center">
                                                    Terimakasih atas kerjasama Abu dan Ummu dalam membimbing ananda memuroja'ah materi ketika belajar di rumah. 
                                                    Selanjutnya kami merekomendasikan untuk senantiasa membimbing dan menemani ananda dalam hal berlatih menulis, 
                                                    berhitung dan membaca Iqro'. Barakallahu Fiik. (Example)
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div><!--/.Col-->

    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus-lg"></i> Create</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="aspek">Aspek Perkembangan <span class="text-danger">*</span> </label>
                        <select name="aspek" id="aspek" class="form-control" wire:model="aspek" wire:change="getSubCategori()">
                            <option value="">Pilih Aspek</option>
                            @if($dataMaster)
                                @foreach($dataMaster->groupBy('kategori') as $kategori => $subs)
                                    <option value="{{$kategori}}">{{$kategori}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="subkategori">Sub Kategori <span class="text-danger">*</span> </label>
                        <select name="subkategori" id="subkategori" class="form-control" wire:model="subkategori" wire:change="getDataMateri()">
                            @if($dataSubKategori)
                                @foreach($dataSubKategori as $item)
                                    <option value="{{$item->subkategori}}">{{$item->subkategori}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="materi">Materi <span class="text-danger">*</span> </label>
                        <select name="materi" id="materi" class="form-control" wire:model="materi">
                            @if($dataMateri)
                                @foreach($dataMateri as $item)
                                    <option value="{{$item->materi}}">{{$item->materi}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="tujuan">Materi <span class="text-danger">*</span> </label>
                        <input type="text" name="tujuan" id="tujuan" class="form-control" wire:model="tujuan"/>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {

                Livewire.on('modalCreate', function () {
                    $('#modalCreate').modal('show')
                }); //membuka modal


                Livewire.on('showAlert', function (data) {
                    Swal.fire({
                        icon: data.type,
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                });

            });
        </script>
    @endpush

</div>
