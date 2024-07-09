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
    <style>
        table{
            width: 100%;
        }
        .text-footer {
            position: fixed;
            bottom: 10px;
            left: 10px;
            width: calc(100% - 20px); /* 10px margin on both sides */
            font-size: 13px;
        }
        .logo-sekolah{
            max-width: 30%;
            height: auto;
        }
        .wrap-logo-sekolah{
            padding-top: 25%;
            padding-bottom: 10%;
        }
        .kolom-nama{
            width: 100%;
            border: 1px solid black;
            border-right: 2px solid black;
            border-bottom: 2px solid black;
            font-weight: bold;
            padding: 8px;
        }
        .title-nama{
            margin: 0;
            padding: 0;
            font-size: 13px;
        }
        .page-break{
            page-break-before: always;
        }
        .padding-top-25{
            padding-top: 25%; 
        }
        .padding-top-10{
            padding-top: 10%;
        }
        .font-13{
            font-size: 13px;
        }
        .font-12{
            font-size: 12px;
        }
        .font-11{
            font-size: 11px;
        }
        .font-10{
            font-size: 10;
        }
        .margin-left-10{
            margin-left: 10%;
        }
        .margin-right-10{
            margin-right: 10%;
        }
        .foto-siswa{
            width: 100%;
            height: auto;
            border: 1px solid black;
        }
        #bg-head-table{
            background-color: rgb(160, 194, 174);
        }
    </style>
  </head>
  <body>

    <table>
        <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-12 text-center wrap-logo-sekolah">
                            <img src="{{asset('storage/home-banner/tutwuri-handayani.png')}}" alt="logo-sdit" class="logo-sekolah">
                        </div>
                        <div class="col-12 text-center mb-5">
                            @if(Auth::user()->campus_id = 4)
                            <h3>
                                RAPORT <br/> PESERTA DIDIK <br/> SEKOLAH MENENGAH PERTAMA <br/> (SMP)
                            </h3>
                            @endif
                            @if(Auth::user()->campus_id == 5) 
                            <h3>
                                RAPORT <br/> PESERTA DIDIK <br/> SEKOLAH MENENGAH KEJURUAN <br/> (SMK)
                            </h3>
                            @endif
                        </div> 
                        <div class="col-2"></div>
                        <div class="col-8 text-center">
                            <p class="title-nama">Nama Peserta Didik :</p>
                            <div class="kolom-nama">
                                {{$user->first_name}}
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-2"></div>
                        <div class="col-8 text-center">
                            <p class="title-nama">NIS/NISN</p>
                            <div class="kolom-nama">
                                {{$user->nis}}/{{$user->nisn}}
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    
                    <div class="page-break"></div>

                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center padding-top-10">
                                <h4>
                                    KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN <br/> REPUBLIK INDONESIA
                                </h4>
                            </div>
                            <div class="col-12 text-center padding-top-25">
                                <h4>
                                    RAPOR <br/> PESERTA DIDIK <br/> SEKOLAH MENENGAH PERTAMA (SMP)
                                </h4>
                            </div>
                            <div class="col-12 padding-top-10">
                                <table class="table table-borderless font-13 margin-left-10 margin-right-10">
                                    <tbody>
                                        <tr>
                                            <td>Nama Sekolah</td>
                                            <td>:</td>
                                            <td> {{$user->campus_name}} </td>
                                        </tr>
                                        <tr>
                                            <td>NPSN</td>
                                            <td>:</td>
                                            <td> {{$user->npsn}} </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Sekolah</td>
                                            <td>:</td>
                                            <td style="padding-right: 100px;"> {{$user->campus_alamat}} </td>
                                        </tr>
                                        <tr>
                                            <td>Kode POS</td>
                                            <td>:</td>
                                            <td>90242</td>
                                        </tr>
                                        <tr>
                                            <td style="white-space: nowrap;">Desa / Kelurahan</td>
                                            <td>:</td>
                                            <td>PAI</td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>:</td>
                                            <td>Biringkanaya</td>
                                        </tr>
                                        <tr>
                                            <td style="white-space: nowrap;">Kabupaten / Kota</td>
                                            <td>:</td>
                                            <td>Makassar</td>
                                        </tr>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td>:</td>
                                            <td>Sulawesi Selatan</td>
                                        </tr>
                                        <tr>
                                            <td>Website</td>
                                            <td>:</td>
                                            <td>smpit@iqis.sch.id</td>
                                        </tr>
                                        <tr>
                                            <td>E-mail</td>
                                            <td>:</td>
                                            <td>https://smpit.iqis.sch.id</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="page-break"></div>

                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center mt-5">
                                <h4>
                                    IDENTITAS PESERTA DIDIK
                                </h4>
                            </div>
                            <div class="col-12 mt-5">
                                <table class="table table-borderless font-11 margin-left-10 margin-right-10">
                                    <tbody>
                                        <tr>
                                            <td>Nama Peserta Didik</td>
                                            <td>:</td>
                                            <td>{{$user->first_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>NIS / NISN</td>
                                            <td>:</td>
                                            <td>{{$user->nis}} / {{$user->nisn}} </td>
                                        </tr>
                                        <tr>
                                            <td>Tempat, Tanggal Lahir</td>
                                            <td>:</td>
                                            @php
                                                $birthTanggal = substr($user->tanggal_lahir, 8, 2);
                                                $birthBulan = substr($user->tanggal_lahir, 5, 2);
                                                $birthTahun = substr($user->tanggal_lahir, 0, 4)
                                            @endphp
                                            <td>{{$user->tempat_lahir}}, {{$birthTanggal}} {{$birthBulan}} {{$birthTahun}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>:</td>
                                            <td>{{$user->gender}}</td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>:</td>
                                            <td>{{$user->agama}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan Sebelumnya</td>
                                            <td>:</td>
                                            <td> {{$user->sekolah_asal}} </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Peserta Didik</td>
                                            <td>:</td>
                                            <td style="padding-right: 100px;">
                                                @php
                                                    $address = strtolower($user->jalan.', '.$user->kel.', '.$user->kec.', '.$user->kota.', '.$user->provinsi);
                                                @endphp
                                                {{ucwords($address)}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Nama Orang Tua</td>
                                        </tr>
                                        <tr>
                                            <td>Ayah</td>
                                            <td>:</td>
                                            <td> {{$wali->where('segment', 'ayah')->first()->nama_lengkap}} </td>
                                        </tr>
                                        <tr>
                                            <td>Ibu</td>
                                            <td>:</td>
                                            <td>{{$wali->where('segment', 'ibu')->first()->nama_lengkap}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Pekerjaan Orang Tua</td>
                                        </tr>
                                        <tr>
                                            <td>Ayah</td>
                                            <td>:</td>
                                            <td>{{$wali->where('segment', 'ayah')->first()->pekerjaan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Ibu</td>
                                            <td>:</td>
                                            <td>{{$wali->where('segment', 'ibu')->first()->pekerjaan}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Alamat Orang Tua</td>
                                        </tr>
                                        <tr>
                                            <td>Jalan</td>
                                            <td>:</td>
                                            <td>{{$user->jalan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kelurahan / Desa</td>
                                            <td>:</td>
                                            <td>{{$user->kel}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>:</td>
                                            <td>{{$user->kec}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kabupaten / Kota</td>
                                            <td>:</td>
                                            <td>{{$user->kota}}</td>
                                        </tr>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td>:</td>
                                            <td>{{$user->provinsi}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Wali Peserta Didik</td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{$wali->where('segment', 'wali')->first()->nama_lengkap}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>:</td>
                                            <td>{{$wali->where('segment', 'wali')->first()->pekerjaan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td style="padding-right: 100px;">{{ucwords($address)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-8"></div>
                            <div class="col-4">
                                @php
                                    $tanggal = substr($dataRaport->tanggal_raport, 8, 2);
                                    $bulan = substr($dataRaport->tanggal_raport, 5, 2);
                                    $tahun = substr($dataRaport->tanggal_raport, 0, 4);
                                    if($bulan == '01'){
                                        $bulanText = "Januari";
                                    }elseif($bulan == '02'){
                                        $bulanText = "Februari";
                                    }elseif($bulan == '03'){
                                        $bulanText = "Maret";
                                    }elseif($bulan == '04'){
                                        $bulanText = "April";
                                    }elseif($bulan == '05'){
                                        $bulanText = "Mei";
                                    }elseif($bulan == '06'){
                                        $bulanText = "Juni";
                                    }elseif($bulan == '07'){
                                        $bulanText = "Juli";
                                    }elseif($bulan == '08'){
                                        $bulanText = "Agustus";
                                    }elseif($bulan == '09'){
                                        $bulanText = "September";
                                    }elseif($bulan == '10'){
                                        $bulanText = "Oktober";
                                    }elseif($bulan == '11'){
                                        $bulanText = "November";
                                    }elseif($bulan == '12'){
                                        $bulanText = "Desember";
                                    }
                                @endphp
                                Makassar, {{$tanggal.' '.$bulanText.' '.$tahun}} <br/>
                                Kepala Sekolah<br/>
                                <br/>
                                <br/>
                                <br/>
                                <span class="fw-bold text-decoration-underline">Arif Rahman Syarif, S.Kom.</span><br/>
                                NIP: 199304 201807 1 03
                            </div>
                        </div>
                    </div>

                    <div class="page-break"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 my-5 text-center">
                                <h3 class="fw-bold">LAPORAN HASIL BELAJAR <br/> (RAPOR)</h3>
                            </div>
                            <div class="col-2 font-13">
                                Nama Peserta Didik<br/>
                                NISN<br/>
                                Sekolah<br/>
                                Alamat<br/>
                            </div>
                            <div class="col-4 font-13">
                                : {{$user->first_name}}<br/>
                                : {{$user->nisn}}<br/>
                                : {{$user->campus_alamat}}
                            </div>
                            <div class="col-2 font-13">
                                Kelas<br/>
                                Fase<br/>
                                Semester<br/>
                                Tahun Pelajaran<br/>
                            </div>
                            <div class="col-4 font-13">
                                @php
                                    if($user->tingkat == 1){
                                        $textKelas = 'Satu';
                                    }elseif($user->tingkat == 2){
                                        $textKelas = 'Dua';
                                    }elseif($user->tingkat == 3){
                                        $textKelas = 'Tiga';
                                    }elseif($user->tingkat == 4){
                                        $textKelas = 'Empat';
                                    }elseif($user->tingkat == 5){
                                        $textKelas = 'Lima';
                                    }elseif($user->tingkat == 6){
                                        $textKelas = 'Enam';
                                    }elseif($user->tingkat == 7){
                                        $textKelas = 'Tujuh';
                                    }elseif($user->tingkat == 8){
                                        $textKelas = 'Delapan';
                                    }elseif($user->tingkat == 9){
                                        $textKelas = 'Sembilan';
                                    }elseif($user->tingkat == 10){
                                        $textKelas = 'Sepuluh';
                                    }elseif($user->tingkat == 11){
                                        $textKelas = 'Sebelas';
                                    }elseif($user->tingkat == 12){
                                        $textKelas = 'Dua Belas';
                                    }

                                    if($user->tingkat == 1){
                                        $romawiKelas = 'I';
                                    }elseif($user->tingkat == 2){
                                        $romawiKelas = 'II';
                                    }elseif($user->tingkat == 3){
                                        $romawiKelas = 'III';
                                    }elseif($user->tingkat == 4){
                                        $romawiKelas = 'IV';
                                    }elseif($user->tingkat == 5){
                                        $romawiKelas = 'V';
                                    }elseif($user->tingkat == 6){
                                        $romawiKelas = 'VI';
                                    }elseif($user->tingkat == 7){
                                        $romawiKelas = 'VII';
                                    }elseif($user->tingkat == 8){
                                        $romawiKelas = 'VIII';
                                    }elseif($user->tingkat == 9){
                                        $romawiKelas = 'IX';
                                    }elseif($user->tingkat == 10){
                                        $romawiKelas = 'X';
                                    }elseif($user->tingkat == 11){
                                        $romawiKelas = 'XI';
                                    }elseif($user->tingkat == 12){
                                        $romawiKelas = 'XII';
                                    }

                                    if($dataRaport->semester == 1){
                                        $semesterText = "I (Ganjil)";
                                    }elseif($dataRaport->semester == 2){
                                        $semesterText = "II (Genap)";
                                    }

                                    if($dataRaport->semester == 1){
                                        $semesterText = "I (Ganjil)";
                                    }elseif($dataRaport->semester == 2){
                                        $semesterText = "II (Genap)";
                                    }
                                @endphp
                                : {{$romawiKelas}} {{$user->kode_kelas}} ({{$textKelas}})<br/>
                                : -<br/>
                                : {{$semesterText}}<br/>
                                : {{$dataRaport->ta}}
                            </div>
                            <div class="col-12 mt-5">
                                <table class="table table-bordered font-12">
                                    <thead>
                                        <tr>
                                            <th id="bg-head-table"> No. </th>
                                            <th id="bg-head-table"> Muatan Pelajaran </th>
                                            <th id="bg-head-table"> Nilai <br/> Akhir </th>
                                            <th id="bg-head-table"> Capaian Kompetensi </th>
                                        </tr>
                                    </thead>
                                    <div class="tbody">
                                        @foreach ($dataNilai->groupBy('idmapel') as $idmapel => $items)    
                                        <tr>
                                            <td class="font-13"> {{$loop->iteration}} </td>
                                            <td class="font-13"> {{$items->first()->nama_mapel}} </td>
                                            <td class="font-13">
                                                @php
                                                    $avgSumatif = $items->where('aspek', 'Sumatif')->avg('nilai');
                                                    $sumTes = $items->where('aspek', 'Sumatif')->sum('test');
                                                    $sumNonTes = $items->where('aspek', 'Sumatif')->sum('non_test');
                                                    $total = $avgSumatif+$sumTes+$sumNonTes;
                                                    $nilaiAkhir = $total/3;
                                                @endphp
                                                {{number_format($nilaiAkhir)}}
                                            </td>
                                            <td class="font-13">
                                                @php
                                                   $deskripsiUpper = $items->where('aspek', 'Formatif')->where('nilai', 1)->where('tampil', 1);
                                                   $deskripsiLower = $items->where('aspek', 'Formatif')->where('nilai', 0)->where('tampil', 1);
                                                @endphp
                                                @if(count($deskripsiUpper) > 0)
                                                    <span> {{$user->first_name}} </span>
                                                    <span> menunjukkan pemahaman dalam </span>
                                                    @foreach($deskripsiUpper as $upper)
                                                            {{$upper->deskripsi.', '}}
                                                    @endforeach
                                               @endif
                                                <br/>
                                               @if(count($deskripsiLower) > 0)
                                                <span> {{$user->first_name}} </span>
                                                <span> membutuhkan bimbingan dalam </span>
                                                @foreach($deskripsiLower as $lower)
                                                        {{$lower->deskripsi.', '}}
                                                @endforeach
                                               @endif

                                            </td>
                                        </tr>
                                        @endforeach

                                    </div>
                                </table>
                                <table class="table table-bordered font-12">
                                    <thead>
                                        <tr>
                                            <th id="bg-head-table">No</th>
                                            <th id="bg-head-table">Ekstrakulikuler</th>
                                            <th id="bg-head-table">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Futsal</td>
                                            <td>Ananda {{$user->first_name}} mampu mempraktikkan berbagai gerakan dasar dengan baik dalam permainan</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-bordered font-12">
                                    <thead>
                                        <tr>
                                            <th colspan="2" id="bg-head-table">Ketidakhadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sakit</td>
                                            <td>4 hari</td>
                                        </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td>0 hari</td>
                                        </tr>
                                        <tr>
                                            <td>Tanpa Keterangan</td>
                                            <td>1 hari</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-4 text-center">
                                Mengetahui<br/>
                                Orang Tua<br/>
                                <br/>
                                <br/>
                                <br/>
                                <span class="text-decoration-underline">................................</span><br/>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                Makassar, {{$tanggal.' '.$bulanText.' '.$tahun}}<br/>
                                Wali Kelas<br/>
                                <br/>
                                <br/>
                                <br/>
                                <span class="text-decoration-underline">{{$wali_kelas->first_name}}</span><br/>
                                NIY : {{$wali_kelas->niy}}
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                Mengetahui,<br/>
                                Kepala Sekolah<br/>
                                <br/>
                                <br/>
                                <br/>
                                <span class="text-decoration-underline">{{$user->campus_kepsek}}</span><br/>
                                NIY : {{$user->niy_kepsek}}
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>

                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <div class="col-12 text-footer font-11">
                        @php
                            if($user->tingkat == 1){
                                $textKelas = 'Satu';
                            }elseif($user->tingkat == 2){
                                $textKelas = 'Dua';
                            }elseif($user->tingkat == 3){
                                $textKelas = 'Tiga';
                            }elseif($user->tingkat == 4){
                                $textKelas = 'Empat';
                            }elseif($user->tingkat == 5){
                                $textKelas = 'Lima';
                            }elseif($user->tingkat == 6){
                                $textKelas = 'Enam';
                            }elseif($user->tingkat == 7){
                                $textKelas = 'Tujuh';
                            }elseif($user->tingkat == 8){
                                $textKelas = 'Delapan';
                            }elseif($user->tingkat == 9){
                                $textKelas = 'Sembilan';
                            }elseif($user->tingkat == 10){
                                $textKelas = 'Sepuluh';
                            }elseif($user->tingkat == 11){
                                $textKelas = 'Sebelas';
                            }elseif($user->tingkat == 12){
                                $textKelas = 'Dua Belas';
                            }

                            if($dataRaport->semester == 1){
                                $semesterText = "I (Ganjil)";
                            }elseif($dataRaport->semester == 2){
                                $semesterText = "II (Genap)";
                            }
                        @endphp
                        <span class="fw-bold">Raport SMPIT IBNUL QAYYIM MAKASSAR</span><br/>
                        <span class="">{{$user->first_name}} | {{$user->nis}} | Kelas : {{$user->tingkat.' '.$user->kode_kelas}} ({{$textKelas}}) | Semester : {{$semesterText}} | {{$dataRaport->ta}} </span>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.print()
    </script>
  </body>
</html>