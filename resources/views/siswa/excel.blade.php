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
            <td>No</td>
            <td>NISN</td>
            <td>Nama Lengkap</td>
            <td>Jenis Kelamin</td>
            <td>Alamat Email</td>
            <td>phone</td>
            <td>kelas</td>
            <td>Tempat, Tanggal Lahir</td>
            <td>NIK</td>
            <td>KK</td>
            <td>Akta Lahir</td>
            <td>Agama</td>
            <td>Kewarganegaraan</td>
            <td>Negara</td>
            <td>Anaka Ke</td>
            <td>Pekerjaan</td>
            <td>Memiliki KIP</td>
            <td>Alasan Menolak PIP</td>
        </tr>
    </table>
    <tbody>
        @foreach ($user as $usr)    
        <tr>
            <td>{{$loop->iteration}}</td>
            <td> {{$usr->nisn}} </td>
            <td> {{$usr->first_name.' '.$usr->last_name}} </td>
            <td> {{$usr->gender}} </td>
            <td> {{$usr->address}} </td>
            <td> {{$usr->email}} </td>
            <td> {{$usr->kode_kelas}} </td>
            <td> {{$usr->tempat_lahir.', '.$usr->tanggal_lahir}} </td>
            <td> {{$usr->nik}} </td>
            <td> {{$usr->kk}} </td>
            <td> {{$usr->akta_lahir}} </td>
            <td> {{$usr->agama}} </td>
            <td> {{$usr->kewarganegaraan}} </td>
            <td> {{$usr->negara}} </td>
            <td> {{$usr->anak_ke}} </td>
            <td> {{$usr->pekerjaan}} </td>
            <td> {{$usr->kip}} </td>
            <td> {{$usr->nook_pip}} </td>
        </tr> 
        @endforeach
    </tbody>
</body>
</html>
