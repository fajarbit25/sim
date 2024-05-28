<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>{{$title}}</title>

    <style>
        *{
            font-family: courier, courier new, serif;
            font-size: 14px;
        }
        table{
            border-collapse: collapse; 
            border: 1px solid;
            width: 100%;
            text-align: left;
        }
        table tr td{
            border:1px solid;
            padding: 3px 3px 3px 3px;
        }
        table tr th{
            border: 1px solid;
            padding: 3px 3px 3px 3px;
        }
        .text-center{
            text-align: center;
        }
        .text-left{
            text-align: left;
        }
        .ttd-guru{
            padding-top: 200 px;
            width: 40%;
            text-align: center;
        }
        .header{
            text-align: center;
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 1px solid black;
        }
        .right-floating-div{
            display: inline-block;
            width: 49%;
        }
    </style>
</head>
<body>

    <div class="header">
        <strong>
            {{$title}} <br/>
            {{$campus->campus_name}}
        </strong>
    </div>
    <div class="right-floating-div">
        <strong>Nama Lengkap : </strong> {{$user->name}} <br/>
        <strong>NISN : </strong> {{$student->nisn}} <br/>
        <strong>Kelas : </strong> {{$kelas->kode_kelas}}
    </div>
    <div class="right-floating-div">
        <strong>Tahun ajaran : </strong> {{$nilai->ta}} <br/>
        <strong>Semester : </strong> @if($nilai->semester == 1) Ganjil @else Genap @endif <br/>
        <strong>Sekolah : </strong> {{$campus->campus_name}} 
    </div>
    <table class="table table-bordered" style="margin-top : 10px;">
        <thead>
            <tr>
                <th class="text-left" rowspan="2">No.</th>
                <th class="text-left" colspan="2" >Mata Pelajaran</th>
                <th class="text-left" colspan="2">Nilai</th>
            </tr>
            <tr>
                <th class="text-left">Kode</th>
                <th class="text-left">Nama Mata Pelajaran</th>
                <th class="text-left">Angka</th>
                <th class="text-left">Huruf</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->kode}}</td>
                <td>{{$item->mapel}}</td>
                <td>{{$item->nilai}}</td>
                <td>
                    @if($item->nilai >= 90 && $item->nilai <= 100) A
                    @elseif($item->nilai >= 80 && $item->nilai <= 89) B
                    @elseif($item->nilai >= 70 && $item->nilai <= 79) C
                    @elseif($item->nilai >= 60 && $item->nilai <= 69) D
                    @else E @endif
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    <div class="ttd-guru">
        <br/>
        <br/>
        Makassar, {{$nilai->tanggal}}
        <br/>
        <br/>
        <br/>
        {{$nilai->guru}}<br/>
        NIP. {{$nilai->nip}}
    </div>

</body>
</html>