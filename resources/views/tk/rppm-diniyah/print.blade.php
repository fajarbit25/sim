<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPPM Diniyah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        *{
            font-size: 12px;;
        }
        /**Test berdiri */
        .vertical-text {
        writing-mode: vertical-lr !important;
            transform: rotate(180deg) !important;
        }
    </style>
</head>
  <body>
   
    <div class="row">
        <div class="col-sm-3 text-center">
            <img src="{{asset('/Admin/assets/img/logo-sekolah/YAYASAN.png')}}" alt="Logo" style="max-width: 100px; height:auto;"> 
        </div>
        <div class="col-sm-6 text-center">
            <h5>
                YAYASAN PENDIDIKAN ISLAM IBNUL QAYYIM <br/>
                TKIT IBNUL QAYYIM
            </h5>
            <span class="fw-bold">Jl. Goa Ria Perumahan Taman Bunga Sudiang 2 Sudiang Makassar</span>
        </div>
        <div class="col-sm-3 text-center">
            <img src="{{asset('/Admin/assets/img//logo-sekolah/TKIT.png')}}" alt="Logo" style="max-width: 100px; height:auto;"> 
        </div>

        <hr/>

        <div class="col-sm-12 text-center">
            <h6>
                RENCANA PELAKSAAN PEMBELAJARAN MINGGUAN <br/>
                TKIT IBNUL QAYYIM MAKASSAR
            </h6>
        </div>

        <div class="col sm-3"></div>
        <div class="col sm-3">
            Semester / Bulan / Pekan <br/>
            Topik / Sub Topik <br/>
            Kelompok
        </div>
        <div class="col sm-3">
            : {{$data->semester}}/{{$data->bulan}}/{{$data->pekan}} <br/>
            : {{$data->topik_id}} / {{$data->subtopik_id}} <br/>
            : {{$data->kelompok_id}}
        </div>
        <div class="col sm-3"></div>

        <div class="col-sm-12">
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
                </tbody>
            </table>
        </div>

        <div class="col-sm-3"></div>
        <div class="col-sm-9">
            Makassar, 17 Mei 2024 <br/>
            Wali Kelas {{$data->kelompok_id}} <br/>
            <br/>
            <br/>
            <br/>
            {{$wali_kelas}}
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.print()
    </script>
  </body>
</html>