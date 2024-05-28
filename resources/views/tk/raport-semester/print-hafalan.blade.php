<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>{{$title}}</title>
    <style>
        *{
            font-size: 12px;
        }
        body {
            font-family: "Century Gothic", sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
        }
        /**Test berdiri */
        .vertical-text {
        writing-mode: vertical-lr !important;
            transform: rotate(180deg) !important;
        }
        #bg-hijau{
            background-color: rgb(91, 155, 30);
        }
        #bg-kuning{
            background-color: rgb(211, 145, 58);
        }
        #border-hijau{
            border-color: rgb(111, 185, 37); 
        }
        #bg-abu{
            background-color: aliceblue;
        }
    </style>
</head>
<body>

<div class="content">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-12 pt-4 mb-4">
                    <h4 class="fw-bold" style="color: rgb(12, 104, 73)">
                        RAPOR TRIWULAN HAFALAN AL-QURAN, HADITS & DOA 
                    </h4>
                </div>
                <div class="col-6">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-center fw-bold" id="bg-hijau">
                                TKIT IBNUL QAYYIM SUDIANG MAKASSAR
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-center">KELAS {{$kelas->kode_kelas}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-center fw-bold" id="bg-hijau">
                                SEMESTER {{$narasi->semester}} TA. {{$narasi->ta}}
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-center">
                                @if($narasi->semester == '1')
                                JULI - DESEMBER
                                @elseif($narasi->semester == '2')
                                JANUARI - JUNI
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-center fw-bold" id="bg-hijau">
                                WALI KELAS
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-center"> {{$kelas->wali_kelas}} </td>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-center fw-bold" id="bg-hijau">
                                TEMA    
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-center">HAFALAN AL-QUR'AN, HADIST & DO’A</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4 text-center">
            <img src="{{asset('/Admin/assets/img//logo-sekolah/TKIT.png')}}" alt="Logo" style="max-width: 200px; height:auto;">
        </div>

        <div class="col-12">
            <table class="table table-bordered" id="border-hijau"> 
                <tr>
                    <th rowspan="9" class="vertical-text text-center" style="width:30px;" id="bg-hijau">
                        {{$user->first_name}}
                    </th>
                    <th rowspan="9" class="vertical-text text-center" style="width:30px;" id="bg-kuning">
                        {{$user->nis}}
                    </th>
                    <th id="bg-hijau">HAFALAN QUR’AN</th>
                    <th id="bg-kuning">Total</th>
                </tr>
                <tr>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                @foreach ($ayat as $item)
                                    <th> 
                                        <?php
                                            $string = $item->kegiatan;
                                            $string_cleaned = preg_replace('/[\p{Arabic}\/]+/u', '', $string);
                                            echo $string_cleaned;
                                        ?>
                                    </th>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($ayat as $item)
                                <th> {{$item->nilai}} </th>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <th>Lancar</th>
                                <th>Kurang Lancar</th>
                                <th>Ulang</th>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    @php
                                        $lcCount = $ayat->filter(function($item) {
                                            return $item->nilai == 'LC';
                                        })->count();
                                    @endphp
                                    {{$lcCount}}
                                </td>
                                <td class="fw-bold">
                                    @php
                                        $klCount = $ayat->filter(function($item) {
                                            return $item->nilai == 'KL';
                                        })->count();
                                    @endphp
                                    {{$klCount}}
                                </td>
                                <td class="fw-bold">
                                    @php
                                        $ulCount = $ayat->filter(function($item) {
                                            return $item->nilai == 'UL';
                                        })->count();
                                    @endphp
                                    {{$ulCount}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="background-color: aliceblue; height:20px;"></td>
                </tr>
                <tr>
                    <th id="bg-hijau">HAFALAN HADITS</th>
                    <th id="bg-abu"></th>
                </tr>
                <tr>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                @foreach ($hadist as $item)
                                    <th> {{$item->kegiatan}} </th>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hadist as $item)
                                    <th> {{$item->nilai}} </th>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <th>Lancar</th>
                                <th>Kurang Lancar</th>
                                <th>Ulang</th>
                            </tr>
                            <tr>
                                <td>
                                    @php
                                        $lcCount = $hadist->filter(function($item){
                                            return $item->nilai == 'LC';
                                        })->count();
                                    @endphp
                                    {{$lcCount}}
                                </td>
                                <td>
                                    @php
                                        $klCount = $hadist->filter(function($item){
                                            return $item->nilai == 'KL';
                                        })->count();
                                    @endphp
                                    {{$klCount}}
                                </td>
                                <th>
                                    @php
                                        $ulCount = $hadist->filter(function($item){
                                            return $item->nilai == 'UL';
                                        })->count();
                                    @endphp
                                    {{$ulCount}}
                                </th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: aliceblue; height:20px;"></td>
                </tr>
                <tr>
                    <th id="bg-hijau">HAFALAN DO’A</th>
                    <th id="bg-abu"></th>
                </tr>
                <tr>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                @foreach ($doa as $item)
                                <th> {{$item->kegiatan}} </th>
                                @endforeach
                            </tr>
                            <tr>
                                <tr>
                                    @foreach ($doa as $item)
                                    <th> {{$item->nilai}} </th>
                                    @endforeach
                                </tr>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <th>Lancar</th>
                                <th>Kurang Lancar</th>
                                <th>Ulang</th>
                            </tr>
                            <tr>
                                <th>
                                    @php
                                        $lcCount = $doa->filter(function($item){
                                            return $item->nilai == 'LC';
                                        })->count();
                                    @endphp
                                    {{$lcCount}}
                                </th>
                                <th>
                                    @php
                                        $klCount = $doa->filter(function($item){
                                            return $item->nilai == 'KL';
                                        })->count();
                                    @endphp
                                    {{$klCount}}
                                </th>
                                <th>
                                    @php
                                        $ulCount = $doa->filter(function($item){
                                            return $item->nilai == 'UL';
                                        })->count();
                                    @endphp
                                    {{$ulCount}}
                                </th>

                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: aliceblue; height:20px;"></td>
                </tr>
            </table>
        </div>
        
       
    </div>
    <div class="page-break"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    window.print()
</script>
</body>
</html>
