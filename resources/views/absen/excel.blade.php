<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Siswa</title>
</head>
<body>
    <table>
        <tr>
            <td>Nomor</td>
            <td>Kelas</td>
            <td>Mata Pelajaran</td>
            <td>Tanggal Absensi</td>
            <td>NISN</td>
            <td>NIPD/NIS</td>
            <td>Sama Siswa</td>
            <td>Jenis Kelamin</td>
            <td>Absensi</td>
            <td>Keterangan</td>
        </tr>
    </table>
    <tbody>
        @foreach ($absen as $abs)    
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$abs->kode_kelas}}</td>
            <td>{{$abs->nama_mapel}}</td>
            <td>{{$abs->tanggal_absen}}</td>
            <td>{{$abs->nisn}}</td>
            <td>{{$abs->nis}}</td>
            <td>{{$abs->first_name}}</td>
            <td>{{$abs->gender}}</td>
            <td>{{$abs->absensi}}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</body>
</html>