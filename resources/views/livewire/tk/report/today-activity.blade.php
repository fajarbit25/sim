<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                Laporan Kegiatan Harian
            </h3>
            @if($activity)
            <div class="row">
                @foreach($dataSub->where('tipe', 'foto') as $item)
                <div class="col-6 mb-2">
                    <div style="width: 100%; height: 200px; display: flex; justify-content: center; align-items: center; overflow: hidden;">
                        <img src="{{ asset('/storage/tk-daily/'.$item->foto) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Image">
                    </div>
                </div>
                @endforeach
                <div class="col-sm-12 mt-2">
                    <span class="fst-italic fw-bold">Bismillah..</span><br/>
                    <span>Materi Hari {{$today}}, Tanggal {{date('d-M-Y')}}</span>
                </div>
                <div class="col-sm-12 my-2">
                    <span class="fw-bold">Topik : </span> <span>{{$activity->topik}}</span><br/>
                    <span class="fw-bold">Sub Topik : </span> <span>{{$activity->subtopik}}</span><br/>
                    <span>- Menghafal Surah {{$activity->menghafal}}</span><br/>
                    <span>- Menulis Huruf Latin {{$activity->menulis}}</span><br/>
                    <span>- Murojaah {{$activity->murojaah}}</span><br/> 
                    <br/>
                    <span class="fw-bold">Sentra : </span> <span>{{$activity->sentra}}</span><br/>
                    <span class="fw-bold">Sub Sentra : </span> <span>{{$activity->subsentra}}</span><br/>
                    <span class="fw-bold">Kegiatan : </span><br/>
                    @foreach($dataSub->where('tipe', 'kegiatan') as $item)
                        <div class="col-sm-12">
                            <span>- {{$item->deskripsi}}</span>
                        </div>
                    @endforeach
                    <br/>
                    <span class="fw-bold">Kosa Kata : </span><br/>
                    <span>- Bahasa Indonesia : {{$activity->bahasa}}</span><br/>
                    <span>- Bahasa Inggris :  {{$activity->menulis}}</span><br/>
                    <span>- Bahasa Arab : {{$activity->arab}}</span><br/>
                    <br/>
                    <span class="fst-italic fw-bold">Syukron</span>
                </div>
            </div>
            @else 
            <div class="col-sm-12">
                <span class="fw-bold fst-italic m-3">
                    Belum ada Laporan Harian Untuk Hari ini. {{Auth::user()->kelas.'-'.date('Y-m-d')}}
                </span>
            </div>
            @endif
            
        </div>
    </div>
</div>
