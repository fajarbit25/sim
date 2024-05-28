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
                padding: 20px;
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
            padding: 20px;
        }
        .kop-img, .footer-img {
            max-width: 100%;
            /* display: none; */
        }
        .dotted-line {
            width: 100%;
            word-wrap: break-word;
            white-space: pre-wrap;
            line-height: 1.5; /* Mengatur jarak antar baris */
        }
        @media screen {
            .content {
                display: block;
            }
        }
    </style>
</head>
<body>

<div class="kop-surat no-print">
    <img src="{{ asset('Admin/assets/img/kop-surat/kop-raport-tk.png') }}" alt="Kop Raport" class="kop-img">
</div>
<div class="content">
    <div class="row">
        <div class="col-sm-12 text-center mb-3">
            <h6 class="fw-bold">
                DESKRIPSI ASPEK TINGKAT PENCAPAIAN PERKEMBANGAN <br/>
                SEMESTER @if($narasi->semester == '1') I @else II @endif TAHUN AJARAN {{$narasi->ta}}
            </h6>
        </div>
        <div class="col-sm-12 mb-3">
            <div class="row">
                <div class="col-2">
                    Nama <br/>
                    Kelas <br/>
                    Fase 
                </div>
                <div class="col-4">
                    : {{$user->first_name}} <br/>
                    : {{$kelas->kode_kelas}} <br/>
                    : {{$narasi->fase}}
                </div>

                <div class="col-2">
                    Semester <br/>
                    Tinggi Badan <br/>
                    Berat Badan <br/>
                </div>
                <div class="col-4">
                    : @if($narasi->semester == "1") I @else II @endif <br/>
                    : {{$priodik->tinggi}} cm <br/>
                    : {{$priodik->berat}} Kg
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="fw-bold text-center" style="background-color:rgb(82, 133, 82)">Nilai Agama dan Budi Pekerti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>
                                {!! nl2br($narasi->agama) !!}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Foto Kegiatan Anak</p>
                            @foreach($fotoAgama as $img)
                                <img src="{{asset('storage/raport-narasi/'.$img->foto)}}" alt="Foto" style="width: auto; max-height:200px; margin:0px 30px 0px 30px;">
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page-break"></div>
</div>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="fw-bold text-center" style="background-color:rgb(9, 173, 202)">Jati Diri</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>
                                {!! nl2br($narasi->jati_diri) !!}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Foto Kegiatan Anak</p>
                            @foreach($fotoJDiri as $img)
                                <img src="{{asset('storage/raport-narasi/'.$img->foto)}}" alt="Foto" style="width: auto; max-height:200px; margin:0px 30px 0px 30px;">
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page-break"></div>
</div>

<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="fw-bold text-center" style="background-color:rgb(207, 116, 12)">Dasar Literasi dan STEAM</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>
                                {!! nl2br($narasi->literasi) !!}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Foto Kegiatan Anak</p>
                            @foreach($fotoLiterasi as $img)
                                <img src="{{asset('storage/raport-narasi/'.$img->foto)}}" alt="Foto" style="width: auto; max-height:200px; margin:0px 30px 0px 30px;">
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page-break"></div>
</div>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 mb-3 text-center" style="background-color: rgb(230, 53, 82)">
                <h6 class="fw-bold pt-2">Refleksi Guru</h6> 
            </div>
            <div class="col-sm-12 mb-5">
                <p>{{$narasi->refleksi_guru}}</p>
            </div>
            <div class="col-sm-12 text-center" style="background-color: rgb(240, 141, 227)">
                <h6 class="fw-bold pt-2">Refleksi Orang Tua</h6> 
            </div>
            <div class="col-sm-12">
                <div class="dotted-line">
                    {{ str_repeat('.', 450) }}
                </div>
            </div>
            <div class="col-6">
                <br/>
                <span class="fw-bold">Orang Tua/Wali</span> <br/>
                <br/>
                <br/>
                <br/>
                <span class="fw-bold text-decoration-underline">........................</span> <br/>
            </div>
            <div class="col-6">
                <span class="fw-bold">Makassar, {{$narasi->tanggal}}</span> <br/>
                <span class="fw-bold">Wali Kelas {{$kelas->kode_kelas}}</span> <br/>
                <br/>
                <br/>
                <br/>
                <span class="fw-bold text-decoration-underline"> {{$kelas->walikelas}} </span> <br/>
            </div>
            <div class="col-12 pt-3 text-center">
                <span class="fw-bold">Mengetahui,</span> <br/>
                <span class="fw-bold">Kepala sekolah TKIT Ibnul Qayyim</span> <br/>
                <br/>
                <br/>
                <br/>
                <span class="fw-bold text-decoration-underline"> {{$kepsek->campus_kepsek}} </span> <br/>
            </div>
        </div>
    </div>
</div>

<div class="footer-surat no-print">
    <img src="{{ asset('Admin/assets/img/kop-surat/footer-raport-tk.png') }}" alt="Footer Raport" class="footer-img">
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    window.print()
</script>
</body>
</html>
