<div class="col-sm-12 row">
    <div class="col-sm-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> {{ session('message') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    @livewire('teacher.kompetensi.form.create', ['userid' => $userid])
    @livewire('teacher.kompetensi.form.edit')
    @livewire('teacher.kompetensi.form.delete')

    {{-- Table --}}
    <div class="cols-m-12">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Bidang Studi</th>
                    <th>Urutan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collection as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <button wire:click="editKompetensi({{ $item->id }})" class="btn btn-primary btn-xs">
                                <i class="bi bi-pencil"></i> Ubah
                            </button>
                            <button wire:click="deleteKompetensi({{ $item->id }})" class="btn btn-danger btn-xs">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </td>
                        <td>{{$item->bidang_studi}}</td>
                        <td>{{$item->urutan}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-sm-12">
        {{$collection->links()}}
    </div>


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

