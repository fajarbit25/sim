<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>{{$title}}</title>
    <!-- Favicons -->
    <link href="{{asset('/Admin/assets/img/favicon-iqis.png')}}" rel="icon">
    <link href="{{asset('/Admin/assets/img/favicon-iqis.png')}}" rel="apple-touch-icon">

    <style>
        *{
            font-size: 12px;
        }
        .logo-sekolah {
            max-width: 35%;
            height: auto;
            padding-top: 20%;
            padding-bottom: 5%;
        }

        .page-break {
            page-break-after: always;
        }

        .nama-sekolah{
            padding-top: 5%;
            font-family: "Arial Black", Arial, sans-serif;
        }

        .nama-siswa{
            border: 1px solid black;
            border-bottom: 2px solid black;
            padding: 5px;
        }

        #footer {
            position: fixed;
            bottom: 0;
            right: 0;
            margin-top: 10px; /* Jarak dari bawah */
        }

        @media print {
            .page-break {
                page-break-after: always;
            }
        }
    </style>

</head>
<body>
<div>
<table>
    <tbody>
        <tr>
            <td>
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{asset('storage/home-banner/SDIT.png')}}" alt="logo-sdit" class="logo-sekolah">
                    </div>
                    <div class="col-sm-12 text-center">
                        <h1>LAPORAN</h1>
                        <h3>HASIL CAPAIAN KOMPETENSI <br/> SEKOLAH DASAR</h3>
                        <h2 class="fw-bold nama-sekolah">{{strtoupper($load->campus_name)}}</h2>
                        <p class="fw-bold">{{$load->campus_alamat}}</p>

                        <div class="row">
                            <p class="mt-5">Nama Peserta Didik</p>
                            <div class="col-3"></div>
                            <div class="nama-siswa col-6 fw-bold">{{$load->first_name}}</div>
                            <div class="col-3"></div>

                            <p class="mt-5">NIS/NISN</p>
                            <div class="col-3"></div>
                            <div class="nama-siswa col-6 fw-bold">{{$load->nis.'/'.$load->nisn}}</div>
                            <div class="col-3"></div>

                        </div>
                        


                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</div>

<div class="page-break"></div>

<div>
<table>
    <tbody>
        <tr>
            <td colspan="2">
                <h2 class="text-center mt-5">
                    KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN<br/>
                    REPUBLIK INDONESIA
                </h2>
            </td>
        </tr>
        <tr>
            <td>
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{asset('storage/home-banner/SDIT.png')}}" alt="logo-sdit" class="logo-sekolah">
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <h2 class="text-center mt-5">
                    LAPORAN HASIL<br/>
                    BELAJAR PESERTA DIDIK<br/>
                    SEKOLAH DASAR<br/>
                    (SD)
                </h2>
            </td>
        </tr>

        <tr>
            <td>
                    <div class="row mt-5">
                        <div class="col-3"></div>
                        <div class="col-2">Nama Sekolah</div>
                        <div class="col-1">:</div>
                        <div class="col-3"> {{$load->campus_name}} </div>
                        <div class="col-3"></div>

                        <div class="col-3"></div>
                        <div class="col-2">NPSN</div>
                        <div class="col-1">:</div>
                        <div class="col-3"> {{$load->npsn}} </div>
                        <div class="col-3"></div>

                        <div class="col-3"></div>
                        <div class="col-2">NSS</div>
                        <div class="col-1">:</div>
                        <div class="col-3"> 102196012582 </div>
                        <div class="col-3"></div>

                        <div class="col-3"></div>
                        <div class="col-2">Alamat Sekolah</div>
                        <div class="col-1">:</div>
                        <div class="col-3"> {{$load->campus_alamat}} </div>
                        <div class="col-3"></div>
                    </div>
            </td>
        </tr>

    </tbody>
</table>
</div>

<div class="page-break"></div>

<div class="row" style="margin:10px;">
    <div class="col-12 text-center my-5">
        <h3>
            RAPORT DAN PROFIL PESERTA DIDIK
        </h3>
    </div>
    <div class="col-2 mb-5">
        Nama Peserta Didik <br/>
        NIS <br/>
        Nama Sekolah <br/>
        Alamat Sekolah
    </div>
    <div class="col-4 mb-5">
        : {{$load->first_name}} <br/>
        : {{$load->nis}} <br/>
        : {{$load->campus_name}} <br/>
        : {{$load->campus_alamat}}
    </div>
    <div class="col-2 mb-5">
        Kelas <br/>
        Semester <br/>
        Tahun Pelajaran 
    </div>
    <div class="col-4">
        : {{$load->tingkat}} 
        @if($load->tingkat == 1) <span>(Satu)</span>
        @elseif($load->tingkat == 2) <span>(Dua)</span>
        @elseif($load->tingkat == 3) <span>(Tiga)</span>
        @elseif($load->tingkat == 4) <span>(Empat)</span>
        @elseif($load->tingkat == 5) <span>(Lima)</span>
        @elseif($load->tingkat == 6) <span>(Enam)</span>
        @elseif($load->tingkat == 7) <span>(Tujuh)</span>
        @elseif($load->tingkat == 8) <span>(Delapan)</span>
        @elseif($load->tingkat == 9) <span>(Sembilan)</span>
        @elseif($load->tingkat == 10) <span>(Sepuluh)</span>
        @elseif($load->tingkat == 11) <span>(Sebelah)</span>
        @elseif($load->tingkat == 12) <span>(Dua Belas)</span>
        @endif 
        {{$load->kode_kelas}}<br/>
        : {{$load->ta}}<br/>
        : @if($load->semester == 1) <span>Ganjil</span>
        @elseif($load->semester == 2) <span>Genap</span>
        @endif
    </div>

    <div class="col-12">
        @foreach($dataNilai->groupBy('iduser') as $idUser => $itemByUser)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="background-color: rgb(34, 133, 21)">No.</th>
                    <th style="background-color: rgb(34, 133, 21)">Mata Pelajaran</th>
                    <th style="background-color: rgb(34, 133, 21)">Nilai Akhir</th>
                    <th style="background-color: rgb(34, 133, 21)">Capaian Kompetensi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataNilai->groupBy('mapel_id') as $idMapel => $items)
                @if($idUser == $items->first()->iduser)

                @if($items->first()->jenis == 'Seni')
                <tr>
                    <td rowspan="3">{{$loop->iteration}}</td>
                    <th colspan="3" style="background-color: rgb(34, 133, 21)">Seni (Pilihan)</th>
                </tr>
                @endif
                
                @if($items->first()->jenis == 'Muatan Lokal')
                <tr>
                    <td rowspan="3">{{$loop->iteration}}</td>
                    <th colspan="3" style="background-color: rgb(34, 133, 21)">Muatan Lokal</th>
                </tr>
                @endif

                <tr>
                    @if($items->first()->jenis == 'Reguler')
                        <td rowspan="2"> {{$loop->iteration}} </td>
                    @endif

                    <td rowspan="2"> {{$items->first()->nama_mapel}} </td>
                    <td rowspan="2">
                        @php
                            $avgNilai = $items->where('mapel_id', $idMapel)->avg('nilai');
                            $maxNilai = $items->where('mapel_id', $idMapel)->max('nilai');
                            $minNilai = $items->where('mapel_id', $idMapel)->min('nilai');
                        @endphp
                        {{number_format($avgNilai, 0)}}
                    </td>
                    <td>
                        <span>{{$items->first()->nick_name}} </span>

                        @foreach($dataCapaian as $capaian)
                        @if($capaian->nilai_min <= $maxNilai && $capaian->nilai_max >= $maxNilai)
                            <span> {{$capaian->deskripsi}} </span>
                        @endif
                        @endforeach

                        <span>dalam </span>

                        @foreach ($dataKd as $kd)
                            @if($kd->idmapel == $items->first()->mapel_id)
                                @if($kd->id == $items->where('nilai', $maxNilai)->first()->kd)
                                    {{$kd->deskripsi}}
                                @endif
                            @endif
                        @endforeach
                        .
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>{{$items->first()->nick_name}} </span>

                        @foreach($dataCapaian as $capaian)
                            @if($capaian->nilai_min <= $minNilai && $capaian->nilai_max >= $minNilai)
                                <span> {{$capaian->deskripsi}} </span>
                            @endif
                        @endforeach

                        <span>dalam </span>

                        @foreach ($dataKd as $kd)
                            @if($kd->idmapel == $items->first()->mapel_id)
                                @if($kd->id == $items->where('nilai', $minNilai)->first()->kd)
                                    {{$kd->deskripsi}}
                                @endif
                            @endif
                        @endforeach
                        .
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>

    <div class="col-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="background-color: rgb(34, 133, 21)">No.</th>
                    <th style="background-color: rgb(34, 133, 21)">Ekstrakulikuler</th>
                    <th style="background-color: rgb(34, 133, 21)">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Pramuka</td>
                    <td>Baik</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Komputer</td>
                    <td>Istimewah</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Hadits</td>
                    <td>Istimewah</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="background-color: rgb(34, 133, 21)">Catatan Guru</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pramuka</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-7">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="3" style="background-color: rgb(34, 133, 21)">
                        Tinggi dan Berat Badan
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tinggi</td>
                    <td>{{$priodik->tinggi}} cm</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Berat</td>
                    <td>{{$priodik->berat}} kg</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-6 mb-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="3" style="background-color: rgb(34, 133, 21)">
                        Ketidak Hadiran
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sakit</td>
                    <td>1 Hari</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ijin</td>
                    <td>0 Hari</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Tanpa Keterangan</td>
                    <td>0 Hari</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-12">
        <div class="row">
            <div class="col-4 text-center">
                <br/>
                Mengetahui,<br/>
                Kepala Sekolah SDIT Ibnul Qayyim <br/>
                <br/>
                <br/>
                <br/>
                <span class="fw-bold text-decoration-underline">{{$load->campus_kepsek}}</span><br/>
                NIY. {{$load->niy_kepsek}}
            </div>
            <div class="col-4"></div>
            <div class="col-4 text-center">
                @php
                    $tanggal = substr($load->tanggal_raport, 8, 2);
                    $bulan = substr($load->tanggal_raport, 5, 2);
                    $tahun = substr($load->tanggal_raport, 0, 4);
                    if($bulan == '01'){
                        $bulanText = 'Januari';
                    }elseif($bulan == '02'){
                        $bulanText = 'Februari';
                    }elseif($bulan == '03'){
                        $bulanText = 'Maret';
                    }elseif($bulan == '04'){
                        $bulanText = 'April';
                    }elseif($bulan == '05'){
                        $bulanText = 'Mei';
                    }elseif($bulan == '06'){
                        $bulanText = 'Juni';
                    }elseif($bulan == '07'){
                        $bulanText = 'Juli';
                    }elseif($bulan == '08'){
                        $bulanText = 'Agustus';
                    }elseif($bulan == '09'){
                        $bulanText = 'September';
                    }elseif($bulan == '10'){
                        $bulanText = 'Oktober';
                    }elseif($bulan == '11'){
                        $bulanText = 'November';
                    }elseif($bulan == '12'){
                        $bulanText = 'Desember';
                    }
                @endphp


                Makassar, {{$tanggal.' '.$bulanText.' '.$tahun}} <br/>
                <br/>
                Guru Kelas <br/>
                <br/>
                <br/>
                <br/>
                <span class="fw-bold text-decoration-underline">{{$room->wali_kelas}}</span><br/>
                NIY. 199608 202205 2 02
            </div>
        </div>
    </div>

</div>


</div>

<div id="footer">
    <table>
        <tfoot>
            <tr>
                <td>
                    <div class="col-12 text-end">
                        <span class="fst-italic" id="pageCount"> {{$load->first_name}} </span>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    window.print()
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
