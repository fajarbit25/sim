<div class="col-sm-12 row">

    @livewire('teacher.anak.form.create', ['userid' => $userid])
    @livewire('teacher.anak.form.edit')
    @livewire('teacher.anak.form.delete')

    {{-- Table --}}
    <div class="cols-m-12">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Jenjang Pendidikan</th>
                    <th>NISN</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat, Tanggal Lahir</th>
                    <th>Tahun Masuk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collection as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <button wire:click="editAnak({{ $item->id }})" class="btn btn-primary btn-xs">
                                <i class="bi bi-pencil"></i> Ubah
                            </button>
                            <button wire:click="deleteAnak({{ $item->id }})" class="btn btn-danger btn-xs">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->jenjang_pendidikan}}</td>
                        <td>{{$item->nisn}}</td>
                        <td>{{$item->gender}}</td>
                        <td>{{$item->tempat_lahir.' '.$item->tanggal_lahir}}</td>
                        <td>{{$item->tahun_masuk}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-sm-12">
        {{$collection->links()}}
    </div>

</div>

