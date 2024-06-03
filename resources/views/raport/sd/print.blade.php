<!DOCTYPE html>
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
        *{
            font-size: 12px;
        }
        .logo-sekolah {
            max-width: 35%;
            height: auto;
            padding-top: 20%;
            padding-bottom: 5%;
        }

        .page-break {
            page-break-after: always;
        }

        .nama-sekolah{
            padding-top: 5%;
            font-family: "Arial Black", Arial, sans-serif;
        }

        .nama-siswa{
            border: 1px solid black;
            border-bottom: 2px solid black;
            padding: 5px;
        }

        #footer {
            position: fixed;
            bottom: 0;
            right: 0;
            margin-top: 10px; /* Jarak dari bawah */
        }

        @media print {
            .page-break {
                page-break-after: always;
            }
        }
    </style>

</head>
<body>
<div>
<table>
    <tbody>
        <tr>
            <td>
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{asset('storage/home-banner/SDIT.png')}}" alt="logo-sdit" class="logo-sekolah">
                    </div>
                    <div class="col-sm-12 text-center">
                        <h1>LAPORAN</h1>
                        <h3>HASIL CAPAIAN KOMPETENSI <br/> SEKOLAH DASAR</h3>
                        <h2 class="fw-bold nama-sekolah">{{strtoupper($load->campus_name)}}</h2>
                        <p class="fw-bold">{{$load->campus_alamat}}</p>

                        <div class="row">
                            <p class="mt-5">Nama Peserta Didik</p>
                            <div class="col-3"></div>
                            <div class="nama-siswa col-6 fw-bold">{{$load->first_name}}</div>
                            <div class="col-3"></div>

                            <p class="mt-5">NIS/NISN</p>
                            <div class="col-3"></div>
                            <div class="nama-siswa col-6 fw-bold">{{$load->nis.'/'.$load->nisn}}</div>
                            <div class="col-3"></div>

                        </div>
                        


                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</div>

<div class="page-break"></div>

<div>
<table>
    <tbody>
        <tr>
            <td colspan="2">
                <h2 class="text-center mt-5">
                    KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN<br/>
                    REPUBLIK INDONESIA
                </h2>
            </td>
        </tr>
        <tr>
            <td>
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{asset('storage/home-banner/SDIT.png')}}" alt="logo-sdit" class="logo-sekolah">
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <h2 class="text-center mt-5">
                    LAPORAN HASIL<br/>
                    BELAJAR PESERTA DIDIK<br/>
                    SEKOLAH DASAR<br/>
                    (SD)
                </h2>
            </td>
        </tr>

        <tr>
            <td>
                    <div class="row mt-5">
                        <div class="col-3"></div>
                        <div class="col-2">Nama Sekolah</div>
                        <div class="col-1">:</div>
                        <div class="col-3"> {{$load->campus_name}} </div>
                        <div class="col-3"></div>

                        <div class="col-3"></div>
                        <div class="col-2">NPSN</div>
                        <div class="col-1">:</div>
                        <div class="col-3"> {{$load->npsn}} </div>
                        <div class="col-3"></div>

                        <div class="col-3"></div>
                        <div class="col-2">NSS</div>
                        <div class="col-1">:</div>
                        <div class="col-3"> 102196012582 </div>
                        <div class="col-3"></div>

                        <div class="col-3"></div>
                        <div class="col-2">Alamat Sekolah</div>
                        <div class="col-1">:</div>
                        <div class="col-3"> {{$load->campus_alamat}} </div>
                        <div class="col-3"></div>
                    </div>
            </td>
        </tr>

    </tbody>
</table>
</div>

<div id="footer">
    <table>
        <tfoot>
            <tr>
                <td>
                    <div class="col-12 text-end">
                        <span class="fst-italic" id="pageCount"> {{$load->first_name}} </span>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    // window.onload = function() {
    //     var footer = document.getElementById("footer");
    //     footer.style.display = "none";
    //     window.onbeforeprint = function() {
    //         footer.style.display = "block";
    //         var pageCount = document.querySelectorAll('.page-break').length;
    //         var currentPage = 1;
    //         var currentPageElement = document.getElementById('currentPage');
    //         if (currentPageElement) {
    //             var matches = window.location.search.match(/page=(\d+)/);
    //             if (matches && matches[1]) {
    //                 currentPage = parseInt(matches[1]);
    //             }
    //             currentPageElement.textContent = currentPage + '/' + pageCount;
    //         }
    //         document.getElementById('pageCount').textContent = ' {{$load->first_name}} ' + currentPage + '/' + pageCount;
    //     };
    //     window.onafterprint = function() {
    //         footer.style.display = "none";
    //     };
    // };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
