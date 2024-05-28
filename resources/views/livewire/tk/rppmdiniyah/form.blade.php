<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">RPPM Diniyah</h3>

                <div class="row">

                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="semester"><i class="bi bi-graph-up-arrow"></i></label>
                        <select class="form-select" id="semester" wire:model="semester">
                        <option value="">Pilih Semester...</option>
                        <option value="1">Ganjil</option>
                        <option value="2">Genap</option>
                        </select>
                    </div>
                    </div>
                
                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="bulan"><i class="bi bi-calendar2-month"></i></label>
                        <select class="form-select" id="bulan" wire:model="bulan">
                            <option value="">Pilih Bulan...</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>
                    </div>
                
                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="pekan"><i class="bi bi-calendar2"></i></label>
                        <select class="form-select" id="pekan" wire:model="pekan">
                            <option value="">Pilih Pekan...</option>
                            <option value="01">Pekan-1</option>
                            <option value="02">Pekan-2</option>
                            <option value="03">Pekan-3</option>
                            <option value="04">Pekan-4</option>
                            <option value="05">Pekan-5</option>
                            <option value="06">Pekan-6</option>
                            <option value="07">Pekan-7</option>
                            <option value="08">Pekan-8</option>
                            <option value="09">Pekan-9</option>
                            <option value="10">Pekan-10</option>
                            <option value="11">Pekan-11</option>
                            <option value="12">Pekan-12</option>
                            <option value="13">Pekan-13</option>
                            <option value="14">Pekan-14</option>
                            <option value="15">Pekan-15</option>
                            <option value="16">Pekan-16</option>
                            <option value="17">Pekan-17</option>
                        </select>
                    </div>
                    </div>
                
                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="kelompok"><i class="bi bi-people"></i></label>
                        <select class="form-select" id="kelompok" wire:model="kelas">
                            <option value="">Pilih Kelompok...</option>
                            @foreach($kelompok as $kls)
                            <option value="{{$kls['kode_kelas']}}">Kelompok-{{$kls['kode_kelas']}} </option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                
                    <div class="col-sm-6">
                    <div class="input-group mb-3">

                            <label class="input-group-text" for="topik"><i class="bi bi-arrow-up"></i></label>
                            <input type="text" name="topik" id="topik" class="form-control @error('topik') is-invalid @enderror" 
                            placeholder="Topik..."  wire:model="topik" @if($countMateri != 0) disabled @endif/>

                    </div>
                    </div>
                
                    <div class="col-sm-6">
                    <div class="input-group mb-3">

                            <label class="input-group-text" for="subtopik"><i class="bi bi-arrow-return-right"></i></label>
                            <input type="text" name="subtopik" id="subtopik" class="form-control @error('subtopik') is-invalid @enderror" 
                            placeholder="Sub Topik..." wire:model="subtopik" @if($countMateri != 0) disabled @endif/>
                    </div>
                    </div>
                
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabel Penilaian</h3>

                <div class="table-responsive">
                    @if($semester == "" || $bulan == "" || $pekan == "" || $kelas == "")
                        <span class="fw-bold text-infom fst-italic">Harap lengkapi Paramater diatas!</span>
                    @else 
                        @if($countMateri == 0)
                            <span class="fw-bold text-infom fst-italic">
                                Data untuk Semester {{$semester}}, Bulan {{$bulan}}, Pekan {{$pekan}}, dan Kelompok {{$kelas}}, 
                                Belum ada silahkan Buat Data Baru!
                            </span><br/>
                            <button type="button" class="btn btn-success btn-xs" wire:click="addMateri()">+ Buat data baru</button>
                        @else 
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th colspan="2">Kompetensi Dasar</th>
                                        <th>Materi Pembelajaran</th>
                                        <th>Kegiatan</th>
                                        @foreach($siswa as $student)
                                        <th class="vertical-text">{{$student['first_name']}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($resultMateri as $key => $rMateri)

                                    {{-- Hitung jumlah row pada setiap materi yang sama --}}
                                    @php
                                        $rowspan3 = count($rMateri->getKegiatan); 
                                        $rowspan1 = count($rMateri->segmentMateri);
                                    @endphp

                                    <tr>
                                        {{-- Tampilkan kolom "Materi" hanya di baris pertama --}}
                                        @if ($key === 0 || $rMateri->segment_materi !== $resultMateri[$key-1]->segment_materi)
                                            <td rowspan="{{ $rowspan1 }}">{{ $rMateri->segment_materi }}</td>
                                        @endif

                                        {{-- Tampilkan kolom "Materi" hanya di baris pertama --}}
                                        @if ($key === 0 || $rMateri->segment_materi !== $resultMateri[$key-1]->segment_materi)
                                            <td rowspan="{{ $rowspan1 }}"></td>
                                        @endif
                                        

                                         {{-- Tampilkan kolom "Materi" hanya di baris pertama --}}
                                        @if ($key === 0 || $rMateri->segment_materi !== $resultMateri[$key-1]->segment_materi)
                                            <td rowspan="{{ $rowspan1 }}">
                                                @if($rMateri->segment_materi == '1')
                                                    A
                                                @else 
                                                    B
                                                @endif
                                            </td>
                                        @endif

                                        {{-- Tampilkan kolom "Materi" hanya di baris pertama --}}
                                        @if ($key === 0 || $rMateri->materi !== $resultMateri[$key-1]->materi)
                                            <td rowspan="{{ $rowspan3 }}">{{ $rMateri->materi }}</td>
                                        @endif

                                        <td> 
                                            {{$rMateri->kegiatan}} 
                                            <a href="javascript:void(0)" class="text-danger" wire:click="confirmDeleteRppm({{$rMateri->id}})"> <i class="bi bi-x-lg"></i> Hapus </a>
                                        </td>

                                        {{-- Looping Kolom penilaian berdasakan siswa --}}
                                        @foreach($rMateri->nilai as $nilai)
                                            <td>
                                                <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                                    @if($nilai->nilai == '-')
                                                        <i class="bi bi-three-dots"></i>
                                                    @else 
                                                        {{$nilai->nilai}}
                                                    @endif
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                    <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilaiBB({{$nilai->id}})">BB</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilaiMB({{$nilai->id}})">MB</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilaiBSH({{$nilai->id}})">BSH</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilaiBSB({{$nilai->id}})">BSB</a></li>
                                                </ul>
                                            </td>
                                        @endforeach
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{url('/tk/rppm-diniyah/'.$idPrint.'/print')}}" target="_blank" class="btn btn-danger btn-xs"><i class="bi bi-printer-fill"></i> Print </a>
                            <button type="button" class="btn btn-primary btn-xs" wire:click="addMateri()"> Buat baris baru <i class="bi bi-arrow-right"></i></button>
                        @endif
                    
                    @endif

                </div>
            </div>
        </div>
    
    </div>   
    
    <div class="modal fade" id="modalAddMateri" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="bi bi-plus"></i> Materi / Kegiatan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <input type="hidden" name="idhari" id="idhari">
                
                <div class="form-group mb-3">
                  <label for="kegiatan">Pilih Materi <span class="text-danger">*</span> </label>
                    <select name="materi" id="materi" wire:model="materi" class="form-control">
                        <option value="">-Pilih Materi..</option>
                        @foreach($resultFormMateri as $mat)
                        <option value="{{$mat['materi']}}"> {{$loop->iteration}}. {{$mat['materi']}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="kegiatan">Pilih Kegiatan <span class="text-danger">*</span> </label>
                      <select name="kegiatan" id="kegiatan" wire:model="kegiatan" class="form-control">
                          <option value="">-Pilih Kegiatan..</option>
                          @foreach($resultFormKegiatan as $keg)
                          <option value="{{$keg['kegiatan']}}"> {{$loop->iteration}}. {{$keg['kegiatan']}} </option>
                          @endforeach
                      </select>
                </div>

                @if($kegiatan == "DIISI SENDIRI")
                    <div class="form-group mb-3">
                        <label for="manualForm">Masukan Nama Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" id="manualForm" class="form-control" wire:model="manualForm">
                    </div>
                @endif

              </div>
            </div>
            <div class="modal-footer"> 
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="btnAddKeterangan" wire:click="createRppmDiniyah()"><i class="bi bi-plus"></i> Tambahkan</button>
            </div>
          </div>
        </div>
    </div><!-- End Basic Modal-->

    <div class="modal fade" id="modalDeleteMateri" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="bi bi-trash"></i> Confirm</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="fw-bold fst-italic">Yakin ingin menghapus?</span>
                <div class="col-sm-12 text-end">

                    <button type="button" class="btn btn-danger" wire:click="deleteRppmDiniyah()" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="bi bi-trash"></i>Ya
                        </span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Menghapus...
                        </span>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                </div>
            </div>
            <div class="modal-footer"> 
            </div>
          </div>
        </div>
    </div><!-- End Basic Modal-->



    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {

                Livewire.on('addMateri', function () {
                    $('#modalAddMateri').modal('show')
                }); //Membuka modal Edit

                Livewire.on('closeModal', function () {
                    $('#modalAddMateri').modal('hide')
                }); //Menutup modal Edit

                Livewire.on('modalConfirmDelete', function () {
                    $("#modalDeleteMateri").modal('show')
                } );

                Livewire.on('closeModalDelete', function () {
                    $("#modalDeleteMateri").modal('hide')
                } );

            });
        </script>
    @endpush
</div>

