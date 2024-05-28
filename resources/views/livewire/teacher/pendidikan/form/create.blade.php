<div class="col-sm-12 row">
    <div class="col-sm-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> {{ session('message') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="col-sm-12 my-4">
        <h5 class="text-success">Pendidikan Formal</h5>
        <button type="button" class="btn btn-success btn-sm" wire:click="create">
            <i class="bi bi-plus-lg"></i> Tambah Data
        </button>
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="modalCreatePendidikanTeacher" wire:ignore.self 
    tabindex="-1" aria-labelledby="modalCreatePendidikanTeacherLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="storePendidikanTeacher">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreatePendidikanTeacherLabel">Tambah Data Pendidikan</h1>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                
                    <div class="form-group mb-3 col-sm-6">
                        <label for="bidang_studi"> Bidang Study <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('bidang_studi') is-invalid @enderror" 
                        name="bidang_studi" wire:model="bidang_studi">
                        @error('bidang_studi')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="jenjang"> Jenjang <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('jenjang') is-invalid @enderror" 
                        name="jenjang" wire:model="jenjang">
                        @error('jenjang')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="gelar_akademik"> Gelar Akademik <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('gelar_akademik') is-invalid @enderror" 
                        name="gelar_akademik" wire:model="gelar_akademik">
                        @error('gelar_akademik')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="satuan_pendidikan_formal"> Satuan Pendidikan Formal <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('satuan_pendidikan_formal') is-invalid @enderror" 
                        name="satuan_pendidikan_formal" wire:model="satuan_pendidikan_formal">
                        @error('satuan_pendidikan_formal')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="tahun_masuk"> Tahun Masuk <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('tahun_masuk') is-invalid @enderror" 
                        name="tahun_masuk" wire:model="tahun_masuk">
                        @error('tahun_masuk')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="tahun_lulus"> Tahun Lulus <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" 
                        name="tahun_lulus" wire:model="tahun_lulus">
                        @error('tahun_lulus')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="nim"> NIM <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                        name="nim" wire:model="nim">
                        @error('nim')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="matkul"> Mata Kuliah <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('matkul') is-invalid @enderror" 
                        name="matkul" wire:model="matkul">
                        @error('matkul')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="semester"> Semester <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('semester') is-invalid @enderror" 
                        name="semester" wire:model="semester">
                        @error('semester')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-6">
                        <label for="ipk"> IPK <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('ipk') is-invalid @enderror" 
                        name="ipk" wire:model="ipk">
                        @error('ipk')
                            <div class="invalid-feedback">{{$message}}, Gunakan titik "." untuk bilangan Decimal</div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">Close</button>

                <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" wire:click="AnimatedButton">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Simpan
                </button>
            </div>
            </form>
        </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {

                Livewire.on('openModalCreate', function () {
                    $('#modalCreatePendidikanTeacher').modal('show')
                }); //Membuka modal create

                Livewire.on('closeModalCreate', function () {
                    $('#modalCreatePendidikanTeacher').modal('hide')
                }); //Menutup modal create
            });
        </script>
    @endpush


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

