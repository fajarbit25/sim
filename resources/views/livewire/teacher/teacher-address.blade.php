<div class="col-sm-12">
    <h5 class="my-3 fw-bold">Alamat</h5>
    <form wire:submit.prevent="updateTeacherAddress">
        <div class="row mb-3">
            <label for="province" class="col-sm-2 col-form-label">Provinsi <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <select wire:model="selectedProvince" id="province" name="province"
                class="form-control @error('province') is-invalid @enderror">
                    @if($provinceActiveName != NULL)
                        <option value="{{$provinceActiveId}}">{{$provinceActiveName}}</option>
                    @endif
                    <option value="">Pilih Provinsi</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                    @endforeach
                </select>
                @error('province')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="city" class="col-sm-2 col-form-label">Kabupaten / Kota <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <select wire:model="selectedCity" id="city" name="city"
                class="form-control @error('city') is-invalid @enderror">
                    @if($cityActiveName != NULL)
                        <option value="{{$cityActiveId}}">{{$cityActiveName}}</option>
                    @endif
                    @foreach($cities as $city)
                        <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                    @endforeach
                </select>
                @error('city')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>


        <div class="row mb-3">
            <label for="district" class="col-sm-2 col-form-label">Kecamatan <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <select wire:model="selectedDistrict" id="district" name="district"
                class="form-control @error('district') is-invalid @enderror">
                    @if($districtActiveName != NULL)
                        <option value="{{$districtActiveId}}">{{$districtActiveName}}</option>
                    @endif
                    @foreach($districts as $district)
                        <option value="{{ $district['id'] }}">{{ $district['name'] }}</option>
                    @endforeach
                </select>
                @error('district')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="district" class="col-sm-2 col-form-label">Desa/Kelurahan <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <select wire:model="selectedVillage" id="village" name="village"
                class="form-control @error('village') is-invalid @enderror">
                    @if($villageActiveName != NULL)
                        <option value="{{$villageActiveId}}">{{$villageActiveName}}</option>
                    @endif
                    @foreach($villages as $village)
                        <option value="{{ $village['id'] }}">{{ $village['name'] }}</option>
                    @endforeach
                </select>
                @error('village')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="dusun" class="col-sm-2 col-form-label">Dusun</label>
            <div class="col-sm-8">
                <input type="text" wire:model="dusun" id="dusun" name="dusun" class="form-control @error('dusun') is-invalid @enderror"/>
                @error('dusun')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="rt" class="col-sm-2 col-form-label">RT <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <input type="text" wire:model="rt" id="rt" name="rt" class="form-control @error('rt') is-invalid @enderror"/>
                @error('rt')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="rw" class="col-sm-2 col-form-label">RW <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <input type="text" wire:model="rw" id="rw" name="rw" class="form-control @error('rw') is-invalid @enderror"/>
                @error('rw')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="jalan" class="col-sm-2 col-form-label">Nama Jalan <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <input type="text" wire:model="jalan" id="jalan" name="jalan" class="form-control @error('jalan') is-invalid @enderror"/>
                @error('jalan')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="lintang" class="col-sm-2 col-form-label">Lintang <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <input type="text" wire:model="lintang" id="lintang" name="lintang" class="form-control @error('lintang') is-invalid @enderror"/>
                @error('lintang')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="bujur" class="col-sm-2 col-form-label">Bujur <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <input type="text" wire:model="bujur" id="bujur" name="bujun" class="form-control @error('bujur') is-invalid @enderror"/>
                @error('bujur')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="kode_pos" class="col-sm-2 col-form-label">Kode POS <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <input type="text" wire:model="kode_pos" id="kode_pos" name="kodepos" class="form-control @error('kode_pos') is-invalid @enderror"/>
                @error('kode_pos')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>


        <div class="mb-3 col-sm-10 text-end">
            <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" id="btnUpdateTeacherAddress" wire:click="AnimatedButton">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Update
            </button>
        </div>

        <div class="mb-3 col-sm-10">
            <div class="alert alert-info">
                <span class="fw-bold fst-italic">Catatan : </span><br/>
                <span class="fst-italic">
                    Untuk mengganti informasi Provinsi, Kabupaten, Kecamatan, & Kelurahan. proses pergantian dimulai dari, 
                </span>&nbsp;
                <span class="fw-bold fst-italic"> Provinsi </span><i class="bi bi-chevron-right"></i>
                <span class="fw-bold fst-italic"> Kabupaten </span><i class="bi bi-chevron-right"></i>
                <span class="fw-bold fst-italic"> Kecamatan </span><i class="bi bi-chevron-right"></i>
                <span class="fw-bold fst-italic"> Kelurahan </span>
            </div>
        </div>


    </form>

    <script>
        //update provinsi
        $("#province").change(function(){

            var url = "/profile/updateTeacherAddressProvice";
            var name = $("#province option:selected").text()
            var id = $("#province").val()

            $.ajax({
                url:url,
                type:'POST',
                cache:false,
                data:{
                    name:name,
                    id:id,
                },
                success:function(response){
                    console.log(name)
                }
            });
        });

        //update kota
        $("#city").change(function(){

            var url = "/profile/updateTeacherAddressCity";
            var name = $("#city option:selected").text()
            var id = $("#city").val()

            $.ajax({
                url:url,
                type:'POST',
                cache:false,
                data:{
                    name:name,
                    id:id,
                },
                success:function(response){
                    console.log(name)
                }
            });
        });

        //update kabupaten
        $("#district").change(function(){

            var url = "/profile/updateTeacherAddressDistricts";
            var name = $("#district option:selected").text()
            var id = $("#district").val()

            $.ajax({
                url:url,
                type:'POST',
                cache:false,
                data:{
                    name:name,
                    id:id,
                },
                success:function(response){
                    console.log(name)
                }
            });
        });

        //update kabupaten
        $("#village").change(function(){

            var url = "/profile/updateTeacherAddressVillages";
            var name = $("#village option:selected").text()
            var id = $("#village").val()

            $.ajax({
                url:url,
                type:'POST',
                cache:false,
                data:{
                    name:name,
                    id:id,
                },
                success:function(response){
                    console.log(name)
                }
            });
        });

    </script>

    @if (session()->has('message'))
        <!-- Flash Mesege -->
        
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: "{{ session('message') }}",
            });
        </script>
        <!--/End Flash Mesege -->
    @endif
</div>
