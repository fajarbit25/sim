<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <span wire:loading class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        Form Penilaian
                    </h3>
                    @if (session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="ta">Tahun Ajaran</label>
                                <input type="text" class="form-control" disabled wire:model="ta"/>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input type="text" class="form-control" value="@if($semester == 1) Ganjil @elseif($semester == 2) Genap @endif" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control @error('kelas') is-invalid @enderror" 
                                wire:model="kelas" @if(count($dataKelas) == 0) disabled @endif>
                                    @if(count($dataKelas) != 0)
                                    <option value="0">Pilih Kelas--</option>
                                    @foreach($dataKelas as $item)
                                    <option value="{{$item->idkelas}}">Kelas {{$item->tingkat. ' '.$item->kode_kelas}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran</label>
                                <select class="form-control @error('mapel') is-invalid @enderror " 
                                wire:model="mapel" @if(count($dataMapel) == 0) disabled @endif>
                                    @if(count($dataMapel) != 0)
                                    <option value="0">Pilih Mapel--</option>
                                    @foreach($dataMapel as $item)
                                    <option value="{{$item->mapel_id}}">{{$item->kode_mapel. ' - '.$item->nama_mapel}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="aspek">Aspek Penilaian</label>
                                <select name="aspek" id="aspek" class="form-control @error('aspek') is-invalid @enderror" 
                                wire:model="aspek" @if(count($dataMapel) == 0) disabled @endif>
                                    <option value="0">-Pilih Aspek Penilaian--</option>
                                    <option value="Formatif">Formatif</option>
                                </select>
                            </div>
                        </div>
                        @if(count($dataNilai) == 0)
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary btn-sm" wire:loading.attr="disabled" wire:click="createFormNilai()">
                                <span wire:loading> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> </span> 
                                <span wire:loading.remove><i class="bi bi-plus"></i></span>
                                Buat Form Penilaian
                            </button>
                            <br/>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div><!--/.col-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Daftar Nilai SDIT Ibnul Qayyim Makassar</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIS/NISN</th>
                                    <th>Nama</th>
                                    <th style="white-space: nowrap;">Nama Panggilan</th>
                                    @foreach ($dataKd as $item)
                                        <th>{{$item->kode}}</th>
                                    @endforeach
                                    <th class="bg-light">HPA</th>
                                    <th class="bg-light">Predikat</th>
                                    <th class="bg-light">Max</th>
                                    <th class="bg-light">Min</th>
                                    <th>Capaian Kompetensi Upper/Lower</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataNilai->groupBy('first_name') as $namaSiswa => $items)
                                <tr>
                                    <td rowspan="2"> {{$loop->iteration}} </td>
                                    <td rowspan="2"> {{$items->first()->nis}} </td>
                                    <td rowspan="2" style="white-space: nowrap;"> {{$namaSiswa}} </td>
                                    <td rowspan="2">
                                        @if(!$items->first()->nick_name)
                                            <a href="javascript:void(0)" class="fw-bold" wire:click="modalNickName('{{$items->first()->idsiswa}}', '{{$namaSiswa}}')"> Input </a>
                                        @else 
                                        {{$items->first()->nick_name}}
                                        @endif
                                    </td>

                                    @foreach($items as $item)
                                    <td rowspan="2">
                                        <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                           {{$item->nilai}}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <div class="col-sm-12" style="padding-left: 10px; padding-right:10px; max-width:200px;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('nilai') is-invalid @endif" aria-describedby="button-addon2" wire:model.lazy="nilai">
                                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" wire:loading.attr="disabled" wire:click="updateNilaiKd({{$item->id_nilai}})">
                                                        <i class="bi bi-check"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </ul>
                                    </td>
                                    @endforeach
                                    <th rowspan="2" class="bg-light">
                                        <span class="@if($items->avg('nilai') <= $kkm) text-danger @endif"> 
                                            {{ number_format($items->avg('nilai'), 2) }}
                                        </span>
                                    </th>
                                    <th rowspan="2" class="bg-light">
                                        @foreach($dataPredikat as $predikat)
                                            @if($predikat->nilai_min <= number_format($items->avg('nilai'), 0) && $predikat->nilai_max >= number_format($items->avg('nilai'), 0))
                                                {{$predikat->deskripsi}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td rowspan="2" class="bg-light">{{ $items->max('nilai') }}</td>
                                    <td rowspan="2" class="bg-light">{{ $items->min('nilai') }}</td>
                                    <td>
                                        <span>{{$items->first()->nick_name}} </span>

                                        @foreach($dataCapaian as $capaian)
                                        @if($capaian->nilai_min <= $items->max('nilai') && $capaian->nilai_max >= $items->max('nilai'))
                                        <span class="fw-bold"> {{$capaian->deskripsi}} </span>
                                        @endif
                                        @endforeach

                                        <span>dalam </span>

                                        @foreach ($dataKd as $kd)
                                            @if($kd->id == $items->where('nilai', $items->max('nilai'))->first()->idkd)
                                            <span class="fw-bold">{{$kd->deskripsi}} </span>
                                            @endif
                                        @endforeach
                                        .
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>{{$items->first()->nick_name}} </span>

                                        @foreach($dataCapaian as $capaian)
                                        @if($capaian->nilai_min <= $items->min('nilai') && $capaian->nilai_max >= $items->min('nilai'))
                                        <span class="fw-bold"> {{$capaian->deskripsi}} </span>
                                        @endif
                                        @endforeach

                                        <span>dalam </span>

                                        @foreach ($dataKd as $kd)
                                            @if($kd->id == $items->where('nilai', $items->min('nilai'))->first()->idkd)
                                            <span class="fw-bold">{{$kd->deskripsi}}, </span>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalNickName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">{{$name}}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="nick_name">Masukkan Nama Panggilan <span class="text-danger">*</span> </label>
                <input type="text" class="form-control @error('nick_name') is-invalid @enderror" wire:model="nick_name">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click="updateNickName()">
               <span wire:loading> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> </span> Simpan
            </button>
        </div>
        </div>
    </div>
    </div>


    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('modalNickName', function () {
                $('#modalNickName').modal('show')
            }); //membuka modalodal('show')


            Livewire.on('closeModal', function () {
                $('#modalNickName').modal('hide')
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
