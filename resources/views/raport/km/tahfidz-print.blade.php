<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link href="http://sims.test/Admin/assets/img/favicon-iqis.png" rel="icon">
    <link href="http://sims.test/Admin/assets/img/favicon-iqis.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('Admin/assets/css/raport-tahfidz.css?v2')}}" >
    <title>{{$title}}</title>

  </head>
  <body>

    <table>
        <thead>
            <tr>
                <td>
                    <img src="{{asset('/storage/home-banner/kop-tahfidz-smkit.png')}}" alt="..." class="kop-raport">
                    <div class="col-sm-12 line-header-smk"></div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="row m-2">
                        <div class="col-12 text-center p-2">
                            <span>بِسْمِ اللهِ الرَّحْمٰنِ الرَّحيمِ</span>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4">
                                    Nama<br/>
                                    NISN
                                </div>
                                <div class="col-8">
                                    : {{$user->first_name}} <br/>
                                    : {{$user->nisn}}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    Kelas / Semester<br/>
                                    Tahun Pelajaran
                                </div>
                                <div class="col-7">
                                    : {{$kelas->tingkat.' '.$kelas->kode_kelas}} / @if($semester == 1) Ganjil @else Genap @endif <br/>
                                    : {{$ta}}
                                </div>
                            </div>
                        </div>
                        @if($kelas->tingkat == '7')
                        <div class="col-12 bg-soft mt-3"> <span class="fw-bold" id="font-smk"> A. Bacaan Al-Qur'an Metode Nurul Bayan </span> </div>
                        <div class="col-12">
                            <table class="table table-bordered my-2">
                                <thead>
                                    <tr>
                                        <th id="thead-smk" class="text-light text-center">Seri Kitab</th>
                                        <th id="thead-smk" class="text-light text-center">Nilai</th>
                                        <th id="thead-smk" class="text-light text-center">Apresiasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"> {{$faturrahman->deskripsi}} </td>
                                        <td class="text-center"> {{$faturrahman->nilai}} </td>
                                        <td class="text-center">
                                            @if($faturrahman->nilai >= 60 && $faturrahman->nilai < 70) <span>Maqbul</span>
                                            @elseif($faturrahman->nilai >= 70 && $faturrahman->nilai < 80) <span>Jayyid</span>
                                            @elseif($faturrahman->nilai >= 80 && $faturrahman->nilai < 90) <span>Jayyid Jiddan</span>
                                            @elseif($faturrahman->nilai >= 90 && $faturrahman->nilai < 100) <span>Mumtaz</span>
                                            @else <span>-</span> @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif

                        <div class="col-12 bg-soft mt-3"> <span class="fw-bold" id="font-smk"> @if($kelas->tingkat == '7') B @else A @endif. Tahfizh Al-Qu r'an </span> </div>
                        @php
                            $count = $result->count();
                            $splitPoint = ceil($count / 2);
                        @endphp
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <table class="table table-bordered my-2">
                                        <thead>
                                            <tr>
                                                <th id="thead-smk" class="text-light text-center">Juz</th>
                                                <th id="thead-smk" class="text-light text-center">Nama Surah</th>
                                                <th id="thead-smk" class="text-light text-center">Nilai</th>
                                                <th id="thead-smk" class="text-light text-center">Apresiasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($result as $item1)
                                            @if ($loop->iteration <= $splitPoint)
                                            <tr>
                                                <td class="text-center"> {{$item1->jus}} </td>
                                                <td class="text-center"> {{$item1->bahasa}} </td>
                                                <td class="text-center"> {{$item1->nilai}} </td>
                                                <td class="text-center">
                                                    @if($item1->nilai >= 60 && $item1->nilai < 70) <span>Maqbul</span>
                                                    @elseif($item1->nilai >= 70 && $item1->nilai < 80) <span>Jayyid</span>
                                                    @elseif($item1->nilai >= 80 && $item1->nilai < 90) <span>Jayyid Jiddan</span>
                                                    @elseif($item1->nilai >= 90 && $item1->nilai < 100) <span>Mumtaz</span>
                                                    @else <span>-</span> @endif
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <table class="table table-bordered my-2">
                                        <thead>
                                            <tr>
                                                <th id="thead-smk" class="text-light text-center">Juz</th>
                                                <th id="thead-smk" class="text-light text-center">Nama Surah</th>
                                                <th id="thead-smk" class="text-light text-center">Nilai</th>
                                                <th id="thead-smk" class="text-light text-center">Apresiasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($result as $item1)
                                            @if ($loop->iteration > $splitPoint)
                                            <tr>
                                                <td class="text-center"> {{$item1->jus}} </td>
                                                <td class="text-center"> {{$item1->bahasa}} </td>
                                                <td class="text-center"> {{$item1->nilai}} </td>
                                                <td class="text-center">
                                                    @if($item1->nilai >= 60 && $item1->nilai < 70) <span>Maqbul</span>
                                                    @elseif($item1->nilai >= 70 && $item1->nilai < 80) <span>Jayyid</span>
                                                    @elseif($item1->nilai >= 80 && $item1->nilai < 90) <span>Jayyid Jiddan</span>
                                                    @elseif($item1->nilai >= 90 && $item1->nilai < 100) <span>Mumtaz</span>
                                                    @else <span>-</span> @endif
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            <tr>
                                                <th colspan="2" id="bg-soft-footer" class="text-center">Nilai rata-rata</th>
                                                <th id="bg-soft-footer" class="text-center">{{$result->avg('nilai')}}</th>
                                                <th id="thead-smk" class="text-center text-light">
                                                    @if($result->avg('nilai') >= 60 && $result->avg('nilai') < 70) <span>Maqbul</span>
                                                    @elseif($result->avg('nilai') >= 70 && $result->avg('nilai') < 80) <span>Jayyid</span>
                                                    @elseif($result->avg('nilai') >= 80 && $result->avg('nilai') < 90) <span>Jayyid Jiddan</span>
                                                    @elseif($result->avg('nilai') >= 90 && $result->avg('nilai') < 100) <span>Mumtaz</span>
                                                    @else <span>-</span> @endif
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-3"></div>
                        <div class="col-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th id="thead-smk" class="text-light text-center">Catatan dan Motivasi dari Ustadz/Ustadzah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center" id="font-smk" style="height: 200px;">{{$catatan}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="3" id="thead-smk" class="text-light text-center">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Nilai</th>
                                        <th colspan="2" class="text-center">Predikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">90 - 99</td>
                                        <td class="text-center">Mumtaz</td>
                                        <td class="text-center">A</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">80 - 89</td>
                                        <td class="text-center">Jayyid Jiddan</td>
                                        <td class="text-center">B</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">70 - 79</td>
                                        <td class="text-center">Jayyid</td>
                                        <td class="text-center">C</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">< 70</td>
                                        <td class="text-center">Maqbul</td>
                                        <td class="text-center">D</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12"></div>
                        <div class="col-sm-6"></div> <!--Grid -->
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4 text-end">Makassar, </div>
                                <div class="col-8">
                                    <span class="text-decoration-underline">{{$hijriah}}</span><br/>
                                    <span>{{$masehi}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            Mengetahui,<br/>
                            Kepala Sekolah<br/>
                            <br/><br/></br/><br/>
                            <span class="text-decoration-underline">{{$campus->campus_kepsek}}</span>
                        </div>
                        <div class="col-6 text-center">
                            <br/>
                            Guru Tahzin<br/>
                            <br/><br/></br/><br/>
                            <span class="text-decoration-underline">{{$guru_tahsin->name ?? ""}}</span>
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
    <!-- Option 2: Separate Popper and Bootstrap JS -->
  </body>
</html>