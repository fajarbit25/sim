<!doctype html>
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
    <link href="{{url('Admin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <style>
        *{
            font-size: 11px;
        }
        header, footer{
            padding: 0px;
            margin: 0px;
            display: none;
        }
        .kop-img{
            max-width: 100%;
            margin: 0px;
        }
        .footer-img{
            max-width: 100%;
            margin: 0px;
        }
        @media print {
            .kop-img{
                position: fixed;
                top: 0;
            }
            .footer-img{
                position: fixed;
                bottom: 0;
            }
            #isi-raport{
                margin-top: 100px;
                margin-bottom: 100px;
                padding: 20px;
            }
            header, footer{
                display: block !important;
            }

            /* Atur margin untuk halaman pertama */
            @page :first {
            margin-top: 100px; /* Atur margin atas */
            }

            /* Atur margin untuk halaman-halaman yang terpisah setelahnya */
            @page :first {
            margin-top: 300px; /* Atur margin atas */
            }

            /* Atur margin untuk halaman-halaman selanjutnya */
            @page :nth-child(n+2) {
            margin-top: 100px; /* Atur margin atas */
            }
        }
    </style>
  </head>
  <body>
    <header id="header">
        <img src="{{asset('storage/home-banner/tk-kop-landscape-top.png')}}" alt="kop-surat" class="kop-img"/>
    </header>
    <div class="row" id="isi-raport">

        <div class="col-12 pt-3">
            <h3 class="fw-bold">
                PERKEMBANGAN ANAK DIDIK <br/>
                KELAS B
            </h3>
        </div>
        <div class="col-2">
            NAMA ANAK <br/>
            NOMOR INDUK <br/>
            BERAT BADAN <br/>
            TINGGI BADAN
        </div>
        <div class="col-10">
            : {{strtoupper($priodik->nama_siswa)}} <br/>
            : {{$priodik->nis}} <br/>
            : {{$priodik->berat}} KG <br/>
            : {{$priodik->tinggi}} CM <br/>
        </div>
        <div class="col-12 py-3">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th rowspan="2" class="bg-light">NO</th>
                        <th rowspan="2" class="bg-light">ASPEK PERKEMBANGAN</th>
                        <th rowspan="2" class="bg-light" style="white-space: nowrap;">INDIKATOR DAN TINGKAT PERKEMBANGAN</th>
                        <th colspan="4" class="bg-light">HASIL PENILAIAN</th>
                    </tr>
                    <tr>
                        <th class="bg-light">BSB</th>
                        <th class="bg-light">BSH</th>
                        <th class="bg-light">MB</th>
                        <th class="bg-light">BB</th>
                    </tr>

                    <tr>
                        <th>I</th>
                        <th colspan="2">NILAI-NILAI AGAMA DAN MORAL</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($dataAgama->groupBy('subkategori') as $subkategori => $items)
                    <tr>
                        <td></td>
                        <td></td>
                        <th>{{$loop->iteration.'. '.$subkategori}}</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($items as $item)
                    <tr>
                        <td></td>
                        <td>
                            @if($item->tujuan)
                            {{$loop->iteration.'. '.$item->tujuan}}
                            @endif
                        </td>
                        <td>{{$loop->iteration.'. '.$item->materi}}</td>
                        <td>
                            @if($item->bsb == 'true')
                            <span class="fw-bold">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($item->bsh == 'true')
                            <span class="fw-bold">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($item->mb == 'true')
                            <span class="fw-bold">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($item->bb == 'true')
                            <span class="fw-bold">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                    @foreach ($dataAll->groupBy('kategori') as $kategori => $subs)
                    <tr>
                        <th>
                            @if($loop->iteration == 1) II
                            @elseif($loop->iteration == 2) III
                            @elseif($loop->iteration == 3) IV
                            @elseif($loop->iteration == 4) V
                            @elseif($loop->iteration == 5) VI
                            @elseif($loop->iteration == 6) VII
                            @elseif($loop->iteration == 7) VIII
                            @elseif($loop->iteration == 8) IX
                            @elseif($loop->iteration == 9) X
                            @elseif($loop->iteration == 10) XI
                            @endif
                        </th>
                        <th colspan="2">{{strtoupper($kategori)}}</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($subs->groupBy('subkategori') as $subkategori => $items)
                    <tr>
                        <td></td>
                        <td colspan="2">{{$loop->iteration.'. '.$subkategori}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($items as $item)
                    <tr>
                        <td></td>
                        <td>
                            <div class="row"> <!-- Membuat baris Bootstrap -->
                                <div class="col-1 text-end"><i class="bi bi-dash-lg"></i></div> <!-- Grid kosong untuk offset -->
                                <div class="col-11"> <!-- Kolom utama untuk $item->materi -->
                                    {{$item->materi}}
                                </div>
                            </div>
                        </td>
                        <td></td>
                        <td>
                            @if($item->bsb == 'true')
                            <span class="fw-bold">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($item->bsh == 'true')
                            <span class="fw-bold">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($item->mb == 'true')
                            <span class="fw-bold">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($item->bb == 'true')
                            <span class="fw-bold">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                    @endforeach
                    @php
                        $countAgama = $dataAgama->count();
                        $countNonAgama = $dataAll->count();
                        $totalData = $countAgama+$countNonAgama;
                    @endphp
                    <tr>
                        <th>VII</th>
                        <th colspan="2">
                            KESIMPULAN PERKEMBANGAN ANAK
                        </th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="5"></td>
                        <td colspan="2">- Tingkat Pencapaian Perkembangan: Berkembang Sangat Baik (BSB)</td>
                        <td colspan="2" class="fw-bold">
                            @php
                                $countBsb = $dataAll->filter(function ($data) {
                                    return $data->bsb == 'true';
                                } )->count();

                                $countAgamaBsb = $dataAgama->filter(function ($data) {
                                    return $data->bsb == 'true';
                                } )->count();

                            @endphp
                            {{$countBsb+$countAgamaBsb.'/'.$totalData}}
                        </td>
                        <td colspan="2" class="fw-bold">
                            @php
                                $penjumlahan =$countBsb+$countAgamaBsb;
                                $pembagian = $penjumlahan/$totalData;
                                $hasil = $pembagian*100;
                            @endphp
                            ({{number_format($hasil, 2)}}%)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">- Tingkat Pencapaian Perkembangan: Berkembang Sesuai Harapan (BSH)</td>
                        <td colspan="2" class="fw-bold">
                            @php
                                $countBsh = $dataAll->filter(function ($data) {
                                    return $data->bsh == 'true';
                                } )->count();

                                $countAgamaBsh = $dataAgama->filter(function ($data) {
                                    return $data->bsh == 'true';
                                } )->count();

                            @endphp
                            {{$countBsh+$countAgamaBsh.'/'.$totalData}}
                        </td>
                        <td colspan="2" class="fw-bold">
                            @php
                                $penjumlahan =$countBsh+$countAgamaBsh;
                                $pembagian = $penjumlahan/$totalData;
                                $hasil = $pembagian*100;
                            @endphp
                            ({{number_format($hasil, 2)}}%)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">- Tingkat Pencapaian Perkembangan: Mulai Berkembang (MB)</td>
                        <td colspan="2" class="fw-bold">
                            @php
                                $countMb = $dataAll->filter(function ($data) {
                                    return $data->mb == 'true';
                                } )->count();

                                $countAgamaMb = $dataAgama->filter(function ($data) {
                                    return $data->mb == 'true';
                                } )->count();

                            @endphp
                            {{$countMb+$countAgamaMb.'/'.$totalData}}
                        </td>
                        <td colspan="2" class="fw-bold">
                            @php
                                $penjumlahan =$countMb+$countAgamaMb;
                                $pembagian = $penjumlahan/$totalData;
                                $hasil = $pembagian*100;
                            @endphp
                            ({{number_format($hasil, 2)}}%)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">- Tingkat Pencapaian Perkembangan: Belum Berkembang (BB)</td>
                        <td colspan="2" class="fw-bold">
                            @php
                                $countBb = $dataAll->filter(function ($data) {
                                    return $data->bb == 'true';
                                } )->count();

                                $countAgamaBb = $dataAgama->filter(function ($data) {
                                    return $data->bb == 'true';
                                } )->count();

                            @endphp
                            {{$countBb+$countAgamaBb.'/'.$totalData}}
                        </td>
                        <td colspan="2" class="fw-bold">
                            @php
                                $penjumlahan =$countBb+$countAgamaBb;
                                $pembagian = $penjumlahan/$totalData;
                                $hasil = $pembagian*100;
                            @endphp
                            ({{number_format($hasil, 2)}}%)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <span>Deskipsi :</span> <br/>
                            <span>{{$raport->deskripsi}}</span>
                        </td>
                    </tr>

                    <tr>
                        <th>VIII</th>
                        <th colspan="2">
                            CATATAN DAN REKOMENDASI WALI KELAS
                        </th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="6" class="text-center">
                            {{$raport->catatan}}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="col-6 text-center">
            <br/>
            Mengetahui, <br/>
            Kepala Sekolah <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <span class="fw-bold">
               {{$campus->campus_kepsek}}
            </span>
        </div>
        <div class="col-6 text-center">
            Makassar,  
            {{ date('d', strtotime($raport->tanggal)) }} 
            @php
                $bulan = date('F', strtotime($raport->tanggal));
                switch($bulan) {
                    case 'January':
                        echo 'Januari';
                        break;
                    case 'February':
                        echo 'Februari';
                        break;
                    case 'March':
                        echo 'Maret';
                        break;
                    case 'April':
                        echo 'April';
                        break;
                    case 'May':
                        echo 'Mei';
                        break;
                    case 'June':
                        echo 'Juni';
                        break;
                    case 'July':
                        echo 'Juli';
                        break;
                    case 'August':
                        echo 'Agustus';
                        break;
                    case 'September':
                        echo 'September';
                        break;
                    case 'October':
                        echo 'Oktober';
                        break;
                    case 'November':
                        echo 'November';
                        break;
                    case 'December':
                        echo 'Desember';
                        break;
                }
            @endphp
            {{ date('Y', strtotime($raport->tanggal)) }}

            <br/>
            Wali Kelas <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <span class="fw-bold">
                {{$kelas->wali}}
            </span>
        </div>
        <div class="col-12 mt-3 text-center">
            Orang Tua Murid <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <span class="fw-bold text-decoration-underline">
                ...........................
            </span>
        </div>
    </div>

    <footer id="footer">
        <img src="{{asset('storage/home-banner/tk-kop-landscape-bottom.png')}}" alt="kop-surat" class="footer-img"/>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.onbeforeprint = function() {
            var headerHeight = document.getElementById('header').offsetHeight;
            var footerHeight = document.getElementById('footer').offsetHeight;

            var content = document.getElementById('content');
            var contentHeight = window.innerHeight - headerHeight - footerHeight;
            
            content.style.marginTop = headerHeight + 'px';
            content.style.marginBottom = footerHeight + 'px';
        };

        window.print()
    </script>
  </body>
</html>