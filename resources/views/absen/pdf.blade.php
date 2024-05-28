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
            font-size: 12px;
        }
        table{
            border-collapse: collapse; 
            border: 1px solid;
            width: 100%;
            text-align: left;
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
                <th colspan="6" class="text-center">
                    <h2>
                        <strong>
                            {{$title}} <br/>
                            {{$campus->campus_initial.' - '.$campus->campus_name}}
                        </strong>
                    </h2>
                </th>
            </tr>

            <tr>
                <th colspan="2" class="text-left">Kelas</th>
                <td colspan="4">{{$kelasRow->kode_kelas}}</td>
            </tr>
            <tr>
                <th colspan="2" class="text-left">Mata Pelajaran</th>
                <td colspan="4">{{$mapelRow->nama_mapel}}</td>
            </tr>
            <tr>
                <th colspan="2" class="text-left">Tanggal Absensi</th>
                <td colspan="4">{{$start}}</td>
            </tr>
            <tr>
                <th colspan="2" class="text-left">Guru</th>
                <td colspan="4">{{$guru}}</td>
            </tr>
            <tr>
                <th>No.</th>
                <th>Nomor Induk</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Absensi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>

            @foreach($result as $rs)
            <tr>
              <td class="text-center"> {{$loop->iteration}} </td>
              <td>{{$rs->nisn}}</td>
              <td> {{$rs->first_name.' '.$rs->last_name}} </td>
              <td> {{$rs->gender}} </td>
              <td>{{$rs->absensi}}</td>
              <td></td>
            </tr>
            @endforeach

          </tbody>
    </table>

    <div class="ttd-guru">
        <br/>
        <br/>
        Makassar, {{$start}}
        <br/>
        <br/>
        <br/>
        {{$guru}}<br/>
        {{'NIP.'.$nip}}
    </div>

</body>
</html>