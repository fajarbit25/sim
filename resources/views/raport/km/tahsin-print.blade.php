<!doctype html>
<html lang="en" >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <!--Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>{{$title}}</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        table{
            width: 100%;
        }

        table thead tr td{
            padding: 0;
            margin: 0;
        }

        #header-foto{
            height: 100%;
            max-width: 100%;
        }
        
        #header-table{
            background-color: rgb(3, 112, 76);
            color: azure;
        }

        #nilai-rata-rata{
            background-color: rgb(83, 167, 111);
        }

        .border-2{
            border: 5ch solid rgb(122, 116, 116);
        }

        #kop-text{
            background-color: rgb(3, 112, 76);
            color: aliceblue;
            text-align: right;
            padding-right: 20px;
        }


    </style>
  </head>
  <body>

    <table>
        <thead>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-1" id="header-table"></div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{asset('/storage/home-banner/IQIS.png')}}" alt="header" id="header-foto">
                                </div>
                                <div class="col-6">
                                    <img src="{{asset('/storage/home-banner/SDIT.png')}}" alt="header" id="header-foto">
                                </div>
                                <div class="col-12 text-center">
                                    <span class="fw-bold"  style="font-size: 10px;">NSS: 102196012582 / NPSN: 69829167</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-7" id="kop-text">
                            <h5>IBNUL QAYYIM ISLAMIC SCHOOL FOUNDATION</h5>
                            <h2>SDIT IBNUL QAYYIM MAKASSAR</h2>
                            <span>
                                081341311314 <i class="bi bi-telephone-fill"></i> <br/>
                                sdit@iqis.sch.id <i class="bi bi-envelope"></i> <br/>
                                https://sdit.iqis.sch.id <i class="bi bi-globe-americas"></i> <br/>
                                Jl. Goa Ria Perumahan Taman Bunga Sudiang 2 Makassar <i class="bi bi-geo-alt-fill"></i>
                            </span>
                        </div>
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h5 class="fw-bold mt-3">
                                LAPORAN PENILAIAN HASIL BELAJAR TAHSIN SEMESTER @if($semester == 1) GANJIL @else GENAP @endif<br/>
                                TAHUN PELAJARAN {{$ta}}
                            </h5>
                        </div>
                        <div class="col-sm-12 p-5">
                            <span>Nama</span> : <span>{{strtoupper($siswa->first_name)}}</span> <br/>
                            @php
                                if($kelas->tingkat == 1){
                                    $tingkat = 'Satu';
                                }elseif($kelas->tingkat == 2){
                                    $tingkat = 'Dua';
                                }elseif($kelas->tingkat == 3){
                                    $tingkat = 'Tiga';
                                }elseif($kelas->tingkat == 4){
                                    $tingkat = 'Empat';
                                }elseif($kelas->tingkat == 5){
                                    $tingkat = 'Lima';
                                }elseif($kelas->tingkat == 6){
                                    $tingkat = 'Enam';
                                }elseif($kelas->tingkat == 7){
                                    $tingkat = 'Tujuh';
                                }elseif($kelas->tingkat == 8){
                                    $tingkat = 'Delapan';
                                }elseif($kelas->tingkat == 9){
                                    $tingkat = 'Sembilan';
                                }elseif($kelas->tingkat == 10){
                                    $tingkat = 'Sepuluh';
                                }elseif($kelas->tingkat == 11){
                                    $tingkat = 'Sebelas';
                                }elseif($kelas->tingkat == 12){
                                    $tingkat = 'Dua Belas';
                                }
                            @endphp
                            <span>Kelas</span> : <span>{{$kelas->tingkat}} {{$kelas->kode_kelas}} ({{$tingkat}})</span> <br/>

                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th id="header-table">No</th>
                                        <th id="header-table">Indikator Penilaian</th>
                                        <th id="header-table">KKM</th>
                                        <th id="header-table">Nilai</th>
                                        <th id="header-table">Apresiasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tahsin->groupBy('kd_id') as $idkd => $items)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$items->first()->arabic}} </td>
                                        <td> {{$items->first()->kkm}} </td>
                                        <td> {{number_format($items->avg('nilai'))}} </td>
                                        <td>
                                            @if($items->avg('nilai') < 69 && $items->avg('nilai') > 0) <span>Belum Tuntas</span>
                                            @elseif($items->avg('nilai') < 74 && $items->avg('nilai') > 69) <span>Cukup</span>
                                            @elseif($items->avg('nilai') < 79 && $items->avg('nilai') > 74) <span>Baik</span>
                                            @elseif($items->avg('nilai') < 84 && $items->avg('nilai') > 79) <span>Sangat Baik</span>
                                            @elseif($items->avg('nilai') < 90 && $items->avg('nilai') > 84) <span>Istimewah</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th id="nilai-rata-rata" colspan="3">Nilai Rata-rata</th>
                                        <th id="nilai-rata-rata">90</th>
                                        <th id="nilai-rata-rata">Istimewah</th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-sm-12 border-2 p-3">
                                <span class="fw-bold">Catatan Guru Tahsin :</span><br/>
                                <span>{{$catatan->catatan}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 text-center">
                            <br/>
                            Guru Tahsin 1
                            <br/>
                            <br/><br/><br/>
                            <span class="text-decoration-underline">{{$guru1->first_name}}</span><br/>
                            <span>NIY : {{$guru1->niy}}</span>
                        </div>
                        <div class="col-sm-6 text-center">
                            Makassar, 22 Juni 2024<br/>
                            Guru Tahsin 2
                            <br/>
                            <br/><br/><br/>
                            <span class="text-decoration-underline">{{$guru2->first_name}}</span><br/>
                            <span>NIY : {{$guru2->niy}}</span>
                        </div>
                        <div class="col-sm-12 mt-3 text-center">
                            Mengetahui,<br/>
                            Kepala Sekolah
                            <br/><br/><br/><br/>
                            <span class="text-decoration-underline">{{$kepsek->campus_kepsek}}</span><br/>
                            <span>NIY : {{$kepsek->niy_kepsek}}</span>
                        </div>
                        
                    </div>
                </td>
            </tr>
        </tbody>

    </table>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.print()
    </script>
  </body>
</html>