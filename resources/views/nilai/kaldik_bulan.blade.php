@if(count($bulan) == 0)
<tr>
    <td colspan="37">
        <span class="fw-bold fst-italic">
            Tidak ada data!
        </span>
    </td>
</tr>
@endif
@foreach($bulan as $bln)
    <tr>
        <td>{{$bln->tahun}}</td>
        <td>{{$bln->bulan}}</td>
        @foreach($hari as $hr)
            @if($bln->id == $hr->bulan_kaldik_id)
                <td class="" style="background-color: @if($hr->hari == 'Minggu') rgb(255,0,0) @elseif($hr->tag != '0') {{$hr->color}} @endif;">

                    @if($bln->lock == 0)
                        <input type="text" value="{{$hr->tanggal}}" style="width:50px;" data-id="{{$hr->id}}" class="tanggal-input">
                    @else 
                        @if($hr->tanggal == 0)
                            -
                        @else 
                            <a href="javascript:void(0)" ondblclick="modalUpdateTagHariKaldik({{$hr->id}})">{{$hr->tanggal}}</a>
                        @endif
                    @endif

                </td>
            @endif
        @endforeach
        <td class="fw-bold">{{$bln->he_sekolah}}</td>
        <td class="fw-bold" id="heSemester-{{$bln->semester}}">{{$bln->he_semester}}</td>
        <td class="fw-bold">{{$bln->pe}}</td>
        <td class="fw-bold">{{$bln->jumlah_pe}}</td>
        <td style="white-space: nowrap;">
            @if($bln->lock ==1)
                <button type="button" class="btn btn-warning btn-xs" onclick="unlockKaldik({{$bln->id}})" id="btnUnlockKaldik-{{$bln->id}}">
                    # Unlock
                </button>
            @else 
                <button type="button" class="btn btn-primary btn-xs" onclick="lockKaldik({{$bln->id}})" id="btnLockKaldik-{{$bln->id}}">
                    &radic; Save
                </button>
            @endif
            <button type="button" class="btn btn-danger btn-xs" onclick="confirmDeleteBulan({{$bln->id}})">
                &times; Hapus
            </button>
        </td>
    </tr>
@endforeach

<script>
    $(document).ready(function(){
        $('.tanggal-input').on('change', function(){
            //var id = $(this).attr('id').split('-')[1];
            var id = $(this).data('id');
            var tanggal = $(this).val();

            $.ajax({
                url: '/nilai/kaldik/update-tanggal', // Ganti dengan URL endpoint Anda
                method: 'POST',
                cache:false,
                data: {
                    id: id,
                    tanggal: tanggal
                },
                success: function(response){
                    // Tanggapan dari server (jika diperlukan)
                    console.log(response.message);
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });
        });
    });
</script>
