<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPPM Diniyah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
       @media print {
            body {
                font-family: "Century Gothic", sans-serif;
                margin: 0;
                padding: 0;
                color: #000;
            }
            .no-print {
                display: none;
            }
            .kop-surat, .footer-surat {
                width: 100%;
                text-align: center;
                position: fixed;
            }
            .kop-surat {
                top: 0;
            }
            .footer-surat {
                bottom: 0;
            }
            .kop-img, .footer-img {
                max-width: 100%;
            }
            .content {
                margin-top: 110px;
                margin-bottom: 50px;
                style="max-width: 100%"
            }
            .page-break {
                page-break-before: always;
            }
            @page {
                margin: 0;
            }
        }

        body {
            font-family: "Century Gothic", sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
        }
        .no-print {
            display: block;
        }
        .kop-surat, .footer-surat {
            width: 100%;
            text-align: center;
            position: fixed;
        }
        .kop-surat {
            top: 0;
        }
        .footer-surat {
            bottom: 0;
        }
        .content {
            margin-top: 160px;
            margin-bottom: 70px;
        }
        .kop-img, .footer-img {
            max-width: 100%;
            /* display: none; */
        }

        /* @media screen {
            .content {
                display: block;
            }
        } */
    </style>
</head>
  <body>
   
    <div class="row">
       
        <div class="kop-surat no-print">
            <img src="{{asset('storage/home-banner/tk-kop-landscape-top.png')}}" alt="kop-surat" style="max-width: 100%; height: auto;" class="kop-img"/>
        </div>

        <div class="content row">

            <div class="text-center" style="width: 100%;">
                <h6>
                    RENCANA PELAKSAAN PEMBELAJARAN MINGGUAN <br/>
                    TKIT IBNUL QAYYIM MAKASSAR
                </h6>
            </div>

            <div class="col-2"></div>
            <div class="col-3">
                Semester / Bulan / Pekan <br/>
                Topik / Sub Topik <br/>
                Kelompok
            </div>
            <div class="col-3">
                : {{$data->semester}}/{{$data->bulan}}/{{$data->pekan}} <br/>
                : {{$data->topik_id}} / {{$data->subtopik_id}} <br/>
                : {{$data->kelompok_id}}
            </div>
            <div class="col-2"></div>

            <div class="">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th colspan="2">Kompetensi Dasar</th>
                            <th>Materi Pembelajaran</th>
                            <th>Kegiatan</th>
                            @foreach($siswa as $student)
                                <th class="vertical-text">{{$student->name}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result as $key => $item)
                        {{-- Hitung jumlah row pada setiap materi yang sama --}}
                        @php
                            $rowspan3 = count($item->getKegiatan); 
                            $rowspan1 = count($item->segmentMateri);
                        @endphp
                        <tr>
                            {{-- Tampilkan kolom "Materi" hanya di baris pertama --}}
                            @if ($key === 0 || $item->segment_materi !== $result[$key-1]->segment_materi)
                                <td class="@if($item->segment_materi == '1') bg-light @endif" rowspan="{{ $rowspan1 }}">{{ $item->segment_materi }}</td>
                            @endif

                            {{-- Tampilkan kolom "Materi" hanya di baris pertama --}}
                            @if ($key === 0 || $item->segment_materi !== $result[$key-1]->segment_materi)
                                <td class="@if($item->segment_materi == '1') bg-light @endif" rowspan="{{ $rowspan1 }}"></td>
                            @endif
                            

                            {{-- Tampilkan kolom "Materi" hanya di baris pertama --}}
                            @if ($key === 0 || $item->segment_materi !== $result[$key-1]->segment_materi)
                                <td class="@if($item->segment_materi == '1') bg-light @endif" rowspan="{{ $rowspan1 }}">
                                    @if($item->segment_materi == '1')
                                        A
                                    @else 
                                        B
                                    @endif
                                </td>
                            @endif

                            {{-- Tampilkan kolom "Materi" hanya di baris pertama --}}
                            @if ($key === 0 || $item->materi !== $result[$key-1]->materi)
                                <td class="@if($item->segment_materi == '1') bg-light @endif" rowspan="{{ $rowspan3 }}">{{ $item->materi }}</td>
                            @endif

                            <td class="@if($item->segment_materi == '1') bg-light @endif"> {{$item->kegiatan}} </td>

                            {{-- Looping Kolom penilaian berdasakan siswa --}}
                            @foreach($item->nilai as $nilai)
                                <td class="@if($item->segment_materi == '1') bg-light @endif">
                                    {{$nilai->nilai}}
                                </td>
                            @endforeach
                        </tr>

                        @endforeach
                    </thead>
                </table>
            </div>

            <div class="col-5 text-center">
                <br/>
                Wali Kelas {{$data->kelompok_id}} <br/>
                <br/>
                <br/>
                <br/>
                <span class="text-decoration-underline">{{$wali_kelas}}</span> 
            </div>
            <div class="col-5 text-center">
                Makassar, 17 Mei 2024 <br/>
                Kepala Sekolah <br/>
                <br/>
                <br/>
                <br/>
                <span class="text-decoration-underline">{{$campus->campus_kepsek}}</span> 
            </div>
        </div>

        <div class="footer-surat no-print">
            <img src="{{asset('storage/home-banner/tk-kop-landscape-bottom.png')}}" alt="kop-surat" style="max-width: 100%; height: auto;" class="footer-img"/>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        //window.print()
    </script>
  </body>
</html>