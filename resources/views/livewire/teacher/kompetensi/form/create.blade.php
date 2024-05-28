<div class="col-sm-12 row">

    <div class="col-sm-12 my-4">
        <h5 class="text-success">Kompetensi</h5>
        <button type="button" class="btn btn-success btn-sm" wire:click="create">
            <i class="bi bi-plus-lg"></i> Tambah Data
        </button>
    </div>

    <div class="col-sm-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> {{ session('message') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <!-- Modal Create -->
    <div class="modal fade" id="modalCreateKompetensiTeacher" wire:ignore.self 
    tabindex="-1" aria-labelledby="modalCreateKompetensiTeacherLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="createKompetensiTeacher">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateKompetensiTeacherLabel">Tambah Data Kompetensi</h1>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                
                    <div class="form-group mb-3 col-sm-8">
                        <label for="bidang_studi"> Bidang Study <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('bidang_studi') is-invalid @enderror" 
                        name="bidang_studi" wire:model="bidang_studi">
                        @error('bidang_studi')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-sm-4">
                        <label for="urutan"> Urutan <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('urutan') is-invalid @enderror" 
                        name="urutan" wire:model="urutan">
                        @error('urutan')
                            <div class="invalid-feedback">{{$message}}</div>
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

                Livewire.on('createKompetensi', function () {
                    $('#modalCreateKompetensiTeacher').modal('show')
                }); //Membuka modal create

                Livewire.on('closeModal', function () {
                    $('#modalCreateKompetensiTeacher').modal('hide')
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

