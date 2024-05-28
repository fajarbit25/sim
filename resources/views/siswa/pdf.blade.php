<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Siswa</title>
    <style>
        *{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 12px;
        }
        table{
            border-collapse: collapse; 
            border: 1px solid;
            width: 100%;
            text-align: left;
            margin-top: 20px;
        }
        table tr td{
            border:1px solid;
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
        #header{
            width: 100%;
            text-align: center;
        }

    </style>
</head>
<body>
    <div id="header">
        <strong><h2>Data Siswa</h2></strong>
    </div>
    <table>
        <tr>
            <th colspan="2">Kelas</th>
            <td colspan="5">: {{$kelasRow->kode_kelas}}</td>
        </tr>
        <tr>
            <th colspan="2">Tahun</th>
            <td colspan="5">: {{date('Y-m-d')}}</td>
        </tr>
        <tr><td colspan="7"></td></tr>
        <tr>
            <th>Nomor</th>
            <th>Nomor Induk</th>
            <th>Nama Lengkap</th>
            <th>Kelas</th>
            <th>Jenis Kelamin</th>
            <th>Nomor Handphone</th>
            <th>Alamat Email</th>
        </tr>
        @foreach ($result as $rslt)    
        <tr>
            <td>{{$loop->iteration}}</td>
            <td> {{$rslt->nip}} </td>
            <td> {{$rslt->first_name.' '.$rslt->last_name}} </td>
            <td> {{'Kelas '.$rslt->kode_kelas}} </td>
            <td> {{$rslt->gender}} </td>
            <td> {{$rslt->phone}} </td>
            <td> {{$rslt->email}} </td>
        </tr>
        @endforeach
    </table>
</body>
</html>