<div class="col-sm-12 row">

    @livewire('teacher.buku.form.create', ['userid' => $userid])
    @livewire('teacher.buku.form.edit')
    @livewire('teacher.buku.form.delete')

    {{-- Table --}}
    <div class="cols-m-12">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Judul Buku</th>
                    <th>Tahun</th>
                    <th>Penerbit</th>
                    <th>isbn</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collection as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <button wire:click="editBuku({{ $item->id }})" class="btn btn-primary btn-xs">
                                <i class="bi bi-pencil"></i> Ubah
                            </button>
                            <button wire:click="deleteBuku({{ $item->id }})" class="btn btn-danger btn-xs">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </td>
                        <td>{{$item->judul}}</td>
                        <td>{{$item->tahun}}</td>
                        <td>{{$item->penerbit}}</td>
                        <td>{{$item->isbn}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-sm-12">
        {{$collection->links()}}
    </div>

</div>

