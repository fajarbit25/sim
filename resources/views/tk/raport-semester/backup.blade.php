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
            .landscape {
                transform: rotate(-90deg) translate(-100%, 0);
                transform-origin: top left;
                page-break-before: always;
                width: 100vh;
                height: 100vw;
                overflow: hidden;
            }
            .landscape .kop-surat, .landscape .footer-surat {
                display: none;
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
        <div class="col-sm-12 text-center">
            <h2>
                DESKRIPSI ASPEK TINGKAT PENCAPAIAN PERKEMBANGAN
                SEMESTER I TAHUN AJARAN 2023-2024
            </h2>
        </div>
        <div class="col-sm-12">
            xxx
        </div>
        <div class="col-sm-12">
            <p>
                {{$narasi->agama}}
            </p>
        </div>
    </div>
    <div class="page-break"></div>
</div>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h2>Halaman Kedua</h2>
        </div>
        <div class="col-sm-12">
            <p>{{$narasi->jati_diri}}</p>
        </div>
    </div>
    <div class="page-break"></div>
</div>

<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h2>Halaman Ketiga</h2>
        </div>
        <div class="col-sm-12">
            <p>{{$narasi->literasi}}</p>
        </div>
    </div>
    <div class="page-break"></div>
</div>

<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h2>Halaman Keempat</h2>
        </div>
        <div class="col-sm-12">
            <p>{{$narasi->refleksi_guru}}</p>
        </div>
    </div>
    <div class="page-break"></div>
</div>

<div class="content landscape">
    <div class="row">
        <div class="col-sm-12">
            <h2>Halaman Kelima</h2>
        </div>
        <div class="col-sm-12">
            <p>xxx</p>
        </div>
    </div>
    <div class="page-break"></div>
</div>

<div class="footer-surat no-print">
    <img src="{{ asset('Admin/assets/img/kop-surat/footer-raport-tk.png') }}" alt="Footer Raport" class="footer-img">
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
