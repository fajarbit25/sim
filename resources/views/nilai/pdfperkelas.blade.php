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
    </style>
</head>
<body>
  
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="5" class="text-center">
                    <h1>
                        <strong>
                            {{$title}} <br/>
                            {{$campus->campus_name}}
                        </strong>
                    </h1>
                </th>
            </tr>

            <tr>
                <th colspan="2" class="text-left">Kelas</th>
                <td colspan="3">{{$nilai->kode_kelas}}</td>
            </tr>
            <tr>
                <th colspan="2" class="text-left">Mata Pelajaran</th>
                <td colspan="3">{{$nilai->nama_mapel}}</td>
            </tr>
            <tr>
                <th colspan="2" class="text-left">Semester</th>
                <td colspan="3">@if($nilai->semester == 1) Ganjil @else Genap @endif</td>
            </tr>
            <tr>
                <th colspan="2" class="text-left">Tahun Ajaran</th>
                <td colspan="3">{{$nilai->ta}}</td>
            </tr>
            <tr>
                <th class="text-left">No.</th>
                <th class="text-left">NISN</th>
                <th class="text-left">Nama Lengkap</th>
                <th class="text-left">Jenis Kelamin</th>
                <th class="text-left">Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->nisn}}</td>
                <td>{{$item->first_name}}</td>
                <td>{{$item->gender}}</td>
                <td>
                    @if($item->nilai <= 65)
                    <span class="fw-bold text-danger">{{$item->nilai}}</span>
                    @else
                    <span class="fw-bold">{{$item->nilai}}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd-guru">
        <br/>
        <br/>
        Makassar, 
        <br/>
        <br/>
        <br/>
        Nama guru<br/>
        NIP
    </div>

</body>
</html>