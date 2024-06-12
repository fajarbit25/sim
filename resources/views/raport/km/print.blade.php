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
            right: 10px;
            text-align: right;
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
            background-color: rgb(11, 243, 204);
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
                            <img src="{{asset('storage/home-banner/SMPIT.png')}}" alt="logo-sdit" class="logo-sekolah">
                        </div>
                        <div class="col-12 text-center mb-5">
                            <h3>
                                RAPORT <br/> PESERTA DIDIK <br/> SEKOLAH DASAR <br/> (SD)
                            </h3>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-8 text-center">
                            <p class="title-nama">Nama Peserta Didik :</p>
                            <div class="kolom-nama">
                                Ahmad Fahran Fahrezy
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-2"></div>
                        <div class="col-8 text-center">
                            <p class="title-nama">NIS/NISN</p>
                            <div class="kolom-nama">
                                2310180/0101119306
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
                                            <td>SMPIT IBNUL QAYYIM MAKASSAR</td>
                                        </tr>
                                        <tr>
                                            <td>NPSN</td>
                                            <td>:</td>
                                            <td>70003152</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Sekolah</td>
                                            <td>:</td>
                                            <td>Jl. Perintis Kemerdekaan Km 15 (Depan Polda)</td>
                                        </tr>
                                        <tr>
                                            <td>Kode POS</td>
                                            <td>:</td>
                                            <td>90242</td>
                                        </tr>
                                        <tr>
                                            <td>Desa / Kelurahan</td>
                                            <td>:</td>
                                            <td>PAI</td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>:</td>
                                            <td>Biringkanaya</td>
                                        </tr>
                                        <tr>
                                            <td>Kabupaten / Kota</td>
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
                                <table class="table table-borderless font-12 margin-left-10 margin-right-10">
                                    <tbody>
                                        <tr>
                                            <td>Nama Peserta Didik</td>
                                            <td>:</td>
                                            <td>Ahmad Fahran Fahrezy</td>
                                        </tr>
                                        <tr>
                                            <td>NIS / NISN</td>
                                            <td>:</td>
                                            <td>2310180 / 0101119306</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat, Tanggal Lahir</td>
                                            <td>:</td>
                                            <td>Makassar, 01 Januari 2001</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>:</td>
                                            <td>Laki-Laki</td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>:</td>
                                            <td>Islam</td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan Sebelumnya</td>
                                            <td>:</td>
                                            <td>SDIT Ibnul Qayyim Makassar</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Peserta Didik</td>
                                            <td>:</td>
                                            <td>JL. Perintis Kemerdekaan Km 15, Kel. PAI, Kec. Biringkanaya, Kota Makassar Sulawesi Selatan</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Nama Orang Tua</td>
                                        </tr>
                                        <tr>
                                            <td>Ayah</td>
                                            <td>:</td>
                                            <td>Muhaammad</td>
                                        </tr>
                                        <tr>
                                            <td>Ibu</td>
                                            <td>:</td>
                                            <td>Aisyah</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Pekerjaan Orang Tua</td>
                                        </tr>
                                        <tr>
                                            <td>Ayah</td>
                                            <td>:</td>
                                            <td>Pegawai Negeri Sipil</td>
                                        </tr>
                                        <tr>
                                            <td>Ibu</td>
                                            <td>:</td>
                                            <td>Ibu Rumah Tanggal</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Alamat Orang Tua</td>
                                        </tr>
                                        <tr>
                                            <td>Jalan</td>
                                            <td>:</td>
                                            <td>Jl. Perintis Kemerdekaan Km 15</td>
                                        </tr>
                                        <tr>
                                            <td>Kelurahan / Desa</td>
                                            <td>:</td>
                                            <td>P A I</td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>:</td>
                                            <td>Biringkanaya</td>
                                        </tr>
                                        <tr>
                                            <td>Kabupaten / Kota</td>
                                            <td>:</td>
                                            <td>Kota Makassar</td>
                                        </tr>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td>:</td>
                                            <td>Sulawesi Selatan</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Wali Peserta Didik</td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>Muhaammad</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>:</td>
                                            <td>Pegawai Negeri Sipil</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>Jl. Perintis Kemerdekaan, Kel. P A I, Kec. Biringkanaya, Kota Makassar</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-2">
                                <img src="https://sim.iqis.sch.id/storage/photo-users/user.png" alt="foto-siswa" class="foto-siswa">
                            </div>
                            <div class="col-4">
                                Makassar, 12 Desember 2024 <br/>
                                Kepala Sekolah<br/>
                                <br/>
                                <br/>
                                <br/>
                                <span class="fw-bold">Arif Rahman Syarif, S.Kom.</span><br/>
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
                                : VII A (Tujuh)<br/>
                                : D<br/>
                                : I (Satu)<br/>
                                : 2023/2024
                            </div>
                            <div class="col-12 mt-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th id="bg-head-table"> No. </th>
                                            <th id="bg-head-table"> Mata Pelajaran </th>
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
                                                {{number_format($nilaiAkhir, 2)}}
                                            </td>
                                            <td class="font-13"> xxxxx </td>
                                        </tr>
                                        @endforeach

                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <div class="col-12 text-footer">
                        <span class="fst-italic">{{$user->first_name}}</span>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  </body>
</html>