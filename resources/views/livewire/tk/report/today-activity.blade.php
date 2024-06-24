<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                Laporan Kegiatan Harian
            </h3>
            <div class="row">
                @if($countData != 0)
                <div class="col-sm-12 mb-3">
                    <img src="{{asset('storage/tk-daily/'.$image)}}" alt="Foto" style="max-width:100%; height:auto;">
                </div>
                <div class="col-sm-12">
                    <span class="fw-bold">Bismillah,</span><br/>
                    <span>Materi hari {{$today}}, Tanggal {{date('Y-m-d')}}</span><br/><br/>

                    @foreach($activity->groupBy('keterangan') as $keterangan => $items)
                        @if($keterangan != '-')
                             <span style="color: pink;"><i class="bi bi-flower3"></i></span> <span> {{$keterangan}}</span> <br/>
                            @if($items->first()->tab_submenu == '1')
                             @foreach($items as $item)
                             <span style="padding-left: 50px;"> - {{$item->subketerangan}} </span><br/>
                             @endforeach
                            @endif
                        @endif
                    @endforeach
                </div>
                @else 
                <div class="col-sm-12">
                    <span class="fw-bold fst-italic">
                        Mohon maaf, belum ada laporan untuk hari ini.
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
