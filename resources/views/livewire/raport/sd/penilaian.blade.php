<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Form Penilaian</h3>
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
                                <input type="text" name="" id="" class="form-control" value="@if($semester == 1) Ganjil @elseif($semester == 2) Genap @endif" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control" wire:model="kelas" @if(count($dataKelas) == 0) disabled @endif>
                                    @if(count($dataKelas) != 0)
                                    <option value="0">Pilih Kelas--</option>
                                    @foreach($dataKelas as $item)
                                    <option value="{{$item->idkelas}}">{{$item->tingkat. ' '.$item->kode_kelas}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran</label>
                                <select name="mapel" id="mapel" class="form-control" wire:model="mapel" @if(count($dataMapel) == 0) disabled @endif>
                                    @if(count($dataMapel) != 0)
                                    <option value="0">Pilih Mapel--</option>
                                    @foreach($dataMapel as $item)
                                    <option value="{{$item->idmapel}}">{{$item->kode_mapel. ' - '.$item->nama_mapel}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="aspek">Aspek Penilaian</label>
                                <select name="aspek" id="aspek" class="form-control" wire:model="mapel" @if(count($dataMapel) == 0) disabled @endif>
                                    <option value="0">-Pilih Aspek Penilaian--</option>
                                    <option value="Pengetahuan">Pengetahuan</option>
                                    <option value="Keterampilan">Keterampilan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary btn-sm" wire:loading.attr="disables" wire:click="createFormNilai()">
                                <span wire:loading> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> </span> 
                                <span wire:loading.remove><i class="bi bi-plus"></i></span>
                                Buat Form Penilaian
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
