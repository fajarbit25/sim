<div class="col-sm-12 row">

    @livewire('teacher.beasiswa.form.create', ['userid' => $userid])
    @livewire('teacher.beasiswa.form.edit')
    @livewire('teacher.beasiswa.form.delete')

    {{-- Table --}}
    <div class="cols-m-12">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Jenis Beasiswa</th>
                    <th>Keterangan</th>
                    <th>Tahun Mulai</th>
                    <th>Tahun Berakhir</th>
                    <th>Masih Menerima</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collection as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <button wire:click="editBeasiswa({{ $item->id }})" class="btn btn-primary btn-xs">
                                <i class="bi bi-pencil"></i> Ubah
                            </button>
                            <button wire:click="deleteBeasiswa({{ $item->id }})" class="btn btn-danger btn-xs">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </td>
                        <td>{{$item->jenis}}</td>
                        <td>{{$item->keterangan}}</td>
                        <td>{{$item->tahun_mulai}}</td>
                        <td>{{$item->tahun_akhir}}</td>
                        <td>{{$item->masih_menerima}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-sm-12">
        {{$collection->links()}}
    </div>

</div>

