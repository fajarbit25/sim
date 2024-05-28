<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Identitas</h3>

                <div class="row">

                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="kelas"><i class="bi bi-house-door"></i></label>
                        <select class="form-select" id="kelas" wire:model="kelas" wire:change="getDataNarasi()">
                            <option value="">Pilih Kelas...</option>
                            @foreach($resultKelas as $kls)
                            <option value="{{$kls['idkelas']}}">kelas-{{$kls['kode_kelas']}} </option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="siswa"><i class="bi bi-people"></i></label>
                        <select class="form-select" id="siswa" wire:model="siswa"  wire:change="getDataNarasi()">
                            <option value="">Pilih Siswa...</option>
                            @foreach($resultSiswa as $sis)
                            <option value="{{$sis['id']}}">{{$sis['nama']}} </option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="ta"><i class="bi bi-graph-up-arrow"></i></label>
                        <select class="form-select" id="ta" wire:model.lazy="ta"  wire:change="getDataNarasi()">
                        <option value="">Pilih Tahun Ajaran...</option>
                        @foreach($taResult as $item)
                        <option value="{{$item['tahun_ajaran']}}">{{$item['tahun_ajaran']}}</option>
                        @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="semester"><i class="bi bi-graph-up-arrow"></i></label>
                        <select class="form-select" id="semester" wire:model="semester"  wire:change="getDataNarasi()">
                        <option value="">Pilih Semester...</option>
                        <option value="1">Ganjil</option>
                        <option value="2">Genap</option>
                        </select>
                    </div>
                    </div>
                
                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="fase"><i class="bi bi-calendar2-month"></i></label>
                        <input type="text" name="fase" id="fase" placeholder="Fase.."  
                        class="form-control @error('fase') is-invalid @enderror" wire:model.lazy="fase"/>
                    </div>
                    </div>

                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="tinggi">Tanggal Raport</label>
                        <input type="date" name="tanggal" id="tanggal" placeholder="Tanggal Raport.."  
                        class="form-control @error('tanggal') is-invalid @enderror" wire:model="tanggal"/>
                    </div>
                    </div>

                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="tinggi">Tinggi Badan</label>
                        <input type="text" name="tinggi" id="tinggi" placeholder="Tinggi Badan.."  
                        class="form-control @error('tinggi') is-invalid @enderror" wire:model="tinggi" disabled/>
                        <label class="input-group-text" for="tinggi">Cm</label>
                    </div>
                    </div>

                    <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="berat">Berat Badan</label>
                        <input type="text" name="berat" id="berat" placeholder="Berat Badan.."  
                        class="form-control @error('berat') is-invalid @enderror" wire:model="berat" disabled/>
                        <label class="input-group-text" for="berat">Kg</label>
                    </div>
                    </div>
                
                </div>

            </div>
        </div>
    </div> 

    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Narasi</h3>
                <div class="row">

                    <div class="col-sm-12">
                    <div class="form-group mb-5">
                        <label for="agama" class="text-success fw-bold">
                            A. Nilai Agama dan Budi Pekerti <span class="text-danger">*</span>
                        </label>
                        <textarea name="agama" id="agama" rows="6" class="form-control @error('agama') is-invalid @enderror" wire:model.lazy="agama"></textarea>
                        <div class="row my-t">
                            <div class="col-sm-12 mb-3">
                                @foreach($agamaGambar as $ag)
                                <a href="{{asset('storage/raport-narasi/'.$ag['foto'])}}" target="_blank">
                                    {{$loop->iteration}}. {{$ag['foto']}} |
                                </a> <a href="javascript:void(0)" wire:click="deleteGambar({{$ag['id']}})" class="text-danger"><i class="bi bi-trash"></i> Remove</a><br/>
                                @endforeach
                            </div>
                            @if($countRaport != 0)
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger btn-sm" wire:click="uploadGambar('Agama')"><i class="bi bi-images"></i> Upload Dokumentasi</button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr/>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group mb-5">
                        <label for="jatiDiri" class="text-success fw-bold">
                            B. Jati Diri <span class="text-danger">*</span>
                        </label>
                        <textarea name="jatiDiri" id="jatiDiri" rows="6" class="form-control @error('jatiDiri') is-invalid @enderror" wire:model.lazy="jatiDiri"></textarea>
                        <div class="row my-t">
                            <div class="col-sm-12 mb-3">
                                @foreach($jatiDiriGambar as $jdg)
                                <a href="{{asset('storage/raport-narasi/'.$jdg['foto'])}}" target="_blank">
                                    {{$loop->iteration}}. {{$jdg['foto']}} |
                                </a> <a href="javascript:void(0)" wire:click="deleteGambar({{$ag['id']}})" class="text-danger"><i class="bi bi-trash"></i> Remove</a><br/>
                                @endforeach
                            </div>
                            @if($countRaport != 0)
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger btn-sm" wire:click="uploadGambar('Jati-Diri')"><i class="bi bi-images"></i> Upload Dokumentasi</button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr/>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group mb-5">
                        <label for="literasi" class="text-success fw-bold">
                            C. Dasar Literasi dan STEAM <span class="text-danger">*</span>
                        </label>
                        <textarea name="literasi" id="literasi" rows="6" class="form-control @error('literasi') is-invalid @enderror" wire:model.lazy="literasi"></textarea>
                        <div class="row my-t">
                            <div class="col-sm-12 mb-3">
                                @foreach($literasiGambar as $lg)
                                <a href="{{asset('storage/raport-narasi/'.$lg['foto'])}}" target="_blank">
                                    {{$loop->iteration}}. {{$lg['foto']}} |
                                </a> <a href="javascript:void(0)" wire:click="deleteGambar({{$lg['id']}})" class="text-danger"><i class="bi bi-trash"></i> Remove</a><br/>
                                @endforeach
                            </div>
                            @if($countRaport != 0)
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-danger btn-sm" wire:click="uploadGambar('Literasi')"><i class="bi bi-images"></i> Upload Dokumentasi</button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr/>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group mb-5">
                        <label for="refleksiGuru" class="text-success fw-bold">
                            D. Refleksi Guru <span class="text-danger">*</span>
                        </label>
                        <textarea name="refleksiGuru" id="refleksiGuru" rows="6" class="form-control @error('refleksiGuru') is-invalid @enderror" 
                        wire:model.lazy="refleksiGuru"></textarea>
                        <div class="row my-t">
                            <div class="col-sm-12 mb-3">
                                @foreach($refleksiGuruGambar as $rgg)
                                <a href="{{asset('storage/raport-narasi/'.$rgg['foto'])}}" target="_blank">
                                    {{$loop->iteration}}. {{$rgg['foto']}} |
                                </a> <a href="javascript:void(0)" wire:click="deleteGambar({{$rgg['id']}})" class="text-danger"><i class="bi bi-trash"></i> Remove</a><br/>
                                @endforeach
                            </div>
                            @if($countRaport != 0)
                            <div class="col-sm-12 mb-3">
                                <button type="button" class="btn btn-danger btn-sm" wire:click="uploadGambar('Refleksi-Guru')"><i class="bi bi-images"></i> Upload Dokumentasi</button>
                            </div>
                            @endif
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" wire:model.debounce.5000ms="check" id="defaultCheck1" {{ $check ? 'checked' : '' }}>
                                    <label class="form-check-label" for="defaultCheck1">
                                      Check Sebelum Menyimpan
                                    </label>
                                  </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary btn-sm" wire:click="saveNarasi()" wire:loading.attr="disabled">
                                    <span wire:loading.remove>
                                        <i class="bi bi-save"></i> Simpan Perubahan
                                    </span>
                                    <span wire:loading>
                                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...
                                    </span>
                                </button>
                            </div>
                            @if($countRaport != 0)
                                <div class="col-sm-12 text-end">
                                    <a href="/tk/raport-semester/{{$idNarasi}}/print" target="_blank" class="btn btn-warning btn-sm"><i class="bi bi-printer-fill"></i> Print Narasi</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    @if($countRaport != 0)
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">RAPOR TRIWULAN HAFALAN AL-QURAN, HADITS & DOA</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td> <span class="fw-bold">Nama :</span> {{$namaSiswa}} </td>
                                    <td> <span class="fw-bold">Semester :</span> {{$semester}} </td>
                                    <td rowspan="3">
                                        <img src="{{asset('/Admin/assets/img//logo-sekolah/TKIT.png')}}" alt="Logo" style="max-width: 100px; height:auto;">
                                    </td>
                                </tr>
                                <tr>
                                    <td> <span class="fw-bold">Kelas :</span> {{$kelas}} </td>
                                    <td> <span class="fw-bold">Tinggi Badan :</span> {{$tinggi}} Cm </td>
                                </tr>
                                <tr>
                                    <td> <span class="fw-bold">Fase :</span> {{$fase}} </td>
                                    <td> <span class="fw-bold">Berat Badan :</span> {{$berat}} Kg </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12 mb-2">
                        <button type="button" class="btn btn-success btn-sm mb-2" wire:click="modalHafalan('Tahfidz')"><i class="bi bi-card-text"></i> Hafalan Qur'an</button>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <body>
                                    <tr>
                                        <th rowspan="2" class="vertical-text bg-light" >Hafalan Qur'an</th>
                                        @foreach($hafalanSiswa as $hs)
                                        <th class="text-center">
                                            <?php
                                                $string = $hs['kegiatan'];
                                                $string_cleaned = preg_replace('/[\p{Arabic}\/]+/u', '', $string);
                                                echo $string_cleaned;
                                            ?>
                                        </th>
                                        @endforeach
                                        <th class="bg-light">Lancar</th>
                                        <th class="bg-light">Kurang Lancar</th>
                                        <th class="bg-light">Ulang</th>
                                    </tr>
                                    <tr>
                                        @foreach($hafalanSiswa as $hs)
                                        <td class="text-center">
                                            <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                                <?php
                                                    $string = $hs['kegiatan'];
                                                    $string_cleaned = preg_replace('/[\p{Arabic}\/]+/u', '', $string);
                                                   if($hs['nilai'] == '-'){
                                                    echo '<i class="bi bi-three-dots"></i>';
                                                   }else{
                                                    echo $hs['nilai'];
                                                   }
                                                ?>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilai('{{$hs['id']}}', 'LC')">LC</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilai('{{$hs['id']}}', 'KL')">KL</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilai('{{$hs['id']}}', 'UL')">UL</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="deleteNilai('{{$hs['id']}}', 'UL')">Delete</a></li>
                                            </ul>
                                        </td>
                                        @endforeach
                                        <th class="bg-light"> {{$hafalanSurahLcCount}} </th>
                                        <th class="bg-light"> {{$hafalanSurahKlCount}} </th>
                                        <th class="bg-light"> {{$hafalanSurahUlCount}} </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-2">
                        <button type="button" class="btn btn-info btn-sm mb-2" wire:click="modalHafalan('Hadist')"><i class="bi bi-card-text"></i> Hafalan Hadits</button>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <body>
                                    <tr>
                                        <th rowspan="2" class="vertical-text bg-light" >Hafalan Hadits</th>
                                        @foreach($hafalanHadist as $hh)
                                        <th class="text-center">
                                            <?php
                                                $string = $hh['kegiatan'];
                                                $string_cleaned = preg_replace('/[\p{Arabic}\/]+/u', '', $string);
                                                echo $string_cleaned;
                                            ?>
                                        </th>
                                        @endforeach
                                        <th class="bg-light">Lancar</th>
                                        <th class="bg-light">Kurang Lancar</th>
                                        <th class="bg-light">Ulang</th>
                                    </tr>
                                    <tr>
                                        @foreach($hafalanHadist as $hh)
                                        <td class="text-center">
                                            <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                                <?php
                                                    $string = $hh['kegiatan'];
                                                    $string_cleaned = preg_replace('/[\p{Arabic}\/]+/u', '', $string);
                                                   if($hh['nilai'] == '-'){
                                                    echo '<i class="bi bi-three-dots"></i>';
                                                   }else{
                                                    echo $hh['nilai'];
                                                   }
                                                ?>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilai('{{$hh['id']}}', 'LC')">LC</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilai('{{$hh['id']}}', 'KL')">KL</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilai('{{$hh['id']}}', 'UL')">UL</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="deleteNilai('{{$hh['id']}}', 'UL')">Delete</a></li>
                                            </ul>
                                        </td>
                                        @endforeach
                                        <th class="bg-light"> {{$hafalanHadistLCCount}} </th>
                                        <th class="bg-light"> {{$hafalanHadistKLCount}} </th>
                                        <th class="bg-light"> {{$hafalanHadistULCount}} </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-2">
                        <button type="button" class="btn btn-secondary btn-sm mb-2" wire:click="modalHafalan('Doa')"><i class="bi bi-card-text"></i> Hafalan Doa</button>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <body>
                                    <tr>
                                        <th rowspan="2" class="vertical-text bg-light" >Hafalan Doa</th>
                                        @foreach($hafalanDoa as $hd)
                                        <th class="text-center">
                                            <?php
                                                $string = $hd['kegiatan'];
                                                $string_cleaned = preg_replace('/[\p{Arabic}\/]+/u', '', $string);
                                                echo $string_cleaned;
                                            ?>
                                        </th>
                                        @endforeach
                                        <th class="bg-light">Lancar</th>
                                        <th class="bg-light">Kurang Lancar</th>
                                        <th class="bg-light">Ulang</th>
                                    </tr>
                                    <tr>
                                        @foreach($hafalanDoa as $hd)
                                        <td class="text-center">
                                            <a class="icon" href="javascript:void(0)" data-bs-toggle="dropdown">
                                                <?php
                                                    $string = $hd['kegiatan'];
                                                    $string_cleaned = preg_replace('/[\p{Arabic}\/]+/u', '', $string);
                                                   if($hd['nilai'] == '-'){
                                                    echo '<i class="bi bi-three-dots"></i>';
                                                   }else{
                                                    echo $hd['nilai'];
                                                   }
                                                ?>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilai('{{$hd['id']}}', 'LC')">LC</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilai('{{$hd['id']}}', 'KL')">KL</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="nilai('{{$hd['id']}}', 'UL')">UL</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" wire:click="deleteNilai('{{$hd['id']}}', 'UL')">Delete</a></li>
                                            </ul>
                                        </td>
                                        @endforeach
                                        <th class="bg-light"> {{$hafalanDoaLCCount}} </th>
                                        <th class="bg-light"> {{$hafalanDoaKLCount}} </th>
                                        <th class="bg-light"> {{$hafalanDoaULCount}} </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($countRaport != 0)
                    <div class="col-sm-12 text-end">
                        <a href="/tk/raport-semester/{{$idNarasi}}/print-hafalan" target="_blank" class="btn btn-warning btn-sm"><i class="bi bi-printer-fill"></i> Print Hafalan</a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Upload -->
    <div class="modal fade" id="modalUploadGambar" wire:ignore.self tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-cloud-arrow-up"></i> Upload Dokumentasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="prosesUploadGambar">
                    <div class="input-group">
                        <input type="file" class="form-control @error('fileUpload') is-invalid @enderror" wire:model.lazy="fileUpload" 
                        id="fileUpload" name="fileUpload" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                        <button class="btn btn-danger" type="submit" id="inputGroupFileAddon04" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="bi bi-upload"></i> Upload
                            </span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Processing...
                            </span>
                        </button>
                      </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Hafalan -->
    <div class="modal fade" id="modalHafalan" wire:ignore.self tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-card-text"></i> Pilih [{{$submateriSelected}}]</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="prosesHafalan()">

                    <div class="input-group">
                        <select name="submateriSelected" id="submateriSelected" wire:model="submateriSelected" class="form-control">
                            <option value="">-Pilih Surah</option>
                            @foreach($submateri as $sm)
                            <option value="{{$sm['submateri']}}"> {{$loop->iteration}}. {{$sm['submateri']}} </option>
                            @endforeach
                        </select>

                        <button class="btn btn-success" type="submit" id="inputGroupFileAddon04" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="bi bi-plus"></i> Add
                            </span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Adding...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {

                Livewire.on('modalUploadGambar', function () {
                    $('#modalUploadGambar').modal('show')
                }); //membuka modal upload

                Livewire.on('closeModalUpload', function () {
                    $('#modalUploadGambar').modal('hide')
                }); //menutup modal upload

                Livewire.on('modalHafalan', function () {
                    $('#modalHafalan').modal('show')
                }); //membuka modal upload

                Livewire.on('closeModalHafalan', function () {
                    $('#modalHafalan').modal('hide')
                }); //menutup modal upload

                Livewire.on('notifSuccess', function(){
                    Swal.fire({
                        title: "Success?",
                        text: "Action Successfully?",
                        icon: "success"
                    });
                });

            });
        </script>
    @endpush
</div>

