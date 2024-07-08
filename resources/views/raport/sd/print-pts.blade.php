<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>{{$title}}</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
        .img-kop-surat{
            max-width: 100%;
            margin: 0px;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <td>
                    <img src="{{asset('/storage/home-banner/kop-surat-sdit.png')}}" alt="kop-surat" class="img-kop-surat">
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="row p-3">
                        <div class="col-sm-12 py-4 text-center">
                            <h4>Laporan Hasil Penilaian Tengah Semester Genap</h4>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4">Nama Peserta Didik</div><div class="col-8">: {{$user->first_name}} </div>
                                <div class="col-4">NIS</div><div class="col-8">: {{$user->nis}} </div>
                                <div class="col-4">Nama Sekolah</div><div class="col-8">: {{$campus->campus_name}} </div>
                                <div class="col-4">Alamat Sekolah</div><div class="col-8">: {{$campus->campus_alamat}}</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-6">Kelas</div><div class="col-6">: {{$user->tingkat.' '.$user->kode_kelas}} </div>
                                <div class="col-6">Semester</div><div class="col-6">: @if($semester == 1) Ganjil @else Genap @endif </div>
                                <div class="col-6">Tahun Pelajaran</div><div class="col-6">: {{$ta}} </div>
                                <br/>
                                <br/>
                            </div>
                        </div>
                        <div class="col-6 p-3">
                            <div class="col-12"><span class="fw-bold">A. Nilai</span></div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="background-color: rgb(34, 133, 21);">No.</th>
                                        <th class="text-center" style="background-color: rgb(34, 133, 21);">Mata Pelajaran</th>
                                        <th class="text-center" style="background-color: rgb(34, 133, 21);">Nilai</th>
                                        <th class="text-center" style="background-color: rgb(34, 133, 21);">Predikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nilai->groupBy('mapel_id') as $idmapel => $items)
                                    <tr>
                                        <td class="text-center"> {{$loop->iteration}} </td>
                                        <td> {{$items->first()->nama_mapel}} </td>
                                        <td class="text-center"> {{number_format($items->avg('nilai'))}} </td>
                                        <td class="text-center">
                                            @php
                                                $nilai = $items->avg('nilai');
                                                $getPredikat = $predikat->where('nilai_min', '<=', $nilai)->where('nilai_max', '>=', $nilai)->first();
                                                $predikatDeskripsi = $getPredikat->deskripsi;
                                            @endphp
                                        {{$predikatDeskripsi}}                                        
                                        </td>
                                    </tr>
                                    @endforeach

                                    @foreach($nilai_ml->groupBy('mapel_id') as $idmapel => $items)
                                    <tr>
                                        <th colspan="4" style="background-color: rgb(34, 133, 21);"> Muatan Lokal</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center"> {{$loop->iteration}} </td>
                                        <td> {{$items->first()->nama_mapel}} </td>
                                        <td class="text-center"> {{number_format($items->avg('nilai'))}} </td>
                                        <td class="text-center">
                                            @php
                                                $nilai2 = $items->avg('nilai');
                                                $getPredikat2 = $predikat->where('nilai_min', '<=', $nilai2)->where('nilai_max', '>=', $nilai2)->first();
                                                $predikatDeskripsi2 = $getPredikat2 ? $getPredikat2->deskripsi : 'N/A';
                                            @endphp
                                            {{$predikatDeskripsi2}}                                         
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6 p-3">
                            <div class="col-12">
                                <div class="col-12"><span class="fw-bold">B. Saran - Saran</span></div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                saran saran
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="col-12"><span class="fw-bold">B. Ekstrakulikuler</span></div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="background-color: rgb(34, 133, 21);"> No </th>
                                            <th class="text-center" style="background-color: rgb(34, 133, 21);"> Kegiatan </th>
                                            <th class="text-center" style="background-color: rgb(34, 133, 21);"> Keterangan </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"> 1 </td>
                                            <td class="text-center"> Hadist </td>
                                            <td class="text-center"> A </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="col-12"><span class="fw-bold">D. Ketidak Hadiran</span></div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Sakit</td>
                                            <td>1 Hari</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Ijin</td>
                                            <td>1 Hari</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Tanpa Keterangan</td>
                                            <td>1 Hari</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12"></div>
                            <div class="col-6 text-center">
                                <br/>
                                Orang Tua / Wali
                                <br/><br/><br/><br/>
                                <span class="text-decoration-underline">..........................</span>
                            </div>
                            <div class="col-6 text-center">
                                @php
                                $textTanggal = substr($tanggal, 8, 2);
                                $bulan = substr($tanggal, 5, 2);
                                $tahun = substr($tanggal, 0, 4);
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
                                Makassar, {{$textTanggal.' '.$bulanText.' '.$tahun}}<br/>
                                Guru Kelas {{$user->tingkat.' '.$user->kode_kelas}}
                                <br/><br/><br/><br/>
                                <span class="text-decoration-underline">{{$wali->wali_kelas}}</span><br/>
                                NIY : {{$wali->niy}}
                            </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        window.print()
    </script>
</body>
</html>