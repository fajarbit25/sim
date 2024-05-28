<div class="col-sm-12 row">
    <div class="col-sm-12">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> {{ session('message') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    @livewire('teacher.pendidikan.form.create', ['userid' => $userid])
    @livewire('teacher.pendidikan.form.edit')
    @livewire('teacher.pendidikan.form.delete')

    {{-- Table --}}
    <div class="cols-m-12">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Bidang Study</th>
                    <th>Jenjang Pendidikan</th>
                    <th>Gelar Akademik</th>
                    <th>Satuan Pendidikan</th>
                    <th>Tahun Masuk</th>
                    <th>Tahun Lulus</th>
                    <th>NIM</th>
                    <th>Mata Kuliah</th>
                    <th>Semester</th>
                    <th>IPK</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collection as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <button wire:click="editPendidikan({{ $item->id }})" class="btn btn-primary btn-xs">
                                <i class="bi bi-pencil"></i> Ubah
                            </button>
                            <button wire:click="deletePendidikan({{ $item->id }})" class="btn btn-danger btn-xs">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </td>
                        <td>{{$item->bidang_studi}}</td>
                        <td>{{$item->jenjang}}</td>
                        <td>{{$item->gelar_akademik}}</td>
                        <td>{{$item->satuan_pendidikan_formal}}</td>
                        <td>{{$item->tahun_masuk}}</td>
                        <td>{{$item->tahun_lulus}}</td>
                        <td>{{$item->nim}}</td>
                        <td>{{$item->matkul}}</td>
                        <td>{{$item->semester}}</td>
                        <td>{{$item->ipk}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
