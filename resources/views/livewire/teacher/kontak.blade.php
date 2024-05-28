<div class="col-sm-12">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <form wire:submit.prevent="updateContactTeacher">
        <input type="hidden" name="idContactTeacher" id="idContactTeacher" wire:model="user_id">

        <h5 class="my-3 fw-bold">Kontak</h5>

        <div class="row mb-3">
            <label for="telephone" class="col-sm-2 col-form-label">Nomor Telephone <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <input type="text" name="telephone" id="telephone" wire:model="telephone"
                class="form-control @error('telephone') is-invalid @enderror" />
                @error('telephone')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="phone" class="col-sm-2 col-form-label">Nomor Handphone <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <input type="text" name="phone" id="phone" wire:model="phone"
                class="form-control @error('phone') is-invalid @enderror" />
                @error('phone')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Alamat Email <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                <input type="email" name="email" id="email" wire:model="email"
                class="form-control @error('email') is-invalid @enderror" />
                @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        

        <div class="mb-3 col-sm-10 text-end">
            <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" id="btnUpdateContactTeacher" wire:click="AnimatedButton">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Update
            </button>
        </div>

    </form>

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
