<div class="col-sm-12 row">
    <div class="col-sm-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> {{ session('message') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    @livewire('teacher.diklat.form.create', ['userid' => $userid])
    @livewire('teacher.diklat.form.edit')
    @livewire('teacher.diklat.form.delete')

    {{-- Table --}}
    <div class="cols-m-12">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Jenis Diklat</th>
                    <th>Nama Diklat</th>
                    <th>Penyelenggara</th>
                    <th>Tahun</th>
                    <th>Peran</th>
                    <th>Tingkat</th>
                    <th>Berapa Jam</th>
                    <th>Sertifikat Diklat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collection as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <button wire:click="editDiklat({{ $item->id }})" class="btn btn-primary btn-xs">
                                <i class="bi bi-pencil"></i> Ubah
                            </button>
                            <button wire:click="deleteDiklat({{ $item->id }})" class="btn btn-danger btn-xs">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </td>
                        <td>{{$item->jenis}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->penyelenggara}}</td>
                        <td>{{$item->tahun}}</td>
                        <td>{{$item->peran}}</td>
                        <td>{{$item->tingkat}}</td>
                        <td>{{$item->berapa_jam}}</td>
                        <td>{{$item->sertifikat_diklat}}</td>
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

