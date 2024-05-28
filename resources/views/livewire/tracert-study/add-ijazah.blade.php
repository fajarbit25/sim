<div class="col-sm-12">
    <!-- Alert -->
    <div class="col-sm-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> {{ session('message') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Modal Tahun Angkatan -->
    <div class="modal fade" id="modalAddIjazah" tabindex="-1" wire:ignore.self 
    aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="updateTracertStudy">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus"></i>Nomor Ijazah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="form-group mb-3">
                                <label for="ijazah"> Nomor Ijazah <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control @error('ijazah') is-invalid @enderror" 
                                name="ijazah" wire:model="ijazah" aria-describedby="alert-ijazah" required/>
                                @error('ijazah')
                                <div class="form-text text-danger fw-bold">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="skhu"> Nomor SKHU <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control @error('skhu') is-invalid @enderror" 
                                name="skhu" wire:model="skhu" aria-describedby="alert-skhu" required/>
                                @error('skhu')
                                <div class="form-text text-danger fw-bold">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModalIjazah">Close</button>

                        <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" wire:click="AnimatedButton">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {

                Livewire.on('addIjazah', function () {
                    $('#modalAddIjazah').modal('show')
                }); //Membuka modal tahun angkatan

                Livewire.on('closeModalAddIjazah', function () {
                    $('#modalAddIjazah').modal('hide')
                }); //Menutup modal tahun angkatan

            });
        </script>
    @endpush
</div>