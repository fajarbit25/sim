<div class="col-sm-12">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> {{ session('message') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <table class="table mt-5">
        <thead>
            <tr>
                <th>#</th>
                <th>Action</th>
                <th>Jenis Sertifikasi</th>
                <th>Nomor Sertifikasi</th>
                <th>Tahun Sertifikasi</th>
                <th>Bidang Studi</th>
                <th>NRG</th>
                <th>Nomor Peserta</th>
            </tr>
        </thead>
        <tbody>
  
            @foreach ($result as $item)
                <tr>
                    <td> {{$loop->iteration}} </td>
                    <td>
                        <button wire:click="editSertifikasi({{ $item->id }})" class="btn btn-primary btn-xs">
                            <i class="bi bi-pencil"></i> Ubah
                        </button>
                        <button wire:click="deleteSertifikasi({{ $item->id }})" class="btn btn-danger btn-xs">
                            <i class="bi bi-trash3"></i> Hapus
                        </button>
                    </td>
                    <td> {{$item->jenis }} </td>
                    <td> {{$item->nomor }} </td>
                    <td> {{$item->tahun }} </td>
                    <td> {{$item->bidang_studi }} </td>
                    <td> {{$item->nrg }} </td>
                    <td> {{$item->nomor_peserta }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $result->links() }}

    {{-- form edit --}}
    <div class="col sm-12">
        @livewire('teacher.sertifikasi.form.edit', ['user_id' => $user_id]) 
    </div>

    {{-- form delete --}}
    <div class="col sm-12">
        @livewire('teacher.sertifikasi.form.delete') 
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
